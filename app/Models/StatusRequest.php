<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRequest extends Model
{
    use HasFactory;

    public function ReservationRequests(){
        return $this->hasMany(ReservationRequest::class);
    }
}
