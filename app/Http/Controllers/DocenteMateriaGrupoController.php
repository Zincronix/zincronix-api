<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DocenteMateriaGrupoController extends Controller
{
    
    public function subjectsOfTeacher($teacher_id)
    {
        // $teacher = Teacher::findOrFail($teacher_id);
        // return $teacher->subjects()->distinct()->get();

        return Subject::whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teachers.id', $teacher_id);
        })->distinct()->get();
    }
    
    public function groupsOfSubjectOfTeacher(Request $request)
    {
        $teacher = Teacher::findOrFail($request->teacher_id);

        $groups = collect();

        foreach($request->subjects as $subject_id){

            $subject = Subject::findOrFail($subject_id);

            $actualGroups = $teacher->groups()
            ->where('subject_id', $subject_id)
            ->get();

            foreach($actualGroups as $actual){
                $groups->push([
                    'id' => $actual->id,
                    'subject_id' => $subject_id,
                    'group' => $subject->name . " / " . $actual->name
                ]);
            }
            
        }

        return $groups;
        
    }

    public function unoccupiedSubjectGroups(Subject $subject)
    {
        $groups = $subject->groups()->where('teacher_id', null)->get();
        //materias libres que no estan registradas
        $response = collect();
        
        foreach($groups as $group){
            $response->push([
                'id' => $group->id,
                'subject_id' => $subject->id,
                'group' => $group->name
            ]);
        }

        return $response;
    }
    //varias materias
    public function unoccupiedSubjectGroups2(Request $request)
    {
        $response = collect();

        foreach($request->subjects as $subject_id){

            $subject = Subject::findOrFail($subject_id);
            $groups = $subject->groups()->where('teacher_id', null)->get();

            foreach($groups as $group){
                $response->push([
                    'id' => $group->id,
                    'subject_id' => $subject->id,
                    'group' => $group->name
                ]);
            }
        }   

        return $response;
    }
}
