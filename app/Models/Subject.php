<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function departament(){
        return $this->belongsTo(Departament::class);
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class, 'docente_materia_grupos', 'subject_id', 'teacher_id');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'docente_materia_grupos', 'subject_id', 'group_id');
    }

}
