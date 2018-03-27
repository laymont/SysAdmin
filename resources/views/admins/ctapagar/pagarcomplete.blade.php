@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h3>Pagar <small>Complete los datos</small></h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {!! Form::model($ctapagar, []) !!}
      <div class="form-group {{ $errors->has('fecha') ? 'has-error' : '' }}">
        {!! Form::label('fecha', 'Fecha', ['class'=>'control-label']) !!}
        {!! Form::date('fecha', $ctapagar->fecha, ['class'=>'form-control col-md-5','readonly']) !!}
        {!! $errors->first('fecha', '<p class="help-block text-danger">:message</p>') !!}
        <small id="fechaHelp" class="form-text text-muted">Fecha de la Factura.</small>
      </div>

      <div class="form-group {{ $errors->has('referencia') ? 'has-error' : '' }}">
        {!! Form::label('referencia', 'Referencia', ['class'=>'control-label']) !!}
        {!! Form::text('referencia', $ctapagar->referencia, ['class'=>'form-control col-md-5','readonly']) !!}
        {!! $errors->first('referencia', '<p class="help-block text-danger">:message</p>') !!}
        <small id="referenciaHelp" class="form-text text-muted">Numero de Referencia.</small>
      </div>

      <div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
        {!! Form::label('tipo', 'Tipo', ['class'=>'control-label']) !!}
        {!! Form::text('tipo', $ctapagar->tipo, ['class'=>'form-control col-md-5','readonly']) !!}
        {!! $errors->first('tipo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="tipoHelp" class="form-text text-muted">Tipo Acreedor.</small>
      </div>

      <div class="form-group {{ $errors->has('observacion') ? 'has-error' : '' }}">
        {!! Form::label('observacion', 'Observacion', ['class'=>'control-label']) !!}
        {!! Form::textarea('observacion', $ctapagar->observacion, ['class'=>'form-control col-md-5','size'=>'30x3']) !!}
        {!! $errors->first('observacion', '<p class="help-block text-danger">:message</p>') !!}
        <small id="observacionHelp" class="form-text text-muted">Observaciones.</small>
      </div>

      <div class="form-group {{ $errors->has('monto') ? 'has-error' : '' }}">
        {!! Form::label('monto', 'Monto', ['class'=>'control-label']) !!}
        {!! Form::number('monto', $ctapagar->monto, ['class'=>'form-control col-md-5 money','step'=>'0.01']) !!}
        {!! $errors->first('monto', '<p class="help-block text-danger">:message</p>') !!}
        <small id="montoHelp" class="form-text text-muted">Monto total pagado.</small>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection