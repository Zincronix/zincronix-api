<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_reservations')->insert([
            [
                'state'=>'APROBADO',
            ],
            [
                'state'=>'PENDIENTE',
            ],
            [
                'state'=>'CANCELADO',
            ]
        ]);
    }
}
