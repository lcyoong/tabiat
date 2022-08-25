<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
}
