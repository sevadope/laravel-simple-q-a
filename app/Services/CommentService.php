<?php 

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;

class CommentService 
{
	public function loadQuestionTitles($comments)
	{
		$comments->where('commentable_type', Question::class)
			->load('commentable:id,title');

		$comments->where('commentable_type', Answer::class)
			->load('commentable.question:id,title');
	}

	public function createForAnswer(array $data, $user_id = null)
	{
		$data['user_id'] = $user_id ? $user_id : auth()->id();
		$data['commentable_type'] = Answer::class;
		$comment = (new Comment())->create($data);

		return $comment;
	}

	public function createForQuestion(array $data, $user_id = null)
	{
		$data['user_id'] = $user_id ? $user_id : auth()->id();
		$data['commentable_type'] = Question::class;
		$comment = (new Comment())->create($data);

		return $comment;
	}
}
