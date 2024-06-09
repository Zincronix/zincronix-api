<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'floor'
    ];

    protected $hidden=[
        'updated_at',
        'created_at'
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
