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
            'period_id' => 'required|array',
            'period_id.*' => 'required|integer|exists:periods,id', 
            
            'reason_reservation' => 'required|string|max:255',

            'date_reservation' => 'required|date|after_or_equal:today',

            'classrooms' => 'required|array',
            'classrooms.*' => 'required|integer|exists:classrooms,id', 

            'teachers' => 'required|array',
            'teachers.*.teacher_id' => 'required|integer|exists:teachers,id', 
            'teachers.*.subjects' => 'required|array',
            'teachers.*.subjects.*' => 'required|integer|exists:subjects,id', 
            'teachers.*.groups' => 'required|array',
            'teachers.*.groups.*' => 'required|array',
            'teachers.*.groups.*.*' => 'required|integer|exists:groups,id', 
        ];
    }

    public function messages()
    {
        return [
            'period_id.*.required' => 'El periodo es obligatorio.',
            'period_id.*.integer' => 'El periodo debe ser un número entero.',
            'period_id.*.exists' => 'El periodo seleccionado no es válido.',

            'reason_reservation.required' => 'El motivo de la reserva es obligatorio.',
            'reason_reservation.string' => 'El motivo de la reserva debe ser una cadena de texto.',
            'reason_reservation.max' => 'El motivo de la reserva no debe exceder los :max caracteres.',

            'date_reservation.required' => 'La fecha de reserva es obligatoria.',
            'date_reservation.date' => 'La fecha de reserva debe ser una fecha válida.',
            'date_reservation.after_or_equal' => 'La fecha de reserva debe ser igual o posterior a hoy.',

            'classrooms.*.required' => 'El aula es obligatoria.',
            'classrooms.*.integer' => 'El aula debe ser un número entero.',
            'classrooms.*.exists' => 'El aula seleccionada no es válida.',

            'teachers.*.teacher_id.required' => 'El ID del profesor es obligatorio.',
            'teachers.*.teacher_id.integer' => 'El ID del profesor debe ser un número entero.',
            'teachers.*.teacher_id.exists' => 'El ID del profesor seleccionado no es válido.',

            'teachers.*.subjects.*.required' => 'La materia es obligatoria.',
            'teachers.*.subjects.*.integer' => 'La materia debe ser un número entero.',
            'teachers.*.subjects.*.exists' => 'La materia seleccionada no es válida.',

            'teachers.*.groups.*.*.required' => 'El grupo es obligatorio.',
            'teachers.*.groups.*.*.integer' => 'El grupo debe ser un número entero.',
            'teachers.*.groups.*.*.exists' => 'El grupo seleccionado no es válido.',
        ];
    }
}
