<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CronogramaRequest extends FormRequest
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
            'archivoCronograma' => 'required|mimes:pdf',
			'parcial' => 'required',
			'rol' => 'required'
        ];
	}
	
	public function messages()
	{
		return  [
			'archivoCronograma.mimes' => 'Solo se permite archivos en terminación .pdf'
		];
	}
}
