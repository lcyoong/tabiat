<?php

namespace App\Models;

use App\Providers\HabitTracked;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = ['tra_habit', 'tra_date'];

    public function habit()
    {
        return $this->belongsTo(Habit::class, 'tra_habit');
    }

    protected static function booted()
    {
        static::created(function ($track) {
            HabitTracked::dispatch($track);
        });
    }

}
