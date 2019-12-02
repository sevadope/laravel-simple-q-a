<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Answer as AnswerResource;
use App\Models\Answer;

class AnswerController extends Controller
{
	private const MAX_LIST_PAGE_SIZE = 100;
	private const LIST_PAGE_SIZE = 10;
    private const QUERY_LIMIT_NAME = 'limit';
    private const QUERY_ORDER_NAME = 'order_by';

    public function show(Answer $answer)
    {
    	return new AnswerResource($answer);
    }

    public function comments(Answer $answer)
    {
    	return new CommentCollection($answer->comments);
    }

    public function list(Request $request)
    {
    	$query = $request->query();
    	$options = $this->sortingOptions();

    	$limit = (integer)(isset($query[self::QUERY_LIMIT_NAME]) && 
    	    		$query[self::QUERY_LIMIT_NAME] <= self::MAX_LIST_PAGE_SIZE ? 
    	    			$query[self::QUERY_LIMIT_NAME] : self::LIST_PAGE_SIZE);

		$order_by = isset($query[self::QUERY_ORDER_NAME]) && 
			array_key_exists($query[self::QUERY_ORDER_NAME], $options) ? 
				$options[$query[self::QUERY_ORDER_NAME]] : $options['default'];

		return new AnswerCollection(
			Answer::orderByRaw($order_by)->simplePaginate($limit)
		);
    }

    private function sortingOptions()
    {
    	return [
    		'default' => 'created_at desc',
    		'created_at' => 'created_at',
    	];
    }
}
