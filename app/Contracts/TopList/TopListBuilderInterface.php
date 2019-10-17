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
	public function getList() : Collection;

	/** 
	 * Refresh current toplist
	 * 
	 * @param void
	 * @return mixed
	**/ 
	public function refreshList();
}