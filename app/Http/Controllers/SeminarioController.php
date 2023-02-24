<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySeminarioRequest;
use App\Http\Requests\StoreSeminarioRequest;
use App\Http\Requests\UpdateSeminarioRequest;
use App\Seminario;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeminarioController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('seminario_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminarios = Seminario::all();

        return view('admin.seminarios.index', compact('seminarios'));
    }

    public function create()
    {
        //abort_if(Gate::denies('seminario_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminarios.create');
    }

    public function store(StoreSeminarioRequest $request)
    {
        $seminario = Seminario::create($request->all());

        return redirect()->route('admin.seminarios.index');
    }

    public function edit(Seminario $seminario)
    {
        //abort_if(Gate::denies('seminario_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminarios.edit', compact('seminario'));
    }

    public function update(UpdateSeminarioRequest $request, Seminario $seminario)
    {
        $seminario->update($request->all());

        return redirect()->route('admin.seminarios.index');
    }

    public function show(Seminario $seminario)
    {
        //abort_if(Gate::denies('seminario_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seminarios.show', compact('seminario'));
    }

    public function destroy(Seminario $seminario)
    {
        //abort_if(Gate::denies('seminario_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminario->delete();

        return back();
    }

    public function massDestroy(MassDestroySeminarioRequest $request)
    {
        Seminario::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}