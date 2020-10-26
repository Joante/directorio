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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/legislador/create', 'LegisladorController@create')->name('legislador.create');
Route::post('/legislador/store', 'LegisladorController@store')->name('legislador.store');
Route::get('legisladores', 'LegisladorController@index')->name('legislador.index')->middleware('auth');
Route::get('/legisladores/{id}/edit', 'LegisladorController@edit')->middleware('auth');
Route::get('/legisladores/{id}', 'LegisladorController@show')->middleware('auth');
Route::post('/legisladores/destroy', 'LegisladorController@destroy')->middleware('auth');
Route::post('/legisladores/{id}/update', 'LegisladorController@update')->name('legisladores.update')->middleware('auth');
Route::post('legisladores/filter', 'LegisladorController@filterLegislastor')->middleware('auth');


