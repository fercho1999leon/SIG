<?php

namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaEscolarAdminRequest extends FormRequest
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
	public function rules() {
		return [
			'fecha' => 'required',
			'nombre' => 'required',
			'adjunto' => 'max:5000',
			'descripcion' => 'required'
		];
	}

	public function messages() {
		return [
			'adjunto.max' => 'El archivo no debe ser mayor a 5MB'
		];
	}
}
