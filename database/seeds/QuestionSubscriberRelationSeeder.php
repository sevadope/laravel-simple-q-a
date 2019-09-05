<?php

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\User;

class QuestionSubscriberRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$relations = [];
        $questions_count = Question::count();
        $users_count = User::count();

        for ($q_id = 1; $q_id <= $questions_count; $q_id++) {

        	// 20% chance that subs count more than 4
	        $subs_count = random_int(0, 5) > 0 ?
	        	random_int(1, 4) 
	        	:
	        	random_int(5, 30);

        	for ($sub = 1; $sub <= $subs_count; $sub++) {
	        	$relations[] = [
	        		'question_id' => $q_id,
	        		'user_id' => random_int(1, $users_count),
	        	];        		
        	}
        }

        \DB::table('question_subscriber')->insert($relations);
    }
}
