<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(self::home());
    }
    public static function home() : string {
            
        if(auth()->user()->post_id == 1){
            return '/users';
        }
        if(auth()->user()->post_id == 2){
            return '/fiches';
        }
        if(auth()->user()->post_id == 3){
            return '/fiches-nouveau';
        }
        if(auth()->user()->post_id == 4){
            return '/';
        }
        if(auth()->user()->post_id == 5){
            return '/reception/calendrier';
        }
        if(auth()->user()->post_id == 6){
            return '/ChefRayon/fiches-nouveau';
        }
    
        return '/';
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
