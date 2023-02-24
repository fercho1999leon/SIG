<?php

namespace App\Http\Requests;

use App\ExperienciaProfesional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienciaProfesionalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experiencia_profesional_edit');
    }

    public function rules()
    {
        return [
            'empresa_institucion' => [
                'string',
                'nullable',
            ],
            'cargo' => [
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
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
