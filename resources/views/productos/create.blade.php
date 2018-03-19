@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Productos <small>Editar</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <nav class="nav">
        <a class="nav-link" href="{{ route('productos.index') }}"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
      </nav>

      {!! Form::open(['url'=>'productos']) !!}
      {{-- Departamento --}}
      <div class="form-group {{ $errors->has('departamento_id') ? 'has-error' : ''}}">
        {!! Form::label('departamento_id', 'Departamento', ['class'=>'control-label']) !!}
        {!! Form::select('departamento_id', $departamentos, null, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione/Departamento']) !!}
        {!! $errors->first('departamento_id', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Nombre --}}
      <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
        {!! Form::label('nombre', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::text('nombre', null, ['class'=>'form-control col-md-5', 'placeholder'=>'Nombre del Producto']) !!}
        {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- marca --}}
      <div class="form-group {{ $errors->has('marca_id') ? 'has-error' : ''}}">
        {!! Form::label('marca_id', 'Marca', ['class'=>'control-label']) !!}
        {!! Form::select('marca_id', $marcas, null, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione/Marca']) !!}
        {!! $errors->first('marca_id', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Presentacion --}}
      <div class="form-group {{ $errors->has('presentacion') ? 'has-error' : ''}}">
        {!! Form::label('presentacion', 'Presentación', ['class'=>'control-label']) !!}
        {!! Form::text('presentacion', null, ['class'=>'form-control col-md-5','placeholder'=>'Presentación del Producto']) !!}
        {!! $errors->first('presentacion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Descripcion --}}
      <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
        {!! Form::label('descripcion', 'Descripción', ['class'=>'control-label']) !!}
        {!! Form::textarea('descripcion', null, ['class'=>'form-control col-md-5', 'size' => '30x3', 'placeholder'=>'Breve descripcion del producto']) !!}
        <small class="form-text text-muted">Breve descripción del producto.</small>
        {!! $errors->first('descripcion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- exento --}}
      <div class="form-group {{ $errors->has('exento') ? 'has-error' : ''}}">
        {!! Form::label('exento', 'Exento', ['class'=>'control-label']) !!}
        {!! Form::select('exento', [0=>'No',1=>'Si'], 0, ['class'=>'form-control col-md-2']) !!}
        {!! $errors->first('exento', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Servicio --}}
      <div class="form-group {{ $errors->has('servicio') ? 'has-error' : '' }}">
        <div class="form-inline">
          {!! Form::label('servicio', 'Servicio', ['class'=>'control-label']) !!}
          {!! Form::checkbox('servicio', 1, false, ['class'=>'form-control col-md-2']) !!}
          {!! $errors->first('servicio', '<p class="help-block text-danger">:message</p>') !!}
        </div>
        <small id="servicioHelp" class="form-text text-muted">Indique si es servicio.</small>
      </div>
      {{-- Min --}}
      <div class="form-group {{ $errors->has('min') ? 'has-error' : ''}}">
        {!! Form::label('min', 'Min', ['class'=>'control-label']) !!}
        {!! Form::number('min', 1, ['class'=>'form-control col-md-2']) !!}
        <small class="form-text text-muted">Cantidad minima en inventario.</small>
        {!! $errors->first('min', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Max --}}
      <div class="form-group {{ $errors->has('max') ? 'has-error' : ''}}">
        {!! Form::label('max', 'Max', ['class'=>'control-label']) !!}
        {!! Form::number('max', 1, ['class'=>'form-control col-md-2']) !!}
        <small class="form-text text-muted">Cantidad maxima en inventario.</small>
        {!! $errors->first('max', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/productos') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection