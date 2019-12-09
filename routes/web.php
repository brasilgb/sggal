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
    return view('painel');
});

Route::resource('coletas', 'ColetaController');

Route::resource('sendeggs', 'SendEggController');

Route::resource('lotes', 'LoteController');
Route::post('lotes/search', 'LoteController@search');

Route::resource('aviarios', 'AviarioController');
Route::post('aviarios/search', 'AviarioController@search');