<?php

namespace App\Http\Requests;

use App\ExperienciaCapacitador;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienciaCapacitadorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experiencia_capacitador_edit');
    }

    public function rules()
    {
        return [
            'curso_seminario' => [
                'string',
                'nullable',
            ],
            'entidades' => [
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
