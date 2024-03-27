<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function DocMatGru(){
        return $this->belongsTo(DocMatGru::class);
    }
    public function ReservationRequest(){
        return $this->belongsTo(ReservationRequest::class);
    }
    public function Classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
