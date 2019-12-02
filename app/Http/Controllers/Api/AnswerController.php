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
	private const LIST_PAGE_SIZE = 10;

    public function show(Answer $answer)
    {
    	return new AnswerResource($answer);
    }

    public function comments(Answer $answer)
    {
    	return new CommentCollection($answer->comments);
    }

    public function list()
    {
		return new AnswerCollection(
			Answer::orderByDesc('created_at')->simplePaginate(self::LIST_PAGE_SIZE)
		);
    }
}
