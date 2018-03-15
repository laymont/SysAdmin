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
      {!! Form::model($productos, ['method' => 'PATCH', 'route' => ['productos.update', $productos->id]]) !!}
      {{-- Departamento --}}
      <div class="form-group {{ $errors->has('departamento_id') ? 'has-error' : ''}}">
        {!! Form::label('departamento_id', 'Departamento', ['class'=>'control-label']) !!}
        {!! Form::select('departamento_id', $departamentos, $productos->departamento_id, ['class'=>'form-control col-md-5']) !!}
        {!! $errors->first('departamento_id', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Nombre --}}
      <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
        {!! Form::label('nombre', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::text('nombre', $productos->nombre, ['class'=>'form-control col-md-5']) !!}
        {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- marca --}}
      <div class="form-group {{ $errors->has('marca_id') ? 'has-error' : ''}}">
        {!! Form::label('marca_id', 'Marca', ['class'=>'control-label']) !!}
        {!! Form::select('marca_id', $marcas, $productos->marca_id, ['class'=>'form-control col-md-5']) !!}
        {!! $errors->first('marca_id', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Presentacion --}}
      <div class="form-group {{ $errors->has('presentacion') ? 'has-error' : ''}}">
        {!! Form::label('presentacion', 'Presentación', ['class'=>'control-label']) !!}
        {!! Form::text('presentacion', $productos->presentacion, ['class'=>'form-control col-md-5']) !!}
        {!! $errors->first('presentacion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Descripcion --}}
      <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
        {!! Form::label('descripcion', 'Descripción', ['class'=>'control-label']) !!}
        {!! Form::textarea('descripcion', $productos->descripcion, ['class'=>'form-control col-md-5', 'size' => '30x3']) !!}
        <small class="form-text text-muted">Breve descripción del producto.</small>
        {!! $errors->first('descripcion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- exento --}}
      <div class="form-group {{ $errors->has('exento') ? 'has-error' : ''}}">
        {!! Form::label('exento', 'Exento', ['class'=>'control-label']) !!}
        {!! Form::select('exento', [0=>'No',1=>'Si'], $productos->exento, ['class'=>'form-control col-md-2']) !!}
        {!! $errors->first('exento', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Min --}}
      <div class="form-group {{ $errors->has('min') ? 'has-error' : ''}}">
        {!! Form::label('min', 'Min', ['class'=>'control-label']) !!}
        {!! Form::number('min', $productos->min, ['class'=>'form-control col-md-2']) !!}
        <small class="form-text text-muted">Cantidad minima en inventario.</small>
        {!! $errors->first('min', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Max --}}
      <div class="form-group {{ $errors->has('max') ? 'has-error' : ''}}">
        {!! Form::label('max', 'Max', ['class'=>'control-label']) !!}
        {!! Form::number('max', $productos->max, ['class'=>'form-control col-md-2']) !!}
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