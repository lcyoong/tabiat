<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Goal;
use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGoal;
use App\Http\Requests\UpdateGoal;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::authUser()->paginate(10);

        return Inertia::render('Goal/Index', compact('goals'));
    }

    // public function create()
    // {
    //     return Inertia::render('Goal/Create');
    // }

    public function store(StoreGoal $request)
    {
        Goal::create($request->input());

        return redirect()->route('goal.index');
    }

    public function update(UpdateGoal $request, Goal $goal)
    {
        $goal->update($request->input());

        return back();
    }

    public function track(Request $request, Goal $goal, $date = null)
    {
        try {
            $date = new Carbon($date);
        } catch (\Exception$e) {
            abort(500);
        }

        // Redirect future date tracking
        if (!$date->isPast()) {
            return redirect()->route('goal.track', ['goal' => $goal]);
        }

        $today = $date->format('Y-m-d');

        $goal->load(['habits', 'habits.tracks' => function($query) use($today) {
            $query->where('tra_date', $today);
        }]);

        return Inertia::render('Goal/Track', compact('goal', 'today'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Goal $goal)
    {
        DB::transaction(function () use($goal) {
            $goal->habits()->delete();

            $goal->delete();    
        });

        return redirect()->route('goal.index');
    }    

    public function analytics(Request $request, Goal $goal)
    {
        $goal->load(['habits.tracks']);
        $habits = $goal->habits;

        return Inertia::render('Goal/Analytics', compact('goal', 'habits'));
    }
}
