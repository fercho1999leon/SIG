<?php

namespace App\Http\Requests\estudiantes;

use Illuminate\Foundation\Http\FormRequest;

class TareasRequest extends FormRequest
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

    public function rules()
    {
		if ($this->isMethod('post')) {
			return [
				'tareas_adjuntos.*' => 'mimes:rtf,jpg,jpeg,png,gif,doc,docx,dot,xls,xlsx,xlsm,ppt,pptx,pps,pot,pdf,rar,zip|max:5000',
			];
		}
	}
	
	public function messages()
	{
		return [
			'tareas_adjuntos.*.mimes' => 'Solo se permite los siguientes formatos .jpg .jpeg .png .gif .doc .docx .dot .xls .xlsx .xlsm .ppt .pptx .pps .pot .pdf .rar .zip',
			'tareas_adjuntos.*.max' => 'Solo se permiten archivos hasta 5MB'
		];
	}
}
