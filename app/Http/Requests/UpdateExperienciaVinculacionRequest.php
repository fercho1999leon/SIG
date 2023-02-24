<?php

namespace App\Http\Requests;

use App\ExperienciaVinculacion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExperienciaVinculacionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('experiencia_vinculacion_edit');
    }

    public function rules()
    {
        return [
            'tipo_experiencia' => [
                'string',
                'nullable',
            ],
            'programa' => [
                'string',
                'nullable',
            ],
            'duracion' => [
                'string',
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
