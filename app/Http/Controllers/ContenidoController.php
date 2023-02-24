<?php

namespace App\Http\Controllers;

use App\Contenido;
use App\Unidad;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($unidad_id)
    {
        try {
            $unidad = Unidad::find($unidad_id);
            return view('UsersViews.docente.contenidos.index', compact('unidad'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function indexDos($unidad_id)
    {
        try {
            $unidad = Unidad::find($unidad_id);
            return view('UsersViews.docente.contenidos.show', compact('unidad'));
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
    public function store($unidad_id, Request $request)
    {
        $unidad = Unidad::find($unidad_id);
        if ($unidad != null) {
            $contenido = new Contenido;
            $contenido->unidad_id = $unidad->id;
            $contenido->titulo = $request->input('nombreContenido');
            $contenido->horas_clase = $request->input('horas_clase');
            $contenido->horas_practicas = $request->input('practicas');
            $contenido->horas_autonomas = $request->input('autonomas');
            $contenido->actividades = $request->input('actividades');
            $contenido->evaluacion = $request->input('mecanismo');
            $contenido->save();
        }
        return redirect()->route('contenidoUnidad', $unidad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function show(Contenido $contenido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function edit($contenido_id)
    {
        $contenido = Contenido::find($contenido_id);
        return view('UsersViews.docente.contenidos.edit', compact('contenido'));

    }

    public function editDos($contenido_id)
    {
        $contenido = Contenido::find($contenido_id);
        return view('UsersViews.docente.contenidos.update', compact('contenido'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contenido_id)
    {
        $contenido = Contenido::find($contenido_id);
        if ($contenido != null) {
            $contenido->titulo = $request->input('nombreContenido');
            $contenido->horas_clase = $request->input('horas_clase');
            $contenido->horas_practicas = $request->input('practicas');
            $contenido->horas_autonomas = $request->input('autonomas');
            $contenido->actividades = $request->input('actividades');
            $contenido->evaluacion = $request->input('mecanismo');
            $contenido->save();
        }
        return redirect()->route('contenidoUnidad', $contenido->unidad_id);
    }

    public function updateDos(Request $request, $contenido_id)
    {
        $contenido = Contenido::find($contenido_id);
        if ($contenido != null) {
            $contenido->titulo = $request->input('nombreContenido');
            $contenido->horas_clase = $request->input('horas_clase');
            $contenido->horas_practicas = $request->input('practicas');
            $contenido->horas_autonomas = $request->input('autonomas');
            $contenido->actividades = $request->input('actividades');
            $contenido->evaluacion = $request->input('mecanismo');
            $contenido->save();
        }
        return redirect()->route('modificarContenidoUnidad', $contenido->unidad_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function destroy($unidad_id, $contenido_id)
    {
        if ($unidad_id != null) {
            $contenido = Contenido::where('id', $contenido_id)->where('unidad_id', $unidad_id);
            $contenido->delete();
        }
        return redirect()->route('crearContenido', $unidad_id);

    }

    public static function getContenidosByUnidad($unidad_id)
    {
        return Contenido::getContenidosByUnidad($unidad_id);
    }
}
