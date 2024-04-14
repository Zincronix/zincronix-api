<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departaments')->insert([
            [
                'name'=> 'MATEMATICAS',
            ],
            [
                'name'=> 'SISTEMAS',
            ],
            [
                'name'=> 'INDUSTRIAL',
            ],
            [
                'name'=> 'QUIMICA',
            ],
            [
                'name'=> 'CIVIL',
            ],
            [
                'name'=> 'FISICA',
            ],
            [
                'name'=> 'BIOLOGIA',
            ] 
        ]);
    }
}
