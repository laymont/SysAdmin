@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Detalles <small>Compra #{{ sprintf("%'.09d\n", $detalles->first()->compra_id) }} | editar ({{ $detalles->count() }} Productos)</small> </h3>
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
      {!! Form::model($detalles, ['method' => 'PATCH', 'route' => ['compras_detalles.update', $detalles->first()->compra_id]]) !!}
      <div class="form-inline">
        @foreach ($detalles as $element)
        <div class="card" style="margin-bottom: 10px;">
          {!! Form::hidden('id[]', $element->id, []) !!}
          {!! Form::hidden('compra_id[]', $element->compra_id, []) !!}
          {{-- producto --}}
          <div class="form-group card-body {{ $errors->has('producto_id') ? 'has-error' : '' }}">
            {!! Form::label('producto_id', 'Producto', ['class'=>'control-label col-md-3']) !!}
            {!! Form::select('producto_id[]', $lista, $element->producto_id, ['class'=>'form-control col-md-8']) !!}
            {!! $errors->first('producto_id', '<p class="help-block text-danger">:message</p>') !!}
            <small id="producto_idHelp" class="form-text text-muted">&nbsp;</small>
          </div>
          {{-- lote --}}
          <div class="form-group card-body  {{ $errors->has('lote') ? 'has-error' : '' }}">
            {!! Form::label('lote', 'Lote', ['class'=>'control-label col-md-3']) !!}
            {!! Form::text('lote[]', $element->lote, ['class'=>'form-control col-md-5']) !!}
            {!! $errors->first('lote', '<p class="help-block text-danger">:message</p>') !!}
            <small id="loteHelp" class="form-text text-muted">&nbsp;</small>
          </div>
          {{-- vence --}}
          <div class="form-group card-body {{ $errors->has('vence') ? 'has-error' : '' }}">
            {!! Form::label('vence', 'Vence', ['class'=>'control-label col-md-3']) !!}
            {!! Form::date('vence[]', $element->vence, ['class'=>'form-control col-md-5']) !!}
            {!! $errors->first('vence', '<p class="help-block text-danger">:message</p>') !!}
            <small id="venceHelp" class="form-text text-muted">&nbsp;</small>
          </div>
          {{-- cantidad --}}
          <div class="form-group card-body {{ $errors->has('cantidad') ? 'has-error' : '' }}">
            {!! Form::label('cantidad', 'Cantidad', ['class'=>'control-label col-md-3']) !!}
            {!! Form::number('cantidad[]', $element->cantidad, ['class'=>'form-control col-md-5','min'=>'1']) !!}
            {!! $errors->first('cantidad', '<p class="help-block text-danger">:message</p>') !!}
            <small id="cantidadHelp" class="form-text text-muted">&nbsp;.</small>
          </div>
          {{-- costo --}}
          <div class="form-group card-body {{ $errors->has('costo') ? 'has-error' : '' }}">
            {!! Form::label('costo', 'Costo', ['class'=>'control-label col-md-3']) !!}
            {!! Form::number('costo[]', $element->costo, ['class'=>'form-control col-md-5']) !!}
            {!! $errors->first('costo', '<p class="help-block text-danger">:message</p>') !!}
            <small id="costoHelp" class="form-text text-muted">&nbsp;</small>
          </div>
        </div>
        @endforeach
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