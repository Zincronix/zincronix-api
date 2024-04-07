<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocenteMateriaGrupoResource;
use App\Models\DocenteMateriaGrupo;
use App\Models\Group;
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

    public function groupsOfSubjectOfTeacher($teacher_id, $subject_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        return $teacher->groups()
                   ->where('subject_id', $subject_id)
                   ->get();
    }

    public function getSubjects($idDocente){
        $materias= DocenteMateriaGrupo::select('subject_id')->where('teacher_id',$idDocente)->get();
        $data = json_decode($materias, true);
        // Inicializar un array para almacenar los subject_id
        $subject_ids = array();
        // Iterar sobre los datos y guardar los subject_id en el array
        foreach ($data as $item) {
            $subject_ids[] = $item['subject_id'];
        }    
        $nombresM= Subject::select('id','name')->whereIn('id',$subject_ids)->get();
        return $nombresM;
        //$nombresG=Group::select()->get();
        // $data = json_decode($ids, true);
        // // Inicializar un array para almacenar los subject_id
        // $subject_ids = array();
        // // Iterar sobre los datos y guardar los subject_id en el array
        // foreach ($data as $item) {
        //     $subject_ids[] = $item['subject_id'];
        // }
    }

    public function getGroups($idDocente,$idMateria){
        $grupos= DocenteMateriaGrupo::select('group_id')->where('teacher_id',$idDocente)->where('subject_id',$idMateria)->get();
        $data = json_decode($grupos, true);
        // Inicializar un array para almacenar los subject_id
        $subject_ids = array();
        // Iterar sobre los datos y guardar los subject_id en el array
        foreach ($data as $item) {
            $subject_ids[] = $item['group_id'];
        }    
        $nombresM= Group::select('name')->whereIn('id',$subject_ids)->get();
        return $nombresM;
    }
}
