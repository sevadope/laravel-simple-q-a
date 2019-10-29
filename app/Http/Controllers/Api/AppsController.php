<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppsController extends Controller
{
	/** 
	 * Introduction to site API
	 * 
	 * @param void
	 * @return Request
	**/ 
	public function intro()
	{
		return view('api.intro');
	}

	/** 
	 * Register app
	 * 
	 * @param void
	 * @return Request
	**/ 
	public function register()
	{
		return view('api.register');
	}

    /** 
     * Apps used by user
     * 
     * @param void
     * @return void
    **/ 
    public function apps()
    {
        $clients = auth()->user()->clients;
        
        return view('api.user_apps', compact('clients'));
    }

}
