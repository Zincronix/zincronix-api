<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('availabilities')->insert([
            [
                'classroom_id' => null,
                'day_id' => 1,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id' => null,
                'day_id' => 2,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id' => null,
                'day_id' => 3,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id' => null,
                'day_id' => 4,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id' => null,
                'day_id' => 5,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id' => null,
                'day_id' => 6,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 1,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 2,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 3,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 4,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 5,
                'range_id' => 2,
                'active' => true
            ],
            [
                'classroom_id'=>1,
                'day_id' => 6,
                'range_id' => 2,
                'active' => true
            ],
        ]);
    }
}
