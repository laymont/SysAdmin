@extends('layouts.app')
@section('css')
<style type="text/css" media="screen">
table tbody tr.even:hover, table tbody tr.odd:hover  { background-color: #ECFFB3; }
</style>
@endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <h3> Compras </h3>
      {{-- errors --}}
      @if ($errors->any())
      <div class="alert alert-danger col-md-4">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div id="toolbar"></div>
    <div class="col-md-12">
      {{-- Bar --}}
      <ul class="nav">
        <a class="nav-link" href="{{ route('compras.create') }}"><i class="fas fa-plus-square"></i> Nueva Compras</a>
        <a class="nav-link" href="#" data-toggle="modal" data-target="#verCompra"><i class="fas fa-eye"></i> Ver Compra</a>
      </ul>

      <table id="compras" class="table table-bordered table-striped datatables" cellspacing="0" data-page-length="25">
        <caption>Listado de compras</caption>
        <thead>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Documento</th>
            <th>Sub-Total</th>
            <th>I.V.A.</th>
            <th>Total</th>
            <th>Pago</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($compras as $element)
          @if ($element->subtotal == 0 && $element->nula == 0)
          <tr class="text-warning">
            @elseif ($element->nula == 1)
            <tr class="text-danger" style="text-decoration: line-through;">
              @else
              <tr>
                @endif
                <td>{{ $element->id }}</td>
                <td>{{ $element->fecha }}</td>
                <td>{{ @$element->proveedor->nombre }}</td>
                <td>{{ $element->documento }}</td>
                <td class="moneda">{{ number_format($element->subtotal,2,",",".") }}</td>
                <td class="moneda">{{ number_format($element->iva,2,",",".") }}</td>
                <td class="moneda">{{ number_format($element->total,2,",",".") }}</td>
                <td class="text-center">
                  @if ($element->pago == 0)
                  <a class="btn btn-sm btn-warning" href="{{ url('admins/ctapagar/'.$element->id.'/pagar') }}" data-toggle="tooltip" data-placement="top" title="Pago Pendiente"> <i class="fas fa-shopping-cart"></i></a>
                  @else
                  <span class="text-success"><i class="fas fa-check-square"></i></span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-sm btn-primary" href="{{ route('toinv',['compra_id'=>$element->id]) }}" data-toggle="tooltip" data-placement="top" title="Cargar Inventarioo"> <i class="fas fa-sign-in-alt"></i></a>
                  <a class="btn btn-sm btn-success" href="{{ route('compras_detalles.show',['compras_detalles'=>$element->id]) }}" data-toggle="tooltip" data-placement="top" title="Ver detalles de la compra"><i class="fas fa-eye"></i></a>
                  <a class="btn btn-sm btn-warning" href="{{ route('compras_detalles.edit',['compras_detalles'=>$element->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar detalles de la compra"><i class="fas fa-cart-arrow-down"></i></a>
                  <a class="btn btn-sm btn-secondary" href="{{ route('compras.edit', ['id' => $element->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar compra"> <i class="fas fa-edit"></i></a>
                  {{-- Anular --}}
                  {!! Form::open(['method'=>'PUT','route' => ['compras.anular', $element->id],'style' => 'display:inline','onsubmit' => 'return confirm("Realmente desea Anular este Registro");']) !!}
                  {{ Form::button('<i class="fas fa-ban"></i>', ['title'=>'Anular', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
                  {!! Form::close() !!}
                  {{-- Eliminar registro --}}
                  {!! Form::open(['method'=>'DELETE','url' => ['compras', $element->id],'style' => 'display:inline','onsubmit' => 'return confirm("Realmente desea eliminar este Registro");']) !!}
                  {{ Form::button('<i class="fa fa-trash"></i>', ['title'=>'Eliminar', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
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
        oTable = $('#compras').DataTable({
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