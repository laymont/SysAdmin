@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Nuevo Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Roles</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <table id="usuarios" class="table table-bordered">
        <caption>Lista de Usuarios</caption>
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email/Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($usuarios as $element)
          <tr>
            <td>{{ $element->id }}</td>
            <td>{{ $element->name }}</td>
            <td>{{ $element->email }}</td>
            <td>
              @php
              {{ foreach ($element->roles as $role) {
               echo $role->description;
             } }}
             @endphp
           </td>
           <td class="text-center">
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['usuarios', $element->id],
                'style' => 'display:inline',
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
