<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\QuestionCollection;
use App\Models\Tag;

class TagController extends Controller
{
	private const LIST_PAGE_SIZE = 10;
	private const QUESTIONS_PAGE_SIZE = 10;

    public function list(Request $request)
    {
    	return new TagCollection(
    		Tag::simplePaginate(self::LIST_PAGE_SIZE)
    	);
    }

    public function show(Tag $tag)
    {
    	return new TagResource($tag);
    }

    public function questions(Tag $tag)
    {
    	return new QuestionCollection(
    		$tag->questions()->orderByDesc('created_at')
    			->simplePaginate(self::QUESTIONS_PAGE_SIZE)
    	);
    }
}
