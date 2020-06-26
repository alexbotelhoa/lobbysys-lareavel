<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
 * Rotas do Sistema de Controle de Portaria - LobbySys v1.0
 */

// Routas de Controle de Acesso ao Sistema
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('logout','AuthController@logout');

// Routas de Visitantes
Route::resource('visitors', 'VisitorController');

// Routas de Salas ou Apartamentos
Route::resource('rooms', 'RoomController');

// Routas da Fila de Espera
Route::get('/queues', 'QueueController@index');
Route::post('/queues', 'QueueController@store');
Route::delete('/queues/{id}', 'QueueController@destroy');

// Routas dos Registros de Entrada de Visitantes
Route::get('/arrivals', 'ArrivalController@index');
Route::post('/arrivals', 'ArrivalController@store');
Route::delete('/arrivals/{id}', 'ArrivalController@destroy');

// Routas do Histórico dos Registros de Portaria
Route::post('/concierges', 'ConciergeController@store');
Route::get('/concierges', 'ConciergeController@filter');
