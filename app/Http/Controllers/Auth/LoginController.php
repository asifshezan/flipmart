<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        // Google Login
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
    }

    // Facebook login
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
    }

    // Github login
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }

    // Github callback
    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
    }


}
