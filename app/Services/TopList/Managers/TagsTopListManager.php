<?php 

namespace App\Services\TopList\Managers;

use App\Models\Tag;
use App\Models\Question;
use App\Services\TopList\AbstractTopListManager;
use Illuminate\Support\Collection;
use  \DB;

class TagsTopListManager extends AbstractTopListManager
{
	private const TOPLIST_NAME = 'tags_toplist';
	private const TOPLIST_LENGTH = 10;

	public function getNewList() : Collection
	{
		$tags_questions = DB::table('question_tag')
			->selectRaw('tag_id, count(*) as questions_count')
			->whereIn('question_id', function ($query) {
				$query->select('id')
					->from('questions')
					->whereRaw('date(created_at) = curdate()');
			})
			->groupBy('tag_id')
			->orderByDesc('questions_count')
			->limit($this->getListLength());

		return Tag::joinSub( $tags_questions, 'tags_questions', function ($join) {
			$join->on('tags.id', '=', 'tags_questions.tag_id');
			})
			->selectRaw('tags.*, tags_questions.questions_count')
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