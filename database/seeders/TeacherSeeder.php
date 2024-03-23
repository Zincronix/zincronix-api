<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'name'=>'maria leticia blanco coca'
            ],
            [
                'name'=>'alex israel bustillos vargas'
            ],
            [
                'name'=>'patricia gonzales'
            ],
            [
                'name'=>'carmen rosa'
            ],
            [
                'name'=>'carla salazar'
            ],
            [
                'name'=>'Doctor lucio gonzales'
            ],
        ]);
    }
}
