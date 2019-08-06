<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {

	$user_id = User::get('id')->random()->id;
    info($user_id);

	$title = $faker->bs() . '?';
	$description = $faker->realText(rand(20, 1000));
	
	$is_published = rand(1, 5) > 1;
	$created_at = $faker->dateTimeBetween('-3 weeks', '-1 week');

    return [
    	'user_id' => $user_id,
        'title' => $title,
        'description' => $description,
        'is_published' => $is_published,
        'published_at' => $is_published ? 
        	$faker->dateTimeBetween('-1 week') : null,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});
