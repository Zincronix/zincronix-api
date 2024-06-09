<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Jobs\EmailJob;
use App\Mail\ReservationMail;
use App\Models\Availability;
use App\Models\DocenteMateriaGrupo;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Teacher;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            'periods:hour',
            'classrooms:name,capacity',
            'docenteMateriaGrupos.teacher',
            'statusReservation'
        ])->get();

        $reservations->transform(function ($reservations) {
            return $this->transformRservation($reservations);
        });
    
        
        return $reservations;
    }

    private function transformRservation($reservation)
    {
        $state = $reservation->statusReservation;
        $classrooms = $reservation->classrooms;
        $periods = $this->getValues($reservation->periods, 'hour');

        $fechaModificada=$reservation->created_at;
        $fechaformateada=date('d/m/Y H:i:s', strtotime($fechaModificada));
        $teacherData = [];

        foreach ($reservation->docenteMateriaGrupos as $docenteMateriaGrupo) {
            $teacherId = $docenteMateriaGrupo->teacher->id;
            $teacherName = $docenteMateriaGrupo->teacher->name;
            $subjectName = $docenteMateriaGrupo->subject->name;
            
            $groups = $reservation->docenteMateriaGrupos
            ->where('teacher_id', $teacherId)
            ->where('subject_id', $docenteMateriaGrupo->subject->id)
            ->load('group') 
            ->pluck('group.name') 
            ->toArray();            

            $teacherData[$teacherId]['teacher_id'] = $teacherId;
            $teacherData[$teacherId]['teacher_name'] = $teacherName;
            $teacherData[$teacherId]['subjects'][$subjectName]['groups'] = $groups;
        }
    
        return [
            'reservation_id' => $reservation->id,
            'classrooms' => $classrooms,
            'date' => date('d/m/Y', strtotime($reservation->date)),
            'periods' => $periods,
            'state' => $state,
            'reason' => $reservation->reason,
            'docenteMateriaGrupo' => array_values($teacherData),
            'fecha_creado'=>$fechaformateada
        ];
    }

    private function getState($reservation)
    {
        return [
            'state_id' => $reservation->statusReservation->id,
            'state' => $reservation->statusReservation->state,
        ];
    }
    
    private function getValues($collection, $attribute)
    {
        return $collection->pluck($attribute)->toArray();
    }
    
    private function getUniqueValues($collection, $attribute)
    {
        return $collection->pluck($attribute)->unique()->values()->toArray();
    }


    public function orderBy(Request $request)
    {
        $reservations = Reservation::with([
            'periods:hour',
            'classrooms:name',
            'docenteMateriaGrupos.teacher'
        ]);        

        switch ($request->orderBy){
            case 1:
                $reservations->oldest();
                break;
            case 2:
                $reservations->orderByRaw('ABS(EXTRACT(EPOCH FROM (AGE(date))))');
                break;
            default:
                $reservations->oldest();
        }

        $reservations = $reservations->paginate(10);

        $reservations = $this->transformRservation($reservations);
        return $reservations;
    }

    public function periodsForClassroomReservation($classroom_id, $date)
    {
        $date = Carbon::parse($date);

        $dayWeekNumber = $date->dayOfWeek;

        $reservas = Reservation::whereHas('classrooms', function ($query) use ($classroom_id) {
            $query->where('classroom_id', $classroom_id);
        })->whereDate('date', $date)->where('status_reservation_id', 1)
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
                $aux = strtotime($period->hour);
                $aux += $period->range->range * 60;
                $horaFin = date('H:i', $aux);
                if (!$reservas->contains($period->id)) {
                    $periodosDisponibles->push([
                        'id' => $period->id,
                        'hour' => $period->hour . " - " . $horaFin,
                        'available' => true
                    ]);
                } else {
                    $periodosDisponibles->push([
                        'id' => $period->id,
                        'hour' => $period->hour . " - " . $horaFin,
                        'available' => false
                    ]);
                }
            }
        }

        return $periodosDisponibles;
    }

    private function procesarReserva(Request $request)
    {
        
        if($request->status == false){
            
            $existingReservationsAceptadas = $this->existingReservation($request->periods, $request->date_reservation, $request->classrooms, 1);
                
            if ($existingReservationsAceptadas->isNotEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe una reserva aceptada para este periodo y estas aulas en la fecha especificada'
                ], 400);
            }
            
            $existingReservationsPendiente = $this->existingReservation($request->periods, $request->date_reservation, $request->classrooms, 2);
            
            if ($existingReservationsPendiente->isNotEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe una reserva pendiente para este periodo y estas aulas en la fecha especificada'
                ], 400);
            }
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservationRequest $request)
    {   

        $check = $this->procesarReserva($request);

        if($check !== true){
            return $check;
        }

        try {
            DB::beginTransaction();
        
            $result = $this->reserve($request);

            if( $result === true ){
            
                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Solicitud de reserva creado satisfactoriamente'
                ],201);

            }else{
                return $result;
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al procesar la solicitud de reserva'
            ], 500);
        }
    }

    private function existingReservation($periods, $date_reservation, $classrooms, $status_reservation_id)
    {
        return Reservation::where(function ($query) use ($periods, $date_reservation, $classrooms, $status_reservation_id) {
            $query->whereHas('periods', function ($query) use ($periods) {
                $query->whereIn('period_id', $periods);
            })
            ->where('status_reservation_id', $status_reservation_id)
            ->where('date', $date_reservation)
            ->whereHas('classrooms', function ($query) use ($classrooms) {
                $query->whereIn('classroom_id', $classrooms);
            });
        })
        ->lockForUpdate() //todo Verificar si produce lentitud al bloquear consultas
        ->get();
    }

    private function reserve($request)
    {
        $reservation = new Reservation;
        
        $modoReservation = Setting::where('id', 1)->value('type_reservation');
        if($modoReservation == 'MANUAL'){
            $reservation->status_reservation_id = 2;
        }else{
            $reservation->status_reservation_id = 1;
        }
        
        $reservation->reason = $request->reason_reservation;
        $reservation->date = $request->date_reservation;

        $reservation->save();

        $reservation->periods()->attach($request->periods);
        $reservation->classrooms()->attach($request->classrooms);

        $result = $this->addDocenteMateriaGrupo($reservation, $request);

        return $result;
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

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $reservation->load([
            'periods:hour',
            'classrooms:name,capacity',
            'docenteMateriaGrupos.teacher',
            'docenteMateriaGrupos.subject.groups',
            'statusReservation'
        ]);

        $reservation = $this->transformRservation($reservation);

        return $reservation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {        
        if( $request->status_reservation_id === 1 ){

            $existingReservation = $this->existingReservation($reservation->periods->pluck('id'), $reservation->date, $reservation->classrooms->pluck('id'), 1);
        
            if ( $existingReservation->isNotEmpty() ) {
                return response()->json([
                    'status' => false,
                    'message' => 'No se puede aceptar la reserva. Ya existe una reserva para este periodo y estas aulas en la fecha especificada'], 400);
            }

            // De esta manera o hacer una automatizacion para actualizar el estado si la fehca se vence
            // Enviar correos de recordatorio para el administrador de las solicitudes pendietes urgentes
            if ( !$this->verificarDate($reservation->date) ){
                return response()->json([
                    'status' => false,
                    'message' => 'La fecha de reserva no es válida'], 400);
            }

        }

        $reservation->update($request->all());
        
        EmailJob::dispatch($reservation, $request->status_reservation_id, $request->motivo);                  

        return response()->json([
            'status' => true,
            'message' => 'Solicitud de reserva actualizado exitosamente'
        ], 200);
    }

    private function verificarDate($date)
    {
        $dateCarbon = Carbon::parse($date);

        return $dateCarbon->isToday() || $dateCarbon->isFuture();
    }

    public function weekReservation(Request $request){
    
        $fechaInicio = Carbon::createFromFormat('d-m-Y', $request->fechaInicio)->toDateString();
        $fechaFin = Carbon::createFromFormat('d-m-Y', $request->fechaFin)->toDateString();
        $aulasIds=$request->aula;
        $reservations = Reservation::whereDate('date', '>=', $fechaInicio)
            ->whereDate('date', '<=', $fechaFin)
            ->whereHas('classrooms', function ($query) use ($aulasIds) {
                $query->whereIn('classrooms.id', $aulasIds);
            })
            ->with([
                'periods:id,hour',
                'classrooms:name',
                'docenteMateriaGrupos.teacher',
                'statusReservation'
            ])
            ->get();

        $reservations->transform(function ($reservations) {
            return $this->transformRservation($reservations);
        });
    
        if($reservations->isEmpty()){
            return response()->json(['message' => 'No se encontraron reservaciones para el rango de fechas proporcionado'], 404);
        }
    
        return $reservations;
    }

    public function sortDate()
    {
        $reservations = Reservation::with([
            'periods:hour',
            'classrooms:name,capacity',
            'docenteMateriaGrupos.teacher',
            'statusReservation'
        ])->get();

        $reservations->transform(function ($reservations) {
            return $this->transformRservation($reservations);
        });
        
        $reservas=$reservations->toArray();


        $currentDate = new DateTime();

    usort($reservas, function($a, $b) use ($currentDate) {
    $dateA = DateTime::createFromFormat('d/m/Y', $a['date']);
    $dateB = DateTime::createFromFormat('d/m/Y', $b['date']);

    if ($dateA == $dateB) {
        $stateOrder = ['ACEPTADO' => 1, 'PENDIENTE' => 2, 'CANCELADO' => 3];
        $stateA = $a['state']['state'];
        $stateB = $b['state']['state'];
        return $stateOrder[$stateA] - $stateOrder[$stateB];
    }

    if ($dateA == $currentDate) {
        return -1; 
    } elseif ($dateB == $currentDate) {
        return 1; 
    } elseif ($dateA < $currentDate && $dateB > $currentDate) {
        return 1; 
    } elseif ($dateA > $currentDate && $dateB < $currentDate) {
        return -1; 
    } else {
        return $dateA <=> $dateB; 
    }
    });
     return $reservas;
    }

}