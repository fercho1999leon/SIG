<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Area;
use App\Calificacion;
use App\Comportamiento;
use App\ConfiguracionSistema;
use App\Course;
use App\Fechas;
use App\Institution;
use App\Matter;
use App\ParcialPeriodico;
use App\PeriodoLectivo;
use App\Student2;
use App\Supply;
use App\UnidadPeriodica;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class PdfControllerActaDeCalificaciones extends Controller
{
    public function invoice($materia, $parcial)
    {
        // $courses = Course::getAllCourses();

        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        //Validar si el docente es dueño de la materia
        $matter = Matter::FindOrFail($materia);
        $students = Student2::getStudentsByCourse($matter->idCurso);
        $course = Course::getCoursesByCourse($matter->idCurso);
        $teacher = Administrative::findBySentinelid($matter->idDocente);
        $supplies = Supply::getSuppliesByMatter($materia);
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $promedios = Calificacion::getPromedioSupply($materia, $matter->idCurso, $parcial);
        $now = Carbon::now();

        $pdf = PDF::loadView('pdf.acta-de-calificaciones',
            compact('teacher', 'parcial', 'now', 'institution', 'matter', 'students',
                'course', 'supplies', 'promedios', 'periodo'));

        return $pdf->download('acta de calificaciones.pdf');

    }

    public function ActaCalificacionesQuimestre($curso, $quimestre)
    {
        $institution = Institution::find(1);
        $matters = Matter::getMattersByCourse($curso);
        $students = Student2::getStudentsByCourse($curso);
        $curso = Course::getCoursesByCourse($curso);

        foreach ($matters as $matter) {
            $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
            $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
            $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
            //$examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id,$quimestre);
            $promediosTotal[$matter->id] = [];
            $promedios80[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP2[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP3[$matter->id][$s->id]['promedio'] != 0) {
                    $promediosTotal[$matter->id][$s->id] = ($promediosP1[$matter->id][$s->id]['promedio'] + $promediosP2[$matter->id][$s->id]['promedio'] + $promediosP3[$matter->id][$s->id]['promedio']) / 3;
                    $promedios80[$matter->id][$s->id] = $promediosTotal[$matter->id][$s->id] * (0.8);
                } else {
                    $promediosTotal[$matter->id][$s->id] = 0;
                    $promedios80[$matter->id][$s->id] = 0;
                }
            }
        }

        //Seleccion del Quimestre
        if ($quimestre == 'q1') {
            $Quimestre = "Primer";
        } else {
            $Quimestre = "Segundo";
        }
        //
        $educacion = "";
        switch ($curso->grado) {
            case "Inicial 1":
                $educacion = "Educación General Básica - Educacion Inicial";
                break;
            case "Inicial 2":
                $educacion = "Educación General Básica - Educacion Inicial";
                break;
            case "Primero":
                $educacion = "Educación General Básica - Preparatoria";
                break;
            case "Segundo":
                $educacion = "Educación General Básica - Basica Elemental";
                break;
            case "Tercero":
                $educacion = "Educación General Básica - Basica Elemental";
                break;
            case "Cuarto":
                $educacion = "Educación General Básica - Basica Elemental";
                break;
            case "Quinto":
                $educacion = "Educación General Básica - Basica Media";
                break;
            case "Sexto":
                $educacion = "Educación General Básica - Basica Media";
                break;
            case "Septimo":
                $educacion = "Educación General Básica - Basica Media";
                break;
            case "Octavo":
                $educacion = "Educación General Básica - Basica Superior";
                break;
            case "Noveno":
                $educacion = "Educación General Básica - Basica Superior";
                break;
            case "Decimo":
                $educacion = "Educación General Básica - Basica Superior";
                break;
            case "Primero de Bachillerato":
                $educacion = "Bachillerato General Unificado";
                break;
            case "Segundo de Bachillerato":
                $educacion = "Bachillerato General Unificado";
                break;
            case "Tercero de Bachillerato":
                $educacion = "Bachillerato General Unificado";
                break;
        }

        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $pdf = PDF::loadView('pdf.acta-de-calificaciones-por-quimestre',
            compact('matters', 'curso', 'fechaA', 'students', 'promediosP1', 'promedios80',
                'promediosP2', 'promediosP3', 'promediosTotal', 'institution', 'Quimestre', 'educacion', 'now'));
        return $pdf->download('acta de calificaciones.pdf');
    }

    public function ActaCalificacionesQuimestreDocente($quimestre, $docente)
    {

        $quimestre = substr($quimestre, 2, 2);
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $teacher = Administrative::find($docente);
        $coursesID = Matter::getMattersByProfessor($teacher->userid)->pluck('idCurso')->toArray();
        $matters = Matter::getMattersByProfessor($teacher->userid);
        $students = Student2::getStudentsByCourse($coursesID);
        $cursos = Course::getCoursesByDocente($teacher->userid);
        foreach ($matters as $matter) {
            $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
            $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
            $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
            $promediosTotal[$matter->id] = [];
            $promedios80[$matter->id] = [];
            $examenes[$matter->id] = [];
            foreach ($students as $s) {
                if ($matter->idCurso == $s->idCurso) {
                    $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id, $quimestre);
                    if ($promediosP1[$matter->id][$s->id]['promedio'] != 0 ||
                        $promediosP2[$matter->id][$s->id]['promedio'] != 0 ||
                        $promediosP3[$matter->id][$s->id]['promedio'] != 0) {
                        $promediosTotal[$matter->id][$s->id] = ($promediosP1[$matter->id][$s->id]['promedio'] + $promediosP2[$matter->id][$s->id]['promedio'] + $promediosP3[$matter->id][$s->id]['promedio']) / 3;
                        $promedios80[$matter->id][$s->id] = $promediosTotal[$matter->id][$s->id] * (0.8);
                    } else {
                        $promediosTotal[$matter->id][$s->id] = 0;
                        $promedios80[$matter->id][$s->id] = 0;
                    }

                }
            }
        }

        //Seleccion del Quimestre
        if ($quimestre == 'q1') {
            $Quimestre = "Primer";
        } else {
            $Quimestre = "Segundo";
        }
        //
        $educacion = "";

        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $docente = Administrative::find($docente);

        $pdf = PDF::loadView('pdf.reportes-por-curso.docentes.acta-de-calificaciones-por-quimestre-docente',
            compact('matters', 'cursos', 'fechaA', 'students', 'docente', 'promediosP1', 'promedios80', 'promediosP2',
                'promediosP3', 'promediosTotal', 'institution', 'Quimestre', 'educacion', 'now', 'examenes', 'periodo'));
        return $pdf->inline('Reporte Acta Quimestre.pdf');
    }

    public function actaGeneral($curso, $parcial)
    {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $matters = Matter::where([
            ['idCurso', $curso], ['nombre', '!=', 'DESARROLLO HUMANO INTEGRAL']])->get();
        $students = Student2::getStudentsByCourse($curso);
        $course = Course::find($curso);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
            'http://' . config('app.api_host_name') .
            ':8081/libreta/periodo/' . $this->idPeriodoUser() .
            '/parcial/' . $parcial . '/curso/' . $curso))
        );
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $teachers = DB::table('users_profile')
            ->join('matters', 'users_profile.userid', '=', 'matters.idDocente')
            ->where('matters.idCurso', $curso)
            ->select('users_profile.nombres', 'users_profile.apellidos', 'matters.id', 'matters.nombre')
            ->distinct()->get();

        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-general',
            compact('fechaA', 'teachers', 'parcial', 'now', 'institution',
                'matters', 'students', 'course', 'periodo', 'data', 'PromedioInsumo'));

        return $pdf->download('Reporte General.pdf');

    }public function actaParcialMateria($curso, $parcial, $materia)
    {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $matters = Matter::where('id', $materia)->get();
        $students = Student2::getStudentsByCourse($curso);
        $course = Course::find($curso);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
            'http://' . config('app.api_host_name') .
            ':8081/libreta/periodo/' . $this->idPeriodoUser() .
            '/parcial/' . $parcial . '/curso/' . $curso))
        );
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $teachers = DB::table('users_profile')
            ->join('matters', 'users_profile.userid', '=', 'matters.idDocente')
            ->where('matters.idCurso', $curso)
            ->select('users_profile.nombres', 'users_profile.apellidos', 'matters.id', 'matters.nombre')
            ->distinct()->get();

        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-general',
            compact('fechaA', 'teachers', 'parcial', 'now', 'institution',
                'matters', 'students', 'course', 'periodo', 'data', 'PromedioInsumo'));

        return $pdf->download('Reporte General.pdf');

    }

    public function old_actaGeneral($curso, $parcial)
    {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);

        $matters = Matter::where([
            ['idCurso', $curso], ['nombre', '!=', 'DESARROLLO HUMANO INTEGRAL']])->get();
        $students = Student2::getStudentsByCourse($curso);
        $course = Course::find($curso);

        $teachers = DB::table('users_profile')
            ->join('matters', 'users_profile.userid', '=', 'matters.idDocente')
            ->where('matters.idCurso', $curso)
            ->select('users_profile.nombres', 'users_profile.apellidos', 'matters.id', 'matters.nombre')
            ->distinct()->get();

        $promedios = [];
        $supplies = [];
        foreach ($matters as $matter) {
            $supplies[$matter->id] = Supply::getSuppliesByMatter($matter->id);
            $promedios[$matter->id] = Calificacion::getPromedioSupply($matter->id, $curso, $parcial);
        }
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-general',
            compact('fechaA', 'teachers', 'parcial', 'now', 'institution',
                'matters', 'students', 'course', 'supplies', 'promedios', 'periodo'));

        return $pdf->download('Reporte General.pdf');

    }

    /* Este reporte aplica para cursos de 2do hasta 3ro de Bachillerato */
    public function evaluacionesPendientes($curso, $parcial)
    {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);

        $matters = Matter::where([
            ['idCurso', $curso], ['nombre', '!=', 'DESARROLLO HUMANO INTEGRAL']])->get();
        $students = Student2::getStudentsByCourse($curso);
        $course = Course::find($curso);

        $teachers = DB::table('users_profile')
            ->join('matters', 'users_profile.id', '=', 'matters.idDocente')
            ->where('matters.idCurso', $curso)
            ->select('users_profile.nombres', 'users_profile.apellidos', 'matters.id', 'matters.nombre')
            ->distinct()->get();

        $promedios = [];
        $supplies = [];
        foreach ($matters as $matter) {
            $supplies[$matter->id] = Supply::getSuppliesByMatter($matter->id);
            $promedios[$matter->id] = Calificacion::getPromedioSupply($matter->id, $curso, $parcial);
        }

        $promedios;
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.evaluaciones-pendientes',
            compact('fechaA', 'teachers', 'parcial', 'now', 'institution',
                'matters', 'students', 'course', 'supplies', 'promedios', 'periodo'));

        return $pdf->download('Evaluaciones Pendientes.pdf');
    }

    public function cuadroGeneralCurso($curso, $parcial)
    {
        // cuadro de calificaciones
        $students = Student2::getStudentsByCourse($curso);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $now = Carbon::now();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $course = Course::find($curso);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
            'http://' . config('app.api_host_name') .
            ':8081/libreta/periodo/' . $this->idPeriodoUser() .
            '/parcial/' . $parcial . '/curso/' . $curso))
        );
        $matters = Matter::getMattersByCourse($curso)->where('principal', 1);
        $matters2 = Matter::getMattersByCourse($curso)->where('principal', 0);
        foreach ($matters as $materia) {
            if ($materia->idArea == null) {
                return Redirect::back()->withErrors(['error' => 'La materia: ' . $materia->nombre . ' no tiene area asignada']);
            }
        }
        $tutor = Administrative::find($course->idProfesor);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.cuadro-de-calificaciones-por-curso',
            compact('students', 'course', 'tutor', 'institution', 'now', 'promedios', 'matters', 'parcial',
                'periodo', 'data', 'notasMenores', 'matters2'))
            ->setOrientation('landscape');

        return $pdf->download('Cuadro de Calificaciones.pdf');
    }
    public function cuadroGeneralCursoQuimestre($curso, $parcial)
    {
        $unidad = UnidadPeriodica::unidadP()->where('identificador', substr($parcial, 2, 2))->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $students = Student2::getStudentsByCourse($curso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1],
            ['principal', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('areas.posicion')->get();
        $matters2 = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1],
            ['principal', '=', 0]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('areas.posicion')->get();

        $examenes = [];
        foreach ($parcialP as $par) { //creado para hacer la consulta dinamica desde la tabla parciales_periodicos
            $promedios[$par->identificador] = json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/promedio/periodo/' . $this->idPeriodoUser() . '/parcial/' . $par->identificador . '/curso/' . $curso));
        }
        foreach ($matters as $matter) {
            foreach ($parcialP as $par) { //creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                if ($par->identificador == 'q1' || $par->identificador == 'q2') {
                    $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id, $par->identificador);
                }
            }
        }
        foreach ($matters2 as $matter2) {
            foreach ($parcialP as $par) { //creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                if ($par->identificador == 'q1' || $par->identificador == 'q2') {
                    $examenes[$matter2->id] = Calificacion::getExamenesMateria($matter2->id, $par->identificador);
                }
            }
        }
        $now = Carbon::now();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::find($this->idPeriodoUser());
        $course = Course::find($curso);
        $area_pos = Area::areasBySection($course->seccion); //orden de las areas en el descargable
        $comportamientos = Comportamiento::where('parcial', $parcial)->get();
        $tutor = Administrative::find($course->idProfesor);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.cuadro-calificaciones-curso-quimestre',
            compact('students', 'course', 'tutor', 'institution', 'now', 'promedios', 'matters', 'matters2', 'parcial', 'comportamientos',
                'periodo', 'parcialP', 'examenes', 'notasMenores', 'PromedioInsumo', 'area_pos'));
        return $pdf->download('Cuadro de Calificaciones.pdf');
    }
    public function oldcuadroGeneralCursoQuimestre($curso, $parcial)
    {
        $students = Student2::getStudentsByCourse($curso);
        $now = Carbon::now();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::find($this->idPeriodoUser());
        $course = Course::find($curso);
        $matters = Matter::getMattersByCourse($curso)->where('principal', 1);
        $matters2 = Matter::getMattersByCourse($curso)->where('principal', 0);
        $comportamientos = Comportamiento::where('parcial', $parcial)->get();
        $promedios = Calificacion::getPromedioFinalQuimestreCurso($curso, substr($parcial, 2, 2));
        $tutor = Administrative::find($course->idProfesor);
        // $pdf =  PDF::load
        return View('pdf.reportes-por-curso.cursos.quimestral.cuadro-calificaciones-curso-quimestre',
            compact('students', 'course', 'tutor', 'institution', 'now', 'promedios', 'matters', 'matters2', 'parcial', 'comportamientos',
                'periodo'));

        return $pdf->download('Cuadro de Calificaciones.pdf');
    }

}
