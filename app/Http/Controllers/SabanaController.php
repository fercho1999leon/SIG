<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Course;
use App\Promedio;
use App\Matter;
use App\Supply;
use App\ReportePromedios;
use App\Institution;
use DB;
use PDF;
use Sentinel;
use Carbon\Carbon;
use App\ConfiguracionSistema;
use App\Calificacion;
use App\Activity;
use App\Area;
use App\Administrative;
use App\Student2Profile;
use App\UnidadPeriodica;
use Illuminate\Support\Facades\Redirect;

class SabanaController extends Controller
{
    /*
	Sábana
    */
    public function sabana($curso,$tipo){
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $tituloTitle = 'Sábana';
        $titutloEncabezado = 'Cuadro de calificaciones finales';
        $course = Course::find($curso);
        $institution = Institution::find(1);
        $now = Carbon::now();
        $students = Student2Profile::getStudentsByCourse($curso);
        $countMaterias = 0;
        $cantidadDeEstudiantes = count($students);
        $cantidadDeEstudiantesPorHoja = 30;
        $cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHoja;
        $sliceEstudiantes = 0;
        $count = 1;
        $reinicioCantidadDeEstudiantesPorHoja = $cantidadDeEstudiantesPorHoja;
        $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();

        $areas = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('areas.nombre AS nombreArea')
            ->selectRaw('count(*) as numero')
            ->orderBy('matters.posicion')
            ->groupBy('nombreArea')->get();

        $matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
        $confDHI = ConfiguracionSistema::configuracionDHI();

        foreach ($matters as $materia) {
            if($materia->idArea == null){
                return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            }
        }

        $sabana = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/sabana/anual/'. $this->idPeriodoUser().'/curso/'.$curso)));
        $sabana = $sabana->sortBy('apellidos');

        if($tipo=='3')// si el reporte es sabana remedial::::::::::::::::::::
        {
            $mostrar =[];
            foreach ($students as $estudiante) {
                $anual[$estudiante->id]= $sabana->where('estudianteId',$estudiante->id)->first();
                foreach ($matters as $materias) {
                    foreach ($anual[$estudiante->id]->materias as $n_m) {
                        if ($n_m->materiaId == $materias->id) {
                            if ($n_m->remedial >0 && $n_m->remedial <10 ) {
                                array_push($mostrar,$estudiante->id);
                            }
                        }
                    }
                }
            }
            $sabana = $sabana->sortBy('apellidos')->whereIn('estudianteId', $mostrar);

        }else if($tipo=='2'){// si el reporte es sabana supletorio::::::::::::::::::::
            $mostrar =[];
            foreach ($students as $estudiante) {
                $anual[$estudiante->id]= $sabana->where('estudianteId',$estudiante->id)->first();
                foreach ($matters as $materias) {
                    foreach ($anual[$estudiante->id]->materias as $n_m) {
                        if ($n_m->materiaId == $materias->id) {
                            if ($n_m->supletorio >0 && $n_m->supletorio <10 ) {
                                array_push($mostrar,$estudiante->id);
                            }
                        }
                    }
                }
            }
            $sabana = $sabana->sortBy('apellidos')->whereIn('estudianteId', $mostrar);
        }

        if ($sabana->count() == 0) {
            return Redirect::back()->withErrors(['info' => 'El curso:'.$course->grado.' '.$course->paralelo.' no tiene estudiantes con estas calificaciones']);
        }

        $dhi = Matter::where(['idCurso' => $curso, 'area' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0, 'principal' => 0 ])->first();

        if ($tipo == 0){
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.sabana-por-curso-egb',compact(
                'course', 'institution', 'matters', 'students', 'notasMenores','sliceEstudiantes', 'titutloEncabezado',
                'tituloTitle','cantidadDeEstudiantesPorHojaSumatoria', 'cantidadDeEstudiantesPorHoja','cantidadDeEstudiantes',
                'count','countMaterias', 'reinicioCantidadDeEstudiantesPorHoja', 'confComportamiento','areas','unidades_a','sabana',
                'confDHI','dhi', 'tipo'
            ))->setOrientation('landscape');
        }else {
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.sabana-por-curso',compact(
                'course', 'institution', 'matters', 'students', 'notasMenores','sliceEstudiantes', 'titutloEncabezado',
                'tituloTitle','cantidadDeEstudiantesPorHojaSumatoria', 'cantidadDeEstudiantesPorHoja','cantidadDeEstudiantes',
                'count','countMaterias', 'reinicioCantidadDeEstudiantesPorHoja', 'confComportamiento','areas','unidades_a','sabana',
                'confDHI','dhi', 'tipo'
            ))->setOrientation('landscape');
        }

        return $pdf->download('Sábana.pdf');
    }

    public function Oldsabana($curso){
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		$tituloTitle = 'Sábana';
		$titutloEncabezado = 'Cuadro de calificaciones finales';
        $course = Course::find($curso);
        $institution = Institution::find(1);
        $now = Carbon::now();
        $matters = Matter::where(['idCurso' => $course->id, 'visible' => 1, 'idPeriodo' => $this->idPeriodoUser()])
            ->where('nombre', '!=', 'PROYECTOS ESCOLARES')
            ->orderBy('area')
            ->get();
            foreach ($matters as $materia) {
                if($materia->idArea == null){
                     return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            }
            }
		$students = Student2Profile::getStudentsByCourse($curso);
		$countMaterias = 0;
		$cantidadDeEstudiantes = count($students);
		$cantidadDeEstudiantesPorHoja = 20;
		$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHoja;
		$sliceEstudiantes = 0;
		$count = 1;
		$reinicioCantidadDeEstudiantesPorHoja = $cantidadDeEstudiantesPorHoja;
        $proyecto = new Matter();
        if( $course->seccion != 'BGU'){
            $proyecto = Matter::where(['idCurso' => $curso, 'visible' => 1])
                ->where('idPeriodo', $this->idPeriodoUser())
                ->where('nombre', 'LIKE', '%PROYECTO%')
                ->first();
        }
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
        $promediosQ1 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q1');
        $promediosQ2 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q2');
        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($curso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($curso);
        $supletorios = [];
        $remediales = [];
        $gracias = [];
        foreach($matters as $matter){
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
        }
		$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.sabana-por-curso',
			compact(
				'course', 'institution', 'matters', 'students', 'promediosAnuales', 'supletorios',
				'proyecto','remediales', 'gracias', 'promediosFinales', 'notasMenores', 'nota_menor',
				'promediosQ1', 'promediosQ2', 'sliceEstudiantes', 'titutloEncabezado', 'tituloTitle',
				'cantidadDeEstudiantesPorHojaSumatoria', 'cantidadDeEstudiantesPorHoja',
				'cantidadDeEstudiantes', 'count','countMaterias', 'reinicioCantidadDeEstudiantesPorHoja', 'confComportamiento'
            ))->setOrientation('landscape');;
		return $pdf->download('Sábana.pdf');
    }
    /**/

    /*
	Sábana Supletorio
    */
    public function sabanaSupletorio($curso){
		$tituloTitle = 'Sábana Supletorio';
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		$titutloEncabezado = 'Cuadro de calificaciones finales supletorio';
        $course = Course::find($curso);
        $institution = Institution::find(1);
        $now = Carbon::now();
        $matters = Matter::getMattersByCourse($curso);
        $students = Student2::getStudentsByCourse($curso);

		$cantidadDeEstudiantes = count($students);
		$cantidadDeEstudiantesPorHoja = 20;
		$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHoja;
		$sliceEstudiantes = 0;
		$count = 1;
		$reinicioCantidadDeEstudiantesPorHoja = $cantidadDeEstudiantesPorHoja;

		$proyecto = null;
        if( $course->seccion != 'BGU'){
            $proyecto = Matter::where(['idCurso' => $curso, 'visible' => 1])
            ->where('nombre', 'LIKE', '%PROYECTO%')
            ->first();
        }

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();

        $promediosQ1 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q1');
        $promediosQ2 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q2');

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($curso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($curso);

        $supletorios = [];
        $remediales = [];
        $gracias = [];
        foreach($matters as $matter){
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
        }

        // $supletorios = [];
        // foreach($matters as $matter){
        //     $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
        // }

        foreach($students as $key => $student){
            $supletorio = false;
            foreach($matters as $matter){
                if( ($promediosAnuales[$matter->id][$student->id] < 7 &&
                $promediosAnuales[$matter->id][$student->id] >=5 &&
                $promediosAnuales[$matter->id][$student->id] > 0)
                 )
                {
                    $supletorio = true;
				}
				if($promediosFinales[$matter->id][$student->id] == 0)
                    $supletorio = false;
                if ($supletorios[$matter->id][$student->id] <7 && $supletorios[$matter->id][$student->id] != 0)
                    $supletorio = false;
            }
            if (!$supletorio){
                $students->forget($key);
            }
        }

		$cantidadDeEstudiantes = count($students);

        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.old-sabana-por-curso',
        compact(
			'course', 'institution', 'matters', 'students', 'promediosAnuales', 'supletorios', 'proyecto',
			'remediales', 'gracias', 'promediosFinales', 'notasMenores', 'nota_menor', 'promediosQ1',
			'promediosQ2', 'sliceEstudiantes', 'titutloEncabezado', 'tituloTitle', 'confComportamiento',
			'cantidadDeEstudiantesPorHojaSumatoria', 'cantidadDeEstudiantesPorHoja', 'cantidadDeEstudiantes',
			'count','countMaterias', 'reinicioCantidadDeEstudiantesPorHoja', 'reinicioSlice'
		))->setOrientation('landscape');

		return $pdf->download('Sábana Supletorio.pdf');
	}
    /**/


    /*
	Sábana Remedial
    */
    public function sabanaRemedial($curso){
		$tituloTitle = 'Sábana Remedial';
		$titutloEncabezado = 'Cuadro de calificaciones finales remedial';
        $course = Course::find($curso);
        $institution = Institution::find(1);
        $now = Carbon::now();
        $matters = Matter::getMattersByCourse($curso);
        $students = Student2::getStudentsByCourse($curso);

		$cantidadDeEstudiantes = count($students);
		$cantidadDeEstudiantesPorHoja = 20;
		$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHoja;
		$sliceEstudiantes = 0;
		$count = 1;
		$reinicioCantidadDeEstudiantesPorHoja = $cantidadDeEstudiantesPorHoja;

        $proyecto = null;
        if( $course->seccion != 'BGU'){
            $proyecto = Matter::where(['idCurso' => $curso, 'visible' => 1])
            ->where('nombre', 'LIKE', '%PROYECTO%')
            ->first();
        }

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();

        $promediosQ1 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q1');
        $promediosQ2 = Calificacion::getPromedioFinalQuimestreCurso($curso, 'q2');

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($curso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($curso);

        $supletorios = [];
        $remediales = [];
        $gracias = [];
        foreach($matters as $matter){
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
        }

        $supletorios = [];
        $remediales = [];
        foreach($matters as $matter){
			$remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
			$supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
        }

        foreach($students as $key => $student){
            $supletorio = false;
            foreach($matters as $matter){
                if( ($promediosAnuales[$matter->id][$student->id] < 7 &&
                $promediosAnuales[$matter->id][$student->id] >=5 &&
                $promediosAnuales[$matter->id][$student->id] > 0)
                 && ($remediales[$matter->id][$student->id] >=7)
                 )
                {
                    $supletorio = true;
				}
				if($promediosFinales[$matter->id][$student->id] == 0)
                    $supletorio = false;
                if ($remediales[$matter->id][$student->id] <7 && $remediales[$matter->id][$student->id] != 0)
                    $supletorio = false;
            }
            if (!$supletorio){
                $students->forget($key);
            }
		}

		$cantidadDeEstudiantes = count($students);

        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.sabana-por-curso',
        compact(
        	'course',
        	'institution',
        	'matters',
        	'students',
        	'promediosAnuales',
        	'supletorios',
        	'proyecto',
			'remediales',
			'gracias',
			'promediosFinales',
			'notasMenores',
			'nota_menor',
			'promediosQ1',
			'promediosQ2',
			'sliceEstudiantes',
			'titutloEncabezado',
			'tituloTitle',
			'cantidadDeEstudiantesPorHojaSumatoria',
			'cantidadDeEstudiantesPorHoja',
			'cantidadDeEstudiantes',
			'count',
			'countMaterias',
			'reinicioCantidadDeEstudiantesPorHoja',
			'reinicioSlice'
		))->setOrientation('landscape');

        return $pdf->download('Sábana Remedial.pdf');
    }
    /**/


    /*
	Sábana Gracia
    */
    /**/
}
