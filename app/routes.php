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
	Route::resource('image', 'Controllers\Resource@image');
	Route::resource('color', 'Controllers\Resource@color');
	Route::resource('file', 'Controllers\Resource@file');
	Route::resource('text', 'Controllers\Resource@text');
});