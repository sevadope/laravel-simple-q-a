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
    private const USERS_PAGE_SIZE = 10;
    private const QUERY_LIMIT_NAME = 'limit';
    private const QUERY_ORDER_NAME = 'order_by';

    public function show(string $name)
    {
        return new UserResource(User::byName($name)->forApi()->first());
    }

    public function answers(User $user, Request $request)
    {
        $limit = (integer) ($request->query(self::QUERY_LIMIT_NAME) ?? 
            self::ANSWERS_PAGE_SIZE);

        return new AnswerCollection(
            $user->answers()->orderByDesc('created_at')->simplePaginate($limit)
        );
    }

    public function questions(User $user)
    {
        $limit = (integer) ($request->query(self::QUERY_LIMIT_NAME) ?? 
            self::QUESTIONS_PAGE_SIZE);

        return new QuestionCollection(
            $user->questions()->orderByDesc('created_at')->simplePaginate($limit)
        );
    }

    public function list(Request $request)
    {
        $query = $request->query();
        $options = $this->sortingOptions();

        $limit = (integer) ($query[self::QUERY_LIMIT_NAME] ?? 
            self::USERS_PAGE_SIZE);

        $query_order = $query[self::QUERY_ORDER_NAME] ?? 'created_at';
        $order_by = $options[$query_order] ?? $options['default'];

        return new UserCollection(
            User::forApi()->orderByRaw($order_by)
                ->simplePaginate($limit)
        );
    }

    private function sortingOptions()
    {
        return [
            'created_at' => 'created_at desc',
            'name' => 'name',
            'answers_count' => 'answers_count desc',
            'questions_count' => 'questions_count desc',
            'default' => 'created_at desc',
        ];
    }
}
