<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientStoreRequest;
use Laravel\Passport\ClientRepository;

class ClientsController extends Controller
{
	private $clients;

	public function __construct(ClientRepository $clients)
	{
		$this->clients = $clients;
	}

	/** 
	 * summary
	 * 
	 * @param Request
	**/ 
	public function store(ClientStoreRequest $request)
	{
		['name' => $name, 'redirect' => $redirect] = $request->validated();

		$new_client = $this->clients->create($request->user()->getKey(), $name, $redirect);
		return redirect()->route('api.apps', $request->user()->name);
	}
}
