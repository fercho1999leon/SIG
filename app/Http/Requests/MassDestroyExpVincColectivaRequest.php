<?php

namespace App\Http\Requests;

use App\ExpVincColectiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExpVincColectivaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exp_vinc_colectiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:exp_vinc_colectivas,id',
        ];
    }
}
