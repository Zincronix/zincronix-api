<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            [
                'hour'=>'06:45',
                'range_id' => 2
            ],
            [
                'hour'=>'08:15',
                'range_id' => 2
            ],
            [
                'hour'=>'09:45',
                'range_id' => 2
            ],
            [
                'hour'=>'11:15',
                'range_id' => 2
            ],
            [
                'hour'=>'12:45',
                'range_id' => 2
            ],
            [
                'hour'=>'14:15',
                'range_id' => 2
            ],
            [
                'hour'=>'15:45',
                'range_id' => 2
            ],
            [
                'hour'=>'17:15',
                'range_id' => 2
            ],
            [
                'hour'=>'18:45',
                'range_id' => 2
            ],
            [
                'hour'=>'20:15',
                'range_id' => 2
            ],
            [
                'hour'=>'21:45',
                'range_id' => 2
            ]
        ]);
    }
}
