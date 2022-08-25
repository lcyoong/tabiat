<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

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
}
