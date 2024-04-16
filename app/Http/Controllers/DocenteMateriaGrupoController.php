<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DocenteMateriaGrupoController extends Controller
{
    
    public function subjectsOfTeacher($teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        return $teacher->subjects()->distinct()->get();
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
                    'group' => $subject->name . " / " . $actual->name
                ]);
            }
            
        }

        // $teacher = Teacher::find($request->teacher_id);

        // if (!$teacher) {
        //     return response()->json(['message' => 'Teacher not found'], 404);
        // }
    
        // $groups = collect();
    
        // foreach($request->subjects as $subject_id) {
        //     $subject = Subject::find($subject_id);
    
        //     if (!$subject) {
        //         continue; // O maneja el error como prefieras
        //     }
    
        //     $actualGroups = $teacher->groups()
        //         ->where('subject_id', $subject_id)
        //         ->get();
    
        //     foreach($actualGroups as $actual) {
        //         $groups->push([
        //             'id' => $actual->id,
        //             'group' => $subject->name . " / " . $actual->name
        //         ]);
        //     }
        // }

        return $groups;
        
    }
}
