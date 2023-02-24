<?php

namespace App\Http\Controllers\Admin;

use App\ExperienciaCapacitador;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExperienciaCapacitadorRequest;
use App\Http\Requests\StoreExperienciaCapacitadorRequest;
use App\Http\Requests\UpdateExperienciaCapacitadorRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienciaCapacitadorController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('experiencia_capacitador_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaCapacitadors = ExperienciaCapacitador::all();

        return view('admin.experienciaCapacitadors.index', compact('experienciaCapacitadors'));
    }

    public function create()
    {
        //abort_if(Gate::denies('experiencia_capacitador_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaCapacitadors.create');
    }

    public function store(StoreExperienciaCapacitadorRequest $request)
    {
        $experienciaCapacitador = ExperienciaCapacitador::create($request->all());

        return redirect()->route('admin.experiencia-capacitadors.index');
    }

    public function edit(ExperienciaCapacitador $experienciaCapacitador)
    {
        //abort_if(Gate::denies('experiencia_capacitador_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaCapacitadors.edit', compact('experienciaCapacitador'));
    }

    public function update(UpdateExperienciaCapacitadorRequest $request, ExperienciaCapacitador $experienciaCapacitador)
    {
        $experienciaCapacitador->update($request->all());

        return redirect()->route('admin.experiencia-capacitadors.index');
    }

    public function show(ExperienciaCapacitador $experienciaCapacitador)
    {
        //abort_if(Gate::denies('experiencia_capacitador_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaCapacitadors.show', compact('experienciaCapacitador'));
    }

    public function destroy(ExperienciaCapacitador $experienciaCapacitador)
    {
        //abort_if(Gate::denies('experiencia_capacitador_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaCapacitador->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienciaCapacitadorRequest $request)
    {
        ExperienciaCapacitador::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}