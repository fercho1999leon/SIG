<?php

namespace App\Http\Controllers\Admin;

use App\Articulo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArticuloRequest;
use App\Http\Requests\StoreArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticuloController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('articulo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articulos = Articulo::all();

        return view('admin.articulos.index', compact('articulos'));
    }

    public function create()
    {
        //abort_if(Gate::denies('articulo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articulos.create');
    }

    public function store(StoreArticuloRequest $request)
    {
        $articulo = Articulo::create($request->all());

        return redirect()->route('admin.articulos.index');
    }

    public function edit(Articulo $articulo)
    {
        //abort_if(Gate::denies('articulo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articulos.edit', compact('articulo'));
    }

    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {
        $articulo->update($request->all());

        return redirect()->route('admin.articulos.index');
    }

    public function show(Articulo $articulo)
    {
        //abort_if(Gate::denies('articulo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.articulos.show', compact('articulo'));
    }

    public function destroy(Articulo $articulo)
    {
        //abort_if(Gate::denies('articulo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $articulo->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticuloRequest $request)
    {
        Articulo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}