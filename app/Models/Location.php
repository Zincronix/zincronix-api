<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable=[
        'description',
        'building_id'
    ];

    protected $hidden=[
        'updated_at',
        'created_at'
    ];

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }
}
