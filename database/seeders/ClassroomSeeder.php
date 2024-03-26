<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->insert([
            [
                'name'=>'690A',
                'capacity' => 40
            ],
            [
                'name'=>'691A',
                'capacity' => 40
            ],
            [
                'name'=>'692A',
                'capacity' => 40
                
            ],
            [
                'name'=>'693A',
                'capacity' => 40
            ],
            [
                'name'=>'691B',
                'capacity' => 40
            ],
            [
                'name'=>'691C',
                'capacity' => 40
            ],
        ]);
    }
}
