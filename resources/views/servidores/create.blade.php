@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Servidores <small>nuevo</small></h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {!! Form::open(['route'=>'servidores.store','method'=>'POST']) !!}
      {{-- Tipo --}}
      <div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
        {!! Form::label('tipo', 'Tipo', ['class'=>'control-label']) !!}
        {!! Form::select('tipo', [1=>'Vendedor'], null, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione']) !!}
        {!! $errors->first('tipo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="tipoHelp" class="form-text text-muted">Tipo de Servidor.</small>
      </div>
      {{-- Indentificacion --}}
      <div class="form-group {{ $errors->has('identificacion') ? 'has-error' : '' }}">
        {!! Form::label('identificacion', 'Identificación', ['class'=>'control-label']) !!}
        {!! Form::text('identificacion', null, ['class'=>'form-control col-md-5','placeholder'=>'Identificacion Unica']) !!}
        {!! $errors->first('identificacion', '<p class="help-block text-danger">:message</p>') !!}
        <small id="identificacionHelp" class="form-text text-muted">Identificación (Ej. C.I.).</small>
      </div>
      {{-- Nombre --}}
      <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::text('nombre', null, ['class'=>'form-control col-md-5','placeholder'=>'Nombre descriptivo']) !!}
        {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
        <small id="nombreHelp" class="form-text text-muted">Nombre del Servidor.</small>
      </div>
      {{-- Porcentaje --}}
      <div class="form-group {{ $errors->has('porcentaje') ? 'has-error' : '' }}">
        {!! Form::label('porcentaje', 'Porcentaje', ['class'=>'control-label']) !!}
        {!! Form::number('porcentaje', null, ['class'=>'form-control col-md-5','placeholder'=>'Indique el porcentaje %','step'=>'0.01']) !!}
        {!! $errors->first('porcentaje', '<p class="help-block text-danger">:message</p>') !!}
        <small id="porcentajeHelp" class="form-text text-muted">Indique el Porcentaje para el Servidor.</small>
      </div>
      {{-- Monto --}}
      <div class="form-group {{ $errors->has('monto') ? 'has-error' : '' }}">
        {!! Form::label('monto', 'Monto', ['class'=>'control-label']) !!}
        {!! Form::number('monto', 0.00, ['class'=>'form-control col-md-5','placeholder'=>'Monto fijo','step'=>'0.01']) !!}
        {!! $errors->first('monto', '<p class="help-block text-danger">:message</p>') !!}
        <small id="montoHelp" class="form-text text-muted">Indique si tiene un monto fijo.</small>
      </div>
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/servidores') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection