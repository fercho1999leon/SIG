<?php

namespace App\Http\Requests;

use App\TituloPosgrado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTituloPosgradoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('titulo_posgrado_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'codigo_senescyt' => [
                'string',
                'nullable',
            ],
            'universidad' => [
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
