<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Tag;
use App\Observers\UserObserver;
use App\Observers\QuestionObserver;
use App\Observers\AnswerObserver;
use App\Observers\CommentObserver;
use App\Observers\TagObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Tag::observe(TagObserver::class);
        Question::observe(QuestionObserver::class);
        Answer::observe(AnswerObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
