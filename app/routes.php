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

Route::get('/', function() {
	return View::make('pages.index');
});

Route::get('/account/login', 'Controllers\LoginController@view');
Route::post('/account/login', 'Controllers\LoginController@submit');

Route::get('/account/logout', 'Controllers\LoginController@logout');

Route::get('/account/signup', 'Controllers\LoginController@regview');
Route::post('/account/signup', 'Controllers\LoginController@regsubmit');

Route::group(array('before' => 'auth'), function() {
	Route::get('/board', 'Controllers\BoardController@index');
	Route::post('/board/new', 'Controllers\BoardController@create');
	Route::get('/board/{id}', 'Controllers\BoardController@view');
	Route::get('/board/{id}/public', 'Controllers\BoardController@makePublic');

	Route::group(array('prefix' => '/api'), function() {

		Route::any('/image/upload', 'Controllers\ImageController@upload');
		Route::get('/', 'Controllers\ResourceController@bulkGet');
		Route::post('/', 'Controllers\ResourceController@bulkSave');

		$gencycle = function($resource) {
			Route::get($resource, 'Controllers\ResourceController@' . $resource .'_index');
			Route::post($resource, 'Controllers\ResourceController@' . $resource .'_create');
			Route::get($resource . '/{id}', 'Controllers\ResourceController@' . $resource .'_get');
			Route::post($resource . '/{id}/edit', 'Controllers\ResourceController@' . $resource .'_edit');
			Route::delete($resource . '/{id}', 'Controllers\ResourceController@' . $resource .'_delete');
		};
		$resources = array('image', 'color', 'file', 'text');

		foreach ($resources as $r) {
			$gencycle($r);
		}

	});
});