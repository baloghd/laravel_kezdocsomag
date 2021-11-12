<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Rating;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
