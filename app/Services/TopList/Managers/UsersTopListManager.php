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

	public function getNewList() : Collection
	{
		$users_answers = DB::table('answers')
			->select('user_id', DB::raw('ifnull(count(*),0) as answers_count'))
			->whereRaw('date(created_at) = curdate()')
			->groupBy('user_id')
			->orderByDesc('answers_count');

		$users_questions = DB::table('questions')
			->select('user_id', DB::raw('ifnull(count(*),0) as questions_count'))
			->whereRaw('date(created_at) = curdate()')
			->groupBy('user_id')
			->orderByDesc('questions_count');

		return User::
			leftJoinSub($users_answers, 'users_answers', function ($join) {
				$join->on('users.id', '=', 'users_answers.user_id');
			})
			->leftJoinSub($users_questions, 'users_questions', function ($join) {
				$join->on('users.id', '=', 'users_questions.user_id');
			})
			->selectRaw(
				'users.*,
				ifnull(users_answers.answers_count, 0) as answers_count,
				ifnull(users_questions.questions_count, 0) as questions_count'
			)
			->groupBy(
				'users.id'
			)
			->havingRaw('(answers_count + questions_count) > 0')
			->orderByRaw(
				'(
					ifnull(answers_count,0) + 
					ifnull(questions_count,0)
				) desc'
			)
			->limit($this->getListLength()	)
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


