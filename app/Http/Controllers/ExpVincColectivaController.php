<?php

namespace App\Http\Controllers\Admin;

use App\ExpVincColectiva;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpVincColectivaRequest;
use App\Http\Requests\StoreExpVincColectivaRequest;
use App\Http\Requests\UpdateExpVincColectivaRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpVincColectivaController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('exp_vinc_colectiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expVincColectivas = ExpVincColectiva::all();

        return view('admin.expVincColectivas.index', compact('expVincColectivas'));
    }

    public function create()
    {
        //abort_if(Gate::denies('exp_vinc_colectiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expVincColectivas.create');
    }

    public function store(StoreExpVincColectivaRequest $request)
    {
        $expVincColectiva = ExpVincColectiva::create($request->all());

        return redirect()->route('admin.exp-vinc-colectivas.index');
    }

    public function edit(ExpVincColectiva $expVincColectiva)
    {
        //abort_if(Gate::denies('exp_vinc_colectiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expVincColectivas.edit', compact('expVincColectiva'));
    }

    public function update(UpdateExpVincColectivaRequest $request, ExpVincColectiva $expVincColectiva)
    {
        $expVincColectiva->update($request->all());

        return redirect()->route('admin.exp-vinc-colectivas.index');
    }

    public function show(ExpVincColectiva $expVincColectiva)
    {
        //abort_if(Gate::denies('exp_vinc_colectiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expVincColectivas.show', compact('expVincColectiva'));
    }

    public function destroy(ExpVincColectiva $expVincColectiva)
    {
        //abort_if(Gate::denies('exp_vinc_colectiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expVincColectiva->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpVincColectivaRequest $request)
    {
        ExpVincColectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}