<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'ci' => 'required',
            'nombres' => 'required',
			'apellidos' => 'required',
            'correo' => 'nullable|email|unique:users,email',
            
        ];
    }
    public function messages()
    {
        return [
            'correo.unique' => 'Este correo ya a sido registrado.'
        ];
    }
}
