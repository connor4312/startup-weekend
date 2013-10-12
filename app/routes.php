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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/mood', 'Controllers\BoardController@index');

Route::group(array('prefix' => '/api'), function() {

	$gencycle = function($resource) {
		Route::get($resource, 'Controllers\ResourceController@' . $resource .'_index');
		Route::post($resource . '/create', 'Controllers\ResourceController@' . $resource .'_create');
		Route::get($resource . '/{id}', 'Controllers\ResourceController@' . $resource .'_get');
		Route::post($resource . '/{id}/edit', 'Controllers\ResourceController@' . $resource .'_edit');
		Route::delete($resource . '/{id}', 'Controllers\ResourceController@' . $resource .'_delete');
	};
	$resources = array('image', 'color', 'file', 'text');

	foreach ($resources as $r) {
		$gencycle($r);
	}
});