<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public function Availabilities(){
        return $this->hasMany(Availability::class);
    }
    public function ReservationRequests(){
        return $this->hasMany(ReservationRequest::class);
    }
    public function AvailabilityGenerals(){
        return $this->hasMany(AvailabilityGeneral::class);
    }
}
