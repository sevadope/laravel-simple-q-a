<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Question as QuestionResource;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use App\Models\Question;

class QuestionController extends Controller
{
	private const MAX_LIST_PAGE_SIZE = 100;
	private const LIST_PAGE_SIZE = 10;
    private const QUERY_LIMIT_NAME = 'limit';
    private const QUERY_ORDER_NAME = 'order_by';

	public function show(Question $question)
	{
		return new QuestionResource($question);
	}

	public function answers(Question $question)
	{
		return new AnswerCollection($question->answers);
	}

	public function comments(Question $question)
	{
		return new CommentCollection($question->comments);
	}

	public function author(Question $question)
	{
		return new UserResource($question->user()->forApi()->first());
	}

	public function list(Request $request)
	{
		$query = $request->query();
		$options = $this->sortingOptions();

		$limit = (integer) ($query[self::QUERY_LIMIT_NAME] ??
			self::LIST_PAGE_SIZE);

		$order_by = 
			isset($query[self::QUERY_ORDER_NAME]) && 
			array_key_exists($query[self::QUERY_ORDER_NAME], $options) ? 
				$options[$query[self::QUERY_ORDER_NAME]] : $options['default'];

        return new QuestionCollection(
        	Question::orderByRaw($order_by)->simplePaginate(
        		$limit <= self::MAX_LIST_PAGE_SIZE ? $limit : self::LIST_PAGE_SIZE
        	)
        );
	}

	private function sortingOptions()
	{
		return [
 			'default' => 'created_at desc',
 			'created_at' => 'created_at',
 			'views' => 'views_count desc'
		];
	}
}
