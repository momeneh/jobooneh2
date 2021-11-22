<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class BasketCheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        if( !empty(Auth::id()) && Auth::guard('web')->check() )//user logged in
            return redirect(RouteServiceProvider::HOME);


        return $next($request);
    }
}
