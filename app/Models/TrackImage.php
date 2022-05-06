<?php

namespace App\Models;

use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackImage extends Model
{
    use HasFactory;

    public function track()
    {
        return $this->belongsTo(Track::class, 'tra_habit');
    }
}
