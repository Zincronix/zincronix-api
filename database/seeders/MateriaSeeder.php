<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materias')->insert([
            [
                'nombre'=>'Intro a la progra'
            ],
            [
                'nombre'=>'Algebra 1'
            ],
            [
                'nombre'=>'elementos'
            ],
            [
                'nombre'=>'calculo 1'
            ],
            [
                'nombre'=>'sistemas de informacion 1'
            ],
            [
                'nombre'=>'calculo 2'
            ]
        ]);
    }
}
