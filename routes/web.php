<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', 'SiteController@index');

Route::group(['prefix' => 'site', 'as' => 'site.'], function() {
	Route::get('/', 'SiteController@index')->name('index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
	Route::get('/', 'ClientsController@index')->name('clients'); //listar clientes
	Route::post('/client/create', 'ClientsController@save')->name('clients.create'); //cadastrar cliente
	Route::get('/client/edit/{id?}', 'ClientsController@index')->name('clients.edit'); //listar form cliente
	Route::put('/client/update', 'ClientsController@save')->name('clients.update'); //atualizar cliente
	Route::delete('client/delete/{id}', 'ClientsController@delete')->name('clients.delete'); //deletar cliente
});
