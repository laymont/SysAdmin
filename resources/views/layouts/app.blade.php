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

    <nav id="main-menu" class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          @if(Auth::user())
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
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ url('/clientes') }}">Listado</a></li>
                <li><a class="dropdown-item" href="{{ route('clientes.create') }}">Nuevo</a></li>
                {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
              </ul>
            </li>
            {{-- Clientes --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Proveedores
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ url('/proveedores') }}">Listado</a></li>
                <li><a class="dropdown-item" href="{{ route('proveedores.create') }}">Nuevo</a></li>
                {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
              </ul>
            </li>
            {{-- Productos --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#"> Productos</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                {{-- Departamentos --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Departamentos</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('departamentos.create') }}">Nuevo</a></li>
                    <li><a class="dropdown-item" href="{{ route('departamentos.index') }}"> Listado</a></li>
                    {{-- <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">A long sub menu</a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Menu item 55</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 56</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 57</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 58</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 59</a></li>
                        <li><a class="dropdown-item" href="#">Menu item 60</a></li>
                      </ul>
                    </li> --}}
                  </ul>
                </li>
                <li class="dropdown-divider"></li>
                {{-- Marcas --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Marcas</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('marcas.create') }}">Nueva</a></li>
                    <li><a class="dropdown-item" href="{{ route('marcas.index') }}"> Listado</a></li>
                  </ul>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Productos</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/productos') }}"> Listado</a></li>
                    <li><a class="dropdown-item" href="{{ route('productos.create') }}"> Nuevo</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            {{-- Compras --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">Compras</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('/compras') }}">Compras</a></li>
                <li><a class="dropdown-item" href="{{ route('compras.create') }}">Nueva</a></li>
                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#verCompra">Ver</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Anular</a></li>
              </ul>
            </li>
            {{-- Inventarios --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">Inventarios</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('/inventarios') }}">Inventario</a></li>
              </ul>
            </li>
            {{-- Ventas --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">Ventas</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Ventas</a></li>
                <li><a class="dropdown-item" href="#">Facturar</a></li>
                <li><a class="dropdown-item" href="#">Reimprimir</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('inventarios.precios') }}">Lista de Precios</a></li>
                <li class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Anular</a></li>
              </ul>
            </li>
            {{-- Administracion --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">Admin</a>
              <ul class="dropdown-menu">
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Bancos</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('bancos.index') }}">Cuentas</a></li>
                  </ul>
                </li>
                <li class="dropdown-divider"></li>
                {{-- Cuentas --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Cuentas por</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admins.ctapagar.index') }}"> Pagar</a></li>
                    <li><a class="dropdown-item" href="#"> Cobrar</a></li>
                  </ul>
                </li>
                <li class="dropdown-divider"></li>
                {{-- Usuarios --}}
                @if (!Auth::user()->hasRole('user'))
                <a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios </a>
                @endif
                <li class="dropdown-divider"></li>
                {{-- Servidores --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Servidores</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('servidores.index') }}"> Listado</a></li>
                    <li><a class="dropdown-item" href="#">Nuevo</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            {{-- Contabilidad --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">Contab</a>
              <ul class="dropdown-menu">
                {{-- Usuarios --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Compras</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Libro</a></li>
                  </ul>
                </li>
                <li class="dropdown-divider"></li>
                {{-- Servidores --}}
                <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Ventas</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Libro</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          @endif
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
            {{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> --}}
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </ul>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    {{-- Modal Ver Compra --}}
    <!-- Modal -->
    <div class="modal fade" id="verCompra" tabindex="-1" role="dialog" aria-labelledby="verCompra" aria-hidden="true">
      <div class="modal-dialog" role="document">
        {!! Form::open(['route'=>'compras.showall','method'=>'post']) !!}
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="verCompraLabel">Ver Compra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::label('compra_id', 'Compra Nº', ['class'=>'control-label']) !!}
            {!! Form::number('compra_id', null, ['class'=>'form-control','placeholder'=>'Numero de la Compra']) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Ver</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>

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
