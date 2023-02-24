<?php

namespace App\Http\Controllers;

use App\Career;
use App\Contenido;
use App\Course;
use App\DescripcionSyllabus;
use App\Informacion;
use App\Matter;
use App\PreCoRequisitos;
use App\Syllabus;
use App\Unidad;
use App\PerfilEgreso;
use App\ReferenciaApa;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $materias = Matter::with('curso')
                ->where('idDocente', session('user_data')->userid)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get()
                ->groupBy('curso.grado');

            return view('UsersViews.docente.syllabus.index', compact(
                'materias'
            ));
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($materia_id)
    {
        /* DATOS DE UNIDAD */
        $matter = Matter::where('id', $materia_id)->where('estado', '1')->first();
        $course = Course::where('id', $matter->idCurso)->where('estado', '1')->first();
        $career = Career::where('id', $course->id_career)->where('estado', '1')->first();

        if ($matter != null && $course != null && $career != null) {
            if (Syllabus::getSyllabusBoolByMatter($matter->id) != true) {
                $syllabus = new Syllabus;
                $syllabus->materia_id = $matter->id;
                $syllabus->nombre_syllabus = $career->nombre . '-' . $matter->nombre;
                $syllabus->save();
                return redirect()->route('informacionGeneral', $syllabus->id);
            }
        }
        return redirect()->route('syllabus');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function show($syllabus_id)
    {
        $syllabus = Syllabus::find($syllabus_id);
        return view('UsersViews.docente.syllabus.show', compact('syllabus'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function edit(Syllabus $syllabus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syllabus $syllabus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Syllabus  $syllabus
     * @return \Illuminate\Http\Response
     */
    public function destroy($materia_id)
    {
        if ($materia_id != null) {

            $syllabus = Syllabus::where('materia_id', $materia_id)->first();
            $informacion_general = Informacion::where('syllabus_id', $syllabus->id)->first();
            $pre_co_requisitos = PreCoRequisitos::where('syllabus_id', $syllabus->id)->first();
            $descripcion_syllabus = DescripcionSyllabus::where('syllabus_id', $syllabus->id)->first();
            $unidades = Unidad::where('syllabus_id', $syllabus->id)->get();
            $referencias = ReferenciaApa::where('syllabus_id', $syllabus->id)->get();

            if ($informacion_general != null) {
                $informacion_general->delete();
            }
            if ($pre_co_requisitos != null) {
                $pre_co_requisitos->delete();
            }
            if ($descripcion_syllabus != null) {
                $descripcion_syllabus->delete();
            }
            if ($unidades != null) {
                foreach ($unidades as $unidad) {
                    $contenido = Contenido::where('unidad_id', $unidad->id)->first();
                    $perfil_egreso = PerfilEgreso::where('unidad_id', $unidad->id)->first();
                    if ($contenido != null) {
                        $contenido->delete();
                    }
                     if ($perfil_egreso != null) {
                        $perfil_egreso->delete();
                    }
                    $unidad->delete();
                }
            }
            if ($referencias != null) {
                foreach ($referencias as $referencia) {
                    $referencia->delete();
                }
            }
            $syllabus->delete();
        }
        return redirect()->route('syllabus');
    }

    public function destroyOnlySyllabus($materia_id)
    {
        if ($materia_id != null) {
            $syllabus = Syllabus::where('materia_id', $materia_id)->first();
            $syllabus->delete();
        }
        return redirect()->route('syllabus');
    }

    public function getDocenteSyllabusName($id_materia)
    {
        $matter = Matter::where('id', $id_materia)->where('estado', '1')->first();
        return view('UsersViews.docente.syllabus.creacion_de_unidades', compact('matter'));
    }

    public function getDocenteUnidadName($id_materia)
    {
        /* $course = Course::getCoursesByCourse($id_curso);
        $career = Career::where('id', $course->id_career)->where('estado', '1')->first(); */
        $matter = Matter::where('id', $id_materia)->where('estado', '1')->first();
        return view('UsersViews.docente.syllabus.creacion_de_contenido', compact('matter'));
    }

    public static function getSyllabusByName($nombre_syllabus)
    {
        return Syllabus::getSyllabusByName($nombre_syllabus);
    }

    public static function getSyllabusBoolByMatter($materia_id)
    {
        return Syllabus::getSyllabusBoolByMatter($materia_id);
    }

    public static function getSyllabusByMatter($materia_id)
    {
        return Syllabus::getSyllabusByMatter($materia_id);
    }

    public static function getSyllabusById($id)
    {
        return Syllabus::getSyllabusById($id);
    }
}
