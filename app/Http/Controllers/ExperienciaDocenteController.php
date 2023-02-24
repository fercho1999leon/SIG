<?php

namespace App\Http\Controllers\Admin;

use App\ExperienciaDocente;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExperienciaDocenteRequest;
use App\Http\Requests\StoreExperienciaDocenteRequest;
use App\Http\Requests\UpdateExperienciaDocenteRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienciaDocenteController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('experiencia_docente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaDocentes = ExperienciaDocente::all();

        return view('admin.experienciaDocentes.index', compact('experienciaDocentes'));
    }

    public function create()
    {
        //abort_if(Gate::denies('experiencia_docente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaDocentes.create');
    }

    public function store(StoreExperienciaDocenteRequest $request)
    {
        $experienciaDocente = ExperienciaDocente::create($request->all());

        return redirect()->route('admin.experiencia-docentes.index');
    }

    public function edit(ExperienciaDocente $experienciaDocente)
    {
        //abort_if(Gate::denies('experiencia_docente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaDocentes.edit', compact('experienciaDocente'));
    }

    public function update(UpdateExperienciaDocenteRequest $request, ExperienciaDocente $experienciaDocente)
    {
        $experienciaDocente->update($request->all());

        return redirect()->route('admin.experiencia-docentes.index');
    }

    public function show(ExperienciaDocente $experienciaDocente)
    {
        //abort_if(Gate::denies('experiencia_docente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.experienciaDocentes.show', compact('experienciaDocente'));
    }

    public function destroy(ExperienciaDocente $experienciaDocente)
    {
        //abort_if(Gate::denies('experiencia_docente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienciaDocente->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienciaDocenteRequest $request)
    {
        ExperienciaDocente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
