<?php

namespace App\Http\Controllers\Admin;

use App\ExperienciaVinculacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExperienciaVinculacionRequest;
use App\Http\Requests\StoreExperienciaVinculacionRequest;
use App\Http\Requests\UpdateExperienciaVinculacionRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienciaVinculacionController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('experiencia_vinculacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaVinculacions = ExperienciaVinculacion::all();

        return view('admin.experienciaVinculacions.index', compact('experienciaVinculacions'));
    }

    public function create()
    {
        //abort_if(Gate::denies('experiencia_vinculacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaVinculacions.create');
    }

    public function store(StoreExperienciaVinculacionRequest $request)
    {
        $experienciaVinculacion = ExperienciaVinculacion::create($request->all());

        return redirect()->route('admin.experiencia-vinculacions.index');
    }

    public function edit(ExperienciaVinculacion $experienciaVinculacion)
    {
        //abort_if(Gate::denies('experiencia_vinculacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaVinculacions.edit', compact('experienciaVinculacion'));
    }

    public function update(UpdateExperienciaVinculacionRequest $request, ExperienciaVinculacion $experienciaVinculacion)
    {
        $experienciaVinculacion->update($request->all());

        return redirect()->route('admin.experiencia-vinculacions.index');
    }

    public function show(ExperienciaVinculacion $experienciaVinculacion)
    {
        //abort_if(Gate::denies('experiencia_vinculacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaVinculacions.show', compact('experienciaVinculacion'));
    }

    public function destroy(ExperienciaVinculacion $experienciaVinculacion)
    {
        //abort_if(Gate::denies('experiencia_vinculacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaVinculacion->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienciaVinculacionRequest $request)
    {
        ExperienciaVinculacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}