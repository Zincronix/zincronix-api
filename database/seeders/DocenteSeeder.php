<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('docentes')->insert([
            [
                'nombre'=>'maria leticia blanco coca'
            ],
            [
                'nombre'=>'alex israel bustillos vargas'
            ],
            [
                'nombre'=>'patricia gonzales'
            ],
            [
                'nombre'=>'carmen rosa'
            ],
            [
                'nombre'=>'carla salazar'
            ],
            [
                'nombre'=>'Doctor lucio gonzales'
            ],
        ]);
    }
}
