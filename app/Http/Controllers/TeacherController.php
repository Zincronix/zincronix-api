<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\DocenteMateriaGrupo;
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
     * todo
     * Aplicar form request
     */ 
    public function store(CreateTeacherRequest $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = '12345678';
        $teacher->active = true;

        $teacher->save();

        foreach ($request['subjects'] as $subjectInfo) {
            foreach ($subjectInfo['groups'] as $groupId) {
                
                $docenteMateriaGrupo = new DocenteMateriaGrupo();
                $docenteMateriaGrupo->teacher_id = $teacher->id;
                $docenteMateriaGrupo->subject_id = $subjectInfo['subject_id'];
                $docenteMateriaGrupo->group_id = $groupId;
                $docenteMateriaGrupo->save();
            }
        }
        return response()->json(['message' => 'Teacher created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return new TeacherResource($teacher);
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
