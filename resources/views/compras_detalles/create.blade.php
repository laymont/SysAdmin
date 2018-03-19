@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Detalles <small>Compra nueva</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      @if (Session::get('status'))
      <div class="alert alert-info" role="alert">
        {{ Session::get('status') }}
      </div>
      @endif
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      {!! Form::open(['route'=>'compras_detalles.store']) !!}
      {{-- compra --}}
      <div class="form-group {{ $errors->has('compra_id') ? 'has-error' : '' }}">
        {!! Form::label('compra_id', 'Compra', ['class'=>'control-label']) !!}
        {!! Form::number('compra_id', $id, ['class'=>'form-control col-md-4','readonly'=>'true']) !!}
        {!! $errors->first('compra_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="compra_idHelp" class="form-text text-muted">ID de la compra.</small>
      </div>
      {{-- producto --}}
      <div class="form-group {{ $errors->has('producto_id') ? 'has-error' : '' }}">
        {!! Form::label('producto_id', 'Producto', ['class'=>'control-label']) !!}
        {!! Form::select('producto_id', $lista, null, ['class'=>'form-control col-md-4', 'placeholder'=>'Seleccione']) !!}
        {!! $errors->first('producto_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="producto_idHelp" class="form-text text-muted">Seleccione el Producto.</small>
      </div>
      {{-- lote --}}
      <div class="form-group {{ $errors->has('lote') ? 'has-error' : '' }}">
        {!! Form::label('lote', 'Lote', ['class'=>'control-label']) !!}
        {!! Form::text('lote', null, ['class'=>'form-control col-md-4','placeholder'=>'Lote del Producto']) !!}
        {!! $errors->first('lote', '<p class="help-block text-danger">:message</p>') !!}
        <small id="loteHelp" class="form-text text-muted">Indentifique el lote del producto.</small>
      </div>
      {{-- vence --}}
      <div class="form-group {{ $errors->has('vence') ? 'has-error' : '' }}">
        {!! Form::label('vence', 'Vence', ['class'=>'control-label']) !!}
        {!! Form::date('vence', null, ['class'=>'form-control col-md-4','placeholder'=>'Fecha de vencimiento']) !!}
        {!! $errors->first('vence', '<p class="help-block text-danger">:message</p>') !!}
        <small id="venceHelp" class="form-text text-muted">Indique fecha de vencimiento.</small>
      </div>
      <div class="form-group {{ $errors->has('cantidad') ? 'has-error' : '' }}">
        {!! Form::label('cantidad', 'Cantidad', ['class'=>'control-label']) !!}
        {!! Form::number('cantidad', null, ['class'=>'form-control col-md-4','min'=>'1','placeholder'=>'Indique la cantidad']) !!}
        {!! $errors->first('cantidad', '<p class="help-block text-danger">:message</p>') !!}
        <small id="cantidadHelp" class="form-text text-muted">Indique la cantidad (Compra).</small>
      </div>
      <div class="form-group {{ $errors->has('costo') ? 'has-error' : '' }}">
        {!! Form::label('costo', 'Costo', ['class'=>'control-label']) !!}
        {!! Form::number('costo', null, ['class'=>'form-control col-md-4','min'=>'1','placeholder'=>'Costo neto del producto','step'=>'0.01']) !!}
        {!! $errors->first('costo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="costoHelp" class="form-text text-muted">Indique el costo neto del producto.</small>
      </div>
      {{-- submit --}}
      <div class="form-group">
        {{ Form::button('<i class="fas fa-cart-plus fa-2x"></i>', ['type' => 'submit','value'=>'loop', 'class' => 'btn btn-lg btn-primary','title'=>'Agregar otro producto'] )  }}
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a name="fin" id="fin" href="#" title="Finalizar la compra" class="btn btn-lg btn-success"><i class="fas fa-check fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('#fin').click(function(e){
      e.preventDefault();
      $confirmado = confirm('Desea Finalizar el registro de compras');
      if($confirmado == true){
        window.location.href=('/compras');
      }
    })
  })
</script>
@endsection