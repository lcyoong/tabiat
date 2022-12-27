<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends Model
{
    use HasFactory;

    protected $primaryKey = 'mil_id';

    public $incrementing = false;

    protected $fillable = [
        'mil_goal',
        'mil_content',
        'mil_date',
    ];

    public function setMilDateAttribute($value)
    {
        $this->attributes['mil_date'] = new Carbon($value);
    }
}
