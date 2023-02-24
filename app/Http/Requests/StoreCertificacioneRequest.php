<?php

namespace App\Http\Requests;

use App\Certificacione;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCertificacioneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('certificacione_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'registro_setec' => [
                'string',
                'nullable',
            ],
            'institucion_certificadora' => [
                'string',
                'nullable',
            ],
            'pais' => [
                'string',
                'nullable',
            ],
            'ano' => [
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
