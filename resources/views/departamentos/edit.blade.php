@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3>Departamentos <small>nuevo</small></h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      {!! Form::model($departamento, ['method' => 'PATCH', 'route' => ['departamentos.update', $departamento->id]]) !!}
      {{-- Nombre --}}
      <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
        {!! Form::label('nombre', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::text('nombre', null, ['class'=>'form-control col-md-5']) !!}
        <small id="rifHelp" class="form-text text-muted">Departamento.</small>
        {!! $errors->first('nombre', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      {{-- Descripcion --}}
      <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
        {!! Form::label('descripcion', 'Descripcion', ['class'=>'control-label']) !!}
        {!! Form::text('descripcion', null, ['class'=>'form-control col-md-5']) !!}
        <small id="rifHelp" class="form-text text-muted">Breve descripcion.</small>
        {!! $errors->first('descripcion', '<p class="help-block text-danger">:message</p>') !!}
      </div>
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/departamentos') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection