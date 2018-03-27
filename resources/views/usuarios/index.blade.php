@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('usuarios.create') }}">Nuevo Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/roles') }}">Roles</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div id="app" class="col-md-10">
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
            @if ($element->id > 1)

            @foreach ($element->role_user as $roleid)
            @if ($roleid->role_id == 3)
            <a class="btn btn-sm btn-primary" href="{{ url('/setSuper/' . $element->id) }}" title="SuperUser" data-toggle="tooltip" data-placement="top"> <i class="fas fa-users"></i></a>
            @elseif($roleid->role_id == 2)
            <a class="btn btn-sm btn-success" href="{{ url('/setUser/' . $element->id) }}" data-toggle="tooltip" data-placement="top" title="User"><i class="fas fa-user"></i></a>
            @endif
            @endforeach
            {!! Form::open(['method'=>'DELETE', 'url' => ['usuarios', $element->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Realmente desea eliminar este Registro");']) !!}
            {{ Form::button('<i class="fa fa-trash"></i>', ['title' => 'Eliminar Usuario', 'data-toggle' => 'tooltip', 'data-placement' => 'top','type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
            {!! Form::close() !!}
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

@endsection
