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

Auth::routes();
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'PainelController@painel')->name('home');
});


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
Route::post('lotes/search', 'LoteController@search');
Route::resource('lotes', 'LoteController');


// Operações nos aviários
Route::prefix('aviarios')->name('aviarios.')->group(function() {
    Route::get('/returnaviario/{idlote}', 'AviarioController@returnaviario')->name('returnaviario');
    Route::get('/totlotefemeas/{loteid}', 'AviarioController@totlotefemeas')->name('totlotefemeas');
    Route::get('/totlotemachos/{loteid}', 'AviarioController@totlotemachos')->name('totlotemachos');
    Route::post('/search', 'AviarioController@search')->name('search');
});
Route::resource('aviarios', 'AviarioController');

// Operações nas baixas de aves
Route::prefix('aves')->name('aves.')->group(function() {
    Route::get('/returnave/{idlote}', 'AveController@returnave')->name('returnave');
    Route::get('/avesestoque/{loteid}/{idaviario}/{sexo}', 'AveController@avesestoque')->name('avesestoque');
    Route::get('/aviariosdolote/{loteid}', 'AveController@aviariosdolote')->name('aviariosdolote');
    Route::post('/search', 'AveController@search')->name('search');
});
Route::resource('aves', 'AveController');

// Operações nas baixas de aves
Route::prefix('coletas')->name('coletas.')->group(function() {
    Route::post('/search', 'ColetaController@search')->name('search');
    Route::get('/numcoleta/{data}/{idlote}/{idaviario}', 'ColetaController@numcoleta')->name('numcoleta');
    Route::get('/relatoriodiario', 'ColetaController@relatoriodiario')->name('relatoriodiario');
});
Route::resource('coletas', 'ColetaController');

// Operações nas baixas de aves
Route::prefix('envios')->name('envios.')->group(function() {
    Route::post('/search', 'EnvioController@search')->name('search');
    Route::get('/estoqueovos/{loteid}', 'EnvioController@estoqueovos')->name('estoqueovos');
});
Route::resource('envios', 'EnvioController');

// Operações nas peso de aves
Route::prefix('pesos')->name('pesos.')->group(function() {
    Route::post('/search', 'PesoController@search')->name('search');
    Route::get('/estoqueovos/{loteid}', 'PesoController@estoqueovos')->name('estoqueovos');
});
Route::resource('pesos', 'PesoController');

// Operações recebimento de racao
Route::namespace('Racao')->prefix('racao/recebimentos')->name('racao/recebimentos.')->group(function() {
    Route::post('/search', 'RecebimentoController@search')->name('search');
});
Route::resource('racao/recebimentos', 'Racao\RecebimentoController');

// Operações recebimento de racao
Route::namespace('Racao')->prefix('racao/consumos')->name('racao/consumos.')->group(function() {
    Route::post('/search', 'ConsumoController@search')->name('search');
});
Route::resource('racao/consumos', 'Racao\ConsumoController');

// Operações configuracoes da empresa
Route::resource('configuracoes/empresa', 'Configuracao\EmpresaController');

// Operações configuracoes de backup
Route::resource('configuracoes/backup', 'Configuracao\BackupController');

// Operações configuracoes de email
Route::resource('configuracoes/email', 'Configuracao\EmailController');

// Operações configuracoes de despesas
Route::namespace('Financeiro')->prefix('financeiro/despesas')->name('financeiro/despesas.')->group(function() {
    Route::post('/search', 'DespesaController@search')->name('search');
});
Route::resource('financeiro/despesas', 'Financeiro\DespesaController');

// Operações configuracoes de tarefas
Route::prefix('tarefas')->name('tarefas.')->group(function() {
    Route::post('/search', 'TarefaController@search')->name('search');
});
Route::resource('tarefas', 'TarefaController');


