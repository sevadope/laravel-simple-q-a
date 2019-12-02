<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\AnswerCollection;
use App\Http\Resources\QuestionCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyUserController extends Controller
{
    private const ANSWERS_PAGE_SIZE = 10;
    private const QUESTIONS_PAGE_SIZE = 10;

    public function show(Request $request)
    {
        return new UserResource(auth()->user());
    }

    public function answers(Request $request)
    {
        return new AnswerCollection(
            $request->user()->answers()
                ->orderByDesc('created_at')
                ->simplePaginate(self::ANSWERS_PAGE_SIZE)
        );        
    }

    public function questions(Request $request)
    {
        return new QuestionCollection(
            auth()->user()->questions()
                ->orderByDesc('created_at')
                ->simplePaginate(self::QUESTIONS_PAGE_SIZE)
        );            
    }

}
