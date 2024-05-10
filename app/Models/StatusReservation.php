<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusReservation extends Model
{
    use HasFactory;

    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
