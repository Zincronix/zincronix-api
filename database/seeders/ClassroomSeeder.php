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
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ],
            [
                'name'=>'691A',
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ],
            [
                'name'=>'692A',
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
                
            ],
            [
                'name'=>'693A',
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ],
            [
                'name'=>'691B',
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ],
            [
                'name'=>'691C',
                'capacity' => 40,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ],
            [
                'name'=>'AUDITORIO',
                'capacity' => 100,
                'description'=>'esta es una nueva aula',
                'image'=>'esta es una imagen'
            ]
        ]);
    }
}
