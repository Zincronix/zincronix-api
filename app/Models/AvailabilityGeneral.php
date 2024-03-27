<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityGeneral extends Model
{
    use HasFactory;

    public function Period(){
        return $this->belongsTo(Period::class);
    }
    public function Day(){
        return $this->belongsTo(Day::class);
    }
}
