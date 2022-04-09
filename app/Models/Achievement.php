<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Achievement extends Model
{
    use HasFactory;

    protected $primaryKey = "ach_id";

    protected $guarded = [];

    public function scopeAuthUser($query)
    {
        return $query->where('ach_user', Auth::user()->id);
    }

}
