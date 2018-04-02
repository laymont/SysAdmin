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
      {!! Form::model($ctapagar, ['method' => 'PATCH', 'route' => ['admins.ctapagar.finishfull',$ctapagar->id]]) !!}
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
        {!! Form::number('monto', $ctapagar->monto, ['class'=>'form-control col-md-5 money','step'=>'0.01','readonly']) !!}
        {!! $errors->first('monto', '<p class="help-block text-danger">:message</p>') !!}
        <small id="montoHelp" class="form-text text-muted">Monto total pagado.</small>
      </div>

      <div class="form-group {{ $errors->has('abono') ? 'has-error' : '' }}">
        {!! Form::label('abono', 'Abono', ['class'=>'control-label']) !!}
        {!! Form::select('abono', ['No'=>'No', 'Si'=>'Si'], $ctapagar->abono, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione']) !!}
        {!! $errors->first('abono', '<p class="help-block text-danger">:message</p>') !!}
        <small id="abonoHelp" class="form-text text-muted">Indique si es un Abono.</small>
      </div>

      <div class="form-group {{ $errors->has('fecha_abono') ? 'has-error' : '' }}">
        {!! Form::label('fecha_abono', 'Fecha/ABono', ['class'=>'control-label']) !!}
        {!! Form::date('fecha_abono', $ctapagar->fecha_abono, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione']) !!}
        {!! $errors->first('fecha_abono', '<p class="help-block text-danger">:message</p>') !!}
        <small id="fecha_abonoHelp" class="form-text text-muted">Indique la fecha del Pago o Abono.</small>
      </div>
      <div class="form-group {{ $errors->has('banco_id') ? 'has-error' : '' }}">
        {!! Form::label('banco_id', 'Banco', ['class'=>'control-label']) !!}
        {!! Form::select('banco_id', $bancos, $ctapagar->banco_id, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione']) !!}
        {!! $errors->first('banco_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="banco_idHelp" class="form-text text-muted">Indique el Banco donde se efectuo el pago.</small>
      </div>

      <div class="form-group {{ $errors->has('movimiento') ? 'has-error' : '' }}">
        {!! Form::label('movimiento', 'Movimiento', ['class'=>'control-label']) !!}
        {!! Form::select('movimiento', ['Deposito'=>'Deposito','Cheque'=>'Cheque','Transferencia'=>'Transferencia'], $ctapagar->movimiento, ['class'=>'form-control col-md-5','placeholder'=>'Seleccione']) !!}
        {!! $errors->first('movimiento', '<p class="help-block text-danger">:message</p>') !!}
        <small id="movimientoHelp" class="form-text text-muted">Indique el tipo de movimiento.</small>
      </div>
      {!! Form::hidden('pagada', 'Si', []) !!}

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
<script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript" charset="utf-8" async defer></script>
@endsection