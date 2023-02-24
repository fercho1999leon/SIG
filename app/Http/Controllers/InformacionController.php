<?php

namespace App\Http\Controllers;

use App\Informacion;
use App\Syllabus;
use App\TituloGrado;
use App\User;
use Illuminate\Http\Request;

class InformacionController extends Controller
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
            return view('UsersViews.docente.informacion_general.index', compact('syllabus'));
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
    public function store($syllabus_id, Request $request)
    {
        $syllabus = Syllabus::find($syllabus_id);

        if ($syllabus != null) {
            if (Informacion::where('syllabus_id', $syllabus->id)->first() == null) {
                $informacion_general = new Informacion;

                $informacion_general->syllabus_id = $syllabus->id;
                $informacion_general->codigo_asignatura = $request->input('codigo');
                $informacion_general->creditos = $request->input('creditos');
                $informacion_general->tipo_asignatura = $request->input('tipo_asignatura');
                $informacion_general->unidad_curricular = $request->input('curricular');
                $informacion_general->horas_semanales = $request->input('horas_semanal');
                $informacion_general->horas_clase = $request->input('horas_clase');
                $informacion_general->horas_tutoria = $request->input('horas_tutoria');
                $informacion_general->teoricas = $request->input('teoricas');
                $informacion_general->practicas = $request->input('practicas');
                $informacion_general->autonomas = $request->input('autonomas');
                $informacion_general->presenciales = $request->input('presenciales');
                $informacion_general->virtuales = $request->input('virtuales');
                $informacion_general->save();

                return redirect()->route('prerequisitosSyllabus', $syllabus->id);
            }
        }
        return redirect()->route('syllabus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function show($syllabus_id)
    {
        $syllabus = Syllabus::find($syllabus_id);
        return view('UsersViews.docente.informacion_general.edit', compact('syllabus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Informacion $informacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $informacion_id)
    {
        $informacion_general = Informacion::find($informacion_id);
        if ($informacion_general != null) {
            $informacion_general->codigo_asignatura = $request->input('codigo');
            $informacion_general->creditos = $request->input('creditos');
            $informacion_general->tipo_asignatura = $request->input('tipo_asignatura');
            $informacion_general->unidad_curricular = $request->input('curricular');
            $informacion_general->horas_semanales = $request->input('horas_semanal');
            $informacion_general->horas_clase = $request->input('horas_clase');
            $informacion_general->horas_tutoria = $request->input('horas_tutoria');
            $informacion_general->teoricas = $request->input('teoricas');
            $informacion_general->practicas = $request->input('practicas');
            $informacion_general->autonomas = $request->input('autonomas');
            $informacion_general->presenciales = $request->input('presenciales');
            $informacion_general->virtuales = $request->input('virtuales');
            $informacion_general->save();
        }
        return redirect()->route('modificarSyllabus', $informacion_general->syllabus_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informacion $informacion)
    {
        //
    }

    public function saveTituloGrado($user_id, Request $request)
    {
        try {
            $docente = User::find($user_id);
            $tituloGrado = new TituloGrado;
            $tituloGrado->nombre = $request->input('titulo');
            $tituloGrado->codigo_senescyt = $request->input('codigo');
            $tituloGrado->universidad = $request->input('universidad');
            $tituloGrado->pais = $request->input('pais');
            $tituloGrado->ano = $request->input('ano');
            $tituloGrado->usuario_id = $docente->id;
            $tituloGrado->save();

            return view('UsersViews.docente.informacion.index', compact('docente', 'tituloGrado'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
