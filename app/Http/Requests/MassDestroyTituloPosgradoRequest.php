<?php

namespace App\Http\Requests;

use App\TituloPosgrado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTituloPosgradoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('titulo_posgrado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:titulo_posgrados,id',
        ];
    }
}
