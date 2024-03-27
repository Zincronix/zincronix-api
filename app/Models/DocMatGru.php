<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocMatGru extends Model
{
    use HasFactory;

    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
    public function Group(){
        return $this->belongsTo(Group::class);
    }
}
