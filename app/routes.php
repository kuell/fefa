<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::get('/', function () {
		return Redirect::to('/fefa');
	});

Route::get('/fefa/relatorios', 'FefaController@getRelatorios');
Route::get('/fefa/relatorio/sif', 'FefaController@getRelatorioSif');
Route::get('/fefa/relatorio/fefa/{empresa}', 'FefaController@getRelatorioFefa');

Route::get('fefa/finalizar', function(){
	return View::make('finalizar');
});
Route::post('/fefa/finalizar', function(){
	$input = Input::all() + ['situacao'=>'fechado'];

	Fefa::abertas()->update($input);

	return 'Ok';
});


Route::resource('fefa', 'FefaController');
