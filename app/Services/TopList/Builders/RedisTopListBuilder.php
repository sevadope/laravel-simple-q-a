<?php

namespace App\Services\TopList\Builders;

use App\Contracts\TopList\TopListBuilderInterface;
use Illuminate\Support\Collection;
use Redis;

class RedisTopListBuilder implements TopListBuilderInterface
{

	public function getList(string $list_name) : ?Collection 
	{
		$list = collect(
			Redis::command('lrange', [$list_name, 0, -1])
		)->map(function ($item) {
			return json_decode($item);
		});

		return $list;
	}

	public function refreshList(string $list_name, Collection $new_list)
	{
		if ($new_list->isEmpty()) {
			return;
		}

		$prepared_list = $new_list
			->map(function ($item) {
				return $item->toJson();
			})
			->toArray();

		Redis::command('del', [$list_name]);
		$list_pushed = Redis::command('rpush',
			[$list_name, $prepared_list]);

		return $list_pushed ? true : false;
	}

	public function push(string $value, $key)
	{
		$value_pushed = Redis::command('rpush', [$key, $value]);
		
		return $value_pushed ? true : false;
	}

}