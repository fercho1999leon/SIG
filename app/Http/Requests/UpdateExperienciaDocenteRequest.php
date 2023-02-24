<?php

namespace App\Http\Requests;

use App\ExperienciaDocente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienciaDocenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experiencia_docente_edit');
    }

    public function rules()
    {
        return [
            'curso_materia_modulo' => [
                'string',
                'nullable',
            ],
            'institucion' => [
                'string',
                'nullable',
            ],
            'desde' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'hasta' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'usuario' => [
                'string',
                'nullable',
            ],
        ];
    }
}
