<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            
            [
                'name'=>'g1'
            ],
            [
                'name'=>'g2'
            ],
            [
                'name'=>'g3'
            ],
            [
                'name'=>'g4'
            ],
            [
                'name'=>'g5'
            ],
            [
                'name'=>'g6'
            ]
    ]);
    }
}
