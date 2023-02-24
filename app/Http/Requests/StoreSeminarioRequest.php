<?php

namespace App\Http\Requests;

use App\Seminario;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSeminarioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seminario_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'institucion' => [
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
            'numero_horas' => [
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
