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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        'deparmento_id' => 'required',
        'nombre' => 'required|min:4',
        'marca_id' => 'required',
        'presentacion' => 'required',
        'descripcion' => 'nullable',
        'exento' => 'required',
        'min' => 'required|min:1',
        'max' => 'required|min:1'
      ]);

      dd($request->all());
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
