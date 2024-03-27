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

    public function Departament(){
        return $this->belongsTo(Departament::class);
    }
    public function DocMatGrus(){
        return $this->hasMany(DocMatGru::class);
    }
}
