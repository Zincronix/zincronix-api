<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('characteristics')->insert([
            [
                'characteristic'=>'DATA',
            ],
            [
                'characteristic'=>'VENTILADOR',
            ],
            [
                'characteristic'=>'TELEVISOR',
            ],
        ]);
    }
}
