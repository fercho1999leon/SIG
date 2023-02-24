<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTituloPosgradoRequest;
use App\Http\Requests\StoreTituloPosgradoRequest;
use App\Http\Requests\UpdateTituloPosgradoRequest;
use App\TituloPosgrado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TituloPosgradoController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('titulo_posgrado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tituloPosgrados = TituloPosgrado::all();

        return view('admin.tituloPosgrados.index', compact('tituloPosgrados'));
    }

    public function create()
    {
        //abort_if(Gate::denies('titulo_posgrado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tituloPosgrados.create');
    }

    public function store(StoreTituloPosgradoRequest $request)
    {
        $tituloPosgrado = TituloPosgrado::create($request->all());

        return redirect()->route('admin.titulo-posgrados.index');
    }

    public function edit(TituloPosgrado $tituloPosgrado)
    {
        //abort_if(Gate::denies('titulo_posgrado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tituloPosgrados.edit', compact('tituloPosgrado'));
    }

    public function update(UpdateTituloPosgradoRequest $request, TituloPosgrado $tituloPosgrado)
    {
        $tituloPosgrado->update($request->all());

        return redirect()->route('admin.titulo-posgrados.index');
    }

    public function show(TituloPosgrado $tituloPosgrado)
    {
        //abort_if(Gate::denies('titulo_posgrado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tituloPosgrados.show', compact('tituloPosgrado'));
    }

    public function destroy(TituloPosgrado $tituloPosgrado)
    {
        //abort_if(Gate::denies('titulo_posgrado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tituloPosgrado->delete();

        return back();
    }

    public function massDestroy(MassDestroyTituloPosgradoRequest $request)
    {
        TituloPosgrado::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}