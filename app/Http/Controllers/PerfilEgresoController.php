<?php

namespace App\Http\Controllers;

use App\PerfilEgreso;
use App\Syllabus;
use App\Unidad;
use Illuminate\Http\Request;

class PerfilEgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($syllabus_id)
    {
        try {
            $syllabus = Syllabus::find($syllabus_id);
            return view('UsersViews.docente.perfil_egreso.index', compact('syllabus'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
        $unidad = Unidad::find($request->input('unidad'));
        $syllabus = Syllabus::find($unidad->syllabus_id);
        if($unidad != null){
            if (PerfilEgreso::where('unidad_id', $unidad->id)->first() == null) {
                $perfil_egreso = new PerfilEgreso;
                $perfil_egreso->unidad_id = $request->input('unidad');
                $perfil_egreso->contribucion = $request->input('contribucion');
                $perfil_egreso->evidencias = $request->input('evidencias');
                $perfil_egreso->save();
                return redirect()->route('perfilUnidad', $syllabus->id);
            }
        }
        return redirect()->route('syllabus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerfilEgreso  $perfilEgreso
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerfilEgreso  $perfilEgreso
     * @return \Illuminate\Http\Response
     */
    public function edit($perfil_id)
    {
        $perfil = PerfilEgreso::find($perfil_id);
        $unidadSola = Unidad::find($perfil->unidad_id);
        $syllabus = Syllabus::find($unidadSola->syllabus_id);
        return view('UsersViews.docente.perfil_egreso.edit', compact('perfil','unidadSola', 'syllabus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilEgreso  $perfilEgreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $perfil_id)
    {
        $perfil = PerfilEgreso::find($perfil_id);
        $unidad = Unidad::find($perfil->unidad_id);
        if ($perfil != null) {
            $perfil->contribucion = $request->input('contribucion');
            $perfil->evidencias = $request->input('evidencias');
            $perfil->save();
        }
        return redirect()->route('perfilUnidad', $unidad->syllabus_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerfilEgreso  $perfilEgreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilEgreso $perfilEgreso)
    {
        //
    }
}
