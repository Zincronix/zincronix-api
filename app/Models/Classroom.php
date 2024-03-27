<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    public function Reservations(){
        return $this->hasMany(Reservation::class);
    }
    public function Availabilitys(){
        return $this->hasMany(Availability::class);
    }
    public function CondSpecial(){
        return $this->belongsTo(CondSpecial::class);
    }
}
