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

/* Users */
Route::resource('/usuarios','UserController');
Route::resource('/roles','RoleController');

Route::get('setUser/{idUser}', function($idUser) {
  $setUser = \App\Role_user::where('user_id','=', $idUser);
  $setUser->update(['role_id' => 3]);
  alert()->success('Operación exitosa', 'Usuario actualizado')->autoclose('3000');
  return redirect('usuarios');
})->name('setUser');

Route::get('setSuper/{idUser}', function($idUser) {
  $setSuper = \App\Role_user::where('user_id','=', $idUser);
  $setSuper->update(['role_id' => 2]);
  alert()->success('Operación exitosa', 'Usuario actualizado')->autoclose('3000');
  return redirect('usuarios');
})->name('setSuper');

/* Home */
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
Route::put('/compras/anular/{compra}','CompraController@anular')->name('compras.anular');
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
Route::resource('/bancos','BancoController');

Route::get('/admins/ctapagar/','CtapagarController@index')->name('admins.ctapagar.index');
Route::get('/admins/ctapagar/{compra}/pagar','CtapagarController@pagarCta')->name('admins.ctapagar.pagar');
Route::get('/admins/ctapagar/{id}/pagarcomplete','CtapagarController@completeCtapagar')->name('admins.ctapagar.pagarcomplete');
Route::patch('/admins/ctapagar/{compra}/finishfull','CtapagarController@finishCtapagar')->name('admins.ctapagar.finishfull');

/* Factutas */
Route::resource('admins/facturas','FacturaController');
/*
Route::get('/admins/facturas','FacturaController@index')->name('admins.facturas.index');
Route::get('/admins/facturas/{factura}','FacturaController@show')->name('admins.facturas.show');
*/

/* Servidores */
Route::resource('/servidores','ServidoreController');

/* Old Version */
Route::get('test', function() {
  $clientesOLD = \App\ClienteOld::all();
  dd($clientesOLD);
})->name('test');


