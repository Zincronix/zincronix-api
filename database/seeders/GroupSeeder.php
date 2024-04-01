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
                'name'=>'G1'
            ],
            [
                'name'=>'G2'
            ],
            [
                'name'=>'G3'
            ],
            [
                'name'=>'G4'
            ],
            [
                'name'=>'G5'
            ],
            [
                'name'=>'G6'
            ]
    ]);
    }
}
