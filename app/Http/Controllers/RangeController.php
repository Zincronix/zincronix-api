<?php

namespace App\Http\Controllers;

use App\Models\Range;
use App\Http\Requests\StoreRangeRequest;
use App\Http\Requests\UpdateRangeRequest;

class RangeController extends Controller
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
     * @param  \App\Http\Requests\StoreRangeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRangeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Range  $range
     * @return \Illuminate\Http\Response
     */
    public function show(Range $range)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRangeRequest  $request
     * @param  \App\Models\Range  $range
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRangeRequest $request, Range $range)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Range  $range
     * @return \Illuminate\Http\Response
     */
    public function destroy(Range $range)
    {
        //
    }
}
