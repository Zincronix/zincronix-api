<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglas = Rule::with('classroom:id,name')->get();
        $response = [];

        foreach ($reglas as $regla) {
        $response[] = [
            'id' => $regla->id,
            'title' => $regla->title,
            'description' => $regla->description,
            'created_at' => $regla->created_at,
            'classroom' => $regla->classroom->name
        ];
    }

    return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validado=$request->validate([
            'titulo'=>'required',
            'descripcion'=>'required',
            'ambiente'=>'required'
        ],[
            'titulo.required'=>'El Titulo es requerido.',
            'descripcion.required'=>'La descripcion es requerida.',
            'ambiente.required'=>'El ambiente es requerido' 
        ]);

        $regla=new Rule();
        $regla->title=$request->titulo;
        $regla->description=$request->descripcion;
        $regla->classroom()->associate($request->ambiente);
        $regla->save();

        return response()->json([
            'status'=>true,
            'msg'=>"Regla creada correctamente"
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reglas = Rule::with('classroom:id,name')->where('classroom_id','=',$id)->get();

        $response = [];

        foreach ($reglas as $regla) {
        $response[] = [
            'id' => $regla->id,
            'title' => $regla->title,
            'description' => $regla->description,
            'created_at' => $regla->created_at,
            'classroom' => $regla->classroom->name
        ];

        return $response;
    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
