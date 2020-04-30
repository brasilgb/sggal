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

// Operações dos períodos de produção
Route::resource('periodos', 'PeriodoController');
Route::prefix('periodos')->name('periodos.')->group(function() {
    Route::get('/', 'PeriodoController@index')->name('index');
    Route::get('/ativaperiodo/{ativo}', 'PeriodoController@ativaperiodo')->name('ativaperiodo');
    Route::get('/atualizaperiodo/{idperiodo}/{ativo}', 'PeriodoController@atualizaperiodo')->name('atualizaperiodo');
    Route::get('/periodoativo/{ativo}', 'PeriodoController@periodoativo')->name('periodoativo');
    Route::post('/search', 'PeriodoController@search')->name('search');
});

// Operações nos lotes de aves
Route::resource('lotes', 'LoteController');
Route::post('lotes/search', 'LoteController@search');

// Operações nos aviários
Route::prefix('aviarios')->name('aviarios.')->group(function() {
    Route::get('/', 'AviarioController@index')->name('index');
    Route::get('/create', 'AviarioController@create')->name('create');
    Route::get('/edit/{aviario}', 'AviarioController@show')->name('show');
    Route::get('/returnaviario/{idlote}', 'AviarioController@returnaviario')->name('returnaviario');
    Route::get('/totlotefemeas/{loteid}', 'AviarioController@totlotefemeas')->name('totlotefemeas');
    Route::get('/totlotemachos/{loteid}', 'AviarioController@totlotemachos')->name('totlotemachos');
    Route::put('/store', 'AviarioController@store')->name('store');
    Route::put('/update/{aviario}', 'AviarioController@update')->name('update');
    Route::post('/search', 'AviarioController@search')->name('search');
    Route::delete('/destroy/{aviario}', 'AviarioController@destroy')->name('destroy');
});

// Operações nas baixas de aves
Route::prefix('aves')->name('aves.')->group(function() {
    Route::get('/', 'AveController@index')->name('index');
    Route::get('/create', 'AveController@create')->name('create');
    Route::get('/show/{ave}', 'AveController@show')->name('show');
    Route::get('/returnave/{idlote}', 'AveController@returnave')->name('returnave');
    Route::get('/avesestoque/{loteid}/{idaviario}/{sexo}', 'AveController@avesestoque')->name('avesestoque');
    Route::get('/aviariosdolote/{loteid}', 'AveController@aviariosdolote')->name('aviariosdolote');
    Route::put('/store', 'AveController@store')->name('store');
    Route::put('/update/{ave}', 'AveController@update')->name('update');
    Route::post('/search', 'AveController@search')->name('search');
    Route::delete('/destroy/{ave}', 'AveController@destroy')->name('destroy');
});

// Operações nas baixas de aves
Route::prefix('coletas')->name('coletas.')->group(function() {
//    Route::get('/', 'ColetaController@index')->name('index');
//    Route::get('/create', 'ColetaController@create')->name('create');
//    Route::get('/show/{coleta}', 'ColetaController@show')->name('show');
//    Route::put('/store', 'ColetaController@store')->name('store');
//    Route::put('/update/{coleta}', 'ColetaController@update')->name('update');
    Route::post('/search', 'ColetaController@search')->name('search');
//    Route::delete('/destroy/{coleta}', 'ColetaController@destroy')->name('destroy');
    Route::get('/numcoleta/{data}/{idlote}/{idaviario}', 'ColetaController@numcoleta')->name('numcoleta');
    Route::get('/relatoriodiario', 'ColetaController@relatoriodiario')->name('relatoriodiario');
});
Route::resource('coletas', 'ColetaController');

// Operações nas baixas de aves
Route::prefix('envios')->name('envios.')->group(function() {
//    Route::get('/', 'ColetaController@index')->name('index');
//    Route::get('/create', 'ColetaController@create')->name('create');
//    Route::get('/show/{coleta}', 'ColetaController@show')->name('show');
//    Route::put('/store', 'ColetaController@store')->name('store');
//    Route::put('/update/{coleta}', 'ColetaController@update')->name('update');
    Route::post('/search', 'EnvioController@search')->name('search');
    Route::get('/estoqueovos/{loteid}', 'EnvioController@estoqueovos')->name('estoqueovos');
//    Route::delete('/destroy/{coleta}', 'ColetaController@destroy')->name('destroy');
});
Route::resource('envios', 'EnvioController');

// Operações nas peso de aves
Route::prefix('pesos')->name('pesos.')->group(function() {
//    Route::get('/', 'ColetaController@index')->name('index');
//    Route::get('/create', 'ColetaController@create')->name('create');
//    Route::get('/show/{coleta}', 'ColetaController@show')->name('show');
//    Route::put('/store', 'ColetaController@store')->name('store');
//    Route::put('/update/{coleta}', 'ColetaController@update')->name('update');
    Route::post('/search', 'PesoController@search')->name('search');
    Route::get('/estoqueovos/{loteid}', 'PesoController@estoqueovos')->name('estoqueovos');
//    Route::delete('/destroy/{coleta}', 'ColetaController@destroy')->name('destroy');
});
Route::resource('pesos', 'PesoController');
