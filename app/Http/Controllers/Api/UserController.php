<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\QuestionCollection;
use App\Models\User;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private const ANSWERS_PAGE_SIZE = 10;
    private const QUESTIONS_PAGE_SIZE = 10;
    private const LIST_PAGE_SIZE = 10;

    public function show(string $name)
    {
        return new UserResource(User::byName($name)->forApi()->first());
    }

    public function answers(User $user, Request $request)
    {
        return new AnswerCollection(
            $user->answers()->orderByDesc('created_at')->simplePaginate(self::ANSWERS_PAGE_SIZE)
        );
    }

    public function questions(User $user)
    {
        return new QuestionCollection(
            $user->questions()->orderByDesc('created_at')->simplePaginate(self::QUESTIONS_PAGE_SIZE)
        );
    }

    public function list(Request $request)
    {
        return new UserCollection(
            User::forApi()->orderByDesc('created_at')->simplePaginate(self::LIST_PAGE_SIZE)
        );
    }
}
