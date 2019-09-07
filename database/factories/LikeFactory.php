<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker){

	$likeable_models = [
		Answer::class,
		Comment::class,
	];

	$likeable_type = array_rand(array_flip($likeable_models));

    return [
        'user_id' => random_int(1, User::count()),
        'likeable_type' => $likeable_type,
        'likeable_id' => random_int(1, $likeable_type::count()),
    ];
});