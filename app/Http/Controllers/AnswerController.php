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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
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
