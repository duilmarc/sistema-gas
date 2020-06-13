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
Route::resource('/clientes','ClienteController');
Route::get('/clientes/{telefono}', 'ClienteController@show');

Route::resource('/ventas', 'VentaController');
Route::resource('/almacen', 'AlmacenController');

