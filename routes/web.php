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

			Route::get('{user}/info', 'UserController@info')->name('info');
			Route::get('{user}/questions', 'UserController@questions')->name('questions');
			Route::get('{user}/answers', 'UserController@answers')->name('answers');
			Route::get('{user}/comments', 'UserController@comments')->name('comments');
		});

		Route::resource('tags', 'TagController')
			->names('tags');

		Route::resource('questions', 'QuestionController')
			->names('questions');
});




