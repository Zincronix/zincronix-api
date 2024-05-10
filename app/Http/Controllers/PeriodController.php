<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeriodResource;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return PeriodResource::collection(Period::latest()->paginate());
    }

    public function periodsForFilterByCantidad()
    {
        $selectPeriod = Period::with('range')
                        ->select('id', 'hour', 'range_id')
                        ->where('range_id', 2)
                        ->get();

        $periods = $selectPeriod->map(function ($period) {
            $aux = strtotime($period->hour);
            $aux += $period->range->range * 60;
            $horaFin = date('H:i', $aux);
    
            return [
                'id' => $period->id,
                'hour' => $period->hour . " - " . $horaFin,
                'available' => true
            ];
        });

        return $periods;
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
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        //
    }
}
