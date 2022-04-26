<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    protected $driver = 'facebook';

    public function redirect()
    {
        return Socialite::driver($this->driver)->redirect();
    }

    public function callback()
    {
        $ouser = Socialite::driver($this->driver)->stateless()->user();

        // Get or create new user based on email
        $user = User::updateOrCreate(['email' => $ouser->email], [
            'email' => $ouser->email,
            'name' => $ouser->name,
            'password' => bcrypt(Str::random(40)),
            'avatar' => $ouser->avatar,
            'signup_with' => $this->driver,
        ]);

        // Login the user
        Auth::login($user);

        return redirect()->route(env('AUTH_REDIRECT_ROUTE_NAME'));
    }
}
