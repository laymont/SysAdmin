@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3>Facturas <a class="btn btn-lg btn-primary float-right" href="{{ route('facturas.create') }}" title="">Facturar</a></h3>

    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table id="facturas" class="table table-striped table-bordered">
        <caption>Listado de Facturas</caption>
        <thead>
          <tr>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Tipo/Pago</th>
            <th>Sub-Total</th>
            <th>I.V.A</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($facturas as $element)
            <tr>
            <td>{{ $element->id }}</td>
            <td>{{ $element->fecha }}</td>
            <td><sup>{{ @$element->cliente->rif }}</sup><br> {{ @$element->cliente->nombre }}</td>
            <td>{{ $element->servidore->nombre }}</td>
            <td>{{ $element->tpago }}</td>
            <td class="moneda">
              @php
              $sbtt = collect();
              foreach ($element->factura_detalles as $value) {
                $sbtt[]= $value->cantidad * $value->precio;
              }
              echo number_format($sbtt->sum(),2,",",".");
              @endphp
            </td>
            <td class="moneda">
              {{ number_format($sbtt->sum() * \Config::get('constants.iva.electronico'),2,",",".") }}
            </td>
            <td class="moneda">{{ number_format($sbtt->sum() + ($sbtt->sum() * \Config::get('constants.iva.electronico')),2,",",".") }}</td>
            <td class="text-center">
              <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" href="{{ route('facturas.show',['factura'=>$element->id]) }}" target="_blank" title="Ver contenido"> <i class="fas fa-eye"></i></a>
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
        oTable = $('#facturas').DataTable({
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