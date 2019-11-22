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

Route::get('/', 'QuestionController@index');

Auth::routes();

/*|========| Public |=======|*/

/*|=== Questions ===|*/

Route::resource('questions', 'QuestionController')
	->except('destroy');

Route::get('feed', 'QuestionController@feed')
	->name('questions.feed')
	->middleware('auth.basic');

Route::group(
	[
		'prefix' => 'questions',
		'middleware' => 'auth.basic'
	],
	function () {

	/*| Store comment for question |*/
	Route::post('{question}/question/comment',
		'CommentController@storeForQuestion')
		->name('comments.storeForQuestion');

	/*| Store comment for answer |*/
	Route::post('{question}/answer/comment',
		'CommentController@storeForAnswer')
		->name('comments.storeForAnswer');

	/*| User subscriptions |*/
	Route::get('{question}/unsubscribe', 
		'QuestionController@unsubscribe')
		->name('questions.unsubscribe');

	Route::get('{question}/subscribe', 
		'QuestionController@subscribe')
		->name('questions.subscribe');	
});


/*|=== Users ===|*/

Route::resource('users', 'UserController')
	->only('index', 'edit', 'update')->names('users');

/*| User`s Profile routes |*/
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {

	Route::get('{user}/info', 
		'UserController@info')
		->name('info');

	Route::get('{user}/questions', 
		'UserController@questions')
		->name('questions');

	Route::get('{user}/answers', 
		'UserController@answers')
		->name('answers');

	Route::get('{user}/comments', 
		'UserController@comments')
		->name('comments');

	Route::get('{user}/remove_image',
		'UserController@removeImage')
		->name('removeImage');
});


/*|=== Answers ===|*/

Route::resource('answers', 'AnswerController')
	->only('store', 'edit', 'update', 'destroy')
	->names('answers');

Route::get('answers/{answer}/change_status',
	'AnswerController@changeStatus')
	->name('answers.changeStatus');

Route::group(['middleware' => 'auth.basic'], function () {

	Route::get('answers/{answer}/add_like', 'AnswerController@addLike')
		->name('answers.addLike');

	Route::get('answers/{answer}/remove_like', 'AnswerController@removeLike')
		->name('answers.removeLike');	
});


/*|=== Comments ===|*/

Route::resource('comments', 'CommentController')
	->only('edit', 'update', 'destroy')
	->names('comments');

Route::group(['middleware' => 'auth.basic'], function () {

	Route::get('comments/{comment}/add_like', 'CommentController@addLike')
		->name('comments.addLike');

	Route::get('comments/{comment}/remove_like', 'CommentController@removeLike')
		->name('comments.removeLike');	
});


/*|=== Tags ===|*/

Route::resource('tags', 'TagController')
	->only('index');

Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {

	/*| Tag`s profile routes |*/
	Route::get('{tag}/info',
		'TagController@info')
		->name('info');

	Route::get('{tag}/questions',
		'TagController@questions')
		->name('questions');

	/*| User subscriptions |*/
	Route::group(['middleware' => 'auth.basic'], function () {
		
		Route::get('{tag}/unsubscribe',	
			'TagController@unsubscribe')
			->name('unsubscribe');

		Route::get('{tag}/subscribe', 
			'TagController@subscribe')
			->name('subscribe');	
	});
});

/*|=== API ===|*/

Route::group(
	[
		'middleware' => 'auth.basic',
		'prefix' => 'api',
		'as' => 'api.',
	],
	function () {
		Route::get('intro', 'Api\ClientController@intro')
			->name('intro');

		Route::group(['as' => 'clients.'], function () {
			Route::get('register', 'Api\ClientController@register')
				->name('register');
			Route::post('clients', 'Api\ClientController@store')
				->name('store');

			Route::get('{user}/apps', 'Api\ClientController@list')
				->name('list');

			Route::get('{client}', 'Api\ClientController@show')
				->name('show');

			Route::get('{client}/edit', 'Api\ClientController@edit')
				->name('edit');

			Route::patch('{client}', 'Api\ClientController@update')
				->name('update');		
		});


});

/*|========| Admin panel |=======|*/

Route::group(
	[
		'prefix' => 'admin',
		'namespace' => 'Admin',
		'middleware' => 'moderator',
		'as' => 'admin.',
	],
	function () {

		/*|=== Questions ===|*/

		Route::resource('questions', 'QuestionController');

		Route::post('questions/{question}/restore', 'QuestionController@restore')
			->name('questions.restore');

		/*| Store comment for question |*/
		Route::post('{question}/question/comment',
			'CommentController@storeForQuestion')
			->name('comments.storeForQuestion');

		/*| Store comment for answer |*/
		Route::post('{question}/answer/comment',
			'CommentController@storeForAnswer')
			->name('comments.storeForAnswer');


		/*|=== Users ===|*/

		Route::resource('users', 'UserController')
			->only('index', 'edit', 'update', 'destroy')
			->names('users');

		Route::group(['prefix' => 'users', 'as' => 'users.'], function () {

			Route::get('{user}/info', 'UserController@info')
				->name('info');

			Route::get('{user}/questions', 'UserController@questions')
				->name('questions');

			Route::get('{user}/answers', 'UserController@answers')
				->name('answers');

			Route::get('{user}/comments', 'UserController@comments')
				->name('comments');

			Route::get('{user}/remove_image', 'UserController@removeImage')
				->name('removeImage');
		});


		/*|=== Tags ===|*/

		Route::resource('tags', 'TagController')
			->except('show')
			->names('tags');

		Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {

			Route::get('{tag}/info', 'TagController@info')
				->name('info');

			Route::get('{tag}/questions', 'TagController@questions')
				->name('questions');

			Route::post('{tag}/restore', 'TagController@restore')
				->name('restore');
		});


		/*|=== Answers ===|*/

		Route::resource('answers', 'AnswerController')
			->only('index', 'store', 'edit', 'update', 'destroy')
			->names('answers');

		Route::post('answers/{answer}/restore', 'AnswerController@restore')
			->name('answers.restore');

		Route::get('answers/{answer}/change_status',
			'AnswerController@changeStatus')
			->name('answers.changeStatus');


		/*|=== Comments ===|*/

		Route::resource('comments', 'CommentController')
			->only('index', 'edit', 'update', 'destroy')
			->names('comments');

		Route::post('comments/{comment}/restore', 'CommentController@restore')
			->name('comments.restore');
});




