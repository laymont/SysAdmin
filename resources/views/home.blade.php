@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card text-center">
        <div class="card-header">
          SysAdmin <small>v2.0</small>
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif
          <h5 class="card-title">Sistema de Administración, Ventas e Inventario</h5>
          <p class="card-text">Version en Desarrollo.</p>
          {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
        <div class="card-footer text-muted">
          Estimado: 2018-05-14
        </div>
      </div>
    </div>
  </div>
</div>
@endsection