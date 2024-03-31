<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public function availabilities(){
        return $this->belongsToMany(Availability::class);
    }
    public function range(){
        return $this->belongsTo(Range::class);
    }
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
