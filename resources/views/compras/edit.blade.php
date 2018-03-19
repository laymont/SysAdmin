@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Compra {{ sprintf("%'.06d\n", $compra->id) }} <small>Editar</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {!! Form::model($compra, ['method' => 'PATCH', 'route' => ['compras.update', $compra->id]]) !!}
      {!! Form::hidden('id', $compra->id, []) !!}
      {{-- fecha --}}
      <div class="form-group">
        {!! Form::label('fecga', 'Fecha', ['class'=>'control-label']) !!}
        {!! Form::date('fecha', $compra->fecha, ['class'=>'form-control col-md-5']) !!}
      </div>
      {{-- proveedor --}}
      <div class="form-group">
        {!! Form::label('proveedor_id', 'Proveedor', ['class'=>'control-label']) !!}
        {!! Form::select('proveedor_id', $proveedores, $compra->proveedor_id, ['class'=>'form-control col-md-5']) !!}
      </div>
      {{-- documento --}}
      <div class="form-group">
        {!! Form::label('documento', 'Documento', ['class'=>'control-label']) !!}
        {!! Form::text('documento', $compra->documento, ['class'=>'form-control col-md-5']) !!}
      </div>
      {{-- subtotal --}}
      <div class="form-group">
        {!! Form::label('subtotal', 'Sub-Total', ['class'=>'control-label']) !!}
        {!! Form::number('subtotal', $compra->subtotal, ['class'=>'form-control col-md-5','step'=>'any']) !!}
      </div>
      {{-- iva --}}
      <div class="form-group">
        {!! Form::label('iva', 'I.V.A.', ['class'=>'control-label']) !!}
        {!! Form::number('iva', $compra->iva, ['class'=>'form-control col-md-5','step'=>'any']) !!}
      </div>
      {{-- total --}}
      <div class="form-group">
        {!! Form::label('total', 'Total', ['class'=>'control-label']) !!}
        {!! Form::number('total', $compra->total, ['class'=>'form-control col-md-5','step'=>'any']) !!}
      </div>
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
$(function(){

})
</script>
@endsection