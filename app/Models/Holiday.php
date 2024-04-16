<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'date',
        'description'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}
