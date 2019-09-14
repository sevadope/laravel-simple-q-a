<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;
    
    public function change_status(User $user, Answer $answer)
    {
        return $user->questions->contains($answer->question_id);
    }

    /**
     * Determine whether the user can view any answers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the answer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Answer  $answer
     * @return mixed
     */
    public function view(User $user, Answer $answer)
    {
        return true;
    }

    /**
     * Determine whether the user can create answers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the answer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Answer  $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id ||
            $user->isModerator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Answer  $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id ||
            $user->isModerator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the answer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Answer  $answer
     * @return mixed
     */
    public function restore(User $user, Answer $answer)
    {
        return $user->isModerator() || $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the answer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Answer  $answer
     * @return mixed
     */
    public function forceDelete(User $user, Answer $answer)
    {
        return $user->isAdmin();
    }
}
