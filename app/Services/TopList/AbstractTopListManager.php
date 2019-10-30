<?php

namespace App\Services\TopList;

use App\Contracts\TopList\TopListManagerInterface;
use App\Services\TopList\TopListBuilder;
use Illuminate\Support\Collection;
use Illuminate\Database\Concerns\BuildsQueries;

abstract class AbstractTopListManager implements TopListManagerInterface 
{
	/**
	 * Builder for this toplist
	 *
	 * @var App\Contracts\TopList\TopListBuilderInterface
	 */
	protected $builder;

	public function __construct()
	{
		$this->builder = app()->make(TopListBuilder::class, [$this]);
	}

	public function get() : ?Collection
	{
		return $this->builder->getList($this->getListName());
	}

	public function refresh()
	{
		return $this->builder->refreshList(
			$this->getListName(),
			$this->getNewList()
		);
	}

	public function push($value)
	{
		return $this->builder->push($value, $this->getListName());
	}

	abstract public function getNewList() : Collection;
	abstract public function getListName();
	abstract public function getListLength();
}