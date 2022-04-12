<?php

namespace App\Listeners;

use App\Events\AchievementVisited;
use App\Models\Achievement;

class TagAchievementViewed
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
     * @param  object  $event
     * @return void
     */
    public function handle(AchievementVisited $event)
    {
        Achievement::user($event->user)->whereNull('ach_viewed')->update([
            'ach_viewed' => now(),
        ]);
    }
}
