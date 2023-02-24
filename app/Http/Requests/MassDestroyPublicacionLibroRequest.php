<?php

namespace App\Http\Requests;

use App\PublicacionLibro;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPublicacionLibroRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('publicacion_libro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:publicacion_libros,id',
        ];
    }
}
