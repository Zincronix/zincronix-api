<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Availability;
use App\Models\DocenteMateriaGrupo;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::with([
            'periods:id,hour',
            'classrooms:name',
            'docenteMateriaGrupos.teacher'
        ])->latest()->paginate(10);

        $reservations->getCollection()->transform(function ($reservation) {
            return [
                'id' => $reservation->id,
                'teachers' => $reservation->docenteMateriaGrupos->pluck('teacher.name')->unique()->values()->toArray(),
                'classrooms' => $reservation->classrooms->pluck('name')->toArray(),
                'date' => $reservation->date,
                'periods' => $reservation->periods->pluck('hour')->toArray(),
                'status' => $reservation->statusreservationtion,
                'reason' => $reservation->reason,
            ];
        });
        
        return $reservations;
    }

    public function periodsForClassroomReservation($classroom_id, $date)
    {
        $date = Carbon::parse($date);

        $dayWeekNumber = $date->dayOfWeek;

        $classroom_id = null;

        $reservas = Reservation::whereHas('classrooms', function ($query) use ($classroom_id) {
            $query->where('classroom_id', $classroom_id);
        })->whereDate('date', $date) 
            ->with('periods')
            ->get()
            ->pluck('periods.*.id')
            ->flatten();

        $disponibilidades = Availability::where('classroom_id', $classroom_id)
                                            ->where('day_id', $dayWeekNumber)
                                            ->with('periods')->get();

        if($disponibilidades->isEmpty()){
            $disponibilidades = Availability::whereNull('classroom_id')
                                        ->where('day_id', $dayWeekNumber)
                                        ->with('periods')->get();
        }

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

        return $periodosDisponibles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservationRequest $request)
    {
        try {
            DB::beginTransaction();

            $existingReservations = $this->existingReservation($request);
            
            if ($existingReservations->isNotEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe una reserva para este periodo y estas aulas en la fecha especificada'
                ], 400);
            }
        
            $reservation = $this->reserve($request);
            
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Solicitud de reserva creado satisfactoriamente',
                'Solicitud' => $reservation
            ],201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al procesar la solicitud de reserva'
            ], 500);
        }


    }

    private function existingReservation($request)
    {
        $existingReservations = Reservation::where(function ($query) use ($request) {
            $query->whereHas('periods', function ($query) use ($request) {
                $query->whereIn('period_id', $request->period_id);
            })
            ->where('status_reservation_id', 1)
            ->where('date', $request->date_reservation)
            ->whereHas('classrooms', function ($query) use ($request) {
                $query->whereIn('classroom_id', $request->classrooms);
            });
        })
        ->lockForUpdate() //todo Verificar si produce lentitud al bloquear consultas
        ->get();

        return $existingReservations;
    }

    private function reserve($request)
    {
        $reservation = new Reservation;
        if(true){
            $reservation->status_reservation_id = 2;
        }else{
            $reservation->status_reservation_id = 1;
        }
        
        $reservation->reason = $request->reason_reservation;
        $reservation->date = $request->date_reservation;

        $reservation->save();

        $reservation->periods()->attach($request->period_id);
        $reservation->classrooms()->attach($request->classrooms);

        $reservation = $this->addDocenteMateriaGrupo($reservation, $request);

        return $reservation;
    }

    private function addDocenteMateriaGrupo($reservation, $request)
    {
        foreach ($request->teachers as $teacher){

            foreach ($teacher['groups'] as $group){

                $docMatGrup = DocenteMateriaGrupo::where([
                    'teacher_id' => $teacher['teacher_id'],
                    'subject_id' => $group[0],
                    'group_id' => $group[1]
                ])->first();

                if (!$docMatGrup) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'No hay consistencia en los datos de Teacher, Subject o Group'
                    ], 500);
                }

                $reservation->docenteMateriaGrupos()->attach($docMatGrup->id);

            }
            
        }

        return $reservation;
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
