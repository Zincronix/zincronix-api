<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name'=>'INTRODUCCIÓN A LA PROGRAMACIÓN'
            ],
            [
                'name'=>'ÁLGEBRA I'
            ],
            [
                'name'=>'ELEMENTOS'
            ],
            [
                'name'=>'CÁLCULO I'
            ],
            [
                'name'=>'SISTEMAS DE INFORMACIÓN I'
            ],
            [
                'name'=>'CÁLCULO II'
            ]
        ]);
    }
}
