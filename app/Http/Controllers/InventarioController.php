<?php

namespace App\Http\Controllers;

use App\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
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
      $inventarios = Inventario::with('producto:id,nombre')
      ->where('cantidad','>',0)
      ->get();
      return view('inventarios.index', compact('inventarios'));
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
      $ids = $request->input('compra_id');

      foreach ($ids as $value) {
        $compraID = $value;
      }

      $inventario = new Inventario;
      $productos = $request->except('_token');
      $finalValues = collect();
      for ($i = 0; $i < count($productos['compra_id']) ; $i++) {
        $finalValues[] = [
          'compra_id' => $productos['compra_id'][$i],
          'producto_id' => $productos['producto_id'][$i],
          'lote' => $productos['lote'][$i],
          'vence' => $productos['vence'][$i],
          'cantidad' => $productos['cantidad'][$i],
          'costo' => $productos['costo'][$i],
          'base1' => $productos['base1'][$i],
          'base2' => $productos['base2'][$i],
          'base3' => $productos['base3'][$i],
          'ubicacion' => $productos['ubicacion'][$i]
        ];
      }

      $finalValues->map(function( $item, $key ){
        $registrar = new Inventario;
        $coleccion = collect($item);
        $registrar->compra_id = $item['compra_id'];
        $registrar->producto_id = $item['producto_id'];
        $registrar->lote = $item['lote'];
        $registrar->vence = $item['vence'];
        $registrar->cantidad = $item['cantidad'];
        $registrar->costo = $item['costo'];
        $registrar->base1 = $item['base1'];
        $registrar->base2 = $item['base2'];
        $registrar->base3 = $item['base3'];
        $registrar->ubicacion = $item['ubicacion'];
        $registrar->save();
      });

      $toinv = \App\Compra_detalle::where('compra_id', $compraID)
      ->update(['inventario'=>1]);

      alert()->success('Operacion Existosa','Compra registrada en Inventario');
      return redirect('/inventarios');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
  }
