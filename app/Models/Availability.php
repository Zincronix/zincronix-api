<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function periods(){
        return $this->belongsToMany(Period::class);
    }
    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function range(){
        return $this->belongsTo(Range::class);
    }
}
