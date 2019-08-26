<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Http\Requests\Admin\UserUpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

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

    public function questions(User $user)
    {
        $user = $user->withCount('questions', 'answers', 'comments')->first();
        $questions = Question::getPaginatedForUser($user->id);

        return view('admin.users.show.questions', compact('user', 'questions'));
    }

    public function answers(User $user)
    {
        $user = $user->withCount('questions', 'answers', 'comments')->first();
        $answers = Answer::getPaginatedForUser($user->id);

        return view('admin.users.show.answers', compact('user', 'answers'));
    }

    public function comments(User $user)
    {

        $comments = Comment::getPaginatedForUser($user->id);

        $comments
            ->where('commentable_type', Answer::class)
            ->load('commentable.question:id,title');

        $comments
            ->where('commentable_type', Question::class)
            ->load('commentable:id,title');

        return view('admin.users.show.comments', compact('user', 'comments'));
    }
    /************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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

}
