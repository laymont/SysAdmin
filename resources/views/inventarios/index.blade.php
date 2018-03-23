@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Inventarios </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if ($inventarios->count() > 0)
      <table id="inventarios" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Inventarios</caption>
        <thead>
          <tr>
            <th>Compra</th>
            <th>Producto</th>
            <th>Lote</th>
            <th>Vence</th>
            <th>Cantidad</th>
            {{-- <th>Costo</th>
            <th>Base 1</th>
            <th>Base 2</th>
            <th>Base 3</th> --}}
            <th>Ubicación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($inventarios as $element)
          <tr>
            <td> {{ $element->compra_id }}</td>
            <td> {{ @$element->producto->nombre }}</td>
            <td class="text-center"> {{ $element->lote }}</td>
            <td class="text-center"> {{ $element->vence }}</td>
            <td class="text-center"> {{ $element->cantidad }}</td>
            {{-- <td class="text-right"> {{ number_format($element->costo,2,",",".") }}</td>
            <td class="text-center"> {{ $element->base1 * 100 }}%</td>
            <td class="text-center"> {{ $element->base2 * 100 }}%</td>
            <td class="text-center"> {{ $element->base3 * 100 }}%</td> --}}
            <td class="text-center"> {{ $element->ubicacion }}</td>
            <td>
              <a class="btn btn-sm btn-primary" href="#" title="Ajuste"><i class="fas fa-cog"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-info col-md-4">
        <h3 class="text-info">Sin Información</h3>
        <p class="text-info">Aun no hay productos en el Inventario.<br>Si posee Compras debe antes ingresarlas en el Inventario</p>
      </div>
      @endif

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>

  $(document).ready(function(){
    oTable = $('#inventarios').DataTable({
      dom: '<"toolbar">Bfrtip',
      "order": [[ 1, "asc" ]],
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