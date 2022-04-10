<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::authUser()->orderBy('ach_id', 'desc')->paginate(10);

        // Tag new achievements as viewed
        Achievement::authUser()->whereNull('ach_viewed')->update([
            'ach_viewed' => now(),
        ]);

        return Inertia::render('Achievement', compact('achievements'));
    }
}
