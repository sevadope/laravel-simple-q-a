<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Http\Requests\Admin\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getPaginatedIndex();
        
        return view('admin.users.index', compact('users'));
    }

    /**** Profile ****/

    public function info($name)
    {
        $user = User::getForShow($name);

        return view('admin.users.show.info', compact('user'));
    }

    public function questions($name)
    {
        $user = User::getShowQuestions($name);

        return view('admin.users.show.questions', compact('user'));
    }

    public function answers($name)
    {
        $user = User::getShowAnswers($name);

        return view('admin.users.show.answers', compact('user'));
    }

    public function comments($name)
    {
        $user = User::getShowComments($name);

        $this->eagerloadQuestionTitles($user->comments);

        return view('admin.users.show.comments', compact('user'));
    }
    /************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        $user = User::getForEdit($name);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $updated = $user->update($data);

        if ($updated) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => "User $user->name successfuly updated"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $destroyed = User::destroy($user->id);

        if ($destroyed) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'User successfuly deleted']);
        } else {
            return back()
                ->withErrors(['msg' => 'Delete error. Please try again.']);
        }
    }

    /**
     * Eager load questions titles for show methods
     *
     * @param $comments
     * @return void
     */
    private function eagerloadQuestionTitles($comments)   
    {

        $question_ids = [];

        // Fill array by all comments questions ids
        $comments->each(function ($item) use (&$question_ids)
        {
            $question_ids[] = $item->commentable_type == Question::class ?
                $item->commentable_id
                :
                $item->commentable->question_id;

        });     

        $questions = Question::getTitles($question_ids);

        // Add questions ids and titles to every comments attributes arrray
        for ($i = 0; $i < $comments->count(); $i++) {
            $comments[$i]->setAttribute('question_id', $questions[$i]->id);
            $comments[$i]->setAttribute('question_title', $questions[$i]->title);
        }
    }
}
