<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/* Clientes */
Route::resource('/clientes','ClienteController');
/* Proveedores */
Route::resource('/proveedores','ProveedorController');
/* Productos */
// Departamentos
Route::resource('/departamentos','DepartamentoController');
// Marcas
Route::resource('/marcas','MarcaController');
// Productos
Route::resource('/productos','ProductoController');
/* Compras */
Route::post('/compras/showall','CompraController@showall')->name('compras.showall');
Route::resource('/compras','CompraController');
// Detalles
Route::resource('compras_detalles','CompraDetalleController');
/* Inventarios */
Route::get('/inventarios','InventarioController@index')->name('inventarios.index');
Route::post('/inventarios', 'InventarioController@store')->name('inventarios.store');

/* Lista de Precios */
Route::get('/inventarios/precios','AdminController@listaprecios')->name('inventarios.precios');

/* Admin */
Route::get('toinv/{compra_id}','AdminController@toinv')->name('toinv');

