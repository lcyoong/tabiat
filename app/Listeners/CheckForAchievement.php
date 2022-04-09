<?php

namespace App\Listeners;

use App\Events\HabitTracked;
use App\Events\SomethingAchieved;
use App\Models\Achievement;
use App\Models\Habit;
use Illuminate\Database\Eloquent\Builder;

class CheckForAchievement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\HabitTracked  $event
     * @return void
     */
    public function handle(HabitTracked $event)
    {
        $track = $event->track;

        $pending = Habit::authUser()->whereDoesntHave('tracks', function (Builder $query) use ($track) {
            $query->where('tra_date', '=', $track->tra_date);
        })->count();

        if ($pending == 0) {
            $achievement = Achievement::create([
                'ach_user' => $track->habit->hab_user,
                'ach_code' => 'daily_complete',
                'ach_parameter' => serialize(['date' => $track->tra_date]),
            ]);

            SomethingAchieved::dispatch($achievement);
        };

    }
}
