<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRequest extends Model
{
    use HasFactory;

    public function Reservations(){
        return $this->hasMany(Reservation::class);
    }
    public function StatusRequest(){
        return $this->belongsTo(StatusRequest::class);
    }
    public function Period(){
        return $this->belongsTo(Period::class);
    }
}
