<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'status_reservation_id',
        'period_id',
        'reason',
        'date',
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function docenteMateriaGrupos(){
        return $this->belongsToMany(DocenteMateriaGrupo::class);
    }
    public function classrooms(){
        return $this->belongsToMany(Classroom::class);
    }
    public function period(){
        return $this->belongsTo(Period::class);
    }
    public function statusReservation(){
        return $this->belongsTo(StatusReservation::class);
    }
}
