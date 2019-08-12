<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\QuestionUpdateRequest;
use App\Http\Requests\Admin\QuestionStoreRequest;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Http\Request;
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
        $questions = Question::getPaginatedIndex();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.questions.create', compact('tags'));
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
        $user_id = auth()->user()->id;
        $data['user_id'] = $user_id;
        $item = (new Question())->create($data);
        $tags_sync = $item->tags()->sync($data['tags']);

        if ($item && $tags_sync) {
            return redirect()
                ->route('admin.questions.show', $item->id)
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
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $tags = Tag::all();

        return view('admin.questions.edit', compact('question', 'tags'));
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
                ->route('admin.questions.show', $question->id)
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
        $destroyed = Question::destroy($question->id);

        if ($destroyed) {
            return redirect()
                ->route('admin.questions.index')
                ->with(['success' => "Question with ID '$question->id' deleted"]);
        } else {
            return back()
                ->withErors(['msg' => 'Delete error. Please try again.']);
        }
    }
}
