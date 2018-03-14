@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3>Editar Proveedor</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      {!! Form::model($proveedor, ['method' => 'PATCH', 'route' => ['proveedores.update', $proveedor->id]]) !!}
      {{-- RIF --}}
      <div class="form-group {{ $errors->has('rif') ? 'has-error' : ''}}">
        {!! Form::label('rif', 'RIF', ['class'=>'control-label']) !!}
        <div class="form-inline">
          {!! Form::select('rifl', ['J'=>'J','V'=>'V','E'=>'E','G'=>'G'], substr($proveedor->rif,0,1), ['class'=>'form-control col-md-1']) !!}
          {!! Form::number('rifn', substr($proveedor->rif,2,8).substr($proveedor->rif,-1), ['class'=>'form-control col-md-4','placeholder'=>'0000000000']) !!}
        </div>
        <small id="rifHelp" class="form-text text-muted">El numero de RIF esta compuesto por 10 caracteres numericos.</small>
        {!! $errors->first('rifl', '<p class="help-block text-danger">:message</p>') !!}
        {!! $errors->first('rifn', '<p class="help-block text-danger">El Numero de RIF esta compuesto de 10 caracteres numericos (:message)</p>') !!}
      </div>
      {{-- Nombre --}}
      <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
        {!! Form::label('nombre', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::text('nombre', $proveedor->nombre, ['class'=>'form-control col-md-5', 'placeholder'=>'Denominación Comercial']) !!}
        <small id="nombrelHelp" class="form-text text-muted">Razón Social o Denominación Comercial.</small>
        {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Retiene --}}
      <div class="form-group {{ $errors->has('retiene') ? 'has-error' : ''}}">
        <div class="form-inline">
          {!! Form::label('retiene', 'Retiene (I.V.A.)', ['class'=>'control-label']) !!}
          {!! Form::select('retiene', [0=>'No',1=>'100%',2=>'75%'], $proveedor->retiene, ['class'=>'form-control col-md-2']) !!}
        </div>
        {!! $errors->first('retiene', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- ISRL --}}
      <div class="form-group {{ $errors->has('isrl') ? 'has-error' : ''}}">
        <div class="form-inline">
          {!! Form::label('isrl', 'I.S.R.L.', ['class'=>'form-check-input']) !!}
          {!! Form::select('isrl', [0=>'No',1=>'Si'], $proveedor->isrl, ['class'=>'form-control col-md-2']) !!}
        </div>
        {!! $errors->first('isrl', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Dirección --}}
      <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
        {!! Form::label('direccion', 'Dirección', ['class'=>'control-label']) !!}
        {!! Form::textarea('direccion', $proveedor->direccion, ['class'=>'form-control col-md-5', 'size' => '30x3', 'placeholder'=>'Lorem ipsum dolor sit amet.']) !!}
        <small id="direccionlHelp" class="form-text text-muted">Dirección Fiscal (incluya zona postal).</small>
        {!! $errors->first('direccion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Telefono --}}
      <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
        {!! Form::label('telefono', 'Teléfono', ['class'=>'control-label']) !!}
        {!! Form::textarea('telefono', $proveedor->telefono, ['class'=>'form-control col-md-5', 'size' => '30x3', 'placeholder'=>'0000 000 0000']) !!}
        <small id="telefonolHelp" class="form-text text-muted">Registre los numeros de Telefonos separado por coma (,).</small>
        {!! $errors->first('telefono', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Email --}}
      <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
        {!! Form::email('email', $proveedor->email, ['class'=>'form-control col-md-5', 'placeholder'=>'buzon@midominio.com']) !!}
        <small id="emaillHelp" class="form-text text-muted">Dirección de correo.</small>
        {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Credito --}}
      <div class="form-group {{ $errors->has('credito') ? 'has-error' : ''}}">
        {!! Form::label('credito', 'Credito', ['class'=>'control-label']) !!}
        <div class="form-inline">
          {!! Form::select('credito', ['No'=>'No','Si'=>'Si'], $proveedor->credito, ['class'=>'form-control col-md-1']) !!}
          {!! Form::number('dias', $proveedor->dias, ['class'=>'form-control col-md-2']) !!}
        </div>
        <small id="creditolHelp" class="form-text text-muted">Indique si el cliente tendrá crédito; y los días de crédito.</small>
        {!! $errors->first('credito', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/clientes') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection