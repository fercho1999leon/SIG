<?php

namespace App\Http\Controllers;

use App\Calificacion;
use App\Career;
use App\Course;
use App\Matter;
use App\Semesters;
use App\User;
use App\UnidadPeriodica;
use Sentinel;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::all()->where('estado', '=', '1');
        $courses = Course::all()->where('estado', '=', '1')->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo);
        $unidad = UnidadPeriodica::unidadP();
        return view('UsersViews.administrador.reportes.reportePorActa', compact(
            'careers', 'courses','unidad'
        ));
    }
    /**
     * Consultas para el AJAX
     */

    public function semestresPorCarrera($id)
    {
        //$semestre = Semesters::all()->where('career_id','=',$id)->where('estado','=','1');
        $semestre = Semesters::query()
            ->where('career_id', '=', $id)
            ->where('estado', '=', '1')
            ->get();
        return $semestre;
    }

    public function matriasPorSemestre($id)
    {

        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','1');
        //$matters = Matter::where('idCurso', $id)->orderBy('posicion')->get();
        //echo ($matters);
        //Matter::getMattersByCourseConfig($course->id)->where('estado','=','1');
        //return $matters;
        //Sentinel::getUser()->idPeriodoLectivo
        \Session::put('idcarrera', $id);
        /*$data = Semesters::find($id);
        $curst = course::join("Semesters", "Semesters.id", "=", "courses.id_career")->join("Career", "Career.id", "=", "Semesters.career_id")
            ->select("Career.nombre")->where("courses.id_career", "=", \Session::get('idcarrera'))
            ->first();*/

        $cursos = course::all()->where('id_career', '=', \Session::get('idcarrera'))->where('estado', '=', '1');
        //$docentes = User::all() ->where('cargo', 'Docente');
        //$idCurso = Matter::select('Career.id')->where('Career.estado','=','1')->where('courses.id_career','=',$id)
        //->join('courses', 'matters.idCurso', '=','courses.id')
        //->join('Semesters','courses.id_career','=','Semesters.id')
        //->join('Career','Semesters.career_id','=','Career.id')
        //->first();
        //session(['prueba' => $id]);
        //$areas = Area::where('idPeriodo',  Sentinel::getUser()->idPeriodoLectivo)->get();
        //$cualitativas = estructuraCualitativa::All();
        //return response()->json($cursos);
        return $cursos;
    }

    public function cursoPorSemestre($id)
    {

        $cursos = course::all()->where('id_career', '=', $id)->where('estado', '=', '1');

        return response()->json($cursos);
    }

    public function postAccedeCurso($id)
    {

        $data = Semesters::find($id);
        $curst = course::join("Semesters", "Semesters.id", "=", "courses.id_career")->join("Career", "Career.id", "=", "Semesters.career_id")
            ->select("Career.nombre")->where("courses.id_career", "=", $id)
            ->first();
        //dd($curst);
        if ($curst == null) {
            $cursto = new course();
            $cursto->nombre = "NO DEFINIDO";
            //$cursto = json_encode($cursto);
            // dd($cursto);
        } else {

            $cursto = $curst;
            //dd($cursto);
        }

        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','1');
        $cursos = course::all()->where('id_career', '=', \Session::get('idcarrera'))->where('estado', '=', '1')->pluck('id')->first();
        //dd($cursos);
        //$matters = Matter::getMattersByCourseConfig($cursos)->where('estado','=','1');
        $matters = Matter::query()->where('idCurso', $id)->where('estado', '=', '1')->orderBy('posicion')->get();

        //dd($matters);
        $docentes = User::all()->where('cargo', 'Docente');
        $idCurso = Matter::select('Career.id')->where('Career.estado', '=', '1')->where('courses.id_career', '=', $id)
            ->join('courses', 'matters.idCurso', '=', 'courses.id')
            ->join('Semesters', 'courses.id_career', '=', 'Semesters.id')
            ->join('Career', 'Semesters.career_id', '=', 'Career.id')
            ->first();

        session(['prueba' => $id]);

        //$areas = Area::where('idPeriodo',  Sentinel::getUser()->idPeriodoLectivo)->get();
        //$cualitativas = estructuraCualitativa::All();
        //dd($matters);
        return response()->json($matters);
        //return view('UsersViews.administrador.cursos.index', compact('matters','data', 'id','cursos','cursto','docentes','areas','cualitativas','materias'));
        //return view('UsersViews.administrador.cursos.index', compact('matters','data', 'career_id','cursos','curst','docentes','areas','cualitativas'));

    }

    public function postAccedeParalelos($id)
    {

        $semestre = Semesters::find($id);
        /*$semestre = Semesters::query()
        ->where('career_id', '=', $careers['id'])
        ->where('estado', '=', '1')
        ->first();*/
        //dd($semestre);


        $cursos = course::all()->where('id_career','=', \Session::get('idcarrera') )->where('estado','=','1');
        //dd($cursos);
        $data = Semesters::find($id);
        $curst = course::join("Semesters", "Semesters.id", "=", "courses.id_career")->join("Career", "Career.id", "=", "Semesters.career_id")
            ->select("Career.nombre")->where("courses.id_career", "=", $id)
            ->first();
            
        if ($curst == null) {
            $cursto = new course();
            $cursto->nombre = "NO DEFINIDO";
            //$cursto = json_encode($cursto);
            // dd($cursto);
        } else {

            $cursto = $curst;
            //dd($cursto);
        }

        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','1');
        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','1')->get();
        $cursos = course::query()->where('id_career', '=', $semestre->career_id)->where('estado', '=', '1')->where('id_semester',$semestre->id)->get();

        $matters = Matter::getMattersByCourseConfig($cursos)->where('estado', '=', '1');
        //dd($matters);
        $docentes = User::all()->where('cargo', 'Docente');
        $idCurso = Matter::select('Career.id')->where('Career.estado', '=', '1')->where('courses.id_career', '=', $id)
            ->join('courses', 'matters.idCurso', '=', 'courses.id')
            ->join('Semesters', 'courses.id_career', '=', 'Semesters.id')
            ->join('Career', 'Semesters.career_id', '=', 'Career.id')
            ->first();

        session(['prueba' => $id]);

        //$areas = Area::where('idPeriodo',  Sentinel::getUser()->idPeriodoLectivo)->get();
        //$cualitativas = estructuraCualitativa::All();

        return $cursos;
        //return view('UsersViews.administrador.cursos.index', compact('matters','data', 'id','cursos','cursto','docentes','areas','cualitativas','materias'));
        //return view('UsersViews.administrador.cursos.index', compact('matters','data', 'career_id','cursos','curst','docentes','areas','cualitativas'));

    }

    public function postAccedeMateria($id)
    {

        //dd($matters);
        $docentes = User::all()
            ->where('cargo', 'Docente')
            ->where('id', $id);

        return $docentes;
    }
    public function idDocenteMateria($id)
    {
        $matters = Matter::query()->where('idCurso', $id)->where('estado', '=', '1')->first();
        return $matters;
    }

    public static function getPromediosByStudent($studentId, $parcial, $idCurso)
    {
        return Calificacion::getPromediosByStudent($studentId, $parcial, $idCurso);
    }

}
