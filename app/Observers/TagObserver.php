<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    /**
     * Handle the tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "updated" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        //
    }

    /**
     * cascade soft deleting questions 
     * with their answers and comments
     *
     * @param void
     * @return void
     */
    public function deleting(Tag $tag)
    {
        $tag->questions
            ->where('tags_count', '1')
            ->each(function ($item) {
                $item->delete();
        });
    }

    /**
     * Handle the tag "deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "restored" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function restored(Tag $tag)
    {
        //
    }

    /**
     * summary
     *
     * @param void
     * @return void
     */
    public function forceDeleting(Tag $tag)
    {
        dd(__METHOD__);
    }

    /**
     * Handle the tag "force deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function forceDeleted(Tag $tag)
    {
        //
    }
}
