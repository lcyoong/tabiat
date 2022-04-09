<?php

namespace App\Traits;

use App\Models\Achievement;

trait UserAchievements
{
    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, ['achievement_count']));

        return parent::getArrayableAppends();
    }

    public function getAchievementCountAttribute()
    {
        return $this->achievements->count();
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'ach_user');
    }

}
