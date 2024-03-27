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
}
