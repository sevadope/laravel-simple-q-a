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
    	factory(\App\Models\User::class, 3000)->create();
    	$this->call(TagSeeder::class);
    	factory(\App\Models\Question::class, 1000)->create();
    	$this->call(QuestionTagRelationSeeder::class);
    	factory(\App\Models\Answer::class, 1500)->create();
    	factory(\App\Models\Comment::class, 2000)->create();
        $this->call(AdminUserSeeder::class);
        $this->call(QuestionSubscriberRelationSeeder::class);
        $this->call(TagSubscriberRelationSeeder::class);
        factory(\App\Models\Like::class, 5000)->create();
    }
}
