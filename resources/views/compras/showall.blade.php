@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Compra </h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-8">
     {{-- Bar --}}
     <nav class="nav">
      <a class="nav-link" href="{{ route('compras.index') }}"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
      @php
      @endphp
      <a class="nav-link" href="{{ route('compras.edit', ['id' => $compra->first()->id]) }}" title="Editar"> <i class="fas fa-edit"></i> Editar</a>
    </nav>
    <div class="card">
      <div class="card-body">
        <div class="form-group row">
          <label for="staticCompra" class="col-sm-2 col-form-label">Compra Nº: </label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCompra" value="{{ sprintf("%'.06d\n", $compra->first()->id) }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticFecha" class="col-sm-2 col-form-label">Fecha: </label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticFecha" value="{{ $compra->first()->fecha }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticProveedor" class="col-sm-2 col-form-label">Proveedor: </label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticProveedor" value="{{ $compra->first()->proveedor->nombre }}">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticDocumento" class="col-sm-2 col-form-label">Documento: </label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticDocumento" value="{{ $compra->first()->documento }}">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    @if ($compra->first()->proveedor->retiene > 0)
    <div class="form-group row">
      <div class="col-sm-10 alert alert-info">
        <p class="text-info">Este cliente retiene el <span class="porcentaje">{{ ($compra->first()->proveedor->retiene) * 100 }}</span> del I.V.A.</p>
      </div>
    </div>
    @endif
    @if ($compra->first()->proveedor->isrl > 0)
    <div class="col-sm-10 alert alert-info">
      <p class="text-info">Este cliente retiene I.S.R.L.</p>
    </div>
    @endif
  </div>
</div>
<div class="row">
  <div class="col-md-12 mt-3">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Cantidad</th>
          <th>Producto</th>
          <th>Costo</th>
          <th>Sub-Total</th>
        </tr>
      </thead>
      @php
      {{ $sub = array(); }}
      @endphp
      <tbody>
        @foreach ($detalles as $element)
        <tr>
          <td class="text-center">{{ $element->cantidad }}</td>
          <td class="text-left text-uppercase">{{ $element->producto->nombre }}</td>
          <td class="moneda">{{ number_format($element->costo,2,",",".") }}</td>
          <td class="moneda">{{ number_format($sub[] = ($element->cantidad * $element->costo),2,",",".") }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-right">Sub-Total</td>
          <td class="moneda"> {{ number_format(array_sum($sub),2,",",".") }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-right">I.V.A. (<span class="porcentaje">{{ (\Config::get('constants.iva.electronico')) * 100 }}</span>)</td>
          <td class="moneda">
            @php
            {{ $iva = (\Config::get('constants.iva.electronico')) * array_sum($sub); }}
            @endphp
            {{ number_format($iva,2,",",".") }}
          </td>
        </tr>
        <tr>
          <td colspan="3" class="text-right">
            Total
            @php
            {{ $subtotal = array_sum($sub); }}
            @endphp
            @if ( ($subtotal + $iva) <> $compra[0]->total )
            <span class="text-warning" data-toggle="tooltip" data-placement="top" title="Totales no concuerdan"><sup><i class="fas fa-info-circle"></i></sup></span>
            @endif
          </td>
          <td class="moneda">
            {{  number_format($subtotal + $iva,2,",",".") }}
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
</div>

@endsection