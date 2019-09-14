<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::list()->paginate(18);

        return view('public.users.index', compact('users'));
    }

    /******** User`s profile routes ********/
    public function info($name)
    {
        $user = User::getForShow($name);

        return view('public.users.show.info', compact('user'));
    }

    public function questions($name)
    {
        $user = User::getForShow($name);
        $questions = Question::list()
            ->forUser($user->id)
            ->paginate(20);

        return view('public.users.show.questions', compact('user', 'questions'));
    }

    public function answers($name)
    {
        $user = User::getForShow($name);
        $answers = Answer::list()
            ->forUser($user->id)
            ->paginate(20);

        return view('public.users.show.answers', compact('user', 'answers'));
    }

    public function comments($name)
    {
        $user = User::getForShow($name);

        $comments = Comment::list()
            ->forUser($user->id)
            ->paginate(20);

        $comments
            ->where('commentable_type', Answer::class)
            ->load('commentable.question:id,title');

        $comments
            ->where('commentable_type', Question::class)
            ->load('commentable:id,title');

        return view('public.users.show.comments', compact('user', 'comments'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('public.users.edit', compact('user'));
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
        $this->authorize('update', $user);

        $data = $request->validated();
        $updated = $user->update($data);

        if ($updated) {
            return redirect()
                ->route('users.index')
                ->with(['success' => "User $user->name successfuly updated"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        } 
    }
}
