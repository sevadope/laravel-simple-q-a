<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {

	$question_id = Question::get('id')->random()->id;
    $user_id = User::get('id')->random()->id;

	$body = $faker->realText(rand(10, 300));
	$created_at = Carbon::now();

    return [
        'question_id' => $question_id,
        'user_id' => $user_id,
        'body' => $body,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
