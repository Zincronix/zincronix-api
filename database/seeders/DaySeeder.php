<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            [
                'day'=>'LUNES',
            ],
            [
                'day'=>'MARTES',
            ],
            [
                'day'=>'MIERCOLES',
            ],
            [
                'day'=>'JUEVES',
            ],
            [
                'day'=>'SÁBADO',
            ],
            [
                'day'=>'DOMINGO',
            ],
        ]);
    }
}
