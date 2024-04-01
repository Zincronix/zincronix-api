<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranges')->insert([
            [
                'range'=>60,
            ],
            [
                'range'=>90,
            ],
        ]);
    }
}
