<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Answer;
use App\Models\Question;

class QuestionObserver
{
    /**
     * Handle the question "created" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function created(Question $question)
    {
        //
    }

    /**
     * Handle the question "updated" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function updated(Question $question)
    {
        //
    }

    /**
     * Delete question`s answers and comments
     *
     * @param void
     * @return void
     */
    public function deleting(Question $question)
    {
        $question->answers()->each(function ($item) {
            $item->delete();
        });
        $question->comments()->delete();
    }

    /**
     * Handle the question "deleted" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function deleted(Question $question)
    {
        //
    }

    /**
     * Handle the question "restored" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function restored(Question $question)
    {
        //
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
    public function forceDeleting(Question $question)
    {
        dd(__METHOD__);
    }

    /**
     * Handle the question "force deleted" event.
     *
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function forceDeleted(Question $question)
    {
        //
    }
}
