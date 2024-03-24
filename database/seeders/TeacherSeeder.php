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
                'name'=>'maria leticia blanco coca',
                'email' => 'leticia@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'alex israel bustillos vargas',
                'email' => 'alex@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'patricia gonzales',
                'email' => 'patricia@gmail.com',
                'password' => '12345678',
                'active' => true
                
            ],
            [
                'name'=>'carmen rosa',
                'email' => 'carmen@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'carla salazar',
                'email' => 'carla@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'Doctor lucio gonzales',
                'email' => 'lucio@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
        ]);
    }
}
