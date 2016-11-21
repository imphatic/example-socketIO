<?php

namespace App\Http\Middleware;

use App\Http\Controllers\User;
use Closure;

class Auth
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

        if(!User::getUserName())
        {
            return redirect()->guest('user');
        }

        return $next($request);
    }

}
