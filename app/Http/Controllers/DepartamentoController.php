<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use Illuminate\Validation\Rule;
use Alert;


class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $departamentos = Departamento::all();
      return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'nombre' => 'required|min:4',
        'descripcion' => 'nullable',
      ]);

      Departamento::insert($request->except(['_token']));
      alert()->success('Operación exitosa', 'Registro ingresado')->autoclose(30000);
      return redirect('departamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $departamento = Departamento::findOrFail($id);
      return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validatedData = $request->validate([
        'nombre' => 'required|min:4',
        'descripcion' => 'nullable',
      ]);

      $departamento = Departamento::findOrFail($id);
      $departamento->update($request->all());
      alert()->success('Operación exitosa', 'Registro actualizado');
      return redirect('departamentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
