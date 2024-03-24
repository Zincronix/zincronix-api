<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Models\DocMatGru;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TeacherResource::collection(Teacher::latest()->paginate());
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
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email',
            'subject_id' => 'required',
            'group_id' => 'required'
        ]);

        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = '12345678';
        $teacher->active = true;

        $teacher->save();

        $docMatGru = new DocMatGru();
        $docMatGru->teacher_id = $teacher->id;
        $docMatGru->subject_id = $request->subject_id;
        $docMatGru->group_id = $request->group_id;

        $res = $docMatGru->save();

        if($res){
            return response()->json([
                'status' => true,
                'message' => 'Teacher creado satisfactoriamente',
                'Teacher' => $teacher
            ],201);
        }
        return response()->json([
            'status' => false,
            'message' => 'Error al crear el teacher'
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $docente)
    {
        return new TeacherResource($docente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
