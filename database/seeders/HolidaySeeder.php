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
                'date'=> '25-05-2024',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '25-06-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '25-12-2024',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '01-05-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '14-09-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '25-06-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '18-06-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '30-07-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '12-04-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
            [
                'date'=> '01-01-2024',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '31-12-2024',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '25-06-2024',
                'description' => 'FERIADO NACIONAL'
            ],
            [
                'date'=> '12-02-2024',
                'description' => 'FERIADO DEPARTAMENTAL'
            ],
        ]);
    }
}
