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
	private const LIST_PAGE_SIZE = 10;

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

	public function list()
	{
        return new QuestionCollection(
        	Question::orderByDesc('created_at')->simplePaginate(self::LIST_PAGE_SIZE)
        );
	}
}
