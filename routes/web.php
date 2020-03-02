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

//Route::get('/', function () {
//    return view('painel');
//});

Route::get('/', 'PainelController@painel');

Route::resource('coletas', 'ColetaController');

Route::resource('sendeggs', 'SendEggController');

Route::resource('lotes', 'LoteController');
Route::post('lotes/search', 'LoteController@search');

Route::resource('aviarios', 'AviarioController');
Route::post('aviarios/search', 'AviarioController@search');
Route::get('aviarios/returnaviario/{idlote}', 'AviarioController@returnaviario');
Route::get('aviarios/totlotefemeas/{loteid}', 'AviarioController@totlotefemeas');
Route::get('aviarios/totlotemachos/{loteid}', 'AviarioController@totlotemachos');

//Route::resource('periodos', 'PeriodoController');
Route::get('periodos', 'PeriodoController@index')->name('periodos.index');
Route::post('periodos/search', 'PeriodoController@search');
Route::get('periodos/ativaperiodo/{ativo}', 'PeriodoController@ativaperiodo')->name('periodos.ativaperiodo');
Route::get('periodos/atualizaperiodo/{idperiodo}/{ativo}', 'PeriodoController@atualizaperiodo')->name('periodos.atualizaperiodo');