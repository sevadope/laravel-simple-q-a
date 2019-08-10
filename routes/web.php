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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Admin **/

Route::group(
	[
		'prefix' => 'admin',
		'namespace' => 'Admin',
		'middleware' => 'auth',
		'as' => 'admin.',
	],
	function () {

		Route::resource('users', 'UserController')
			->except('show')
			->names('users');

		Route::group(['prefix' => 'user', 'as' => 'users.'], function () {

			Route::get('{id}/info', 'UserController@info')->name('info');
			Route::get('{id}/questions', 'UserController@questions')->name('questions');
			Route::get('{id}/answers', 'UserController@answers')->name('answers');
			Route::get('{id}/comments', 'UserController@comments')->name('comments');
		});

		Route::resource('tags', 'TagController')
			->names('tags');

		Route::resource('questions', 'QuestionController')
			->names('questions');
});




