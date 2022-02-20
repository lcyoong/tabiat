<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Inertia\Inertia;

class HabitController extends Controller
{
    public function index()
    {
        $habits = Habit::get();
        return Inertia::render('MyTracker', compact('habits'));
    }
}
