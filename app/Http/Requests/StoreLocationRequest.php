<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'description' => 'required|max:255',
            'building_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'La descripción es requerida',
            'description.max' => 'La descripción no puede tener más de 255 caracteres',
            'building_id.required' => 'El ID del edificio es requerido',
            'building_id.integer' => 'El ID del edificio debe ser un número entero',
        ];
    }
}
