<?php

use App\Models\Tag;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionTagRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$relations = [];

    	$tags_count = Tag::count();
    	$questions_count =  Question::count();

    	for ($q_id = 1; $q_id <= $questions_count; $q_id++) {
    		
            $q_tags_count = random_int(1, 5);

            for ($tag = 1; $tag <= $q_tags_count; $tag++) {
                $relations[] = [
                    'question_id' => $q_id,
                    'tag_id' => random_int(1, $tags_count),
                ];
            }
    	}

    	\DB::table('question_tag')->insert($relations);
    }
}
