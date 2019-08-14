<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
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
        $destroyed = $answer->delete();
        $restore_route = route('admin.answers.restore', $answer->id);

        if ($destroyed) {
            return back()
                ->with(['success' => 
                    "Answer with ID '$answer->id' successfuly deleted",
                    'restore_route' => $restore_route]);
        } else {
            return back()
                ->withErrors(['msg' => "Delete error. Please try again."]);
        }
    }
}
