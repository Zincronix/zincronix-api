<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'classroom_id'
    ];

    protected $hidden=[
        'updated_at'
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
