<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteMateriaGrupo extends Model
{
    use HasFactory;
    

    protected $fillable=[
        'teacher_id',
        'subject_id',
        'group_id',
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

  
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function reservations(){
        return $this->belongsToMany(Reservation::class);
    }
}


