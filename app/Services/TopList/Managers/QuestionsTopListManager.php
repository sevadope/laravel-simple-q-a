<?php

namespace App\Services\TopList\Managers;

use App\Models\Question;
use App\Services\TopList\AbstractTopListManager;
use Illuminate\Support\Collection;
use Illuminate\Database\Concerns\BuildsQueries;

class QuestionsTopListManager extends AbstractTopListManager
{
    private const TOPLIST_NAME = 'questions_toplist';
	private const TOPLIST_LENGTH = 10;

    public function getNewList() : Collection
    {
    	return Question::
    		withCount('subscribers', 'answers')
    		->whereRaw('created_at > (now() - interval 1 week)')
    		->orderByRaw('(subscribers_count * views_count) desc')
    		->limit($this->getListLength())
            ->get();
    }

    public function getListName() {
        return self::TOPLIST_NAME;
    }

    public function getListLength()
    {
        return self::TOPLIST_LENGTH;
    }
}
