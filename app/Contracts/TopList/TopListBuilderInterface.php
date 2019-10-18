<?php

namespace App\Contracts\TopList;

use Illuminate\Support\Collection;

interface TopListBuilderInterface
{
	/**
	 * Return collection for current toplist
	 *
	 * @param TopListInterface
	 * @return Collection 
	 */
	public function getList(string $list_name) : ?Collection;

	/** 
	 * Refresh current toplist
	 * 
	 * @param string
	 * @param Collection
	 * @return mixed
	**/ 
	public function refreshList(string $list_name, Collection $new_list);

	/**
	 * Push value to toplist
	 *
	 * @param string
	 * @param mixed
	 * @return void 
	 */
	public function push(string $value, $key);
}