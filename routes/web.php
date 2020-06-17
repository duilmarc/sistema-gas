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

Route::get('/ventas/a/{id}', 'VentaController@realizado');
Route::get('/ventas/c/{id}', 'VentaController@cancelado');
Route::get('/ventas/asignar/{id_venta}/{id_repartidor}', 'VentaController@asignar_repartidor');
Route::resource('/ventas', 'VentaController');

Route::resource('/almacen', 'AlmacenController');

Route::resource('/empleados','EmpleadoController');
Route::resource('/empleados/{telefono}/edit','EmpleadoController@edit');

Route::resource('/motos','MotoController');
Route::resource('/motos/{placa}/edit','MotoController@edit');


Route::resource('/clientes','ClienteController');
Route::get('/clientes/{telefono}', 'ClienteController@show');
Route::get('/clientes/{telefono}/edit', 'ClienteController@edit');