<?php

namespace App\Http\Requests;

use App\ExperienciaCapacitador;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExperienciaCapacitadorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('experiencia_capacitador_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:experiencia_capacitadors,id',
        ];
    }
}
