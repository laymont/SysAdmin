<?php

namespace App\Http\Controllers;

use App\Ctapagar;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class CtapagarController extends Controller
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
      $ctapagar = Ctapagar::all();
      return view('admins.ctapagar.index', compact('ctapagar'));
    }

    public function pagarCta(Request $request, $compra)
    {
      $compraPagar = \App\Compra::findOrFail($compra);
      $referencia = 'C'.'-'.str_pad($compraPagar->id,10,0, STR_PAD_LEFT).'-'.str_replace('-','',$compraPagar->fecha).'P'.$compraPagar->proveedor_id.'-'.$compraPagar->documento;

      $datos = collect(['referencia' => $referencia]);

      $messages = [
        'unique' => 'Esta cuenta ya fue pagada.',
      ];

      $validator = Validator::make($datos->all(), [
        'referencia' => 'required|unique:ctapagars,referencia',
      ], $messages);

      if ($validator->fails()) {
        return redirect('compras')
        ->withErrors($validator);
      }

      $ctapagar = new Ctapagar;
      $ctapagar->fecha = $compraPagar->fecha;
      $ctapagar->referencia = $referencia;
      $ctapagar->tipo = 'Proveedores';
      $ctapagar->observacion = null;
      $ctapagar->monto = $compraPagar->total;
      $ctapagar->abono = 'No';
      $ctapagar->fecha_abono = \Illuminate\Support\Carbon::now();
      $ctapagar->banco_id = 0;
      $ctapagar->movimiento = 'Transferencia';
      $ctapagar->pagada = 1;
      $ctapagar->save();
      return redirect()->route('admins.ctapagar.pagarcomplete', [$ctapagar->id]);
    }

    public function completeCtapagar($id)
    {
      $ctapagar = Ctapagar::findOrFail($id);
      return view('admins.ctapagar.pagarcomplete', compact('ctapagar'));
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
     * @param  \App\Ctapagar  $ctapagar
     * @return \Illuminate\Http\Response
     */
    public function show(Ctapagar $ctapagar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ctapagar  $ctapagar
     * @return \Illuminate\Http\Response
     */
    public function edit(Ctapagar $ctapagar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ctapagar  $ctapagar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ctapagar $ctapagar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ctapagar  $ctapagar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ctapagar $ctapagar)
    {
        //
    }
  }
