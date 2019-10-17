<?php 

namespace App\Services;

use App\Models\Question;
use App\Models\Answer;

class AnswerService 
{
	public function create(array $data, $user_id = null)
	{
		$data['user_id'] = $user_id ? $user_id : auth()->id();
		$item = (new Answer())->create($data);

		return $item;
	}
}