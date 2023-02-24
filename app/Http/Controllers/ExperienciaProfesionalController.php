<?php

namespace App\Http\Controllers\Admin;

use App\ExperienciaProfesional;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExperienciaProfesionalRequest;
use App\Http\Requests\StoreExperienciaProfesionalRequest;
use App\Http\Requests\UpdateExperienciaProfesionalRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienciaProfesionalController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('experiencia_profesional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaProfesionals = ExperienciaProfesional::all();

        return view('admin.experienciaProfesionals.index', compact('experienciaProfesionals'));
    }

    public function create()
    {
        //abort_if(Gate::denies('experiencia_profesional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaProfesionals.create');
    }

    public function store(StoreExperienciaProfesionalRequest $request)
    {
        $experienciaProfesional = ExperienciaProfesional::create($request->all());

        return redirect()->route('admin.experiencia-profesionals.index');
    }

    public function edit(ExperienciaProfesional $experienciaProfesional)
    {
        //abort_if(Gate::denies('experiencia_profesional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaProfesionals.edit', compact('experienciaProfesional'));
    }

    public function update(UpdateExperienciaProfesionalRequest $request, ExperienciaProfesional $experienciaProfesional)
    {
        $experienciaProfesional->update($request->all());

        return redirect()->route('admin.experiencia-profesionals.index');
    }

    public function show(ExperienciaProfesional $experienciaProfesional)
    {
        //abort_if(Gate::denies('experiencia_profesional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaProfesionals.show', compact('experienciaProfesional'));
    }

    public function destroy(ExperienciaProfesional $experienciaProfesional)
    {
        //abort_if(Gate::denies('experiencia_profesional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaProfesional->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienciaProfesionalRequest $request)
    {
        ExperienciaProfesional::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}