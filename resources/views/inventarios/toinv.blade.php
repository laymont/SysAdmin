@extends('layouts.app')
{{-- {{ dd($productos) }} --}}
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Inventario <small>cargar compras al inventario</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      {!! Form::open(['route' => 'inventarios.store']) !!}
      <table class="table table-bordered table-striped">
        <caption>Carga de Productos</caption>
        <thead>
          <tr>
            <th>Producto</th>
            <th>Lote</th>
            <th>Vence</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Base 1</th>
            <th>Base 2</th>
            <th>Base 3</th>
            <th>Ubicación</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productos as $element)
          <tr>
            <td>
              {!! Form::hidden('compra_id[]', $element->compra_id, []) !!}
              {!! Form::hidden('producto_id[]', $element->producto_id, []) !!}
              {!! Form::hidden('lote[]', $element->lote, []) !!}
              {!! Form::hidden('vence[]', $element->vence, []) !!}
              {!! Form::hidden('cantidad[]', $element->cantidad, []) !!}
              {!! Form::hidden('costo[]', $element->costo, []) !!}
              {{ $element->nombre }}
            </td>
            <td>{{ $element->lote }}</td>
            <td>{{ $element->vence }}</td>
            <td class="text-center">{{ $element->cantidad }}</td>
            <td class="text-right">{{ number_format($element->costo,2,",",".") }}</td>
            <td>
              {!! Form::number('base1[]', null, ['class'=>'form-control col-md-4','placeholder'=>'0,3','step'=>'0.01']) !!}
            </td>
            <td>
              {!! Form::number('base2[]', null, ['class'=>'form-control col-md-4','placeholder'=>'0,0','step'=>'0.01']) !!}
            </td>
            <td>
              {!! Form::number('base3[]', null, ['class'=>'form-control col-md-4','placeholder'=>'0,0','step'=>'0.01']) !!}
            </td>
            <td>
              {!! Form::select('ubicacion[]', [0=>'0'], 0, ['class'=>'form-control col-md-10']) !!}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="form-group">
        {{ Form::button('<i class="fas fa-save fa-2x"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  }}
        <a class="btn btn-lg btn-warning" href="{{ url('/compras') }}" title="Cancelar"> <i class="fas fa-ban fa-2x"></i></a>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection