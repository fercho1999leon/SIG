<?php

namespace App\Http\Requests;

use App\PublicacionLibro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePublicacionLibroRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('publicacion_libro_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
            'filiacion' => [
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
