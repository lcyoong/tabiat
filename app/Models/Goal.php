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

    protected $fillable = [
        'gol_name',
        'gol_days'
    ];

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

    protected static function booted()
    {
        static::creating(function ($goal) {
            $goal->gol_user = Auth::user()->id;
        });
    }    
}
