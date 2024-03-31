<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
            'period_id' => 'required|integer',
            'reason_reservation' => 'required|string',
            'date_reservation' => 'required|date',
            'classrooms' => 'required|array',
            'classrooms.*' => 'required|integer',
            'teachers' => 'required|array',
            'teachers.*.teacher_id' => 'required|integer',
            'teachers.*.subjects' => 'required|array',
            'teachers.*.subjects.*.subject_id' => 'required|integer',
            'teachers.*.subjects.*.groups' => 'required|array',
            'teachers.*.subjects.*.groups.*' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'period_id.required' => 'El ID del período es obligatorio.',
            'period_id.integer' => 'El ID del período debe ser un número entero.',
            
            'reason_reservation.required' => 'La razón de la reserva es obligatoria.',
            'reason_reservation.string' => 'La razón de la reserva debe ser un texto.',
            
            'date_reservation.required' => 'La fecha de la reserva es obligatoria.',
            'date_reservation.date' => 'La fecha de la reserva debe ser una fecha válida.',
            
            'classrooms.required' => 'Se requiere al menos un aula para la reserva.',
            'classrooms.array' => 'Las aulas deben ser proporcionadas en formato de arreglo.',
            
            'classrooms.*.required' => 'Cada aula debe tener un ID asociado.',
            'classrooms.*.integer' => 'El ID de cada aula debe ser un número entero.',
            
            'teachers.required' => 'Se requiere al menos un profesor para la reserva.',
            'teachers.array' => 'Los profesores deben ser proporcionados en formato de arreglo.',
            
            'teachers.*.teacher_id.required' => 'Cada profesor debe tener un ID asociado.',
            'teachers.*.teacher_id.integer' => 'El ID de cada profesor debe ser un número entero.',
            
            'teachers.*.subjects.required' => 'Cada profesor debe tener al menos una materia asociada.',
            'teachers.*.subjects.array' => 'Las materias de cada profesor deben ser proporcionadas en formato de arreglo.',
            
            'teachers.*.subjects.*.subject_id.required' => 'Cada materia debe tener un ID asociado.',
            'teachers.*.subjects.*.subject_id.integer' => 'El ID de cada materia debe ser un número entero.',
            
            'teachers.*.subjects.*.groups.required' => 'Cada materia debe tener al menos un grupo asociado.',
            'teachers.*.subjects.*.groups.array' => 'Los grupos de cada materia deben ser proporcionados en formato de arreglo.',
            
            'teachers.*.subjects.*.groups.*.required' => 'Cada grupo debe tener un ID asociado.',
            'teachers.*.subjects.*.groups.*.integer' => 'El ID de cada grupo debe ser un número entero.',
        ];
    }
}
