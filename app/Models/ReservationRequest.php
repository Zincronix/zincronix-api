<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRequest extends Model
{
    use HasFactory;

    protected $fillable=[
        'period_id',
        'reason_reservation',
        'date_reservation',
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

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
