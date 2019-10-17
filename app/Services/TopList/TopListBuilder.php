<?php

namespace App\Services\TopList;

use App\Contracts\TopList\TopListBuilderInterface;
use App\Contracts\TopList\TopListManagerInterface;
use Illuminate\Support\Collection;

abstract class TopListBuilder implements TopListBuilderInterface{

	/**
	 * Current toplist manger
	 *
	 * @var TopListInterface
	 */
	protected $manager;

	public function __construct(TopListManagerInterface $manager)
	{
		$this->manager = $manager;
	}

	abstract public function getList() : Collection;
	abstract public function refreshList();
}
