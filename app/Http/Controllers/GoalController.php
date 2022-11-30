<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGoal;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::authUser()->paginate(10);

        return Inertia::render('Goal/Index', compact('goals'));
    }

    public function create()
    {
        return Inertia::render('Goal/Create');
    }

    public function store(StoreGoal $request)
    {
        Goal::create($request->input());

        return redirect()->route('goal.index');
    }

    public function track(Request $request, Goal $goal)
    {
        $goal->load('habits');

        return Inertia::render('Goal/Track', compact('goal'));
    }
}
