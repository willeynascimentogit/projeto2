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
    return view('auth.login');
});
Auth::routes();

Route::get('/logar', 'UserController@logar')->name('logar');
Route::post('/entrar', ['as' => 'entrar', 'uses' => 'UserController@logar']);


Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth.cliente'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);


	Route::get('produtos/index', ['as' => 'produtos.index', 'uses' => 'ProdutoController@index']);
	Route::get('produtos/create', ['as' => 'produtos.create', 'uses' => 'ProdutoController@create']);
  Route::get('produtos/edit/{produto}', ['as' => 'produtos.edit', 'uses' => 'ProdutoController@edit']);
  Route::put('produtos/update/{produto}', ['as' => 'produtos.update', 'uses' => 'ProdutoController@update']);
  Route::post('produtos/store', ['as' => 'produtos.store', 'uses' => 'ProdutoController@store']);
  Route::get('produtos/{produto}', ['as' => 'produtos.destroy', 'uses' => 'ProdutoController@destroy']);


  Route::get('grupos/index', ['as' => 'grupos.index', 'uses' => 'GrupoController@index']);
  Route::get('grupos/create', ['as' => 'grupos.create', 'uses' => 'GrupoController@create']);
  Route::get('grupos/edit/{grupo}', ['as' => 'grupos.edit', 'uses' => 'GrupoController@edit']);
  Route::put('grupos/update/{grupo}', ['as' => 'grupos.update', 'uses' => 'GrupoController@update']);
  Route::post('grupos/store', ['as' => 'grupos.store', 'uses' => 'GrupoController@store']);
  Route::get('grupos/{grupo}', ['as' => 'grupos.destroy', 'uses' => 'GrupoController@destroy']);

  Route::any('users/index', ['as' => 'users.index', 'uses' => 'UserController@index']);
  Route::post('users/excel', ['as' => 'users.excel', 'uses' => 'UserController@excel']);
  // Route::get('grupos/create', ['as' => 'grupos.create', 'uses' => 'GrupoController@create']);
  // Route::get('grupos/edit/{grupo}', ['as' => 'grupos.edit', 'uses' => 'GrupoController@edit']);
  // Route::put('grupos/update/{grupo}', ['as' => 'grupos.update', 'uses' => 'GrupoController@update']);
  // Route::post('grupos/store', ['as' => 'grupos.store', 'uses' => 'GrupoController@store']);
  // Route::get('grupos/{grupo}', ['as' => 'grupos.destroy', 'uses' => 'GrupoController@destroy']);


  Route::get('condicaos/create/{grupo_id}', ['as' => 'condicaos.create', 'uses' => 'CondicaoController@create']);
  Route::get('condicaos/edit/{condicao}', ['as' => 'condicaos.edit', 'uses' => 'CondicaoController@edit']);
  Route::put('condicaos/update/{condicao}', ['as' => 'condicaos.update', 'uses' => 'CondicaoController@update']);
  Route::post('condicaos/store', ['as' => 'condicaos.store', 'uses' => 'CondicaoController@store']);
  Route::get('condicaos/{condicao}', ['as' => 'condicaos.destroy', 'uses' => 'CondicaoController@destroy']);

  Route::any('companhias/index', ['as' => 'companhias.index', 'uses' => 'CompanhiaController@index']);
  Route::get('companhias/create', ['as' => 'companhias.create', 'uses' => 'CompanhiaController@create']);
  Route::get('companhias/edit/{companhia}', ['as' => 'companhias.edit', 'uses' => 'CompanhiaController@edit']);
  Route::put('companhias/update/{companhia}', ['as' => 'companhias.update', 'uses' => 'CompanhiaController@update']);
  Route::post('companhias/store', ['as' => 'companhias.store', 'uses' => 'CompanhiaController@store']);
  Route::get('companhias/{companhia}', ['as' => 'companhias.destroy', 'uses' => 'CompanhiaController@destroy']);

  Route::post('companhias/excel', ['as' => 'companhias.excel', 'uses' => 'CompanhiaController@excel']);


  Route::get('parametros/choose/', ['as' => 'parametros.choose', 'uses' => 'ParametroController@choose']);
  Route::get('parametros/edit/{id}', ['as' => 'parametros.edit', 'uses' => 'ParametroController@edit']);
  Route::put('parametros/update/{parametros}', ['as' => 'parametros.update', 'uses' => 'ParametroController@update']);

  Route::any('calculos/index', ['as' => 'calculos.index', 'uses' => 'CalculoController@index']);
  Route::get('calculos/create', ['as' => 'calculos.create', 'uses' => 'CalculoController@create']);
  Route::post('calculos/confirm', ['as' => 'calculos.confirm', 'uses' => 'CalculoController@confirm']);
  Route::post('calculos/pdf', ['as' => 'calculos.pdf', 'uses' => 'CalculoController@pdf']);
  Route::get('calculos/pdfAdmin/{id}', ['as' => 'calculos.pdfAdmin', 'uses' => 'CalculoController@pdfAdmin']);
  Route::post('calculos/excel', ['as' => 'calculos.excel', 'uses' => 'CalculoController@excel']);


  Route::get('calculos/edit/{id}', ['as' => 'calculos.edit', 'uses' => 'CalculoController@edit']);
  Route::get('calculos/relatorio/{id}', ['as' => 'calculos.relatorio', 'uses' => 'CalculoController@relatorio']);
  Route::put('calculos/update/{calculo}', ['as' => 'calculos.update', 'uses' => 'CalculoController@update']);
  Route::post('calculos/store', ['as' => 'calculos.store', 'uses' => 'CalculoController@store']);
  Route::get('calculos/{calculo}', ['as' => 'calculos.destroy', 'uses' => 'CalculoController@destroy']);
  Route::get('calculos/{id}', ['as' => 'calculos.destroy', 'uses' => 'CalculoController@destroy']);

});

Route::group(['middleware' => 'auth.cliente'], function () {
  Route::get('calculos/index', ['as' => 'calculos.index', 'uses' => 'CalculoController@index']);
});
