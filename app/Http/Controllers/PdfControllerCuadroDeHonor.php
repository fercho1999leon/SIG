<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Institution;
use App\Course;
use App\Fechas;
use App\Student2;
use PDF;
use App\Calificacion;
use App\Comportamiento;
use App\PeriodoLectivo;
use App\ConfiguracionSistema;

class PdfControllerCuadroDeHonor extends Controller
{
    public function invoice($idCurso, $parcial)
    {
        $NroEstudiantesCH = ConfiguracionSistema::EstudiantesCuadroHonor()->valor;
         $data2 =new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/'.substr($parcial, 2,2).'/curso/'.$idCurso)));
         $estudiantes = $data2->sortByDesc('promedioEstudiante')->take($NroEstudiantesCH);
        $institution = Institution::findOrFail(1);
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $course = Course::findOrFail($idCurso);
        $quimestre ='';
        if( $parcial=='p1q1' || $parcial=='p2q1' || $parcial=='p3q1'){
            $quimestre = 'Primer Quimestre';
        }else{
            $quimestre = 'Segundo Quimestre';
        }
        $educacion = "";
        switch($course->grado){
            case "Inicial 1":
                $educacion = "Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = "Educacion Inicial";
            break;
            case "Primero":
                $educacion = "Preparatoria";
            break;
            case "Segundo":
                $educacion = "Educación General Básica";
            break;
            case "Tercero":
                $educacion = "Educación General Básica";
            break;
            case "Cuarto":
                $educacion = "Educación General Básica";
            break;
            case "Quinto":
                $educacion = "Educación General Básica";
            break;
            case "Sexto":
                $educacion = "Educación General Básica";
            break;
            case "Septimo":
                $educacion = "Educación General Básica";
            break;
            case "Octavo":
                $educacion = "Educación General Básica";
            break;
            case "Noveno":
                $educacion = "Educación General Básica";
            break;
            case "Decimo":
                $educacion = "Educación General Básica";
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
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $comportamientos = Comportamiento::where('parcial', substr($parcial, 2,2))->get();
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.cuadro-de-honor',
        compact( 'institution', 'now', 'course', 'cuadro', 'estudiantes', 'quimestre', 'educacion',
        'fechaA', 'parcial', 'periodo', 'comportamientos','data2'));
        return $pdf->download('Cuadro de Honor.pdf');
	}
    public function old_invoice($idCurso, $parcial)
    {
        $cuadro = Calificacion::CuadroDeHonor($idCurso, substr($parcial, 2,2));
        if(count($cuadro)>0)
            $students = Student2::whereIn('id', array_keys($cuadro))->orderByRaw('FIELD(id,'.implode(',',array_keys($cuadro)).')')->get();
        else
        $students = [];
        $institution = Institution::findOrFail(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $course = Course::findOrFail($idCurso);
        $quimestre ='';
        if( $parcial=='p1q1' || $parcial=='p2q1' || $parcial=='p3q1'){
            $quimestre = 'Primer Quimestre';
        }else{
            $quimestre = 'Segundo Quimestre';
        }
        $educacion = "";
        switch($course->grado){
            case "Inicial 1":
                $educacion = "Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = "Educacion Inicial";
            break;
            case "Primero":
                $educacion = "Preparatoria";
            break;
            case "Segundo":
                $educacion = "Educación General Básica";
            break;
            case "Tercero":
                $educacion = "Educación General Básica";
            break;
            case "Cuarto":
                $educacion = "Educación General Básica";
            break;
            case "Quinto":
                $educacion = "Educación General Básica";
            break;
            case "Sexto":
                $educacion = "Educación General Básica";
            break;
            case "Septimo":
                $educacion = "Educación General Básica";
            break;
            case "Octavo":
                $educacion = "Educación General Básica";
            break;
            case "Noveno":
                $educacion = "Educación General Básica";
            break;
            case "Decimo":
                $educacion = "Educación General Básica";
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
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);

        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $comportamientos = Comportamiento::where('parcial', $parcial)->get();
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.cuadro-de-honor',
        compact( 'institution', 'now', 'course', 'cuadro', 'students', 'quimestre', 'educacion',
        'fechaA', 'parcial', 'periodo', 'comportamientos'));

        return $pdf->download('Cuadro de Honor.pdf');
    }

}
