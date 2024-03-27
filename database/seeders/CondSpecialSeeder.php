<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondSpecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cond_specials')->insert([
            [
                'condition'=>'Data',
            ],
            [
                'condition'=>'Ventilador',
            ],
        ]);
    }
}
