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
    		
    		$tag_id = random_int(1, $tags_count);

            $has2tags = random_int(1,2) > 1;

            $relations[] = [
                    'question_id' => $i,
                    'tag_id' => $tag_id,
            ];

            if ($has2tags) {
                $relations[] = [
                    'question_id' => $i,
                    'tag_id' => $tag_id == 10 ? 2 : 10,
                ];
            }
    	}

    	\DB::table('question_tag')->insert($relations);
    }
}
