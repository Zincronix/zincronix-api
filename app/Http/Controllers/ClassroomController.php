<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassroomResource;
use App\Models\Characteristic;
use App\Models\Classroom;
use App\Models\Reservation;
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

        if($request->hasFile('imagen')){
        $validado=$request->validate([
            'nombre'=>'unique:App\Models\Classroom,name',
            'capacidad'=>'required',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,binary'
        ],[
            'nombre.unique'=>'El nombre de aula que elijiste ya existe',
            'imagen.mimes'=>'Solo se permiten imagenes de tipo: jpeg, png, jpg.' 
        ]);

        }else{
        $validado=$request->validate([
            'nombre'=>'unique:App\Models\Classroom,name',
            'capacidad'=>'required',
        ],[
            'nombre.unique'=>'El nombre de aula que elijiste ya existe',
            'imagen.mimes'=>'Solo se permiten imagenes de tipo: jpeg, png, jpg.' 
        ]);
        }

        $jsonizable=json_decode($request->input('condiciones'));

        $curso=new Classroom;
        $curso->name=$request->input('nombre');
        $curso->capacity=$request->input('capacidad');
        $curso->description=$request->input('descripcion');
        if($request->hasFile('imagen')){
        $direccionIMG = $request->file('imagen')->store('classroom', 'public');
        $origen = "http://127.0.0.1:8000/storage/";
        $cadenaTotal = $origen . $direccionIMG;
        $curso->image = $cadenaTotal;
        }else{
            $curso->image="este curso no tiene imagen";
        }
        $curso->save();

        $curso->characteristics()->attach($jsonizable);

        return response()->json([
            'status'=>true,
            'message'=>'Aula creada correctamente',
        ],201);
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
    public function showClassroomAvailable(Classroom $classroom, Request $request)
    {
        $reservas = $this->getReservationsForClassroom($classroom, $request);

        $state = $reservas ? "En otra solicitud" : "Libre";

        $suggestion = $this->showAvailableClassroomsEfficiently($request);
        $suggestion = $suggestion->except($classroom->id);

        $suggestionStates = $this->getStatesForSuggestion($suggestion, $request);

        return response()->json([
            'Available' => [
                'id' => $classroom->id,
                'name' => $classroom->name,
                'capacity' => $classroom->capacity,
                'state' => $state
            ],
            'Suggestion' => $suggestionStates
        ], 201);
    }

    private function getReservationsForClassroom(Classroom $classroom, Request $request)
    {
        return $classroom->reservations()
            ->whereHas('periods', function ($query) use ($request) {
                $query->whereIn('periods.id', $request->periods);
            })
            ->whereDate('date', $request->date)
            ->where('status_reservation_id', 2)
            ->exists();
    }

    private function getStatesForSuggestion($suggestion, Request $request)
    {
        $suggestionStates = [];
        foreach ($suggestion as $suggestedClassroom) {
            $suggestedReservas = $this->getReservationsForClassroom($suggestedClassroom, $request);
            $suggestionStates[] = [
                'id' => $suggestedClassroom->id,
                'name' => $suggestedClassroom->name,
                'capacity' => $suggestedClassroom->capacity,
                'state' => $suggestedReservas ? "En otra solicitud" : "Libre"
            ];
        }
        return $suggestionStates;
    }

    /**
     * Esta funcion servirá para sugerencias 
     * en la vista de filtrar por ambiente
     */    
    public function showAvailableClassroomsEfficiently(Request $request)
    {
        $periods = $request->periods;
        $date = Carbon::parse($request->date);
        $dayWeekNumber = $date->dayOfWeek;

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
