@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Detalle de la Compra {{ sprintf("%'.09d\n", $id) }}</h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div id="toolbar"></div>
    <div class="col-md-12">
      {{-- Bar --}}
      <nav class="nav">
        <a class="nav-link" href="{{ route('compras.index') }}"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
        <a Class="nav-link" href="{{ route('compras_detalles.edit',['id'=> $id]) }}" title=""><i class="fas fa-edit"></i> Editar detalles</a>
      </nav>

      <table id="detales_lista" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Detalle de la compra</caption>
        <thead>
          <tr>
            <th>Compra</th>
            <th>Producto</th>
            <th>Lote</th>
            <th>Vence</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Inventario</th>
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
            <td>Bs. {{ number_format($element->costo,2,",",".") }}</td>
            <td>
              @if ($element->inventario == 1)
              <span class="text-success"><i class="far fa-check-square"></i></span>
              @else
              <span class="text-secondary"><i class="fas fa-clock"></i></span>
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
@section('scripts')
<script>


  $(document).ready(function(){
    oTable = $('#detales_lista').DataTable({
      dom: '<"toolbar">Bfrtip',
      "order": [[ 0, "desc" ]],
      "columnDefs": [
      { className: "dt-right", "targets": [5] },
      { className: "dt-center", "targets": [2,3,4,6] }
      ],
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