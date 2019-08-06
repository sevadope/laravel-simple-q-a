<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	factory(\App\Models\User::class, 20)->create();
    	$this->call(TagSeeder::class);
    	factory(\App\Models\Question::class, 100)->create();
    	$this->call(QuestionTagRelationSeeder::class);
    	factory(\App\Models\Answer::class, 100)->create();
    	factory(\App\Models\Comment::class, 200)->create();
    }
}
