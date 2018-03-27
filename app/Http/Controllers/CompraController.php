<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
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
      $compras = Compra::with('proveedor:id,nombre')->get()->sortByDesc('fecha');
      return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $proveedores = \App\Proveedor::pluck('nombre','id');
      return view('compras.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $validar = $request->validate([
        'fecha' => 'required',
        'proveedor_id' => 'required',
        'documento' => 'required',
        'subtotal' => 'required',
        'iva' => 'required',
        'total' => 'required',
        'pago' => 'nullable'
      ]);
      $compra = Compra::create($request->except('_token'));
      session(['id' => $compra->id]);
      return redirect()->route('compras_detalles.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    public function showAll(Request $request)
    {
      /* Informacion de la compra */
      $compra = Compra::with('compra_detalle')->where('id', $request->input('compra_id'))->get();
      /* Detalles de la compra */
      $detalles = \App\Compra_detalle::with('producto:id,nombre,marca_id,presentacion')
      ->where('compra_id', $request->input('compra_id'))
      ->get();
      return view('compras.showall', compact('compra','detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
      $proveedores = \App\Proveedor::pluck('nombre','id');
      return view('compras.edit', compact('compra','proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        $compra->fecha = $request->fecha;
        $compra->proveedor_id = $request->proveedor_id;
        $compra->documento = $request->documento;
        $compra->subtotal = $request->subtotal;
        $compra->iva = $request->iva;
        $compra->total = $request->total;
        $compra->save();

        alert()->success('Operacion exitosa','Registro actualizado')->autoclose('5000');
        return redirect('/compras');
    }

    public function anular(Request $request, Compra $compra)
    {
      $compra->update(['nula' => 1]);
      alert()->success('Operacion exitosa','Compra Anulada')->autoclose('2000');
      return redirect('compras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
      $detalles = \App\Compra_detalle::findOrFail($compra->id);
      if ($detalles->count() > 0) {
        alert()->error('No se puede eliminar una compra que posee registros en el Inventario','Imposible Eliminar')->autoclose('5000');
        return redirect('compras');
      }
      $eliminar = Compra::findOrFail($compra->id);
      $eliminar->delete();
      alert()->success('Operación exitosa', 'Registro eliminado')->autoclose(2000);
      return redirect('compras');
    }
}
