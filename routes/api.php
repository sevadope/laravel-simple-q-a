<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*|========| Users |=======|*/

Route::group(
	[
		'prefix' => 'users',
		'as' => 'users.'
	],
	function () {

		Route::group(
			[
				'prefix' => 'me',
				'as' => 'me',
				'middleware' => 'auth:api',
			],
			function () {

			Route::get('', 'Api\MyUserController@show')
				->name('show');

			Route::get('answers', 'Api\MyUserController@answers')
				->name('answers');

			Route::get('questions', 'Api\MyUserController@questions')
				->name('questions');
		});


		Route::get('', 'Api\UserController@list')
			->name('list');

		Route::get('{user}/answers', 'Api\UserController@answers')
			->name('answers');

		Route::get('{user}/questions', 'Api\UserController@questions')
			->name('questions');

		Route::get('{user}', 'Api\UserController@show')
			->name('show');
});

