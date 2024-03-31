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
        return false;
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
}
