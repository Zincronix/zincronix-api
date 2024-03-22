<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}
