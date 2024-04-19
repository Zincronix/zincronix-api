<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassroomResource::collection(Classroom::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Este controlador servira para mostrar la vista 2 del proceso de reserva
     * Esta funcion es para filtrar por ambiente
     * todo
     * Sugerencias de ambientes
     */
    public function showClassroomAvailable($classroom_id, $period_id, $date)
    {
        $classroom = Classroom::findOrFail($classroom_id);
        return response()->json([
            'Available' => [
                $classroom
            ],
            'Suggestion' => []
        ], 201);
    }

    /**
     * Esta funcion servirá para sugerencias 
     * en la vista de filtrar por ambiente
     */
    public function showAvailableClassrooms(Request $request)
    {
        $periods = $request->periods;
        $date = Carbon::parse($request->date);
        $dayWeekNumber = $date->dayOfWeek;

        $reservedClassrooms = collect();
        $availableClassrooms = collect();

        foreach($periods as $period_id){

            $reservedClassroomsForPeriod = $this->reservedClassroomsForPeriod($period_id, $date);
            $reservedClassrooms = $reservedClassrooms->merge($reservedClassroomsForPeriod);

            $availableClassroomsForPeriod = $this->classroomsWithAvailabilityForPeriod($period_id, $dayWeekNumber);
            $availableClassrooms = $availableClassrooms->merge($availableClassroomsForPeriod);
                                   
        }

        $classroomsWithoutReservations = $availableClassrooms->diff($reservedClassrooms);
        
        return $classroomsWithoutReservations;
    }

    private function reservedClassroomsForPeriod($period_id, $date)
    {
        return Classroom::whereHas('reservations', function ($query) use ($period_id, $date) {
            $query->whereHas('periods', function ($query) use ($period_id) {
                $query->where('periods.id', $period_id);
            })->whereDate('date', $date)
                ->where('status_reservation_id', 1);
        })->get();

    }

    private function classroomsWithAvailabilityForPeriod($period_id, $dayWeekNumber)
    {
        $classroomsWithCustomizedAvailability  = Classroom::whereHas('availabilities', function ($query) use ($dayWeekNumber, $period_id) {
            $query->where('day_id', $dayWeekNumber)
                    ->whereHas('periods', function ($query) use ($period_id) {
                        $query->where('periods.id', $period_id);
                    });
        })->get();

        $classroomsWithGeneralAvailability  = Classroom::whereDoesntHave('availabilities')
        ->orWhereHas('availabilities', function ($query) use ($dayWeekNumber, $period_id) {
            $query->whereNull('classroom_id')
                ->where('day_id', $dayWeekNumber)
                ->whereHas('periods', function ($query) use ($period_id) {
                    $query->where('periods.id', $period_id);
                });
        })->get();

        return $classroomsWithCustomizedAvailability->merge($classroomsWithGeneralAvailability);        
    }

    public function showAvailableClassroomsEfficiently(Request $request)
    {
        $periods = $request->periods;
        $date = Carbon::parse($request->date);
        $dayWeekNumber = $date->dayOfWeek;

        $minPeriod = min($periods);
        $maxPeriod = max($periods);

        $reservedClassrooms = $this->reservedClassroomsForPeriodRange($periods, $date);

        $availableClassrooms = $this->classroomsAvailableForPeriods($periods, $dayWeekNumber);

        $classroomsWithoutReservations = $availableClassrooms->diff($reservedClassrooms);
        
        return $classroomsWithoutReservations;
    }

    private function reservedClassroomsForPeriodRange($periods, $date)
    {        
        return Classroom::select('id', 'name', 'capacity')
        ->whereHas('reservations', function ($query) use ($periods, $date) {
            $query->whereHas('periods', function ($query) use ($periods){
                $query->whereIn('periods.id', $periods);
            })->whereDate('date', $date)
                ->where('status_reservation_id', 1);
        })->get();
    }

    private function classroomsAvailableForPeriods($periods, $dayWeekNumber)
    {

        $availableClassrooms = Classroom::select('id', 'name', 'capacity')
        ->whereHas('availabilities', function ($query) use ($dayWeekNumber, $periods) {
            $query->where('day_id', $dayWeekNumber)
                    ->whereHas('periods', function ($query) use ($periods) {
                        $query->whereIn('periods.id', $periods);
                    }, '=', count($periods));                
        })
        ->orWhereDoesntHave('availabilities')
        ->orWhereHas('availabilities', function ($query) use ($dayWeekNumber, $periods) {
            $query->whereNull('classroom_id')
                ->where('day_id', $dayWeekNumber)
                ->whereHas('periods', function ($query) use ($periods) {
                    $query->whereIn('periods.id', $periods);
                }, '=', count($periods));                    
        })->get();

        return $availableClassrooms;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
