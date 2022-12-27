<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMilestone;

class MilestoneController extends Controller
{
    public function store(StoreMilestone $request)
    {
        Milestone::create($request->input());

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Milestone $milestone)
    {
        $milestone->delete();

        return back()->setStatusCode(303);
    }    
}
