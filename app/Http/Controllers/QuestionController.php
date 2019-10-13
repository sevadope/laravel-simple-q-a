<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use Illuminate\Routing\Route;

class QuestionController extends Controller
{
    /******** Subscriptions ********/
    
    public function subscribe(Question $question)
    {
        $sub_attached = $question->subscribers()
            ->syncWithoutDetaching(auth()->id());

        if ($sub_attached) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'unsubscribe'], $question->id),
            ]);
        } else {
            return json_encode([
                'result' => 'Bad',
            ]);
        }
    }

    public function unsubscribe(Question $question)
    {
        $sub_detached = $question->subscribers()->detach(auth()->id());

        if ($sub_detached) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'subscribe'], $question->id),
            ]);
        } else {
            return json_encode([
                'result' => 'Bad',
            ]);
        }
    }

    /******** CRUD ********/

    public function feed()
    {
        $this->authorize('feed', Question::class);

        $sorting_tabs = $this->getListSortingTabs();
        $sorting_param = request()->query('tab');

        $user_tags = auth()->user()->subscribed_tags->modelKeys();

        if (empty($user_tags)) {
            return redirect()
                ->route('tags.index')
                ->with(['success' => 
                    'Please subscribe to few tags for fill your feed']);
        }

        $query = Question::list()->forTags($user_tags);
        $questions = $this->setQuerySorting($query, $sorting_param)
            ->paginate(20);

        return view(
            'public.questions.feed', 
            compact('questions', 'sorting_param', 'sorting_tabs')
        );
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorting_tabs = $this->getListSortingTabs();
        $sorting_param = request()->query('tab');

        $query = Question::list();
        $questions = $this->setQuerySorting($query, $sorting_param)
            ->paginate(20);

        return view(
            'public.questions.index',
            compact('questions', 'sorting_param', 'sorting_tabs')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::getForSelect();

        return view('public.questions.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        QuestionStoreRequest $request,
        QuestionService $question_service
    )
    {   
        $data = $request->validated();
        $item = $question_service->create($data);

        if ($item) {
            return redirect()
                ->route('questions.show', $item->id)
                ->with(['success' => 'Question successfuly created']);
        } else {
            dd($item);
            return back()
                ->withErors(['msg' => 'Create error. Please try again'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::getForShow($id);

        $question->comments->merge($question->answers)
            ->load('user:id,name,first_name,last_name,profile_image');

        $question->increment('views_count');
        
        return view('public.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {   
        $tags = Tag::getForSelect();

        return view('public.questions.edit', compact('question', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(
        QuestionUpdateRequest $request,
        Question $question,
        QuestionService $question_service
    )
    {
        $data = $request->validated();
        $updated = $question_service->update($question, $data);

        if ($updated) {

            return redirect()
                ->route('questions.show', $question->id)
                ->with(['success' => 'Question successfuly updated']);  
        } else {

            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $destroyed = $question->delete();

        if ($destroyed) {
            return redirect()
                ->route('questions.index')
                ->with(['success' => "Question with ID '$question->id' deleted"]);
        } else {
            return back()
                ->withErors(['msg' => 'Delete error. Please try again.']);
        }
    }

    /******** Custom functions ********/

    /**** Sorting ****/

    private function setQuerySorting($query, $sorting_param)
    {
        if (is_null($sorting_param)) {
            return $query;
        }
        elseif ($sorting_param == 'newest') {
            return $query;
        }
        elseif ($sorting_param == 'without_answer') {
            return $query->withoutAnswer();
        }

        return  $query;
    }

    private function getListSortingTabs()
    {
        return [
            'newest' => 'New',
            'without_answer' => 'Without answer',
        ];
    }
}
