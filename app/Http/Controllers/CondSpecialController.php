<?php

namespace App\Http\Controllers;

use App\Http\Resources\CondSpecialResource;
use App\Models\CondSpecial;
use Illuminate\Http\Request;

class CondSpecialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CondSpecialResource::collection(CondSpecial::latest()->paginate());
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
     * @param  \App\Models\CondSpecial  $condSpecial
     * @return \Illuminate\Http\Response
     */
    public function show(CondSpecial $condSpecial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CondSpecial  $condSpecial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CondSpecial $condSpecial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CondSpecial  $condSpecial
     * @return \Illuminate\Http\Response
     */
    public function destroy(CondSpecial $condSpecial)
    {
        //
    }
}
