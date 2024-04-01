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
        ]);
    }
}
