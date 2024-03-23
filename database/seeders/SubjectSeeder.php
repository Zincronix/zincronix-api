<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjets')->insert([
            [
                'name'=>'Intro a la progra'
            ],
            [
                'name'=>'Algebra 1'
            ],
            [
                'name'=>'elementos'
            ],
            [
                'name'=>'calculo 1'
            ],
            [
                'name'=>'sistemas de informacion 1'
            ],
            [
                'name'=>'calculo 2'
            ]
        ]);
    }
}
