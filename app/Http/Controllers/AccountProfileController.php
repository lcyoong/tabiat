<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserProfile;

class AccountProfileController extends Controller
{
    public function show()
    {
        return Inertia::render('Profile', ['user' => Auth::user()]);
    }

    public function update(UpdateUserProfile $request)
    {
        $user = User::find($request->id);

        $user->update($request->all());

        return redirect()->route('profile.show');
    }

}
