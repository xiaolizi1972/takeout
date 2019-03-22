<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Admin\Auth;

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

        if(!session('admin')){

            return  redirect('login/loginForm');
        }

        view()->share('menus',Auth::menu());
        return $next($request);
    }
}
