<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidays')->insert([
            [
                'date'=> '2024-01-01',
                'description' => 'AÑO NUEVO'
            ],
            [
                'date'=> '2024-01-22',
                'description' => 'DIA DEL ESTADO PLURINACIONAL'
            ],
            [
                'date'=> '2024-02-28',
                'description' => 'CARNAVAL'
            ],
            [
                'date'=> '2024-03-01',
                'description' => 'CARNAVAL'
            ],
            [
                'date'=> '2024-04-15',
                'description' => 'VIERNES SANTO'
            ],
            [
                'date'=> '2024-05-01',
                'description' => 'DIA DEL TRABAJO'
            ],
            [
                'date'=> '2024-05-02',
                'description' => 'FERIADO DEL DIA DEL TRABAJO'
            ],
            [
                'date'=> '2024-06-16',
                'description' => 'CORPUS CHRISTI'
            ],
            [
                'date'=> '2024-06-21',
                'description' => 'AÑO NUEVO AYMARA'
            ],
            [
                'date'=> '2024-08-06',
                'description' => 'DIA DE LA INDEPENDENCIA'
            ],
            [
                'date'=> '2024-11-02',
                'description' => 'DIA DE TODOS SANTOS'
            ],
            [
                'date'=> '2024-12-25',
                'description' => 'NAVIDAD'
            ],
            [
                'date'=> '2024-12-26',
                'description' => 'FERIADO DE NAVIDAD'
            ],
            [
                'date'=> '2024-09-21',
                'description' => 'DIA DE AMISTAD'
            ],
            [
                'date'=> '2024-09-14',
                'description' => 'DIA DE COCHABAMBA'
            ],
        ]);
    }
}
