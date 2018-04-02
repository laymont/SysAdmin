<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $request->user()->authorizeRoles(['user', 'admin','superuser']);
      /* Total facturado mes actual */
      $totalInv = \App\Inventario::where('cantidad','>',0)->count();
      $totalFac = \App\Factura::where('anulada',0)->get();
      $facturas = \App\Factura::where('anulada',0)->with('cliente:id,rif,nombre','servidore:id,nombre')->get()->sortByDesc('id')->take(5);
      /* Grafico */
      DB::statement("SET lc_time_names = 'es_VE'");
      $dataGraph = DB::table('factura_detalles')
      ->selectRaw('UPPER(MONTHNAME(facturas.fecha)) AS `mes`, YEAR(facturas.fecha) AS `ano`, SUM(factura_detalles.cantidad * factura_detalles.precio) AS `total`')
      ->join('facturas','factura_detalles.factura_id','=','facturas.id')
      ->whereRaw('YEAR(facturas.fecha) = "2018"')
      ->groupBy(DB::raw('MONTH(facturas.fecha)'))
      ->orderByRaw('MONTH(facturas.fecha) ASC')
      ->get();

      $meses = array();
      $totales = array();
      foreach ($dataGraph as $value) {
        $meses[] = $value->mes;
        $totales[] = $value->total;
      }
      $chartjs = app()->chartjs
      ->name('lineChartTest')
      ->type('line')
      ->size(['width' => 400, 'height' => 200])
      ->labels($meses)
      ->datasets([
        [
          "label" => "Ventas",
          'backgroundColor' => "rgba(38, 185, 154, 0.31)",
          'borderColor' => "rgba(38, 185, 154, 0.7)",
          "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
          "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
          "pointHoverBackgroundColor" => "#fff",
          "pointHoverBorderColor" => "rgba(220,220,220,1)",
          "data" => $totales,
        ]/*,
        [
          "label" => "My Second dataset",
          'backgroundColor' => "rgba(38, 185, 154, 0.31)",
          'borderColor' => "rgba(38, 185, 154, 0.7)",
          "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
          "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
          "pointHoverBackgroundColor" => "#fff",
          "pointHoverBorderColor" => "rgba(220,220,220,1)",
          'data' => [12, 33, 44, 44, 55, 23, 40],
        ]*/
      ])
      ->options([]);

      return view('home', compact('totalInv','totalFac','facturas','chartjs'));
    }

    /*
    public function someAdminStuff(Request $request)
    {
      $request->user()->authorizeRoles(‘admin’);

      return view(‘some.view’);
    }
    */
  }
