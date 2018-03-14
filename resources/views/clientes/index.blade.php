@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Clientes </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table id="clientes_lista" class="table table-bordered table-striped datatables" cellspacing="0">
        <caption>Listado de Clientes</caption>
        <thead>
          <tr>
            <th>RIF</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Credito</th>
            <th>Dias</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clientes as $element)
          <tr>
            <td>{{ ucfirst($element->rif) }}</td>
            <td>
              @if ($element->retiene > 0)
              <i class="fas fa-cart-arrow-down text-warning" title="Retiene I.V.A."></i>
              @endif
              @if ($element->isrl)
                <i class="fas fa-cart-arrow-down text-warning" title="Retiene I.S.R.L"></i>
              @endif
              {{ $element->nombre }}
            </td>
            <td>{{ $element->direccion }}</td>
            <td>{{ $element->telefono }}</td>
            <td>{{ $element->email }}</td>
            <td>{{ $element->credito }}</td>
            <td>{{ $element->dias }}</td>
            <td>
              <a class="btn btn-sm btn-warning" href="{{ route('clientes.edit', ['cliente' => $element->id]) }}" title="Editar"> <i class="fas fa-edit"></i></a>
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
    oTable = $('#clientes_lista').DataTable({
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