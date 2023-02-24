<?php

namespace App\Http\Controllers;

use App\Syllabus;
use App\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
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
            return view('UsersViews.docente.unidades.index', compact('syllabus'));
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function indexDos($syllabus_id)
    {
        try {
            $syllabus = Syllabus::find($syllabus_id);
            return view('UsersViews.docente.unidades.show', compact('syllabus'));
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
    public static function store($syllabus_id, Request $request)
    {
        $syllabus = Syllabus::find($syllabus_id);
        if ($syllabus != null) {
            $unidad = new Unidad;
            $unidad->syllabus_id = $syllabus->id;
            $unidad->nombre_unidad = $request->input('nombreUnidad');
            $unidad->objetivo = $request->input('objetivoUnidad');
            $unidad->aprendizaje = $request->input('resultados');
            $unidad->metodologia = $request->input('metodologia');
            $unidad->recursos = $request->input('recursos');
            $unidad->save();
        }
        return redirect()->route('unidadSyllabus', $syllabus_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad $unidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function edit($unidad_id)
    {
        $unidad = Unidad::find($unidad_id);
        return view('UsersViews.docente.unidades.edit', compact('unidad'));
    }

    public function editDos($unidad_id)
    {
        $unidad = Unidad::find($unidad_id);
        return view('UsersViews.docente.unidades.update', compact('unidad'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $unidad_id)
    {
        $unidad = Unidad::find($unidad_id);
        if ($unidad != null) {
            $unidad->nombre_unidad = $request->input('nombreUnidad');
            $unidad->objetivo = $request->input('objetivoUnidad');
            $unidad->aprendizaje = $request->input('resultados');
            $unidad->metodologia = $request->input('metodologia');
            $unidad->recursos = $request->input('recursos');
            $unidad->save();
        }
        return redirect()->route('unidadSyllabus', $unidad->syllabus_id);
    }

    public function updateDos(Request $request, $unidad_id)
    {
        $unidad = Unidad::find($unidad_id);
        if ($unidad != null) {
            $unidad->nombre_unidad = $request->input('nombreUnidad');
            $unidad->objetivo = $request->input('objetivoUnidad');
            $unidad->aprendizaje = $request->input('resultados');
            $unidad->metodologia = $request->input('metodologia');
            $unidad->recursos = $request->input('recursos');
            $unidad->save();
        }
        return redirect()->route('modificarUnidadSyllabus', $unidad->syllabus_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidad $unidad)
    {
        //
    }

    public static function getUnidadesBySyllabus($syllabus_id)
    {
        return Unidad::getUnidadesBySyllabus($syllabus_id);
    }

    public static function getUnidadById($id)
    {
        return Unidad::getUnidadById($id);
    }
}
