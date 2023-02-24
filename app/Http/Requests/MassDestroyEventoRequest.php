<?php

namespace App\Http\Requests;

use App\Evento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEventoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('evento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:eventos,id',
        ];
    }
}
