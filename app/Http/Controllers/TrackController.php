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
        if ($date->diff(today())->days > 0) {
            return redirect('/track');
        }

        $human_difference = $date->diff(today())->days < 1 ? 'today' : $date->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]);

        $date = $date->toFormattedDateString();

        return Inertia::render('Track', compact('habits', 'date', 'human_difference'));
    }
}
