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
    private const USERS_PAGE_SIZE = 10;
    private const LIMIT_NAME = 'limit';

    public function show(Request $request)
    {
        return new UserResource(auth()->user());
    }

    public function answers(Request $request)
    {
        $limit = (integer) ($request->query(self::LIMIT_NAME) ?? 
            self::ANSWERS_PAGE_SIZE);

        return new AnswerCollection(
            $request->user()->answers()
                ->orderByDesc('created_at')
                ->simplePaginate($limit)
        );        
    }

    public function questions(Request $request)
    {
       $limit = (integer) ($request->query(self::LIMIT_NAME) ?? 
            self::QUESTIONS_PAGE_SIZE);

        return new QuestionCollection(
            auth()->user()->questions()
                ->orderByDesc('created_at')
                ->simplePaginate($limit)
        );            
    }

}
