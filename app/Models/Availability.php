<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    public function Classrooms(){
        return $this->belongsTo(Classroom::class);
    }
    public function Periods(){
        return $this->belongsTo(Period::class);
    }
    public function Days(){
        return $this->belongsTo(Day::class);
    }
}
