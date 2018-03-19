<?php

namespace App\Http\Controllers;

use App\Servidore;
use Illuminate\Http\Request;

class ServidoreController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('servidores.index');
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
        //
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
        //
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
