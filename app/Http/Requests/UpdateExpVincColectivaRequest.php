<?php

namespace App\Http\Requests;

use App\ExpVincColectiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExpVincColectivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('exp_vinc_colectiva_edit');
    }

    public function rules()
    {
        return [
            'tipo_experiencia' => [
                'string',
                'nullable',
            ],
            'programa_proyecto' => [
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
