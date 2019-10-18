<?php 

namespace App\Contracts\TopList;

use Illuminate\Support\Collection;
use Illuminate\Database\Concerns\BuildsQueries;

/**
 * Managers realizes Facade pattern.
 *
 * Managers delegates calls to builder which uses some DBMS.
 *
 * Builder resolves by Laravel service container 
 * for supporting DBMS changing.
 * 
 */
interface TopListManagerInterface {

	public function push($value);
	public function get() : ?Collection;
	public function refresh();

	public function getNewList() : Collection;
	public function getListName();
	public function getListLength();
}