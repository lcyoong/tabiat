<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::authUser()->orderBy('ach_id', 'desc')->paginate(10);

        return Inertia::render('Achievement', compact('achievements'));

    }
}
