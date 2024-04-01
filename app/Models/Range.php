<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory;

    public function periods(){
        return $this->hasMany(Period::class);
    }

    public function availabilities(){
        return $this->hasMany(Availability::class);
    }
}
