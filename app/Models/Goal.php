<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $primaryKey = 'gol_id';

    public $incrementing = false;

    protected $fillable = [
        'gol_name',
        'gol_days'
    ];

    protected $appends = ['gol_start', 'gol_end'];

    public function getGolStartAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getGolEndAttribute()
    {
        return $this->created_at->addDays($this->gol_days)->format('Y-m-d');
    }    

    /**
     * Scope a query to include habit of the current authenticated user
     *
     * @param [type] $query
     * @return void
     */
    public function scopeAuthUser($query)
    {
        return $query->where('gol_user', Auth::user()->id);
    }

    public function golUser(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Auth::user()->id,
        );        
    }

    public function habits()
    {
        return $this->hasMany(Habit::class, 'hab_goal');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'mil_goal');
    }    

    protected static function booted()
    {
        static::creating(function ($goal) {
            $goal->gol_user = Auth::user()->id;
        });
    }    
}
