<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Alert;
use DB;

class AdminController extends Controller
{
  /* Mover compra a Inventario */
  public function toinv($compra_id)
  {
    /*$productos = \App\Compra_detalle::DB('compras_detalles')->where('compra_id',$compra_id)->get();*/
    $productos = DB::table('compras_detalles')
    ->join('productos','compras_detalles.producto_id','=','productos.id')
    ->where('compra_id', $compra_id)
    ->select('compra_id','producto_id','productos.nombre','compras_detalles.lote','compras_detalles.vence','compras_detalles.cantidad','compras_detalles.costo')->get();
    if ($productos->count() > 0) {
      return view('inventarios/toinv', compact('productos'));
    }
  }

  public function listaprecios()
  {
    $precios = \App\Inventario::with('producto:id,nombre')->get();
    return view('inventarios.precios', compact('precios'));
  }
}
