@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Servidores </h3>
      {{-- errors --}}
      @if ($errors->any())
      <div class="alert alert-danger col-md-4">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <table class="table table-bordered table-striped">
        <caption>Listado de Servidores</caption>
        <thead>
          <tr>
            <th>Id</th>
            <th>Tipo</th>
            <th>Identificación</th>
            <th>Nombre</th>
            <th>Porcentaje</th>
            <th>Monto</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($servidores as $element)
          <tr>
            <td>{{ $element->id }}</td>
            <td>
              @if ($element->tipo == 1)
                Vendedor
              @endif
            </td>
            <td>{{ $element->identificacion }}</td>
            <td>{{ $element->nombre }}</td>
            <td class="number">{{ $element->porcentaje }}</td>
            <td class="number">{{ $element->monto }}</td>
            <td class="text-center">
              <a class="btn btn-sm btn-warning" href="{{ route('servidores.edit', ['servidore' => $element->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fas fa-edit"></i></a>
              {!! Form::open([
                'method'=>'DELETE',
                'url'=>'servidores',$element->id,
                'style'=>'display:inline',
                'onsubmit' => 'return confirm("Realmente desea eliminar este Registro");'
                ]) !!}
                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection