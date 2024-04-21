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
                'date'=> '2024-05-25',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '2024-06-25',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-12-25',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '2024-05-01',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-09-14',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-06-25',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-06-18',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-07-30',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-04-12',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '2024-01-01',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '2024-12-31',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '2024-06-25',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '2024-02-12',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
        ]);
    }
}
