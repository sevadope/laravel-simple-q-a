<?php 

namespace App\Services;

use App\Models\Question;

class QuestionService 
{
	public function create(array $data, $user_id = null)
	{
		$data['user_id'] = $user_id ? $user_id : auth()->id();
		$item = (new Question())->create($data);
		$tags_sync = $item->tags()->sync($data['tags']);
		$item->subscribers()->attach($data['user_id']);

		if ($item->exists && $tags_sync) {
			return $item;
		}
		return false;
	}

	public function update(Question $question, array $data)
	{
		$updated = $question->update($data);
		$tags_sync = $question->tags()->sync($data['tags']);

		if ($updated && $tags_sync) {
			return true;
		}
		return false;
	}

	/** 
	 * Eager load for:
	 * -> Authors of:
	 * 	  - Question
	 *    - Question comments
	 *    - Answers
	 *    - Answers comments
	 * -> Likes for:
	 *    - Question comments
	 *    - Answers comments
	 * 
	 * @param Question
	 * @return void
	**/ 
	public function eagerLoadForShow($question)
	{
		$answers_comments = $question->answers->reduce(
			function ($total, $answer) {
				return $total->merge($answer->comments);
			}, 
			collect()
		);		

		$question->comments
			->merge($answers_comments)
			->load('likes')
			->merge($question->answers)
			->merge([$question])
			->load('user:id,name,first_name,last_name,profile_image');
	}

}
