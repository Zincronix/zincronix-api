<?php

namespace App\Http\Controllers;

use App\Models\DocMatGru;
use App\Models\Reservation;
use App\Models\ReservationRequest;
use Illuminate\Http\Request;

class ReservationRequestController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'period_id' => 'required',
            'reason_reservation' => 'String',
            'date_reservation' => 'String',
            'classrooms' => 'required',
            'teachers' => 'required'
        ]);

        $solicitud = new ReservationRequest;
        $solicitud->period_id = $request->period_id;
        $solicitud->reason_reservation = $request->reason_reservation;
        $solicitud->date_reservation = $request->date_reservation;
        $solicitud->save();

        foreach ($request->classrooms as $classrom_id){
            foreach ($request->teachers as $teacher){
                foreach ($teacher['subjects'] as $subject){
                    foreach ($subject['groups'] as $group){
                        $docMatGrup = DocMatGru::firstOrFail([
                            'teacher_id' => $teacher['teacher_id'],
                            'subject_id' => $subject['subject_id'],
                            'group_id' => $group
                        ]);

                        $reservation = new Reservation();
                        $reservation->reservation_request_id = $solicitud->id;
                        $reservation->classrom_id = $classrom_id;
                        $reservation->doc_mat_gru_id = $docMatGrup->id;
                        $res = $reservation->save();
                        if(!$res){
                            return response()->json([
                                'status' => false,
                                'message' => 'Error en la solicitud de reserva'
                            ], 500);
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Solicitud de reserva creado satisfactoriamente',
            'Solicitud' => $solicitud
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservationRequest  $reservationRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ReservationRequest $reservationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservationRequest  $reservationRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservationRequest $reservationRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservationRequest  $reservationRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservationRequest $reservationRequest)
    {
        //
    }
}
