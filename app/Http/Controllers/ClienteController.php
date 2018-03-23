<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Validation\Rule;
use Alert;

class ClienteController extends Controller
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
      $clientes = Cliente::all();
      return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('clientes.create');
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
        'rif' => 'required|unique:clientes,rif|max:12',
        'nombre' => 'required',
        'retiene' => 'required',
        'isrl' => 'nullable',
        'direccion' => 'required',
        'telefono' => 'required',
        'email' => 'nullable|email|unique:clientes,email',
        'credito' => 'required',
        'dias' => 'required_unless:credito,Si|between:1,365'
      ]);

      $input = $request->except(['rifl','rifn']);
      // dd($input);
      /* Registrar Cliente */
      $cliente = new Cliente;
      // dd($input);
      $cliente->rif = ucfirst($input['rif']);
      $cliente->nombre = $input['nombre'];
      $cliente->retiene = $input['retiene'];
      $cliente->isrl = $input['isrl'];
      $cliente->direccion = $input['direccion'];
      $cliente->telefono = $input['telefono'];
      $cliente->email = $input['email'];
      $cliente->credito = $input['credito'];
      $cliente->dias = $input['dias'];
      // dd($cliente);
      $cliente->save();

      return redirect('clientes');
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
      $cliente = Cliente::findOrFail($id);
      return view('clientes.edit', compact('cliente'));
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

      $cliente = Cliente::findOrFail($id);

      $request->merge(array('rif' => $request->rifl.'-'.substr($request->rifn, 0, -1).'-'.substr($request->rifn,-1)));
      /* Validar */
      $validatedData = $request->validate([
        'rifl' => 'bail|required|max:1',
        'rifn' => 'bail|required|min:9|max:9',
        /* Regla para revalidar el RIF */
        Rule::unique('clientes', 'rif')
        ->where('rif', $cliente->rif)
        ->ignore($cliente->rif, 'rif'),
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
      $cliente->update($inputs->all());

      // Alert::success('Success Message', 'Optional Title');
      alert()->success('Operación exitosa', 'Registro actualizado')->autoclose(30000);

      return redirect('/clientes');
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
