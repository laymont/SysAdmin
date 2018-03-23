@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Ctas. por Pagar </h3>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Proveedores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Servidores</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
          {{-- Proveedores --}}
          <table id="porpagar" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Ctas x Pagar</caption>
        <thead>
          <tr>
            <th>Documento</th>
            <th>Fecha</th>
            <th>Acreedor</th>
            <th>Subtotal</th>
            <th>I.V.A.</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ctapagar as $element)
          <tr>
            <td>{{ $element->documento }}</td>
            <td>{{ $element->fecha }}</td>
            <td>{{ $element->proveedor->nombre }}</td>
            <td class="moneda">{{ $element->subtotal }}</td>
            <td class="moneda">{{ $element->iva }}</td>
            <td class="moneda">{{ $element->total }}</td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
        </div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          {{-- Servidores --}}
          <table id="porpagarser" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Ctas x Pagar</caption>
        <thead>
          <tr>
            <th>Documento</th>
            <th>Fecha</th>
            <th>Acreedor</th>
            <th>Subtotal</th>
            <th>I.V.A.</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </tbody>
      </table>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>

  $(document).ready(function(){
    oTable = $('#porpagar').DataTable({
      dom: '<"toolbar">Bfrtip',
      "order": [[ 1, "desc" ]],
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

    oTable = $('#porpagarser').DataTable({
      dom: '<"toolbar">Bfrtip',
      "order": [[ 1, "desc" ]],
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
