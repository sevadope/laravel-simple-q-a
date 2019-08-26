<?php

namespace App\Http\Middleware;

use Closure;

class Moderator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && (auth()->user()->isModerator() || auth()->user()->isAdmin())) {
            return $next($request);
        }
        return back();
    }
}
