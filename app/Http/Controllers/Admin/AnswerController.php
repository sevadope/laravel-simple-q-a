<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Http\Requests\Admin\AnswerStoreRequest;
use App\Http\Requests\Admin\AnswerUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $answer = (new Answer())->create($data);

        if ($answer) {
            return redirect()
                ->route('admin.questions.show', $answer->question_id)
                ->with(['success' => 'Answer successfully created']);   
        } else {
            return back()
                ->withErrors(['msg' => 'Create error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('admin.answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerUpdateRequest $request, Answer $answer)
    {
        $data = $request->validated();

        $updated = $answer->update($data);

        if ($updated) {
            return redirect()
                ->route('admin.questions.show', $answer->question_id)
                ->with(['success' => 'Answer successfully updated']);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again'])
                ->withInput();
        }
    }

    /**
     * Restore with comments
     *
     * @param int $id
     * @return void
     */
    public function restore($id)
    {
        $answer = Answer::withTrashed()->find($id);

        $restored = $answer->restore();

        if ($restored) {
            return redirect()
                ->route('admin.questions.show', $answer->question_id)
                ->with(['success' => 'Answer restored!']);
        } else {
            return back()
                ->withErrors(['msg' => 'Restore error']);
        }
    }           

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $question_id = $answer->question_id;
        $destroyed = $answer->delete();
        $restore_route = route('admin.answers.restore', $answer->id);

        if ($destroyed) {
            return redirect()
                ->route('admin.questions.show', $question_id)
                ->with(['success' => 
                    "Answer with ID '$answer->id' successfully deleted",
                    'restore_route' => $restore_route]);
        } else {
            return back()
                ->withErrors(['msg' => "Delete error. Please try again."]);
        }
    }
}
