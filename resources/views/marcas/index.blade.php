@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Marcas </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      {{-- Bar --}}
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('marcas.create') }}"><i class="fas fa-plus-square"></i> Nuevo Marcas</a>
        </li>
      </ul>

      <table id="marcas_lista" class="table table-bordered table-striped datatables" cellspacing="0">
        <caption>Listado de Marcas</caption>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($marcas as $element)
          <tr>
            <td>{{ $element->id }}</td>
            <td>{{ $element->nombre }}</td>
            <td>
              <a class="btn btn-sm btn-warning" href="{{ route('departamentos.edit', ['id' => $element->id]) }}" title="Editar"> <i class="fas fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>


  $(document).ready(function(){
    oTable = $('#marcas_lista').DataTable({
      "pagingType": "full_numbers",
      "language": {
        "decimal": ",",
        "thousands": ".",
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      dom: 'Bfrtip',
      buttons: [
      'excel', 'pdf', 'print', 'colvis'
      ]
    });
    table.buttons().container()
    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
  });
</script>
@endsection