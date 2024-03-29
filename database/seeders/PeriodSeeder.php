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
            ],
            [
                'hour'=>'08:15',
            ],
            [
                'hour'=>'09:45',
            ],
            [
                'hour'=>'11:15',
            ],
            [
                'hour'=>'12:45',
            ],
            [
                'hour'=>'14:15',
            ],
        ]);
    }
}
