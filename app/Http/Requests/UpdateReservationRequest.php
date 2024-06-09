<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'status_reservation_id' => 'required|integer|between:1,3',
            'motivo'=>'nullable'
        ];
    }

    public function messages()
{
    return [
        'status_reservation_id.required' => 'El campo status es obligatorio.',
        'status_reservation_id.integer' => 'El campo status debe ser un número entero.',
        'status_reservation_id.between' => 'El campo status debe estar entre 1 y 3.',
    ];
}
}
