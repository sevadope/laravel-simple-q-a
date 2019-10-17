<?php

namespace App\Services\TopList;

use App\Contracts\TopList\TopListManagerInterface;
use App\Services\TopList\TopListBuilder;
use Illuminate\Support\Collection;
use Illuminate\Database\Concerns\BuildsQueries;

abstract class AbstractTopListManager implements TopListManagerInterface 
{
	/**
	 * Manager for this toplist
	 *
	 * @var TopListManager
	 */
	protected $builder;

	public function __construct()
	{
		$this->builder = app()->make(TopListBuilder::class, [$this]);
	}

	public function get() : Collection {
		return $this->builder->getList();
	}

	public function refresh() {
		return $this->builder->refreshList();
	}

	abstract public function getListSortingQuery();
	abstract public function getListName();
	abstract public function getListLength();
}