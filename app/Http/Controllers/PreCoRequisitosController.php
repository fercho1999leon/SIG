<?php

namespace App\Http\Controllers;

use App\PreCoRequisitos;
use App\Syllabus;
use App\Course;
use App\Matter;
use Illuminate\Http\Request;

class PreCoRequisitosController extends Controller
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
            return view('UsersViews.docente.prerequisitos.index', compact('syllabus'));
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
            if (PreCoRequisitos::where('syllabus_id', $syllabus->id)->first() == null) {
                $pre_co_requisitos = new PreCoRequisitos;

                $pre_co_requisitos->syllabus_id = $syllabus->id;
                $pre_co_requisitos->materia_pre = $request->input('asignaturaPre');
                $pre_co_requisitos->materia_pre_cod = $request->input('codigo');
                $pre_co_requisitos->materia_co = $request->input('asignaturaCo');
                $pre_co_requisitos->materia_co_cod = $request->input('codigoDos');
                $pre_co_requisitos->save();

                return redirect()->route('descripcionSyllabus', $syllabus->id);
            }
        }
        return redirect()->route('syllabus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreCoRequisitos  $preCoRequisitos
     * @return \Illuminate\Http\Response
     */
    public function show($syllabus_id)
    {
        $id_carrera = \Session::get('idcarrera');
        $arrayMaterias = [];
        $syllabus = Syllabus::find($syllabus_id);
        $coursesCareer =  Course::where('id_career', $id_carrera)
                                ->where('estado', '1')
                                ->get();
        foreach ($coursesCareer as $course)
        {
            $materias = Matter::getMattersAllByCourse($course->id)
                                ->where('estado', '1')
                                ->where('idPeriodo', $this->idPeriodoUser());
                             
            foreach($materias as $materia)
            {
                $materiasUnificadas = array();
                $materiasUnificadas['id'] = $materia->id;
                $materiasUnificadas['nombre'] = $materia->nombre; 
                array_push($arrayMaterias, $materiasUnificadas);
            }

        }


        return view('UsersViews.docente.prerequisitos.edit', compact('syllabus', 'arrayMaterias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreCoRequisitos  $preCoRequisitos
     * @return \Illuminate\Http\Response
     */
    public function edit(PreCoRequisitos $preCoRequisitos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreCoRequisitos  $preCoRequisitos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pre_co_requisitos_id)
    {
        $pre_co_requisitos = PreCoRequisitos::find($pre_co_requisitos_id);
        if ($pre_co_requisitos != null) {
            $pre_co_requisitos->materia_pre = $request->input('asignaturaPre');
            $pre_co_requisitos->materia_pre_cod = $request->input('codigo');
            $pre_co_requisitos->materia_co = $request->input('asignaturaCo');
            $pre_co_requisitos->materia_co_cod = $request->input('codigoDos');
            $pre_co_requisitos->save();

        }
        return redirect()->route('modificarSyllabus', $pre_co_requisitos->syllabus_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreCoRequisitos  $preCoRequisitos
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreCoRequisitos $preCoRequisitos)
    {
        //
    }
}
