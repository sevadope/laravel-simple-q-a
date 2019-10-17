<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Like;
use App\Http\Requests\AnswerStoreRequest;
use App\Http\Requests\AnswerUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AnswerService;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Answer::class, 'answer');
    }

    public function addLike(Answer $answer)
    {
        if ($answer->likes->contains('user_id', auth()->id())) {
            return json_encode(['result' => 'Bad']);
        }

        $like = $answer->likes()->create([
            'user_id' => auth()->id(),
            'likeable_type' => Answer::class,
            'likeable_id' => $answer->id,
        ]);

        if ($like && $like->exists) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'removeLike'], $answer->id),
            ]);
        } else {
            return json_encode(['result' => 'Bad']);
        }
    }

    public function removeLike(Answer $answer)
    {
        $like = $answer->likes
            ->where('user_id', auth()->id())
            ->first();

        if ($like) {
            $deleted = $like->delete();
        }

        if (isset($deleted)) {
            return json_encode([
                'result' => 'Ok',
                'next_uri' => action([self::class, 'addLike'], $answer->id),
            ]);
        } else {
            return json_encode(['result' => 'Bad']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        AnswerStoreRequest $request,
        AnswerService $answer_service
    )
    {
        $data = $request->validated();
        $answer = $answer_service->create($data);

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
                ->route('questions.show', $answer->question_id)
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

    public function changeStatus(Answer $answer)        
    {
        $this->authorize('change_status', $answer);
        
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
