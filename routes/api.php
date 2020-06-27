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

// Routas de Controle de Usuários
Route::get('/users', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::delete('/users/{id}', 'UserController@destroy');

// Routas de Controle de Visitantes
Route::get('/visitors', 'VisitorController@index');
Route::post('/visitors', 'VisitorController@store');
Route::delete('/visitors/{id}', 'VisitorController@destroy');

// Routas de Controle de Salas ou Apartamentos
Route::get('/rooms', 'RoomController@index');
Route::post('/rooms', 'RoomController@store');
Route::delete('/rooms/{id}', 'RoomController@destroy');

// Routas de Controle da Fila de Espera
Route::get('/queues', 'QueueController@index');
Route::post('/queues', 'QueueController@store');
Route::delete('/queues/{id}', 'QueueController@destroy');

// Routas de Controle do Registro de Visitantes
Route::get('/arrivals', 'ArrivalController@index');
Route::post('/arrivals', 'ArrivalController@store');
Route::delete('/arrivals/{id}', 'ArrivalController@destroy');

// Routas de Controle do Histórico dos Registros de Portaria
Route::post('/concierges', 'ConciergeController@store');
Route::get('/concierges', 'ConciergeController@filter');
