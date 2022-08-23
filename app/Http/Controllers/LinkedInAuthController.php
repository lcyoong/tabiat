<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LinkedInAuthController extends Controller
{
    protected $driver = 'linkedin';

    public function redirect()
    {
        return Socialite::driver($this->driver)->redirect();
    }

    public function callback()
    {
        // Linkedin returned user
        try {
            $ouser = Socialite::driver($this->driver)->stateless()->user();
        } catch (ClientException $e) {
            return redirect('/login')->withErrors(['email' => 'An error occurred while trying to sync with your LinkedIn account. Please try again.']);
        }

        // Reject if email is registered with a different driver

        // Get or create new user based on email
        $user = User::firstOrCreate(['email' => $ouser->email],
            [
                'name' => $ouser->name,
                'auth_email' => $ouser->email,
                'user_name' => $ouser->name.date('ymdHis'),
                'password' => bcrypt(Str::random(40)),
                'avatar' => $ouser->avatar,
                'signup_with' => $this->driver,
            ]);

        // Login the user
        Auth::login($user);

        return redirect()->route(env('AUTH_REDIRECT_ROUTE_NAME'));
    }

}
