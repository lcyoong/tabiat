<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GoalPublicController extends Controller
{
    public function show(User $user, Goal $goal)
    {
        if($goal->gol_user !== $user->id) {
            abort(404);
        }

        $goal->load('habits.tracks');

        return Inertia::render('PublicGoal/Display', compact('user', 'goal'));
    }
}
