<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Auth\Auth;

class AdminAuth
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

        if(!Auth::isLogin()){

            return  redirect('login/loginForm');
        }

        return $next($request);
    }
}
