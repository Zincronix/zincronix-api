<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'doc_mat_gru_id',
        'classromm_id',
        'reservation_request_id',
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

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
