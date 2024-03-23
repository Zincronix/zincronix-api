<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupos')->insert([
            
                [
                    'nombre'=>'g1'
                ],
                [
                    'nombre'=>'g2'
                ],
                [
                    'nombre'=>'g3'
                ],
                [
                    'nombre'=>'g4'
                ],
                [
                    'nombre'=>'g5'
                ],
                [
                    'nombre'=>'g6'
                ]
        ]);
    }
}
