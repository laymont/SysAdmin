@extends('layouts.app')

@section('content')

<div class="container">
  {{-- Formulario --}}
  <div class="row">
    {!! Form::open(['class'=>'col-md-12 justify-content-center','route'=>'facturas.store','method'=>'POST']) !!}
    <div class="form-row">
      {{-- Numero de factura --}}
      <div class="form-group col-md-4 {{ $errors->has('id') ? 'has-error' : '' }}">
        {!! Form::label('id', 'Numero', ['class'=>'control-label']) !!}
        {!! Form::number('id', $numero_factura, ['class'=>'form-control-plaintext','readonly']) !!}
        {!! $errors->first('id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="idHelp" class="form-text text-muted">Numero de Factura.</small>
      </div>
      {{-- fecha --}}
      <div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
        {!! Form::label('fecha', 'Fecha', ['class'=>'control-label']) !!}
        {!! Form::date('fecha', \Illuminate\Support\Carbon::now(), ['class'=>'form-control ml-3','required']) !!}
        {!! $errors->first('fecha', '<p class="help-block text-danger">:message</p>') !!}
        <small id="fechaHelp" class="form-text text-muted">Fecha de Facturación.</small>
      </div>
      {{-- vendedor --}}
      <div class="form-group col-md-4 {{ $errors->has('servidor_id') ? 'has-error' : '' }}">
        {!! Form::label('servidor_id', 'Vendedor', ['class'=>'control-label']) !!}
        {!! Form::select('servidor', $servidores, null, ['class'=>'form-control ml-3','placeholder'=>'Seleccione el Vendedor','required']) !!}
        {!! $errors->first('servidor_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="servidor_idHelp" class="form-text text-muted">Vendedor.</small>
      </div>
    </div>
    <div class="form-row">
      {{-- cliente --}}
      <div class="form-group col-md-6 {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
        {!! Form::label('cliente_id', 'Cliente', ['class'=>'control-label']) !!}
        {!! Form::select('cliente_id', $clientes, null, ['class'=>'form-control','placeholder'=>'Seleccione el Cliente','required']) !!}
        {!! $errors->first('cliente_id', '<p class="help-block text-danger">:message</p>') !!}
        <small id="cliente_idHelp" class="form-text text-muted">Nombre o Razón Social.</small>
      </div>
      {{-- direccion --}}
      <div class="form-group col-md-6 {{ $errors->has('direccion') ? 'has-error' : '' }}">
        {!! Form::label('direccion', 'Dirección', ['class'=>'control-label']) !!}
        {!! Form::textarea('direccion', null, ['class'=>'form-control ml-3','size'=>'30x3', 'readonly']) !!}
        {!! $errors->first('direccion', '<p class="help-block text-danger">:message</p>') !!}
        <small id="direccionHelp" class="form-text text-muted">Dirección Fiscal.</small>
      </div>
    </div>
    <hr>
    <div class="form-row">
      <table class="table" id="factura_detalles" name="factura_detalles">
        <caption>
          <button type="button" class="btn btn-primary button_agregar_producto" id="add" name="add" data-toggle="tooltip" data-placement="top" title="Agregar Producto"><i class="fas fa-plus"></i> Add Producto</button>
          {{ Form::button('<i class="fas fa-sign-in-alt"></i> Crear Factura', ['title'=>'Facturar', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'type' => 'submit', 'class' => 'ml-3 btn btn-success btn-lg'] )  }}
        </caption>
        <thead class="table-bordered">
          <tr>
            <th class="col-1">Cantidad</th>
            <th class="col-5">Descripción</th>
            <th class="col-3">Precio</th>
            <th class="col-3">Total</th>
          </tr>
        </thead>
        <tbody class="table-bordered">
          <tr>@php $id = 0; @endphp
            <td>
              <input type="number" name="detalles[cantidad][]" value="" placeholder="" class="form-control-plaintext" min="1" step="1" required="required">
            </td>
            <td>
              <select name="detalles[inventario_id][]" class="form-control-plaintext productos">
                <option value="">Seleccione</option>
                @foreach ($listadoProductos as $element => $value)
                <option value="{{ $element }}">{{ $value }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="number" name="detalles[precio][]" value="" placeholder="Precio" class="form-control-plaintext" min="1" step="0.01" required="required">
            </td>
            <td>
              <div class="form-row align-items-center">
                <input type="number" name="detalles[sbtt][]" value="" placeholder="SubTotal" class="form-control-plaintext col-md-11">
                <a id="rem" name="rem" class="float-right col-md-1 text-danger button_eliminar_producto" href="#" data-toggle="tooltip" data-placement="top" title="Remover"><i class="fas fa-minus-circle"></i></a>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" class="border-bottom-0"></td>
            <td class="table-bordered text-right">I.V.A.</td>
            <td class="table-bordered moneda">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="border: none !important;"></td>
            <td class="table-bordered text-right">Sub-Total</td>
            <td class="table-bordered moneda">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="border: none !important;"></td>
            <td class="table-bordered text-right">Exento</td>
            <td class="table-bordered moneda">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="border: none !important;"></td>
            <td class="table-bordered text-right">Total</td>
            <td class="table-bordered moneda">&nbsp;</td>
          </tr>
        </tfoot>
      </table>
    </div>
    {!! Form::close() !!}
  </div>

</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function(){

    /* Agregar Fila */
    $(".button_agregar_producto").click(function(event){
      event.preventDefault();
      var clonarfila= $("#factura_detalles").find("tbody tr:last").clone();
      $("table tbody").append(clonarfila);
    });

    /* Eliminar Fila */
    $("#factura_detalles").on('click', '.button_eliminar_producto', function () {
      var numeroFilas = $("#factura_detalles tr").length;
      if(numeroFilas>6){
        $(this).closest('tr').remove();
      }
    });

    /* Detect click Select */
    $('#cliente_id').change(function() {
      // console.log( $(this).val() );
      var id = $(this).val();
      $.get('/direccionCliente/'+id, function (value) {
        // console.log(value);
        $('#direccion').val( value );
      })
    })

  });
</script>
@endsection

