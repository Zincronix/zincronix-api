<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function subjects(){
        return $this->belongsToMany(Subject::class, 'docente_materia_grupos', 'group_id', 'subject_id');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class, 'docente_materia_grupos', 'group_id', 'teacher_id');
    }
}
