@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Productos </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div id="toolbar"></div>
    <div class="col-md-12">

      <table id="productos_lista" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Listado de Produtos</caption>
        <thead>
          <tr>
            <th>Departamento</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Presentación</th>
            <th>Descripción</th>
            <th>Cant/Min</th>
            <th>Cant/Max</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productos as $element)
          <tr>
            <td>{{ $element->departamento->nombre }}</td>
            <td>
              @if ($element->exento > 0)
              <i class="fas fa-cart-arrow-down text-warning" title="Exento"></i>
              @endif
              {{ $element->nombre }}
            </td>
            <td>{{ $element->marca['nombre'] }}</td>
            <td>{{ $element->presentacion }}</td>
            <td>{{ $element->descripcion }}</td>
            <td>{{ $element->min }}</td>
            <td>{{ $element->max }}</td>
            <td>
              <a class="btn btn-sm btn-warning" href="{{ route('productos.edit', ['id' => $element->id]) }}" title="Editar"> <i class="fas fa-edit"></i></a>
              {!! Form::open([
                'method'=>'DELETE',
                'url' => ['productos', $element->id],
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
      oTable = $('#productos_lista').DataTable({
        dom: '<"toolbar">Bfrtip',
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