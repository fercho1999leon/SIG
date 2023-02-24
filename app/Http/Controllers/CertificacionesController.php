<?php

namespace App\Http\Controllers;

use App\Certificacione;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCertificacioneRequest;
use App\Http\Requests\StoreCertificacioneRequest;
use App\Http\Requests\UpdateCertificacioneRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificacionesController extends Controller
{
    public function index()
    {
        ////abort_if(Gate::denies('certificacione_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificaciones = Certificacione::all();

        return view('UsersViews.docente.certificaciones.index', compact('certificaciones'));
    }

    public function create()
    {
        ////abort_if(Gate::denies('certificacione_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.certificaciones.create');
    }

    public function store(StoreCertificacioneRequest $request)
    {
        $certificacione = Certificacione::create($request->all());

        return redirect()->route('UsersViews.docente.certificaciones.index');
    }

    public function edit(Certificacione $certificacione)
    {
        ////abort_if(Gate::denies('certificacione_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.certificaciones.edit', compact('certificacione'));
    }

    public function update(UpdateCertificacioneRequest $request, Certificacione $certificacione)
    {
        $certificacione->update($request->all());

        return redirect()->route('UsersViews.docente.certificaciones.index');
    }

    public function show(Certificacione $certificacione)
    {
        ////abort_if(Gate::denies('certificacione_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('UsersViews.docente.certificaciones.show', compact('certificacione'));
    }

    public function destroy(Certificacione $certificacione)
    {
        ////abort_if(Gate::denies('certificacione_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificacione->delete();

        return back();
    }

    public function massDestroy(MassDestroyCertificacioneRequest $request)
    {
        Certificacione::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}