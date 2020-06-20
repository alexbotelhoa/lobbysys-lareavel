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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * Rotas do Sistema Visitor V1
 */

// Criação de Visitantes
Route::resource('visitors', 'VisitorController');

// Criação de Salas ou Apartamentos
Route::resource('rooms', 'RoomController');

// Criação dos Registros de Portaria
Route::resource('concierges', 'ConciergeController');

// Criação da Fila de Espera
Route::resource('queues', 'QueueController');
