<?php

use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')
    ->name('dashboard');


/*
 * Rotas das páginas de Administração de Visitantes - Tabela Visitors
 */
Route::prefix('/visitors')->group(function () {

    Route::get('/', 'VisitorController@index')
        ->name('visitors.index');

    Route::get('/new', 'VisitorController@create')
        ->name('visitors.create');

    Route::get('/{id}/edit', 'VisitorController@edit')
        ->name('visitors.edit');

});


/*
 * Rotas das páginas de Administração de Salas - Tabela Rooms
 */
Route::prefix('/rooms')->group(function () {

    Route::get('/', 'RoomController@index')
        ->name('rooms.index');

    Route::get('/new', 'RoomController@create')
        ->name('rooms.create');

    Route::get('/{id}/edit', 'RoomController@edit')
        ->name('rooms.edit');

});


/*
 * Rota da visualização dos Registros da Portaria - Tabela Concierge
 */
Route::get('/concierges', 'ConciergeController@index')
    ->name('concierges.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
