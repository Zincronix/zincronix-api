<?php

namespace Database\Seeders;

use App\Models\DocenteMateriaGrupo;
use App\Models\Reservation;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                "status_reservation_id" => 1,
                "reason" => "esta es una reserva",
                "date" => "2024-06-29",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-05-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 3,
                "reason" => "esta es una reserva",
                "date" => "2024-06-21",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-06-26",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 1,
                "reason" => "esta es una reserva",
                "date" => "2024-07-01",
            ],
            [
                "status_reservation_id" => 3,
                "date" => "2024-07-12",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 3,
                "reason" => "esta es una reserva",
                "date" => "2024-06-10",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-08-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 3,
                "reason" => "esta es una reserva",
                "date" => "2024-06-30",
            ],
            [
                "status_reservation_id" => 1,
                "date" => "2024-07-21",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 1,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 1,
                "date" => "2024-07-01",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 1,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 3,
                "reason" => "esta es una reserva",
                "date" => "2024-07-05",
            ],
            [
                "status_reservation_id" => 1,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 2,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 2,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 3,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 3,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 3,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ],
            [
                "status_reservation_id" => 1,
                "reason" => "esta es una reserva",
                "date" => "2024-07-29",
            ],
            [
                "status_reservation_id" => 2,
                "date" => "2024-07-29",
                "reason" => "esta es otra reserva",
            ]
        ]);

        $reservas=Reservation::all();

        $docenteAsignado=DocenteMateriaGrupo::select('id')->whereNotNull('teacher_id')->pluck('id')->toArray();
        
        foreach ($reservas as $reserva1) {
        $indiceAleatorio = array_rand($docenteAsignado);
        $teacherIdAleatorio = $docenteAsignado[$indiceAleatorio];
        $random=rand(11,18);
        $random1=rand(1,6);
        $random2=rand(1,10);
        $reserva1->docenteMateriaGrupos()->attach([$teacherIdAleatorio]);
        $reserva1->classrooms()->attach([$random1]);
        $reserva1->periods()->attach([$random2]);
        $reserva1->created_at='2024-03-01';
        $reserva1->save();
        }
        
    }
}
