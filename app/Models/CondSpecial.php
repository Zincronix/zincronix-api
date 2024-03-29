<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondSpecial extends Model
{
    use HasFactory;

    public function Classroom(){
        return $this->hasMany(Classroom::class);
    }
}
