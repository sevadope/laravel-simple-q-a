<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
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
                ->route('questions.show', $answer->question_id)
                ->with(['success' => 'Answer successfully created']);   
        } else {
            return back()
                ->withErrors(['msg' => 'Create error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('public.answers.edit', compact('answer'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $destroyed = $answer->delete();

        if ($destroyed) {
            return redirect()
                ->route('questions.show', $answer->question_id)
                ->with(['success' => 
                    "Answer with ID '$answer->id' successfully deleted"]);
        } else {
            return back()
                ->withErrors(['msg' => "Delete error. Please try again."]);
        } 
    }

    public function add_like(Answer $answer)
    {
        
    }

    public function changeStatus(Answer $answer)        
    {
        $answer->is_solution = $answer->is_solution === 0 ? 1 : 0;
        $saved = $answer->save();

        if ($saved) {
            return redirect()
                ->route('questions.show', $answer->question_id)
                ->with(['success' 
                    => $answer->is_solution ?
                        "Answer by {$answer->user->profileName} add to solutions"
                        :
                        "Answer by {$answer->user->profileName} removed from solutions"
                ]);              
        } else {
            return back()
                ->withErrors(['Please try again']);
        }
    }
}
