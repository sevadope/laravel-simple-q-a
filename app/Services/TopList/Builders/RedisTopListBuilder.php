<?php

namespace App\Services\TopList\Builders;

use App\Contracts\TopList\TopListBuilderInterface;
use App\Services\TopList\TopListBuilder;
use Illuminate\Support\Collection;
use Redis;

class RedisTopListBuilder extends TopListBuilder
{
	/** 
	 * summary
	 * 
	 * @param void
	 * @return void
	**/ 
	public function getList() : Collection 
	{
		$list = collect(
			Redis::command('lrange', [$this->manager->getListName(), 0, -1])
		)->map(function ($item) {
			return json_decode($item);
		});

		if (empty($list)) {
			$this->refreshList();
			return $this->{__FUNCTION__}();
		}

		return $list;
	}

	/** 
	 * summary
	 * 
	 * @param void
	 * @return void
	**/ 
	public function refreshList()
	{
		$new_list = $this->manager->getListSortingQuery()
			->get();

		$prepared_list = $new_list
			->map(function ($item) {
				return json_encode($item);
			})
			->toArray();
		
		Redis::command('del', [$this->manager->getListName()]);
		$list_pushed = Redis::command('rpush',
			[$this->manager->getListName(),$prepared_list]);

		return $list_pushed ? $new_list : false;
	}

}