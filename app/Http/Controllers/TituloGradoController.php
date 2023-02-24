<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTituloGradoRequest;
use App\Http\Requests\StoreTituloGradoRequest;
use App\Http\Requests\UpdateTituloGradoRequest;
use App\TituloGrado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TituloGradoController extends Controller
{
    public function index()
    {
        ////abort_if(Gate::denies('titulo_grado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tituloGrados = TituloGrado::all();

        return view('UsersViews.docente.tituloGrados.index', compact('tituloGrados'));
    }

    public function create()
    {
        //abort_if(Gate::denies('titulo_grado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.tituloGrados.create');
    }

    public function store(StoreTituloGradoRequest $request)
    {
        $tituloGrado = TituloGrado::create($request->all());

        return redirect()->route('UsersViews.docente.titulo-grados.index');
    }

    public function edit(TituloGrado $tituloGrado)
    {
        //abort_if(Gate::denies('titulo_grado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.tituloGrados.edit', compact('tituloGrado'));
    }

    public function update(UpdateTituloGradoRequest $request, TituloGrado $tituloGrado)
    {
        $tituloGrado->update($request->all());

        return redirect()->route('UsersViews.docente.titulo-grados.index');
    }

    public function show(TituloGrado $tituloGrado)
    {
        //abort_if(Gate::denies('titulo_grado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.tituloGrados.show', compact('tituloGrado'));
    }

    public function destroy(TituloGrado $tituloGrado)
    {
        //abort_if(Gate::denies('titulo_grado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tituloGrado->delete();

        return back();
    }

    public function massDestroy(MassDestroyTituloGradoRequest $request)
    {
        TituloGrado::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}