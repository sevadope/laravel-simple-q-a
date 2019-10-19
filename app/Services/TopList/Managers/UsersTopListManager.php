<?php

namespace App\Services\TopList\Managers;

use App\Models\User;
use App\Models\Answer;
use App\Services\TopList\AbstractTopListManager;
use Illuminate\Support\Collection;
use \DB;

class UsersTopListManager extends AbstractTopListManager
{
	private const TOPLIST_NAME = 'users_toplist';
	private const TOPLIST_LENGTH = 5;

	public function increment($user_id)
	{

	}

	public function getNewList() : Collection
	{
		return User::join('answers', 'users.id', '=', 'answers.user_id')
			->selectRaw('users.*, count(answers.user_id) as answers_count')
			->whereRaw("date(answers.created_at) = curdate()")
			->groupBy('answers.user_id')
			->orderByDesc('answers_count')
			->limit($this->getListLength())
			->get();
	}

	public function getListName()
	{
		return self::TOPLIST_NAME;
	}

	public function getListLength()
	{
		return self::TOPLIST_LENGTH;
	}

}


