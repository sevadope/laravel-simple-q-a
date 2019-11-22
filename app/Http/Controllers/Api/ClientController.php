<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientStoreRequest;
use App\Http\Requests\Api\ClientUpdateRequest;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Client;

class ClientController extends Controller
{
	/** 
	 * Introduction to site API
	**/ 
	public function intro()
	{
		return view('api.intro');
	}

	/** 
	 * Register app
	**/ 
	public function register()
	{
		return view('api.clients.register');
	}

	public function show(Client $client)
	{
		return view('api.clients.show', compact('client'));
	}

    /** 
     * Apps created by user
     * 
    **/ 
    public function list(Request $request)
    {
        $clients = $request->user()->clients;
        
        return view('api.clients.list', compact('clients'));
    }

	public function store(ClientStoreRequest $request, ClientRepository $clients)
	{
		['name' => $name, 'redirect' => $redirect] = $request->validated();

		$new_client = $clients->create($request->user()->getKey(), $name, $redirect);
		return redirect()->route('api.clients.list', $request->user()->name);
	}

	public function edit(Client $client)
	{
		return view('api.clients.edit', compact('client'));
	}

	public function update(ClientUpdateRequest $request, Client $client)
	{
		$data = $request->validated();

        if ($client->update($data)) {
         	return redirect()
         		->route('api.clients.list', $request->user()
         		->getKey());
        }		
        else {
        	return back()
        		->withErrors(['msg' => 'Update Error. Please try again.'])
        		->withInput();
        }
	}
}
