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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->intended(self::home());
            }
        }

        return $next($request);
    }
    public static function home() : string {
            
        if(auth()->user()->post_id == 1){
            return '/users';
        }
        if(auth()->user()->post_id == 2){
            return '/fiches';
        }
        if(auth()->user()->post_id == 3){
            return '/Appro/Chart/Vue';
        }
        if(auth()->user()->post_id == 4){
            return '/Pharmacien/Chart/Vue';
        }
        if(auth()->user()->post_id == 5){
            return '/reception/calendrier';
        }
        if(auth()->user()->post_id == 6){
            return '/ChefRayon/fiches-nouveau';
        }
    
        return '/';
    }
}
