<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Alert;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $proveedores = Proveedor::all();
      return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->merge(array('rif' => $request->rifl.'-'.substr($request->rifn, 0, -1).'-'.substr($request->rifn,-1)));

      $validatedData = $request->validate([
        'rifl' => 'required|max:1',
        'rifn' => 'required|min:9|max:9',
        'rif' => 'required|unique:proveedores,rif|max:12',
        'nombre' => 'required',
        'retiene' => 'required',
        'isrl' => 'nullable',
        'direccion' => 'required',
        'telefono' => 'required',
        'email' => 'nullable|email|unique:proveedores,email',
        'credito' => 'required',
        'dias' => 'required_unless:credito,Si|between:1,365'
      ]);

      $input = $request->except(['rifl','rifn']);
      // dd($input);
      /* Registrar Cliente */
      $proveedor = new Proveedor;
      // dd($input);
      $proveedor->rif = ucfirst($input['rif']);
      $proveedor->nombre = $input['nombre'];
      $proveedor->retiene = $input['retiene'];
      $proveedor->isrl = $input['isrl'];
      $proveedor->direccion = $input['direccion'];
      $proveedor->telefono = $input['telefono'];
      $proveedor->email = $input['email'];
      $proveedor->credito = $input['credito'];
      $proveedor->dias = $input['dias'];
      // dd($cliente);
      $proveedor->save();

      return redirect('/proveedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor, $id)
    {
      $proveedor = Proveedor::findOrFail($id);
      return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor,$id)
    {
      $proveedor = Proveedor::findOrFail($id);

      $request->merge(array('rif' => $request->rifl.'-'.substr($request->rifn, 0, -1).'-'.substr($request->rifn,-1)));
      /* Validar */
      $validatedData = $request->validate([
        'rifl' => 'bail|required|max:1',
        'rifn' => 'bail|required|min:9|max:9',
        /* Regla para revalidar el RIF */
        Rule::unique('proveedores', 'rif')
        ->where('rif', $proveedor->rif)
        ->ignore($proveedor->rif, 'rif'),
        /* Regla para revalidar el RIF */
        'nombre' => 'bail|required',
        'retiene' => 'required',
        'isrl' => 'nullable',
        'direccion' => 'bail|required',
        'telefono' => 'bail|required',
        /* Regla para revalidar el email */
        'email' => 'email|nullable',
        /* Regla para revalidar el email */
        'credito' => 'bail|required',
        'dias' => 'required'
      ]);
      $input = $request->except(['rifl','rifn']);
      $inputs = collect($input);
      $proveedor->update($inputs->all());

      // Alert::success('Success Message', 'Optional Title');
      alert()->success('Operación exitosa', 'Registro actualizado')->autoclose(30000);

      return redirect('/proveedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
  }
