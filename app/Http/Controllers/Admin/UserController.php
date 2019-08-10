<?php

namespace App\Http\Controllers\Admin;

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

    public function info($id)
    {
        $user = User::getForShow($id);

        return view('admin.users.show.info', compact('user'));
    }

    public function questions($id)
    {
        $user = User::getForShow($id);

        return view('admin.users.show.questions', compact('user'));
    }

    public function answers($id)
    {
        $user = User::getForShow($id);

        return view('admin.users.show.answers', compact('user'));
    }

    public function comments($id)
    {
        $user = User::getForShow($id);

        return view('admin.users.show.comments', compact('user'));
    }    

    /************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::getForEdit($id);

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
        $result = User::destroy($user->id);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'User successfuly deleted']);
        } else {
            return back()
                ->withErrors(['msg' => 'Delete error. Please try again.']);
        }
    }
}
