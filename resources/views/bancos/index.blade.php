@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h3>Cuentas <small>Bancos</small></h3>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('bancos.create') }}">Nueva Cuenta</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <table class="table table-bordered table-striped">
        <caption>Listado de Cuentas</caption>
        <thead>
          <tr>
            <th>Id</th>
            <th>Banco</th>
            <th>Cuenta</th>
            <th>Tipo</th>
            <th>Saldo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cuentas as $element)
          <tr>
            <td>{{ $element->id }}</td>
            <td>{{ $element->nombre }}</td>
            <td class="center">{{ $element->cuenta }}</td>
            <td>{{ $element->tipo }}</td>
            <td class="moneda">{{ $element->saldo }}</td>
            <td>
              <a class="btn btn-sm btn-warning" href="{{ route('bancos.edit',['banco'=>$element->id]) }}" title="Editar"> <i class="fas fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection