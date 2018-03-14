<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
  {{-- DataTables-CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('datatables/DataTables-1.10.16/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('datatables/DataTables-1.10.16/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('datables/Buttons-1.5.1/css/buttons.bootstrap4.min.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('bootstrap-4.0.0/dist/js/bootstrap.min.js') }}"></script>

  {{-- jQuery --}}
  <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

  {{-- Sweet-Alert --}}
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <script src="{{ mix('js/font-awesome.js') }}"></script>
  {{-- DataTables-JS --}}
  <script src="{{ asset('datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('datatables/Buttons-1.5.1/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('datatables/Buttons-1.5.1/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('datatables/numeric-comma.js') }}"></script>

  <style type="text/css" media="screen">
    body { font-family: 'Roboto', sans-serif; }
    table tbody { font-size: 0.8em !important; }
  </style>

</head>
<body>
  {{-- Sweet-Alert --}}
  @include('sweet::alert')
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/home') }}">Inicio <span class="sr-only">(current)</span></a>
            </li>
            {{-- Clientes --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Clientes
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('/clientes') }}">Listado</a>
                <a class="dropdown-item" href="{{ route('clientes.create') }}">Nuevo</a>
                {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
              </div>
            </li>
            {{-- Clientes --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Proveedores
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('/proveedores') }}">Listado</a>
                <a class="dropdown-item" href="{{ route('proveedores.create') }}">Nuevo</a>
                {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
              </div>
            </li>
            {{-- Productos --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Productos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('departamentos.index') }}">Departamentos</a>
                <a class="dropdown-item" href="{{ route('marcas.index') }}">Marcas</a>
                <a class="dropdown-item" href="{{ url('/productos') }}">Listado</a>
                <a class="dropdown-item" href="#">Nuevo</a>
                <a class="dropdown-item" href="#">Lista de Precios</a>
              </div>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>
</div>


@yield('scripts')
</body>
</html>
