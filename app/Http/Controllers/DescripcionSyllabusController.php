<?php

namespace App\Http\Controllers;

use App\DescripcionSyllabus;
use App\Syllabus;
use Illuminate\Http\Request;

class DescripcionSyllabusController extends Controller
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
            return view('UsersViews.docente.descripcion.index', compact('syllabus'));
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
            if (DescripcionSyllabus::where('syllabus_id', $syllabus->id)->first() == null) {
                $descripcion_syllabus = new DescripcionSyllabus;

                $descripcion_syllabus->syllabus_id = $syllabus->id;
                $descripcion_syllabus->descripcion = $request->input('descripcion_asignatura');
                $descripcion_syllabus->objetivo = $request->input('objetivo_asignatura');
                $descripcion_syllabus->resultados = $request->input('resultados_asignatura');
                $descripcion_syllabus->contribucion = $request->input('contribucion');
                $descripcion_syllabus->competencias = $request->input('competencias');
                $descripcion_syllabus->save();

                return redirect()->route('unidadSyllabus', $syllabus->id);
            }
        }
        return redirect()->route('syllabus');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DescripcionSyllabus  $descripcionSyllabus
     * @return \Illuminate\Http\Response
     */
    public function show($syllabus_id)
    {
        $syllabus = Syllabus::find($syllabus_id);
        return view('UsersViews.docente.descripcion.edit', compact('syllabus'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DescripcionSyllabus  $descripcionSyllabus
     * @return \Illuminate\Http\Response
     */
    public function edit(DescripcionSyllabus $descripcionSyllabus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DescripcionSyllabus  $descripcionSyllabus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $descripcion_syllabus_id)
    {
        $descripcion_syllabus = DescripcionSyllabus::find($descripcion_syllabus_id);
        if ($descripcion_syllabus != null) {
            $descripcion_syllabus->descripcion = $request->input('descripcion_asignatura');
            $descripcion_syllabus->objetivo = $request->input('objetivo_asignatura');
            $descripcion_syllabus->resultados = $request->input('resultados_asignatura');
            $descripcion_syllabus->contribucion = $request->input('contribucion');
            $descripcion_syllabus->competencias = $request->input('competencias');
            $descripcion_syllabus->save();
        }
        return redirect()->route('modificarSyllabus', $descripcion_syllabus->syllabus_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DescripcionSyllabus  $descripcionSyllabus
     * @return \Illuminate\Http\Response
     */
    public function destroy(DescripcionSyllabus $descripcionSyllabus)
    {
        //
    }
}
