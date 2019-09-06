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
        $questions = Question::list()
            ->forTags($tag->id)
            ->paginate(20);

        return view('public.tags.show.questions', compact('questions', 'tag'));
    }

    public function subscribe(Tag $tag)
    {
        $sub_attached = $tag->subscribers()
            ->syncWithoutDetaching(auth()->id());

        if ($sub_attached) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => $sub_attached.'Subscribe error. Please try again.']);
        }
    }

    public function unsubscribe(Tag $tag)
    {
        $sub_detached = $tag->subscribers()->detach(auth()->id());

        if ($sub_detached) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => 'Subscribe error. Please try again.']);
        }
    }
}
