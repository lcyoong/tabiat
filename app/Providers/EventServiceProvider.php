<?php

namespace App\Providers;

use App\Events\AchievementVisited;
use App\Events\HabitTracked;
use App\Listeners\CheckForAchievement;
use App\Listeners\TagAchievementViewed;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        HabitTracked::class => [
            CheckForAchievement::class,
        ],

        AchievementVisited::class => [
            TagAchievementViewed::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
