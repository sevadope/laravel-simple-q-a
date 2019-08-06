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

    	for ($i = 0; $i < $questions_count; $i++) {
    		
    		$tag_id = rand(1, $tags_count);

    		list($relations[], $relations[]) = [
    			[
    				'question_id' => $i,
    				'tag_id' => $tag_id,
    			],

    			[
    				'question_id' => $i,
    				'tag_id' => $tag_id == 10 ? 1 : 10,
    			]
    		];
    	}

    	\DB::table('question_tag')->insert($relations);
    }
}
