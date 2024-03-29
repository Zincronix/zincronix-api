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


    public function DocMatGrus(){
        return $this->hasMany(DocMatGru::class);
    }
}
