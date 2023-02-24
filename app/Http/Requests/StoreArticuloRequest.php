<?php

namespace App\Http\Requests;

use App\Articulo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArticuloRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('articulo_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
            'nombre_revista' => [
                'string',
                'nullable',
            ],
            'codigo_issn' => [
                'string',
                'nullable',
            ],
            'volumen' => [
                'string',
                'nullable',
            ],
            'fecha_publicacion' => [
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
