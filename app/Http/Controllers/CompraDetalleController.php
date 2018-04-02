<?php

namespace App\Http\Controllers;

use App\Compra_detalle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Session;
use Alert;

class CompraDetalleController extends Controller
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
      $detalles = Compra_detalle::with('producto:id,nombre')->get();
      return view('compras_detalles.index', compact('detalles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id = Session::get('id'); //Id de la compra
      if ( !Session::get('finish') ) {
        session(['finish' => false]);
      }
      // $productos = \App\Producto::pluck('nombre','marca','id');
      $productos = \App\Producto::with('marca:id,nombre')->select('nombre','marca_id','id')->get();
      // dd($productos->toArray());
      foreach ($productos->toArray() as $index => $value) {
        // dd($value);
        $lista[$value['id']] = $value['nombre'].' - '.$value['marca']['nombre'];
      }
      sort($lista);
      return view('compras_detalles.create', compact('lista','id'));
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
        'compra_id' => 'required',
        'producto_id' => 'required',
        'lote' => 'nullable',
        'vence' => 'nullable',
        'cantidad' => 'required|min:1',
        'costo' => 'required'
      ]);

      // dd($request->all());

      /*$detalles = new Compra_detalle;
      $detalles->compra_id = $request->compra_id;
      $detalles->producto_id = $request->producto_id;
      $detalles->lote = $request->lote;
      $detalles->vence = $request->vence;
      $detalles->cantidad = $request->cantidad;
      $detalles->costo = $request->costo;
      $detalles->save();*/

      $detalles = Compra_detalle::create($request->except('_token'));
      alert()->success('Operacion exitosa','Producto agregado');
      $request->session()->flash('status', 'Producto agregado!');
      return redirect()->route('compras_detalles.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra_detalle  $compra_detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Compra_detalle $compra_detalle, $id)
    {
      $detalles = Compra_detalle::where('compra_id','=',$id)->with('producto:id,nombre')->get();
      return view('compras_detalles.show', compact('detalles','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra_detalle  $compra_detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra_detalle $compra_detalle,$id)
    {
      $detalles = Compra_detalle::where('compra_id',$id)->get();
      if(!$detalles->count() > 0){
        alert()->error('Compra sin detalles', 'ERROR')->persistent('Close');
        return redirect()->route('compras.index');
      }

      $productos = \App\Producto::with('marca:id,nombre')->select('nombre','marca_id','id')->get();
      // dd($productos->toArray());
      foreach ($productos->toArray() as $index => $value) {
        // dd($value);
        $lista[$value['id']] = $value['nombre'].' - '.$value['marca']['nombre'];
      }
      sort($lista);
      return view('compras_detalles.edit', compact('detalles','lista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra_detalle  $compra_detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra_detalle $compra_detalle)
    {
      // dump($request->post());
      $inputs = $request->except('_token','_method');
      $registro = collect();
      for ($i = 0; $i < count($inputs['id']) ; $i++) {

        $registro[] = [
          'id' => $inputs['id'][$i],
          'compra_id' => $inputs['compra_id'][$i],
          'producto_id' => $inputs['producto_id'][$i],
          'lote' => $inputs['lote'][$i],
          'vence' => $inputs['vence'][$i],
          'cantidad' => $inputs['cantidad'][$i],
          'costo' => $inputs['costo'][$i]
        ];
      }

      $registro->map(function( $item, $key ){
        $update = Compra_detalle::findOrFail($item['id']);
        $coleccion = collect($item);
        $update->producto_id = $coleccion['producto_id'];
        $update->lote = $coleccion['lote'];
        $update->vence = $coleccion['vence'];;
        $update->cantidad = $coleccion['cantidad'];
        $update->costo = $coleccion['costo'];
        $update->save();

      });

      alert()->success('Operacion exitosa','Registro actualizado')->autoclose(5000);
      return redirect()->route('compras_detalles.show',['id'=>$registro[0]['compra_id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra_detalle  $compra_detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra_detalle $compra_detalle)
    {
        //
    }
  }
