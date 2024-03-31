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
                'name'=>'MARIA LETICIA BLANCO COCA',
                'email' => 'leticia@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'ALEX ISRAEL BUSTILLOS VARGAS',
                'email' => 'alex@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'PATRICIA GONZALES',
                'email' => 'patricia@gmail.com',
                'password' => '12345678',
                'active' => true
                
            ],
            [
                'name'=>'CARMEN ROSA',
                'email' => 'carmen@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'CARLA SALAZAR',
                'email' => 'carla@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
            [
                'name'=>'LUCIO GONZALES',
                'email' => 'lucio@gmail.com',
                'password' => '12345678',
                'active' => true
            ],
        ]);
    }
}
