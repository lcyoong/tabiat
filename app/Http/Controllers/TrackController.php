<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Carbon\Carbon;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function show($date = null)
    {
        $habits = Habit::get();

        try {
            $date = new Carbon($date);
        } catch (\Exception $e) {
            abort(500);
        }

        // Redirect future date tracking
        if (!$date->isPast()) {
            return redirect('/track');
        }

        $date = $date->format('Y-m-d');

        return Inertia::render('Track', compact('habits', 'date'));
    }
}
