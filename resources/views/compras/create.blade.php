@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Compras <small>nueva</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {!! Form::open(['route' => 'compras.store']) !!}
      {{-- fecha --}}
      <div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
        {!! Form::label('fecha', 'Fecha', ['class'=>'control-label']) !!}
        {!! Form::date('fecha', \Illuminate\Support\Carbon::now(), ['class'=>'form-control col-md-4']) !!}
        {!! $errors->first('fecha', '<p class="help-block text-danger">:message</p>') !!}
        <small id="fechaHelp" class="form-text text-muted">Fecha de la Factura de compra.</small>
      </div>
      {{-- Proveedor --}}
      <div class="form-group {{ $errors->has('proveedor_id') ? 'has-error' : '' }}">
        {!! Form::label('proveedor_id', 'Proveedor', ['class'=>'control-label']) !!}
        {!! Form::select('proveedor_id', $proveedores, null, ['class'=>'form-control col-md-4','placeholder'=>'Seleccion/Proveedor']) !!}
        {!! $errors->first('proveedor_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="proveedor_idHelp" class="form-text text-muted">Proveedor de la compra.</small>
      </div>
      {{-- Documento --}}
      <div class="form-group {{ $errors->has('documento') ? 'has-error' : '' }}">
        {!! Form::label('documento', 'Documento', ['class'=>'control-label']) !!}
        {!! Form::number('documento', null, ['class'=>'form-control col-md-4','placeholder'=>'Factura de compra' ]) !!}
        {!! $errors->first('documento', '<p class="help-block text-danger">:message</p>') !!}
        <small id="documentoHelp" class="form-text text-muted">Factura de la compra.</small>
      </div>
      {{-- Sub total --}}
      <div class="form-group {{ $errors->has('subtotal') ? 'has-error' : '' }}">
        {!! Form::label('subtotal', 'Subtotal', ['class'=>'control-label']) !!}
        {!! Form::number('subtotal', null, ['class'=>'form-control col-md-4','placeholder'=>'Sub-Total de la factura', 'step'=>'0.01']) !!}
        {!! $errors->first('subtotal', '<p class="help-block text-danger">:message</p>') !!}
        <small id="subtotalHelp" class="form-text text-muted">Subtotal de la compra.</small>
      </div>
      {{-- iva --}}
      <div class="form-group {{ $errors->has('iva') ? 'has-error' : '' }}">
        {!! Form::label('iva', 'I.V.A.', ['class'=>'control-label']) !!}
        {!! Form::number('iva', null, ['class'=>'form-control col-md-4','placeholder'=>'IVA de la factura','step'=>'0.01']) !!}
        {!! $errors->first('iva', '<p class="help-block text-danger">:message</p>') !!}
        <small id="ivaHelp" class="form-text text-muted">IVA ({{ Config::get('constants.iva.electronico') }}) de la compra.</small>
      </div>
      {{-- total --}}
      <div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
        {!! Form::label('total', 'Total', ['class'=>'control-label']) !!}
        {!! Form::number('total', null, ['class'=>'form-control col-md-4','placeholder'=>'Total de la factura','step'=>'0.01']) !!}
        {!! $errors->first('total', '<p class="help-block text-danger">:message</p>') !!}
        <small id="totalHelp" class="form-text text-muted">Total de la compra.</small>
      </div>
      {{-- pago --}}
      <div class="form-group {{ $errors->has('pago') ? 'has-error' : '' }}">
        <div class="form-inline">
          {!! Form::label('pago', 'Pago', ['class'=>'control-label']) !!}
          {!! Form::checkbox('pago', 1, true, ['class'=>'form-control col-md-1']) !!}
        </div>
        {!! $errors->first('pago', '<p class="help-block text-danger">:message</p>') !!}
        <small id="pagoHelp" class="form-text text-muted">La compra esta paga por defecto, no tilde si no esta paga.</small>
      </div>
      {{-- submit --}}
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/compras') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#subtotal').blur(function(){
      $subtotal = $('#subtotal').val();
      $iva = parseFloat( $('#subtotal').val() * {{ Config::get('constants.iva.electronico') }} );
      $total = parseFloat($subtotal)  + parseFloat($iva);
      $('#iva').val($iva);
      $('#total').val($total);
    })
  })
</script>
@endsection