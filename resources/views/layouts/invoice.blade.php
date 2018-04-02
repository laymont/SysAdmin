<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'SysAdmin') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.smartmenus.bootstrap-4.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
  {{-- DataTables-CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('datatables/Buttons-1.5.1/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('datatables/DataTables-1.10.16/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('datatables/Buttons-1.5.1/css/buttons.bootstrap4.min.css') }}">
  @yield('css')

  <style type="text/css" media="screen">
  body { font-family: 'Roboto', sans-serif; }
  table tbody { font-size: 0.8em !important; }
  input[type=number] { text-align: right; -moz-appearance: textfield; }
  input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; /* Removes leftover margin */ }
.number { text-align: right; }
.moneda { text-align: right;  }
.moneda:before { content: 'Bs. '; }
.porcentaje:after { content: '%'; }
</style>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
</head>
<body>
  {{-- Sweet-Alert --}}
  @include('sweet::alert')
  <div id="app">
    <main class="py-4">

      @yield('content')

    </main>
  </div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('bootstrap-4.0.0/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>

<script src="{{ asset('datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/jszip.min.js') }}"></script>
<script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('datatables/Buttons-1.5.1/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('datatables/numeric-comma.js') }}"></script>

<script src="{{ mix('js/font-awesome.js') }}"></script>

<script src="{{ asset('js/jquery.smartmenus.min.js') }}"></script>
<script src="{{ asset('js/jquery.smartmenus.bootstrap-4.min.js') }}"></script>

<script>
  var $=jQuery.noConflict();
  $(document).ready(function(){
    console.log('jQuery run ');
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

@yield('scripts')
</html>
