<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User as UserResource;
use App\Models\User;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /** 
     * summary
     * 
     * @param void
     * @return void
    **/ 
    public function me(Request $request)
    {
        return new UserResource(auth()->user());
    }
}
