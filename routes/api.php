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

/*|========| Questions |=======|*/

Route::group(
	[
		'prefix' => 'questions',
		'as' => 'questions.',
	],
	function () {
		Route::get('', 'Api\QuestionController@list')
			->name('list');

		Route::get('{question}', 'Api\QuestionController@show')
			->name('show');

		Route::get('{question}/answers', 'Api\QuestionController@answers')
			->name('answers');

		Route::get('{question}/comments', 'Api\QuestionController@comments')
			->name('comments');

		Route::get('{question}/author', 'Api\QuestionController@author')
			->name('author');
	}
);

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

/*|========| Answers |=======|*/

Route::group(
	[
		'prefix' => 'answers',
		'as' => 'answers.',
	],
	function () {
		Route::get('', 'Api\AnswerController@list')
			->name('list');

		Route::get('{answer}', 'Api\AnswerController@show')
			->name('show');

		Route::get('{answer}/comments', 'Api\AnswerController@comments')
			->name('comments');
	}
);

/*|========| Tags |=======|*/

Route::group(
	[
		'prefix' => 'tags',
		'as' => 'tags.'
	],
	function () {
		Route::get('', 'Api\TagController@list')
			->name('list');

		Route::get('{tag}', 'Api\TagController@show')
			->name('show');

		Route::get('{tag}/questions', 'Api\TagController@questions')
			->name('questions');
	}
);