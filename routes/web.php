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
    return view('index');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/servicios','ServicioController@index');

Route::get('/ventas/canceladas','VentaController@show_cancel');
Route::get('/ventas/realizadas','VentaController@show_accept');
Route::get('/ventas/comision','VentaController@show_comision_por_balon');
Route::get('/ventas/ventas_realizadas/{id}','EmpleadoController@ventas');
Route::get('/ventas/repartidores','VentaController@repartidores');

Route::get('/repartidores/asistencia','EmpleadoController@asistencia');
Route::get('/repartidores/asistencia/{id}','EmpleadoController@marcar_asistencia');


Route::get('/ventas/a/{id}', 'VentaController@realizado');
Route::get('/ventas/c/{id}', 'VentaController@cancelado');
Route::get('/ventas/asignar/{id_venta}/{id_repartidor}', 'VentaController@asignar_repartidor');
Route::get('/consulta', 'VentaController@buscar_cliente');

Route::get('/ventas/cartera', ['as' => '/ventas/cartera', 'uses' => 'EmpleadoController@descripcion_cartera']);

Route::get('/repartidores/cartera', 'EmpleadoController@cartera');

Route::resource('/ventas', 'VentaController');

Route::resource('/almacen', 'AlmacenController');
Route::get('/almacen/balones_prestados', 'AlmacenController@balones_prestados');

Route::resource('/empleados','EmpleadoController');
Route::resource('/empleados/{telefono}/edit','EmpleadoController@edit');

Route::resource('/motos','MotoController');
Route::resource('/motos/{placa}/edit','MotoController@edit');


Route::resource('/clientes','ClienteController');
Route::get('/clientes/{telefono}', 'ClienteController@show');
Route::get('/clientes/{telefono}/edit', 'ClienteController@edit');
Route::get('/clientes/balones_prestados','ClienteController@balones_prestados');

Route::resource('/gastos','GastosController');
Route::get('/gastos/{id}/edit', 'GastosController@edit');