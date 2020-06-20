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


/*
 * Rotas das páginas de Administração de Visitantes - Tabela Visitors
 */
Route::prefix('/visitors')->group(function () {

    Route::get('/', 'VisitorController@index');

    Route::get('/new', 'VisitorController@create');

    Route::get('/{id}/edit', 'VisitorController@edit');

});


/*
 * Rotas das páginas de Administração de Salas - Tabela Rooms
 */
Route::prefix('/rooms')->group(function () {

    Route::get('/', 'RoomController@index');

    Route::get('/new', 'RoomController@create');

    Route::get('/{id}/edit', 'RoomController@edit');

});


/*
 * Rota da visualização dos Registros da Portaria - Tabela Concierge
 */
Route::get('/', 'ConciergeController@index');





