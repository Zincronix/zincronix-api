<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Departament extends Model
{
    use HasFactory;

    public function subjects(){
        return $this->hasMany(Subset::class);
    }
}
