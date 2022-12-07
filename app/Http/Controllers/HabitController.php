<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreHabit;
use App\Http\Requests\UpdateHabit;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHabit $request, Goal $goal)
    {
        Habit::create($request->input());

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHabit $request, Habit $habit)
    {
        $habit->update($request->input());

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Habit $habit)
    {
        $habit->tracks()->delete();

        $habit->delete();

        return back()->setStatusCode(303);
    }
}
