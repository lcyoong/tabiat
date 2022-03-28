<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Track;
use Carbon\Carbon;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Request;

class TrackController extends Controller
{
    public function show(Request $request, $date = null)
    {
        $habits = Habit::get();

        try {
            $date = new Carbon($date);
        } catch (\Exception $e) {
            abort(500);
        }

        // Redirect future date tracking
        if (!$date->isPast()) {
            return redirect()->route('track.index');
        }

        $date = $date->format('Y-m-d');

        $tracking = Track::where('tra_date', $date)->get();

        return Inertia::render('Track', compact('habits', 'date', 'tracking'));
    }

    public function store(Request $request)
    {
        $input = $request->input();

        return Track::firstOrCreate([
            'tra_habit' => $input['habit'],
            'tra_date' => $input['date'],
        ]);
    }

    public function delete(Request $request)
    {
        $input = $request->input();

        return Track::where([
            'tra_habit' => $input['habit'],
            'tra_date' => $input['date'],
        ])->delete();
    }
}
