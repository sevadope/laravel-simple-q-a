<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;
use Illuminate\Support\Arr;
use App\Http\Requests\UserUpdateRequest;
use App\Services\CommentService;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /*|========| CRUD |=======|*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::list()->paginate(18);
        
        return view('admin.users.index', compact('users'));
    }

    /*|=== User`s profile routes ===|*/

    public function info($name)
    {
        $user = User::getForShow($name);

        return view('admin.users.show.info', compact('user'));
    }

    public function questions($name)
    {
        $user = User::getForShow($name);
        $questions = Question::list()
            ->forUser($user->id)
            ->paginate(20);

        return view('admin.users.show.questions', compact('user', 'questions'));
    }

    public function answers($name)
    {
        $user = User::getForShow($name);
        $answers = Answer::list()->forUser($user->id)->paginate(20);

        return view('admin.users.show.answers', compact('user', 'answers'));
    }

    public function comments($name, CommentService $comment_service)
    {
        $user = User::getForShow($name);

        $comments = Comment::list()->forUser($user->id)
            ->paginate(20);

        $comment_service->loadQuestionTitles($comments);

        return view('admin.users.show.comments', compact('user', 'comments'));
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
        return view('admin.users.edit', compact('user'));
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
        $data = $request->validated();
        $image = $data['profile_image'] ?? false;

        if ($image) {
            $data['profile_image'] = $user_service
                ->setProfileImage($image, $user);
        }

        $updated = $user->update($data);

        if ($updated) {
            return redirect()
                ->route('admin.users.info', $user->name)
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
     * Remove current profile image and set default image
     * 
     * @param User $user
     * @return \Illuminate\Http\Response
    **/ 
    public function removeImage(User $user, UserService $user_service)
    {
        $this->authorize('removeImage', $user);

        $user_service->setDefaultProfileImage($user);

        return back();
    }

}
