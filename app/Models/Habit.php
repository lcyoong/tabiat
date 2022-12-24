<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Habit extends Model
{
    use HasFactory;

    protected $primaryKey = "hab_id";

    protected $fillable = [
        'hab_goal',
        'hab_name',
    ];

    protected $appends = ['hab_color'];

    protected $guarded = [];

    public function tracks()
    {
        return $this->hasMany(Track::class, 'tra_habit');
    }

    public function getHabColorAttribute()
    {
        $randomString = md5($this->hab_id);
        $r = substr($randomString,0,2);
        $g = substr($randomString,2,2);
        $b = substr($randomString,4,2);
        return '#'.$r.$g.$b;
    }    

    /**
     * Scope a query to include habit of the current authenticated user
     *
     * @param [type] $query
     * @return void
     */
    // public function scopeAuthUser($query)
    // {
    //     return $query->where('hab_user', Auth::user()->id);
    // }

    protected static function booted()
    {
        static::creating(function ($habit) {
            // $habit->hab_user = Auth::user()->id;
        });
    }
}
