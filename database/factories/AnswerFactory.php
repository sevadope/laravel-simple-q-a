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
    
    // 20% that answer is solution
    $is_solution = random_int(1, 5) == 1 ? 1 : 0;
        
	$body = $faker->realText(rand(10, 300));

    $created_at = random_int(1, 3) > 1 ? 
        $faker->dateTimeBetween('-1 year')
        : $faker->dateTimeBetween('-3 days');

    return [
        'question_id' => $question_id,
        'user_id' => $user_id,
        'body' => $body,
        'created_at' => $created_at,
        'updated_at' => $created_at,
        'is_solution' => $is_solution,
    ];
});
