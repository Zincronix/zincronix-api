<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [           
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers',
            'subjects' => 'required|array',
            'subjects.*.subject_id' => 'required|integer',
            'subjects.*.groups' => 'required|array',
            'subjects.*.groups.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del profesor es obligatorio.',
            'email.required' => 'El correo electrónico del profesor es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'Ya existe un profesor con este correo electrónico.',
            'subjects.required' => 'Se requiere al menos una materia para el profesor.',
            'subjects.array' => 'El formato de las materias no es válido.',
            'subjects.*.subject_id.required' => 'El ID de la materia es obligatorio.',
            'subjects.*.subject_id.integer' => 'El ID de la materia debe ser un número entero.',
            'subjects.*.groups.required' => 'Se requiere al menos un grupo para la materia.',
            'subjects.*.groups.array' => 'El formato de los grupos no es válido.',
            'subjects.*.groups.*.integer' => 'El ID del grupo debe ser un número entero.'
        ];
    }
}
