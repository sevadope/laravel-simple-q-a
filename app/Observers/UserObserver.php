<?php

namespace App\Observers;

use App\Models\Question;
use App\Models\Comment;
use App\Models\Answer;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Delete childs like cascade
     *
     * @param void
     * @return void
     */
    public function deleting(User $user)
    {
        $user->answers->each(function ($item) {
            $item->comments()->forceDelete();
        });
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
    public function forceDeleting(User $user)
    {
        dd($user->questions(), __METHOD__);
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
