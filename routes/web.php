<?php

use Illuminate\Support\Facades\Route;

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

//----> Routes for axios request <-----//

//-> Routes for concesionarios
Route::get('/getting/concesionarios', 'ConcesionarioController@getAll');

//-> Routes for clientes
Route::post('/sending/cliente', 'ClienteController@save');
Route::put('/sending/new/changes/cliente', 'ClienteController@saveUpdate');
Route::get('/getting/clientes', 'ClienteController@getAll');
Route::put('/removing/cliente', 'ClienteController@remove');
Route::put('/resetting/cliente/{idCliente}', 'ClienteController@resetCliente');
Route::get('/getting/clientes/by/concesionario/{idConcesionario}', 'ClienteController@getClienteByConcesionario');
Route::get('/getting/clientes/by/name/{word}', 'ClienteController@getClienteByName');
Route::get('/getting/clientes/by/doc/{doc}', 'ClienteController@getClienteByDoc');

//-----> End Routes for axios request <-----//