<?php

namespace App\Http\Requests;

use App\Evento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evento_create');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'lugar' => [
                'string',
                'nullable',
            ],
            'fecha_publicacion' => [
                'string',
                'nullable',
            ],
            'url' => [
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
