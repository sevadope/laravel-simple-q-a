<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorting_tabs = $this->getListSortingTabs();
        $sorting_param = request()->query('tab') ?? 'newest';

        $query = Question::list();
        $questions = $this->setIndexSorting($query, $sorting_param)
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
    public function store(QuestionStoreRequest $request)
    {   
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        
        $item = (new Question())->create($data);
        $tags_sync = $item->tags()->sync($data['tags']);
        $sub_attached = $item->subscribers()->attache($data['user_id']);

        if ($item && $tags_sync && $sub_attached) {
            return redirect()
                ->route('questions.show', $item->id)
                ->with(['success' => 'Question successfuly created']);
        } else {
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

        return view('public.questions.show', compact('question'));
    }

    public function subscribe(Question $question)
    {
        $sub_attached = $question->subscribers()
            ->syncWithoutDetaching(auth()->id());

        if ($sub_attached) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => $sub_attached.'Subscribe error. Please try again.']);
        }
    }

    public function unsubscribe(Question $question)
    {
        $sub_detached = $question->subscribers()->detach(auth()->id());

        if ($sub_detached) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => 'Subscribe error. Please try again.']);
        }
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
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $data = $request->validated();

        $updated = $question->update($data);
        $tags_sync = $question->tags()->sync($data['tags']);

        if ($updated && $tags_sync) {

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

    private function setIndexSorting($query, string $sorting_param)
    {
        if ($sorting_param == '') {
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
