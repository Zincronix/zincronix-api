<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class DocenteMateriaGrupoController extends Controller
{
    
    public function subjectsOfTeacher($teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        return $teacher->subjects()->distinct()->get();
    }

    public function groupsOfSubjectOfTeacher($teacher_id, $subject_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        return $teacher->groups()
                   ->where('subject_id', $subject_id)
                   ->get();
    }
}
