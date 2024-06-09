<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            [
                'name' => 'BLOQUE CENTRAL',
                'floor' => 2
            ],
            [
                'name' => 'DEPARTAMENTO DE FÍSICA',
                'floor' => 3
            ],
            [
                'name' => 'DEPARTAMENTO DE QUÍMICA',
                'floor' => 3
            ],
            [
                'name' => 'EDIFICIO ACADÉMICO 2',
                'floor' => 4
            ],
            [
                'name' => 'MEMI',
                'floor' => 3
            ],
            [
                'name' => 'DEPARTAMENTO DE INF-SIS',
                'floor' => 1
            ],
            [
                'name' => 'CAE',
                'floor' => 2
            ],
            [
                'name' => 'EDIFICIO LAB. BÁSICOS',
                'floor' => 2
            ],

        ]);
    }
}
