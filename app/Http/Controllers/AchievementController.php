<?php

namespace App\Http\Controllers;

use App\Events\AchievementVisited;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::authUser()->orderBy('ach_id', 'desc')->paginate(10);

        AchievementVisited::dispatch(Auth::user()->id);

        return Inertia::render('Achievement', compact('achievements'));
    }
}
