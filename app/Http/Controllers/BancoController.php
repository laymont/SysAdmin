<?php

namespace App\Http\Controllers;

use App\Banco;
use Illuminate\Http\Request;
use Alert;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cuentas = Banco::all();
      return view('bancos.index', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $codigos = collect(\Config::get('constants.bancos'));
      $codigos = $codigos->pluck('nombre','id');
      return view('bancos.create', compact('codigos'));
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
        'nombre' => 'required|max:255',
        'codigo' => 'required|max:4',
        'cuenta' => 'required|min:20|max:20',
        'tipo' => 'required',
        'saldo' => 'nullable'
      ]);

      $cuenta = new Banco;
      $cuenta->nombre = $request->nombre;
      $cuenta->codigo = $request->codigo;
      $cuenta->cuenta = $request->cuenta;
      $cuenta->tipo = $request->tipo;
      $cuenta->saldo = $request->saldo;
      $cuenta->save();
      alert()->success('Operacion exitosa','Registro creado')->autoclose('2000');
      return redirect('bancos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
      $codigos = collect(\Config::get('constants.bancos'));
      $codigos = $codigos->pluck('nombre','id');
      return view('bancos.edit', compact('banco','codigos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
      dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        //
    }
}
