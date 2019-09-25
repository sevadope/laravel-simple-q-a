<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tag;
use App\Observers\UserObserver;
use App\Observers\QuestionObserver;
use App\Observers\AnswerObserver;
use App\Observers\TagObserver;
use Illuminate\Support\Facades\Blade;

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
        Blade::if('admin', function () {
            return auth()->user()->isAdmin();
        });

        Blade::if('moderator', function () {
            return auth()->check() && 
                (auth()->user()->isModerator()
                || auth()->user()->isAdmin());
        });

        Blade::if('user_subscribed', function ($subscribers) {
            return $subscribers->contains(auth()->id());
        });

        Blade::if('user_liked', function ($likes) {
            return $likes->where('user_id', auth()->id())->isnotEmpty();
        });
        
        User::observe(UserObserver::class);
        Tag::observe(TagObserver::class);
        Question::observe(QuestionObserver::class);
        Answer::observe(AnswerObserver::class);
    }
}
