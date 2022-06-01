<?php

namespace App\Models;

use App\Events\HabitTracked;
use App\Models\TrackImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $primaryKey = "tra_id";

    protected $fillable = ['tra_habit', 'tra_date'];

    public function habit()
    {
        return $this->belongsTo(Habit::class, 'tra_habit');
    }

    public function images()
    {
        return $this->hasOne(TrackImage::class, 'trai_track');
    }

    protected static function booted()
    {
        static::created(function ($track) {
            HabitTracked::dispatch($track);
        });
    }

}
