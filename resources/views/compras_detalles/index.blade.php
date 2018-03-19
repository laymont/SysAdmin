@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Compras <small>Detalles</small> </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div id="toolbar"></div>
    <div class="col-md-12">
      {{-- Bar --}}
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('compras_detalles.create') }}"><i class="fas fa-plus-square"></i> Nueva Compras</a>
        </li>
      </ul>

      <table id="detales_lista" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Listado de compras</caption>
        <thead>
          <tr>
            <th>Compra</th>
            <th>Producto</th>
            <th>Lote</th>
            <th>Vence</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Inventario</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($detalles as $element)
          <tr>
            <td>{{ @$element->compra_id }}</td>
            <td>{{ @$element->producto->nombre }}</td>
            <td>{{ $element->lote }}</td>
            <td>{{ $element->vence }}</td>
            <td>{{ $element->cantidad }}</td>
            <td>{{ $element->costo }}</td>
            <td>{{ $element->inventario }}</td>
            <td>
              <a class="btn btn-sm btn-secondary" href="{{ route('compras_detalles.edit', ['id' => $element->id]) }}" title="Editar"> <i class="fas fa-edit"></i></a>
              {!! Form::open([
                'method'=>'DELETE',
                'url' => ['compras_detalles', $element->id],
                'style' => 'display:inline'
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
  @section('scripts')
  <script>


    $(document).ready(function(){
      oTable = $('#detales_lista').DataTable({
        dom: '<"toolbar">Bfrtip',
        "order": [[ 0, "desc" ]],
        buttons: [
        'pageLength', 'excel', 'pdf',
        {
          extend: 'print',
          text: 'Imprimir'
        }
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
        }
      });
    });

  </script>
  @endsection