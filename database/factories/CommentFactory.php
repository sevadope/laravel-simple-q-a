<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

	$user_id = User::get('id')->random()->id;

	$body = $faker->realText(rand(10, 150));
	$created_at = Carbon::now();

	list($commentable_id, $commentable_type) = rand(1, 5) > 3 ? 
		[
			Question::get('id')->random()->id,
			'App\Models\Question'
		] 
		:
		[
			Answer::get('id')->random()->id,
			'App\Models\Answer'
		];

    return [
        'user_id' => $user_id,
        'commentable_id' => $commentable_id,
        'commentable_type' => $commentable_type,
        'body' => $body,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
