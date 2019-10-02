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
    /******** Subscriptions ********/

    public function subscribe(Tag $tag)
    {
        $sub_attached = $tag->subscribers()
            ->syncWithoutDetaching(auth()->id());

        if ($sub_attached) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'unsubscribe'], $tag->slug),
            ]);
        } else {
            return json_encode([
                'result' => 'Bad',
            ]);
        }
    }

    public function unsubscribe(Tag $tag)
    {
        $sub_detached = $tag->subscribers()->detach(auth()->id());

        if ($sub_detached) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'subscribe'], $tag->slug),
            ]);
        } else {
            return json_encode([
                'result' => 'Bad',
            ]);
        }
    }

    /******** CRUD ********/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::list()->paginate(18);

        return view('public.tags.index', compact('tags'));
    }

    /******** Tag`s profile routes ********/

    public function info(Tag $tag)
    {
        $tag = $tag->withCount('subscribers')->first();
        return view('public.tags.show.info', compact('tag'));
    }

    public function questions(Tag $tag)
    {
        $tag = $tag->withCount('subscribers')->first();
        $questions = Question::list()
            ->forTags($tag->id)
            ->paginate(20);

        return view('public.tags.show.questions', compact('questions', 'tag'));
    }

}
