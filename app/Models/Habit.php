<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $primaryKey = "hab_id";

    public function tracks()
    {
        return $this->hasMany(Track::class, 'tra_habit');
    }

}
