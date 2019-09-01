<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TagStoreRequest;
use App\Http\Requests\Admin\TagUpdateRequest;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::GetPaginatedIndex(18);

        return view('public.tags.index', compact('tags'));
    }

    /******** Tag`s profile routes ********/
    public function info(Tag $tag)
    {
        return view('public.tags.show.info', compact('tag'));
    }

    public function questions(Tag $tag)
    {
        $questions = Question::getPaginatedForTag($tag->id);

        return view('public.tags.show.questions', compact('questions', 'tag'));
    }
}
