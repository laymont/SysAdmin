<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Alert;
use DB;

class FacturaController extends Controller
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
      $facturas = Factura::where('anulada',0)->with('cliente:id,rif,nombre','servidore:id,nombre','factura_detalles:factura_id,cantidad,precio')->get()->sortByDesc('id');
      return view('admins.facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clientes = \App\Cliente::pluck('nombre','id');
      $servidores = \App\Servidore::pluck('nombre','id');
      $productos = DB::table('inventarios')
      ->join('productos','inventarios.producto_id','=','productos.id')
      ->join('marcas','productos.marca_id','=','marcas.id')
      ->selectRaw('inventarios.id,CONCAT(productos.nombre," | ",marcas.nombre, " | ", productos.presentacion) AS `producto`')
      ->where('inventarios.cantidad','>',0)
      ->orderBy('producto','ASC')
      ->get();
      $listadoProductos = $productos->pluck('producto','id');
      $numero = Factura::all();
      $numero_factura = $numero->sortByDesc('id')->first()->id;
      return view('admins.facturas.create', compact('clientes','servidores','listadoProductos','numero_factura'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
      $facturaVer = Factura::with('cliente')->findOrFail($factura->id);
      $detalles = DB::table('factura_detalles')
      ->join('inventarios','factura_detalles.inventario_id','=','inventarios.id')
      ->join('productos','inventarios.producto_id','=','productos.id')
      ->join('marcas','productos.marca_id','=','marcas.id')
      ->where('factura_detalles.factura_id',$factura->id)
      ->selectRaw('factura_detalles.cantidad, productos.nombre AS `producto`, marcas.nombre AS `marca`, productos.presentacion,productos.descripcion, productos.exento, factura_detalles.precio')
      ->get();
      $linea = 0;
      $sbtt = collect();

      return view('admins.facturas.show', compact('facturaVer','detalles','linea','sbtt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
      return "hola mundo";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
  }
