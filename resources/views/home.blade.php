@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <main class="col-md-10 offset-md-1 justify-content-center" role="main">
    {{-- <h1>Inicio</h1> --}}
    <section class="row text-center placeholders">

      <div class="col-md-3">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <div>
              <i class="fas fa-bookmark fa-3x"></i>
            </div>
            <div>
              {{ $totalInv }} Productos!<br>
            </div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('inventarios.index') }}">
            <span class="float-left">Ver Inventario</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-success">
          <div class="card-body">
            <div>
              <i class="fas fas fa-file-alt fa-3x"></i>
            </div>
            <div>
              {{ $totalFac->count() }} Facturas!<br>
            </div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('facturas.index') }}">
            <span class="float-left">Ver Facturas</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-warning">
          <div class="card-body">
            <div>
              <i class="fas fa-money-bill-alt fa-3x"></i>
            </div>
            <div>0 Por Pagar!</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Ver Ctas. x Pagar</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-danger">
          <div class="card-body">
            <div>
              <i class="fas fa-dollar-sign fa-3x"></i>
            </div>
            <div>0 Por Cobrar!</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">Ver Ctas. x Cobrar</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>


    </section>
    <hr>
    <section class="row">

      <div class="col-md-6">
        <h3>Ultimas {{ $facturas->count() }} Facturas</h3>
        <table class="table table-striped table-bordered small">
          <caption>Facturas</caption>
          <thead class="bg-info text-white">
            <tr>
              <th>Numero</th>
              <th>Fecha</th>
              <th>Cliente</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($facturas as $element)
            <tr>
              <td>{{ $element->id }}</td>
              <td>{{ $element->fecha }}</td>
              <td><sup>{{ $element->cliente->rif }}</sup><br>{{ $element->cliente->nombre }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
        <h3>Ventas <small>Año</small></h3>
        <div class="card">
          <div class="card-header"> Ventas <i class="fas fa-chart-bar"></i></div>
          <div class="card-body">
            {!! $chartjs->render() !!}
          </div>
          <div class="card-footer">Actualizado {{ \Illuminate\Support\Carbon::now('America/Caracas') }}</div>
        </div>
      </div>


    </section>
  </main>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/Chart.min.js') }}" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    Chart.defaults.global.scaleLabel = "<%=parseInt(value).toLocaleString()%>";
    Chart.defaults.global.tooltipTemplate = "<%if (label){%><%=label%>: <%}%><%=value.toLocaleString()%>";
  });
</script>
@endsection