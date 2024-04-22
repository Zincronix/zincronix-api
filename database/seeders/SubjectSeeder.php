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
                'name'=>'INTRODUCCIÓN A LA PROGRAMACIÓN',
                'departament_id' => 2
            ],
            [
                'name'=>'ÁLGEBRA I',
                'departament_id' => 1
            ],
            [
                'name'=>'ELEMENTOS',
                'departament_id' => 2
            ],
            [
                'name'=>'CÁLCULO I',
                'departament_id' => 1
            ],
            [
                'name'=>'SISTEMAS DE INFORMACIÓN I',
                'departament_id' =>  2
            ],
            [
                'name'=>'CÁLCULO II',
                'departament_id' => 1
            ],
            [
                'name'=>'INTELIGENCIA ARTIFICIAL I',
                'departament_id' => 2
            ],
            [
                'name'=>'INTELIGENCIA ARTIFICIAL II',
                'departament_id' => 2
            ],
            [
                'name'=>'SISTEMAS DE INFORMACIÓN II',
                'departament_id' =>  2
            ],
            [
                'name'=>'INGLES I',
                'departament_id' =>  2
            ],
            [
                'name'=>'INGLES II',
                'departament_id' =>  2
            ],
            [
                'name'=>'REDES AVANZADAS',
                'departament_id' =>  2
            ],
            [
                'name'=>'TALLER DE PROGRAMACION EN BAJO NIVEL',
                'departament_id' =>  2
            ],
        ]);
    }
}
