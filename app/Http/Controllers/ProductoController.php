<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Alert;
use App\Departamento;
use App\Marca;


class ProductoController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productos = Producto::with('departamento:id,nombre','marca:id,nombre')->get();

      return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $departamentos = Departamento::pluck('nombre','id');
      $marcas = Marca::pluck('nombre','id');
      return view('productos.create', compact('departamentos','marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validar = $request->validate([
        'departamento_id' => 'bail|required',
        'nombre' => 'bail|required|unique:productos',
        'marca_id' => 'bail|required',
        'presentacion' => 'bail|required',
        'descripcion' => 'nullable',
        'exento' => 'required',
        'min' => 'required|min:1',
        'max' => 'required|min:1'
      ]);
      $producto = Producto::create($request->except('_token'));
      alert()->success('Operacion exitosa','Registro Creado');
      return redirect('/productos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
      $productos = Producto::findOrFail($producto->id);
      $departamentos = Departamento::pluck('nombre','id');
      $marcas = Marca::pluck('nombre','id');

      return view('productos.edit', compact('productos','departamentos','marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
      $validatedData = $request->validate([
        'nombre' => 'bail|required|min:4',
        'presentacion' => 'bail|required',
        'min' => 'bail|required|min:1',
        'max' => 'bail|required|min:1'
      ]);

      $update = Producto::findOrFail($producto->id);
      $update->update($request->all());
      alert()->success('Operacion exitosa', 'Registro actualizado');
      return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
      $productos = Producto::findOrFail($producto->id);
      $productos->delete();
      alert()->success('Operación exitosa', 'Registro eliminado');
      return redirect('productos');
    }
  }
