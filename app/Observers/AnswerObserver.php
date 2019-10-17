<?php

namespace App\Observers;

use App\Models\Answer;

class AnswerObserver
{
    /**
     * Handle the answer "created" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "updated" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function updated(Answer $answer)
    {
        //
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
    public function deleting(Answer $answer)
    {
        $answer->comments()->delete();
    }

    /**
     * Handle the answer "deleted" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "restored" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function restored(Answer $answer)
    {
        $answer->comments()->restore();
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
    public function forceDeleting(Answer $answer)
    {
        dd(__METHOD__);
    }

    /**
     * Handle the answer "force deleted" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function forceDeleted(Answer $answer)
    {
        //
    }
}
