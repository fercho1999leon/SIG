<?php

namespace App\Http\Controllers;

use App\estructuraCualitativa;
use App\rangosCualitativo;
use Illuminate\Http\Request;

class EstructuraCualitativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $estructuras = estructuraCualitativa::all()->sortBy('nombre');
       // dd($estructura);
        return view('layouts.modals.EstructuraCualitativa',compact('estructuras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|string|min:3|unique:estructura_cualitativas',
        ]);
        $estructuras = estructuraCualitativa::create($request->all());
         return '<div class="alert alert-success" role="alert">Estructura creada correctamente.</div>';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\estructuraCualitativa  $estructuraCualitativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($estructuraCualitativa);
        $estructura = estructuraCualitativa::findOrFail($id);
       return view('layouts.modals.EditarEstructura', compact('estructura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\estructuraCualitativa  $estructuraCualitativa
     * @return \Illuminate\Http\Response
     */
    public function edit(EstructuraCualitativa $estructuraCualitativa)
    {
        //
        return 'eliminando';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\estructuraCualitativa  $estructuraCualitativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estructura = estructuraCualitativa::findOrFail($id);
        $estructura->update($request->all());
        return '<div class="alert alert-success" role="alert">Estructura Actualizada con exito.</div>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\estructuraCualitativa  $estructuraCualitativa
     * @return \Illuminate\Http\Response
     */
    public function deteteEstructura(EstructuraCualitativa $estructuraCualitativa)
    {
        $estructuraCualitativa->delete();
        return '<div class="alert alert-success" role="alert">Estructura Eliminada con exito.</div>';
    }
    public function ver($id)
    {
       $estructuras = estructuraCualitativa::all()->sortBy('nombre');
       return view('layouts.modals.ShowEstructuras', compact('estructuras'));
    }
    public function verRangos($id)
    {
        $estructura = estructuraCualitativa::findOrFail($id);
        $rangos = rangosCualitativo::where('idEstructura',$id)->get();
       return view('layouts.modals.ShowRangosCualitativos', compact('estructura', 'rangos'));
    }
    public function actualizarR(Request $request)
    {
        if (isset($request->id)) {
             $this->validate($request,[
                'rangoI.*' => 'required|numeric',
                'rangof.*' => 'required|numeric',
                'nota.*' => 'required|string|min:1',
                ]);
            for ($i=0; $i < count($request->id) ; $i++) {
                $rango = rangosCualitativo::findOrFail($request->id[$i]);
                $rango->rangoI  = $request->rangoI[$i];
                $rango->rangoF  = $request->rangoF[$i];
                $rango->nota  = $request->nota[$i];
                $rango->descripcion  = $request->descripcion[$i] == null ? '-' : $request->descripcion[$i];
                $rango->save();
            }

        }
        if (!empty($request->rangoI_nuevo)) {
            $this->validate($request,[
                'rangoI_nuevo' => 'required|numeric',
                'rangoF_nuevo' => 'required|numeric',
                'nota_nuevo' => 'required|string|min:1',
                ]);
            $rango = new rangosCualitativo();
            $rango->rangoI  = $request->rangoI_nuevo;
            $rango->rangoF  = $request->rangoF_nuevo;
            $rango->nota  = $request->nota_nuevo;
            $rango->descripcion  = $request->descripcion_nuevo == null ? '-' : $request->descripcion_nuevo;
            $rango->idEstructura = $request->idEstructura;
            $rango->save();
        }
        return '<div class="alert alert-success" role="alert">Rangos Cualitativos Actualizados.</div>';
    }
    public function deleteRango($id)
    {
        $rango = rangosCualitativo::findOrFail($id);
        $rango->delete();
        return '<div class="alert alert-success" role="alert">Rangos Cualitativos Eliminado.</div>';
    }

}
