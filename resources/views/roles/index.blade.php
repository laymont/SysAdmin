@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h3>Roles</h3>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-8">
    <table class="table table-bordered table-striped">
      <caption>Roles</caption>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($roles as $element)
        <tr>
          <td>{{ $element->id }}</td>
          <td>{{ $element->name }}</td>
          <td>{{ $element->description }}</td>
          <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection