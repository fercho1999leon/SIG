<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Student2Profile;
use App\Calificacion;
use App\Destreza;
use App\Course;
use App\Matter;
use App\Institution;
use App\PeriodoLectivo;
use DB;
use App\Administrative;
use App\ConfiguracionSistema;
use PDF;
use Carbon\Carbon;
use App\Fechas;
use App\Promedio;
use App\Supply;
use App\ReportePromedios;
use App\Activity;
use Illuminate\Support\Facades\Redirect;
use App\Comportamiento;
use App\CourseAssistance;
use App\Area;
use Sentinel;

class LibretasParcialController extends Controller
{
    /*
	Libretas Destrezas
    */
    public function libretaDestreza($curso, $parcial){
        $students = Student2::getStudentsByCourse($curso)->where('matricula', '!=', 'Pre Matricula')->where('retirado', '!=', 'SI');
        $estudiantes = Student2Profile::whereIn('idStudent', $students->pluck('id'))->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
		$institucion = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
		$course = Course::find($curso);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->where('clasesdestrezas.parcial', strtoupper($parcial))
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
		$institution = Institution::find(1);
        $seccion = $course->seccion;
        $nQuimestre = substr($parcial,3,1);
        $n_parcial =  substr($parcial,1,1);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.libreta-destreza-general', compact(
            'representantes','tutor', 'parcial', 'institution', 'nQuimestre', 'n_parcial',
            'matters', 'course', 'students', 'destrezas', 'seccion', 'periodo', 'estudiantes'
		));
		return $pdf->download('Reporte Destrezas.pdf');
	}
    /**/


    /*
	Libreta Destrezas por Estudiante
    */
    public function libretaDestrezaAlumno($alumno, $curso, $parcial){
        $students = Student2::where('id',$alumno)->get();
        $estudiantes = Student2Profile::whereIn('idStudent', $students->pluck('id'))->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
		$course = Course::find($curso);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::find($students->first()->idRepresentante);
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->where('clasesdestrezas.parcial', strtoupper($parcial))
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
        $institution = Institution::find(1);
        $seccion = $course->seccion;
        $nQuimestre = substr($parcial,3,1);
        $n_parcial =  substr($parcial,1,1);
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.libreta-destreza-general', compact(
            'representantes','tutor', 'parcial', 'institution', 'nQuimestre', 'n_parcial',
            'matters', 'course', 'students', 'destrezas', 'seccion', 'periodo', 'estudiantes'
        ));
		return $pdf->download('Libreta.pdf');
	}
    /**/

    /*
	Libreta Parcial
    */
	public function libreta($idCurso,$parcial){
        try {
            $i = 0;
			$confDHI = ConfiguracionSistema::configuracionDHI();
			$dhi = Matter::where(['idCurso' => $idCurso, 'nombre' => 'DESARROLLO HUMANO INTEGRAL',
				'visible' => 0, 'principal' => 0 ])->first();
            $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
            $tipo_libreta = ConfiguracionSistema::formatoLibreta();
            $curso = Course::find($idCurso);
			$tutor = Administrative::find($curso->idProfesor);
            $materias = Matter::getMattersByCourse($curso->id);
            $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
			$now = Carbon::now();
			$asistenciaCurso = CourseAssistance::query()
				->where('idCurso', $idCurso)
				->where('parcial', $parcial)
				->first();
            $comportamientos = Comportamiento::where('parcial', $parcial)->get();
            if(count($materias) > 0){
                $students = Student2Profile::getStudentsByCourse($idCurso);
                $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
                    'http://'. config('app.api_host_name') .
                    ':8081/libreta/periodo/'. $this->idPeriodoUser().
                    '/parcial/'.$parcial.'/curso/'.$idCurso))
                );
                $allMatters  = DB::table('matters')->where([
                    ['idCurso', '=', $idCurso],
                    ['visible', '=', 1]])
                    ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
                    ->select('matters.*', 'areas.nombre AS nombreArea')
                        ->orderBy('areas.posicion')->get();
               // foreach ($allMatters as $materia) {
                    //if($materia->idArea == null){
                      //  return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                   // }
                //}
                $institution =Institution::first();
                $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
                $notasMenores = ConfiguracionSistema::notasRojo()->valor;
                $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
                $porcentajeInsumos = ConfiguracionSistema::InsumoPorcentual()->valor;
                $nota_menor = ConfiguracionSistema::notaMenorRojo();
                $comportamiento_menor = ConfiguracionSistema::comportamientoRojo();
                $insumos = Supply::getSuppliesOrdered($idCurso);
                $reps = [];
                foreach($data as $student){
                    if( $student->estudiante->IDRepresentante != null){
                        array_push($reps, $student->estudiante->IDRepresentante);
                    }
                }
                $representantes = Administrative::whereIn('id',$reps)->get();
                $seccion = $curso->seccion;
                $nQuimestre = substr($parcial,3,1);
                $n_parcial =  substr($parcial,1,1);
                if($tipo_libreta=='0') {// formato1
                    $pdf = PDF::loadview('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api',
                        compact('curso', 'tutor', 'parcial', 'data', 'comportamiento_menor', 'comportamientos',
                        'institution', 'notasMenores', 'representantes', 'insumos', 'nota_menor', 'seccion', 'now', 'periodo',
                        'nombre_representante_libreta_parcial', 'confDHI','area_pos', 'dhi', 'asistenciaCurso', 'tipo_libreta','students','PromedioInsumo','area_pos','porcentajeInsumos',
                        'allMatters'))->setOrientation('landscape');
                }
                elseif($tipo_libreta=='1'){// formato2
                    $pdf = PDF::loadview('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api2',
                        compact('curso', 'tutor', 'parcial', 'data', 'comportamiento_menor', 'comportamientos',
                        'institution', 'notasMenores', 'representantes', 'insumos', 'nota_menor', 'seccion', 'now', 'periodo',
                        'nombre_representante_libreta_parcial', 'i', 'confDHI', 'dhi', 'asistenciaCurso', 'tipo_libreta',
                        'students','PromedioInsumo', 'nQuimestre', 'n_parcial','area_pos','allMatters','porcentajeInsumos'
                    ));
                }else{ // formato3
                    $pdf = PDF::loadview('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api3',
                        compact('curso', 'tutor', 'parcial', 'data', 'comportamiento_menor', 'comportamientos',
                        'institution', 'notasMenores', 'representantes', 'insumos', 'nota_menor', 'seccion', 'now', 'periodo',
                        'nombre_representante_libreta_parcial', 'i', 'confDHI', 'dhi', 'asistenciaCurso', 'tipo_libreta',
                        'students','PromedioInsumo', 'nQuimestre', 'n_parcial','allMatters','area_pos','porcentajeInsumos'
                    ))->setOrientation('landscape');
                }
				return $pdf->download('Libreta Parcial.pdf');
            }else{
                throw new \Exception('No registra materias en el sistema.');
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**/

    /*
	Libreta Parcial por Estudiante
    */
    public function libretaParcialAlumno($idEstudiante,$idCurso,$parcial){
        $i = 0;
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $dhi = Matter::where(['idCurso' => $idCurso,
            'nombre' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0, 'principal' => 0
        ])->first();
		$nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
        $students = Student2::where('id',$idEstudiante)->get();
        $curso = Course::find($idCurso);
        $asistenciaCurso = CourseAssistance::query()
            ->where('idCurso', $idCurso)
            ->where('parcial', $parcial)
            ->first();
		$seccion = $curso->seccion;
          $materiasExtra = Matter::where(['idCurso' => $curso->id, 'visible' => 1, 'principal' => 0])->get();
		$now = Carbon::now();
		$comportamientos = Comportamiento::where('parcial', $parcial)->get();
		$materias = Matter::getMattersByCourse($curso->id);
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $promediosP = [];
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $allMatters  = DB::table('matters')->where([
                ['idCurso', '=', $idCurso],
                ['visible', '=', 1]])
                ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
                ->select('matters.*', 'areas.nombre AS nombreArea')
                 ->orderBy('areas.posicion')->get();
                 //foreach ($allMatters as $materia) {
                   // if($materia->idArea == null){
                  //  return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                   //}
               // }
        $nQuimestre = substr($parcial,3,1);
        $n_parcial =  substr($parcial,1,1);
        foreach ($materias as $matter){
            $promediosP[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, $parcial);
        }
        if(count($materias) > 0){
            $tutor = Administrative::find($curso->idProfesor);
			$institution = Institution::find(1);
			$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
            $notasMenores = ConfiguracionSistema::notasRojo()->valor;
            $porcentajeInsumos = ConfiguracionSistema::InsumoPorcentual()->valor;
            $nota_menor = ConfiguracionSistema::notaMenorRojo();
            $comportamiento_menor = ConfiguracionSistema::comportamientoRojo();
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
            $insumos = Supply::getSuppliesOrdered($idCurso);
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
                'http://'. config('app.api_host_name') .
                ':8081/libreta/periodo/'. $this->idPeriodoUser().
                '/parcial/'.$parcial.'/'.$idEstudiante))
            );
            $reps = [];
            foreach($data as $student){
                if( $student->estudiante->IDRepresentante != null)
                    array_push($reps, $student->estudiante->IDRepresentante);
            }
            $nQuimestre = substr($parcial,3,1);
            $n_parcial =  substr($parcial,1,1);
            $representantes = Administrative::whereIn('id',$reps)->get();
            if($tipo_libreta=='0') {
                $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api',
                    compact('course', 'students', 'curso', 'tutor', 'notasMenores', 'representantes', 'comportamientos',
                    'institution',  'parcial', 'data', 'insumos', 'nota_menor', 'comportamiento_menor', 'confDHI','dhi', 'seccion', 'now', 'periodo',
                    'nombre_representante_libreta_parcial', 'tipo_libreta', 'asistenciaCurso', 'promediosP','PromedioInsumo', 'nQuimestre', 'n_parcial','area_pos','allMatters','porcentajeInsumos'
                ))->setOrientation('landscape');
            } elseif($tipo_libreta=='1'){
                $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api2',
                    compact('course', 'students', 'curso', 'tutor', 'notasMenores', 'representantes', 'comportamientos', 'n_parcial', '',
                    'institution',  'parcial', 'data', 'insumos', 'nota_menor', 'comportamiento_menor', 'confDHI','dhi', 'seccion', 'now', 'periodo',
                    'nombre_representante_libreta_parcial', 'tipo_libreta', 'asistenciaCurso', 'i','PromedioInsumo','materiasExtra', 'nQuimestre','area_pos','allMatters','porcentajeInsumos'
                ))->setOrientation('landscape');

             }else{ // formato3
                    $pdf = PDF::loadview('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-parcial-api3',
                        compact('curso', 'tutor', 'parcial', 'data', 'comportamiento_menor', 'comportamientos',
                        'institution', 'notasMenores', 'representantes', 'insumos', 'nota_menor', 'seccion', 'now', 'periodo',
                        'nombre_representante_libreta_parcial', 'i', 'confDHI', 'dhi', 'asistenciaCurso', 'tipo_libreta',
                        'students','PromedioInsumo', 'nQuimestre', 'n_parcial','allMatters','area_pos','porcentajeInsumos'
                    ))->setOrientation('landscape');
                }
            return $pdf->download('Libreta Parcial.pdf');
        }else{
            return Redirect::back()->withErrors(['login_fail' => 'No registra materias en el sistema.']);
        }
    }
    /**/


    /*
    Libreta Parcial RA
    */
    public function LibretaRA($idCurso, $parcial){
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $dhi = Matter::where(['idCurso' => $idCurso,
            'nombre' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0, 'principal' => 0
        ])->first();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $curso = Course::find($idCurso);
        $tutor = Administrative::find($curso->idProfesor);
		$institution = Institution::find(1);
		$comportamientos = Comportamiento::where('parcial', $parcial)->get();
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
        $comportamiento_menor = ConfiguracionSistema::comportamientoRojo();
        $materias = Matter::getMattersByCourse($curso->id);
        $allMatters  = DB::table('matters')->where([
                ['idCurso', '=', $idCurso],
                ['visible', '=', 1]])
                ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
                ->select('matters.*', 'areas.nombre AS nombreArea')
                 ->orderBy('areas.posicion')->get();
                // foreach ($allMatters as $materia) {
                  //  if($materia->idArea == null){
                 //   return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                 //   }
               // }
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
        $seccion = $curso->seccion;
        $now = Carbon::now();
        $nQuimestre = substr($parcial,3,1);
        $n_parcial =  substr($parcial,1,1);
        $asistenciaCurso = CourseAssistance::query()
                ->where('idCurso', $idCurso)
                ->where('parcial', $parcial)
                ->first();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        if(count($materias) > 0){
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
                'http://'. config('app.api_host_name') .
                ':8081/libreta/periodo/'. $this->idPeriodoUser().
                '/parcial/'.$parcial.'/curso/'.$idCurso)) );
            $reps = [];
            foreach($data as $student){
                if( $student->estudiante->IDRepresentante != null)
                    array_push($reps, $student->estudiante->IDRepresentante);
            }
            $representantes = Administrative::whereIn('id',$reps)->get();
            $insumos = Supply::getSuppliesOrdered($idCurso);
            if($tipo_libreta==2){
           $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-refuerzo-api3',compact(
                'representantes', 'data', 'curso', 'tutor', 'institution', 'notasMenores', 'parcial','insumos','nota_menor',
                'comportamiento_menor', 'periodo', 'comportamientos', 'students', 'confDHI', 'dhi','PromedioInsumo','seccion','now','area_pos','allMatters','nombre_representante_libreta_parcial','n_parcial','nQuimestre','asistenciaCurso'
            ))->setOrientation('landscape');

            }else{
            $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-refuerzo-api',compact(
                'representantes', 'data', 'curso', 'tutor', 'institution', 'notasMenores', 'parcial','insumos','nota_menor',
                'comportamiento_menor', 'periodo', 'comportamientos', 'students', 'confDHI', 'dhi','PromedioInsumo','seccion','now','area_pos','allMatters','nombre_representante_libreta_parcial'
            ))->setOrientation('landscape');
            }
            return $pdf->download('Libreta Refuerzo Academico.pdf');
        }else{
            return Redirect::back()->withErrors(['login_fail' => 'No registra materias en el sistema.']);
        }
    }
    /**/

    /*
    Libreta Parcial RA por Estudiante
    */
    public function LibretaRAAlumno($idEstudiante, $parcial){
        $students = Student2Profile::where('idStudent',$idEstudiante)->first();
        $curso = Course::find($students->idCurso);
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $dhi = Matter::where(['idCurso' => $students->idCurso,
            'nombre' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0, 'principal' => 0
        ])->first();
        $tutor = Administrative::find($curso->idProfesor);
		$institution = Institution::find(1);
		$comportamientos = Comportamiento::where('parcial', $parcial)->get();
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
        $comportamiento_menor = ConfiguracionSistema::comportamientoRojo();
        $materias = Matter::getMattersByCourse($curso->id);
        if(count($materias) > 0){
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
                'http://'. config('app.api_host_name') .
                ':8081/libreta/periodo/'. $this->idPeriodoUser().
                '/parcial/'.$parcial.'/'.$idEstudiante))
            );
            $reps = [];
            foreach($data as $student){
                if( $student->estudiante->IDRepresentante != null)
                    array_push($reps, $student->estudiante->IDRepresentante);
            }
            $seccion = $curso->seccion;
            $now = Carbon::now();
            $nQuimestre = substr($parcial,3,1);
            $n_parcial =  substr($parcial,1,1);
            $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
            $allMatters  = DB::table('matters')->where([
                ['idCurso', '=', $curso->id],
                ['visible', '=', 1]])
                ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
                ->select('matters.*', 'areas.nombre AS nombreArea')
                 ->orderBy('areas.posicion')->get();
            $asistenciaCurso = CourseAssistance::query()
                ->where('idCurso', $curso->id)
                ->where('parcial', $parcial)
                ->first();
            $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
            $tipo_libreta = ConfiguracionSistema::formatoLibreta();
            $representantes = Administrative::whereIn('id',$reps)->get();
            $insumos = Supply::getSuppliesOrdered($curso->id);
            $tipo_libreta = ConfiguracionSistema::formatoLibreta();
            if($tipo_libreta==2){
            $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-refuerzo-api3',compact(
                'representantes', 'data', 'curso', 'tutor',  'institution',  'notasMenores',  'comportamiento_menor', 'comportamientos',
                'parcial', 'insumos',  'nota_menor', 'periodo', 'students', 'confDHI', 'dhi', 'PromedioInsumo','seccion','now','area_pos','allMatters','nombre_representante_libreta_parcial','n_parcial','nQuimestre','asistenciaCurso'
            ))->setOrientation('landscape');
            }else{
                  $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.acta-calificaciones-refuerzo-api',compact(
                'representantes', 'data', 'curso', 'tutor', 'institution', 'notasMenores', 'parcial','insumos','nota_menor',
                'comportamiento_menor', 'periodo', 'comportamientos', 'students', 'confDHI', 'dhi','PromedioInsumo','seccion','now','area_pos','allMatters','nombre_representante_libreta_parcial'
            ))->setOrientation('landscape');
            }
            return $pdf->download('Libreta Refuerzo Academico.pdf');
        }else{
            return Redirect::back()->withErrors(['login_fail' => 'No registra materias en el sistema.']);
        }
    }
}
