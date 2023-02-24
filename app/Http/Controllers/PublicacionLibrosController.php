<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPublicacionLibroRequest;
use App\Http\Requests\StorePublicacionLibroRequest;
use App\Http\Requests\UpdatePublicacionLibroRequest;
use App\PublicacionLibro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicacionLibrosController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('publicacion_libro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicacionLibros = PublicacionLibro::all();

        return view('admin.publicacionLibros.index', compact('publicacionLibros'));
    }

    public function create()
    {
        //abort_if(Gate::denies('publicacion_libro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicacionLibros.create');
    }

    public function store(StorePublicacionLibroRequest $request)
    {
        $publicacionLibro = PublicacionLibro::create($request->all());

        return redirect()->route('admin.publicacion-libros.index');
    }

    public function edit(PublicacionLibro $publicacionLibro)
    {
        //abort_if(Gate::denies('publicacion_libro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicacionLibros.edit', compact('publicacionLibro'));
    }

    public function update(UpdatePublicacionLibroRequest $request, PublicacionLibro $publicacionLibro)
    {
        $publicacionLibro->update($request->all());

        return redirect()->route('admin.publicacion-libros.index');
    }

    public function show(PublicacionLibro $publicacionLibro)
    {
        //abort_if(Gate::denies('publicacion_libro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicacionLibros.show', compact('publicacionLibro'));
    }

    public function destroy(PublicacionLibro $publicacionLibro)
    {
        //abort_if(Gate::denies('publicacion_libro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicacionLibro->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublicacionLibroRequest $request)
    {
        PublicacionLibro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}