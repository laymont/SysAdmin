@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8" id="banco-nuevo">
      <h3>Cuentas <small>Bancos</small></h3>
      {!! Form::model($banco, ['method' => 'PUT', 'route' => ['bancos.update', $banco->id]]) !!}
      <div class="form-group {{ $errors->has('codigo') ? 'has-error' : '' }}">
        {!! Form::label('codigo', 'Nombre', ['class'=>'control-label']) !!}
        {!! Form::select('codigo', $codigos, $banco->codigo, ['class'=>'form-control col-md-6', 'placeholder'=> 'Seleccione', 'name' => 'codigo']) !!}
        {{-- <select id="codigo" name="codigo" class="form-control col-md-6">
          <option value="">Seleccione</option>
          @foreach ($codigos as $index => $value)
          <option value="{{ $index }}">{{ $value }}</option>
          @endforeach
        </select> --}}
        {!! $errors->first('codigo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="codigoHelp" class="form-text text-muted">Nombre y Codigo Indentificador.</small>
      </div>
      {!! Form::hidden('nombre', null, ['id'=>'nombre']) !!}

      <div class="form-group {{ $errors->has('cuenta') ? 'has-error' : '' }}">
        {!! Form::label('cuenta', 'Cuenta', ['class'=>'control-label']) !!}
        {!! Form::text('cuenta', $banco->cuenta, ['class'=> 'form-control col-md-6']) !!}
        {!! $errors->first('cuenta', '<p class="help-block text-danger">:message</p>') !!}
        <small id="cuentaHelp" class="form-text text-muted">Numero de Cuenta.</small>
      </div>

      <div class="form-group {{ $errors->has('tipo') ? 'has-error' : '' }}">
        {!! Form::label('tipo', 'Tipo', ['class'=>'control-label']) !!}
        {!! Form::select('tipo', ['ahorro'=>'Ahorro', 'corriente'=>'Corriente'], $banco->tipo, ['class'=>'form-control col-md-6', 'placeholder' => 'Seleccione']) !!}
        {!! $errors->first('tipo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="tipoHelp" class="form-text text-muted">Ahorro o Corriente.</small>
      </div>

      <div class="form-group {{ $errors->has('saldo') ? 'has-error' : '' }}">
        {!! Form::label('saldo', 'Saldo Incial', ['class'=>'control-label']) !!}
        {!! Form::number('saldo', $banco->saldo, ['class'=>'form-control col-md-6','placeholder'=> '0.00','step'=>'any']) !!}
        {!! $errors->first('saldo', '<p class="help-block text-danger">:message</p>') !!}
        <small id="saldoHelp" class="form-text text-muted">Indique Saldo inicial (Opcional).</small>
      </div>

      {{-- submit --}}
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/bancos') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(function() {
    $('#codigo').change(function() {
     var nombre = $('#codigo option:selected').text();
     $('#nombre').val(nombre);
     $('#cuenta').val( $(this).val() );
     console.log($(this).val() + ' ' + nombre);
   })
  })
</script>
@endsection