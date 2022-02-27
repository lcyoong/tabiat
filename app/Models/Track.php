<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = ['tra_habit', 'tra_date'];

    public function habit()
    {
        return $ths->belongsTo(Habit::class);
    }
}
