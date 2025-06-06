<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//        }
//        echo '*******************RedirectIfAuthenticated ******************'; dd($guards);
        switch ($guards[0]){
            case 'admin':
                if(Auth::guard($guards[0])->check())
                    return redirect()->route('admin.dashboard');
                break;
            default:
                if(Auth::guard($guards[0])->check())
                    return redirect(RouteServiceProvider::HOME);
                break;
        }

        return $next($request);
    }
}
