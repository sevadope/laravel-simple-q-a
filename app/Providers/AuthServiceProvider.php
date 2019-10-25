<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Tag' => 'App\Policies\TagPolicy',
        'App\Models\Question' =>'App\Policies\QuestionPolicy',
        'App\Models\Answer' => 'App\Policies\AnswerPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];
        #'App\Models\Question' => 'App\Policies\QuestionPolicy',
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
