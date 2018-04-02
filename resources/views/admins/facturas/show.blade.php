@extends('layouts.invoice')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h6 class="card-title">Cliente</h6>
        </div>
        <div class="card-body">
          <p>Nombre o Razón Social: <span class="ml-1"> {{ $facturaVer->cliente->nombre }}</span></p>
          <p>R.I.F.: <span class="ml-1"> {{ $facturaVer->cliente->rif }}</span></p>
          <p>Dirección: <span class="ml-1 small">{{ $facturaVer->cliente->direccion }}</span></p>
          <p>Teléfonos: <span class="ml-1">{{ $facturaVer->cliente->telefono }}</span></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h6 class="card-title">Factura</h6>
        </div>
        <div class="card-body">
          <p>Numero #<span class="ml-1 text-danger font-weight-bold"> {{ str_pad($facturaVer->id, 10, "0", STR_PAD_LEFT) }}</span></p>
          <p>Fecha: <span class="ml-1"> {{ $facturaVer->fecha }}</span></p>
          <p class="text-info small">Copia si derecho a Crédito Fiscal</p>
        </div>
      </div>
    </div>
  </div>
  {{-- cuerpo de la factura --}}
  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="row">
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th>Cant.</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Sub-Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($detalles as $element)
            <tr>
              <td class="text-center">{{ $element->cantidad }} @php {{ ++ $linea; }} @endphp</td>
              <td class="w-50">
                {{ $element->producto }}<br>
                <small class="font-weight-bold">{{ $element->marca }} &nbsp;&nbsp;{{ $element->presentacion }}</small>
              </td>
              <td class="moneda">{{ number_format($element->precio,2,",",".") }}</td>
              <td class="moneda">
                @php
                $sbtt[] = (['subt'=>$element->cantidad * $element->precio]);
                @endphp
                {{ number_format($element->cantidad * $element->precio,2,",",".") }}
              </td>
            </tr>
            @endforeach
            {{-- Completar lineas --}}
            @for ($i = 0; $i < ( Config::get('constants.doclineas') - $linea) ; $i++)
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            @endfor
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2"></td>
              <td class="text-right">Sub-Total</td>
              <td class="moneda">{{ number_format($sbtt->sum('subt'),2,",",".") }}</td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td class="text-right">I.V.A ({{ Config::get('constants.iva.electronico') * 100 }}%)</td>
              <td class="moneda">{{ number_format($sbtt->sum('subt') * Config::get('constants.iva.electronico'),2,",",".") }}</td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td class="text-right">Exento</td>
              <td class="moneda">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td class="text-right">Total</td>
              <td class="moneda">{{ number_format( $sbtt->sum('subt') + ($sbtt->sum('subt') * Config::get('constants.iva.electronico')) ,2,",",".") }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection