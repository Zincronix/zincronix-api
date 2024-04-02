<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Availability;
use App\Models\DocenteMateriaGrupo;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function periodsForClassroomReservation($classroom_id, $date)
    {
        $date = Carbon::parse($date);

        $numeroDiaSemana = $date->dayOfWeek;

        $reservas = Reservation::whereHas('classrooms', function ($query) use ($classroom_id) {
            $query->where('classroom_id', $classroom_id);
        })->whereDate('date', $date)->pluck('period_id');

        $disponibilidades = Availability::where('classroom_id', $classroom_id)
                                            ->where('day_id', $numeroDiaSemana)
                                            ->with('periods')->get();

        $periodosDisponibles = collect();

        foreach ($disponibilidades as $disponibilidad) {
            foreach ($disponibilidad->periods as $period) {
                if (!$reservas->contains($period->id)) {
                    $periodosDisponibles->push([
                        'id' => $period->id,
                        'hour' => $period->hour,
                        'available' => true
                    ]);
                } else {
                    $periodosDisponibles->push([
                        'id' => $period->id,
                        'hour' => $period->hour,
                        'available' => false
                    ]);
                }
            }
        }

        // dd($periodosDisponibles);

        return $periodosDisponibles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //todo
    //Verificar que no exista reserva para esa fecha
    //Manejar transacciones
    public function store(CreateReservationRequest $request)
    {
        $reservation = new Reservation;
        $reservation->status_reservation_id = 2;
        $reservation->period_id = $request->period_id;
        $reservation->reason = $request->reason_reservation;
        $reservation->date = $request->date_reservation;

        $reservation->save();

        $reservation->classrooms()->attach($request->classrooms);

        foreach ($request->teachers as $teacher){
            foreach ($teacher['subjects'] as $subject){
                
                foreach ($subject['groups'] as $group){
                    $docMatGrup = DocenteMateriaGrupo::where([
                        'teacher_id' => $teacher['teacher_id'],
                        'subject_id' => $subject['subject_id'],
                        'group_id' => $group
                    ])->first();

                    if (!$docMatGrup) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Error en la solicitud de reserva'
                        ], 500);
                    }

                    $reservation->docenteMateriaGrupos()->attach($docMatGrup->id);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Solicitud de reserva creado satisfactoriamente',
            'Solicitud' => $reservation
        ],201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
