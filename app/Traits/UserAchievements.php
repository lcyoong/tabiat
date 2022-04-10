<?php

namespace App\Traits;

use App\Models\Achievement;

trait UserAchievements
{
    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['new_achievement_count']));

        return parent::getArrayableAppends();
    }

    public function getNewAchievementCountAttribute()
    {
        return $this->new_achievements->count();
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'ach_user');
    }

    public function new_achievements()
    {
        return $this->achievements()->whereNull('ach_viewed');
    }

}
