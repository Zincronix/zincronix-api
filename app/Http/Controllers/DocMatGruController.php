<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocenteMateriaGrupoResource;
use App\Models\DocenteMateriaGrupo;
use Illuminate\Http\Request;

class DocMatGruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DocenteMateriaGrupoResource::collection(DocenteMateriaGrupo::with(['teacher','subject','group'])->get());
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
     * @param  \App\Models\DocMatGru  $docMatGru
     * @return \Illuminate\Http\Response
     */
    public function show(DocenteMateriaGrupo $docMatGru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocMatGru  $docMatGru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocenteMateriaGrupo $docMatGru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocMatGru  $docMatGru
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocenteMateriaGrupo $docMatGru)
    {
        //
    }
}
