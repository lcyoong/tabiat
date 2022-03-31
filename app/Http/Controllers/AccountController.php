<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function profile()
    {
        return Inertia::render('Profile', ['user' => Auth::user()]);
    }
}
