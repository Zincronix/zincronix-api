<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'password',
        'active'
    ];

    protected $hidden=[
        'password',
        'created_at',
        'updated_at'
    ];

    public function subjects(){
        return $this->belongsToMany(Subject::class, 'docente_materia_grupos', 'teacher_id', 'subject_id');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'docente_materia_grupos', 'teacher_id', 'group_id');
    }
}
