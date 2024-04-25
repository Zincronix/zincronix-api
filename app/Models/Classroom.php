<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'capacity',
        'description'
    ];

    protected $hidden=[
        'updated_at',
        'created_at'
    ];

    public function reservations(){
        return $this->belongsToMany(Reservation::class);
    }
    public function availabilities(){
        return $this->hasMany(Availability::class);
    }
    public function characteristics(){
        return $this->belongsToMany(Characteristic::class);
    }
}
