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
use App\Services\CommentService;
use Illuminate\Support\Facades\Storage;
use App\Services\UserService;
use App\Services\TopList\Managers\UsersTopListManager;

class UserController extends Controller
{
    /*|========| CRUD |=======|*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersTopListManager $list_manager)
    {
        $users_toplist = $list_manager->get();

        $users = User::list()->paginate(18);

        return view('public.users.index', compact('users', 'users_toplist'));
    }

    /*|=== User`s profile routes ===|*/

    public function info($name, UsersTopListManager $list_manager)
    {
        $users_toplist = $list_manager->get();

        $user = User::getForShow($name);

        return view('public.users.show.info', compact('user', 'users_toplist'));
    }

    public function questions($name, UsersTopListManager $list_manager)
    {
        $users_toplist = $list_manager->get();

        $user = User::getForShow($name);
        $questions = Question::list()
            ->forUser($user->id)
            ->paginate(20);

        return view(
            'public.users.show.questions',
            compact('user', 'questions', 'users_toplist')
        );
    }

    public function answers($name, UsersTopListManager $list_manager)
    {
        $users_toplist = $list_manager->get();

        $user = User::getForShow($name);
        $answers = Answer::list()
            ->forUser($user->id)
            ->paginate(20);

        return view(
            'public.users.show.answers',
            compact('user', 'answers', 'users_toplist')
        );
    }

    public function comments(
        $name,
        CommentService $comment_service,
        UsersTopListManager $list_manager
    )
    {
        $users_toplist = $list_manager->get();

        $user = User::getForShow($name);
        $comments = Comment::list()
            ->forUser($user->id)
            ->paginate(20);

        $comment_service->loadQuestionTitles($comments);

        return view(
            'public.users.show.comments', 
            compact('user', 'comments', 'users_toplist')
        );
    }
    /*|======|*/

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
    public function update(
        UserUpdateRequest $request,
        UserService $user_service,
        User $user
    )
    {   
        $this->authorize('update', $user);

        $data = $request->validated();
        $image = $data['profile_image'] ?? false;

        if ($image) {
            $data['profile_image'] = $user_service
                ->setProfileImage($image, $user);
        }

        $updated = $user->update($data);

        if ($updated) {
            return redirect()
                ->route('users.info', $user->name)
                ->with(['success' => "User $user->name successfuly updated"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        } 
    }

    /** 
     * Remove current profile image and set default image
     * 
     * @param User $user
     * @return \Illuminate\Http\Response
    **/ 
    public function removeImage(User $user, UserService $user_service)
    {
        $this->authorize('removeImage', $user);

        $success = $user_service->setDefaultProfileImage($user);

        if ($success) {
            return back();
        } else {
            return back()->withErrors(['msg' => 'Error']);
        }
    }
}
