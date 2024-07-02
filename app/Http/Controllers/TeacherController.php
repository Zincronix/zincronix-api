<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\DocenteMateriaGrupo;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $teacher = $this->createTeacher($validated);

            $this->assignTeacher($teacher, $validated['subjects']);

            DB::commit();

            return response()->json(['message' => 'Teacher created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al procesar la solicitud' . $e->getMessage()
            ], 500);
        }

    }

    private function createTeacher(array $data)
    {
        return Teacher::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => '12345678',
            'active' => true,
        ]);
    }

    private function assignTeacher(Teacher $teacher, array $subjects)
    {
        foreach ($subjects as $subjectInfo) {
            foreach ($subjectInfo['groups'] as $groupId) {

                $docenteMateriaGrupo = DocenteMateriaGrupo::where([
                    'subject_id' => $subjectInfo['subject_id'],
                    'group_id' => $groupId
                ])->first();

                if(!$docenteMateriaGrupo) {
                    throw new \Exception('No hay consistencia en los datos de Subject o Group');
                }

                if ($docenteMateriaGrupo->teacher_id !== null){
                    throw new \Exception('El grupo ya tiene docente asignado');
                }

                $docenteMateriaGrupo->teacher_id = $teacher->id;
                $docenteMateriaGrupo->save();
            }
        }
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

    public function subjectsAndGroupsOfTeacher($id)
    {
        $teacher = Teacher::with(['subjects.groups' => function ($query) use ($id) {
            $query->select('groups.id', 'groups.name', 'docente_materia_grupos.subject_id as id_subject')
                ->where('docente_materia_grupos.teacher_id', $id);
        }])->find($id);

        $uniqueSubjects = $teacher->subjects->unique('id');

        $result = [
            'id' => $teacher->id,
            'name' => $teacher->name,
            'subjects' => $uniqueSubjects->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                    'groups' => $subject->groups,
                ];
            }),
        ];

        return $result;
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
