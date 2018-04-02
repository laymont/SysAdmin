<?php

namespace App\Http\Controllers;

use App\Servidore;
use Illuminate\Http\Request;
use Alert;
use Validator;
use Illuminate\Validation\Rule;

class ServidoreController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
  public function __construct()
  {
    $this->middleware('auth:web');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $servidores = Servidore::all();
      return view('servidores.index', compact('servidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('servidores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $messages = [
        'unique' => 'Identificación en uso.',
      ];

      $validator = Validator::make($request->all(), [
        'tipo' => 'required',
        'identificacion' => 'required|unique:servidores,identificacion',
        'nombre' => 'required',
        'porcentaje' => 'required',
        'monto' => 'required',
      ], $messages);

      if ($validator->fails()) {
        return redirect('servidores')
        ->withErrors($validator);
      }

      $servidor = Servidore::create($request->except('_token'));
      alert()->success('Operacion exitosa','Registro creado');
      return redirect('servidores');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servidore  $servidore
     * @return \Illuminate\Http\Response
     */
    public function show(Servidore $servidore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servidore  $servidore
     * @return \Illuminate\Http\Response
     */
    public function edit(Servidore $servidore)
    {
      $servidor = Servidore::findOrFail($servidore->id);
      return view('servidores.edit', compact('servidor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servidore  $servidore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servidore $servidore)
    {
     $messages = [
      'unique' => 'Identificación en uso.',
    ];

    $validator = Validator::make($request->all(), [
      'tipo' => 'required',
      'identificacion' => 'required|unique:servidores,identificacion,' . $servidore->id,
      'nombre' => 'required',
      'porcentaje' => 'required',
      'monto' => 'required',
    ], $messages);

    if ($validator->fails()) {
      return redirect('servidores')
      ->withErrors($validator);
    }

    $servidor = Servidore::findOrFail($servidore->id);
    $servidor->update($request->except('_token','_method'));
    // dd( count($servidor->getChanges()) );
    if ( count($servidor->getChanges()) > 0 ) {
      alert()->success('Operacion exitosa','Registro Actualizado');
      return redirect('servidores');
    }else {
      alert()->warning('Sin acciones','No se ejecuto ninguna accion sobre los datos');
      return redirect('servidores');
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servidore  $servidore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servidore $servidore)
    {
        //
    }
  }
