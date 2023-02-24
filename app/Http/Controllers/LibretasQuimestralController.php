<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Calificacion;
use App\Destreza;
use App\Course;
use Illuminate\Support\Str;
use App\Matter;
use App\Institution;
use DB;
use App\Administrative;
use App\ConfiguracionSistema;
use App\CourseAssistance;
use PDF;
use Carbon\Carbon;
use App\Fechas;
use App\PeriodoLectivo;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use Illuminate\Support\Facades\Redirect;
use App\Student2Profile;
use App\Area;
use Sentinel;

class LibretasQuimestralController extends Controller
{
    /*
	Libretas Destrezas
    */
    public function libretaDestreza($curso, $parcial){
		//$students = Student2::where('idCurso', $curso)->where('matricula', '!=', 'Pre Matricula')->where('retirado', '!=', 'SI')->orderBy('apellidos')->get();
        $students = Student2::getStudentsByCourse($curso);
        $estudiantes = Student2Profile::whereIn('idStudent', $students->pluck('id'))->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
		$institucion = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $course = Course::find($curso);
        $nQuimestre = substr($parcial,3,1);
        $quimestre =  $nQuimestre;
        $n_parcial =  substr($parcial,1,1);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->where('clasesdestrezas.parcial', 'EX' . substr($parcial, 2, 2))
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion', 'clasesdestrezas.parcial')
            ->get();
        $asistenciaCurso = CourseAssistance::query()
			->where('idCurso', $curso)
			->whereIn('parcial', ["p1{$quimestre}","p2{$quimestre}","p3{$quimestre}"])
			->get();
        $totalAsistenciaDelCurso = 0;
		foreach ($asistenciaCurso as $asistenciaCurso) {
			$totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
        }
		$institution = Institution::find(1);
		$seccion = $course->seccion;
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-destreza-quimestre', compact(
            'representantes', 'tutor', 'parcial', 'institution', 'matters', 'course', 'students', 'destrezas', 'seccion', 'periodo',
            'quimestre', 'n_parcial' , 'nQuimestre', 'estudiantes'
		));

		return $pdf->download('Reporte Destrezas Quimestral.pdf');
	}
	/**/


    /*
	Libreta Destrezas por Estudiante
    */
    public function libretaDestrezaAlumno($curso, $parcial, $idEstudiante){

        $students = Student2::where('id', $idEstudiante)->get();
        $estudiantes = Student2Profile::where('idStudent', $students->first()->id)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
		$institucion = Institution::find(1);
        $course = Course::find($curso);
        $nQuimestre = ( strlen($parcial)==4 ? substr($parcial,3,1) : substr($parcial,1,1) );
        $quimestre =  $nQuimestre;
        $n_parcial =  "";
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion', 'clasesdestrezas.parcial')
            ->get();
        $asistenciaCurso = CourseAssistance::query()
			->where('idCurso', $curso)
			->whereIn('parcial', ["p1{$quimestre}","p2{$quimestre}","p3{$quimestre}"])
			->get();
        $totalAsistenciaDelCurso = 0;
		foreach ($asistenciaCurso as $asistenciaCurso) {
			$totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
        }
		$institution = Institution::find(1);
		$seccion = $course->seccion;
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-destreza-quimestre', compact(
			'representantes', 'tutor', 'parcial', 'periodo', 'institution', 'matters', 'course', 'students',
			'destrezas', 'seccion', 'quimestre', 'n_parcial' , 'nQuimestre', 'estudiantes'
		));

		return $pdf->download('Reporte Destrezas Quimestral.pdf');
    }

    public function informeQuimestralDestrezasEstudiantes($curso,$parcial,$idEstudiante){

        $q= ( strlen($parcial) == 2 ? $parcial : ( strlen($parcial) == 3 ? substr($parcial, 0, 2) : substr($parcial, 2, 2) ) );        
        $nQuimestre = substr($q,1,1);
        $quimestre = $nQuimestre;
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $q)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $students = Student2Profile::getStudentsByCourse($curso);
        $students = $students->where('idStudent', $idEstudiante);
        $course = Course::find($curso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
             ->orderBy('areas.posicion')->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();        
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $informe = "";
        $area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/'.$q.'/curso/'.$curso)));            
        $pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.quimestral.informe-cualitativo-quimestral-curso',
			compact( 'representantes', 'tutor', 'institution', 'matters', 'course',
			'students', 'destrezas', 'data', 'area_pos',
			'informe', 'periodo','quimestre','parcialP','unidad','nQuimestre'
		))->setOrientation('landscape');
		return $pdf->download('Informe Cualitativo Quimestral Detallado.pdf');
	}
    
	/**/


    /*
	Libreta Quimestre libreta
    */
    public function libreta($idCurso, $quimestre){
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
		$nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		$asistenciaCurso = CourseAssistance::query()
			->where('idCurso', $idCurso)
			->whereIn('parcial', ["p1{$quimestre}","p2{$quimestre}","p3{$quimestre}"])
			->get();
        $totalAsistenciaDelCurso = 0;
		foreach ($asistenciaCurso as $asistenciaCurso) {
			$totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
		}
		$confDHI = ConfiguracionSistema::configuracionDHI();
        $studentsprofile = Student2Profile::getStudentsByCourse($idCurso);
        $students = Student2::whereIn('id', $studentsprofile->pluck('idStudent'))->get();
        //$students = Student2::getStudentsByCourse($idCurso);
		$curso = Course::find($idCurso);
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $seccion = $curso->seccion;
        $n_parcial = '';
        $now = Carbon::now();
        $tutor = Administrative::find($curso->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
		$dhi = Matter::where(['idCurso' => $idCurso,'area' => 'DESARROLLO HUMANO INTEGRAL',
			'visible' => 0,'principal' => 0
		])->first();
        $reps = [];
        foreach($students as $student){
            if( $student->idRepresentante != null)
                array_push($reps, $student->idRepresentante);
        }
        $representantes = Administrative::whereIn('id',$reps)->get();
            $allMatters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            //foreach ($allMatters as $materia) {
                 //   if($materia->idArea == null){
                 //   return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                 //   }
              //  }
            $materiasFijas = count($allMatters->where('principal',1));
            $materiasExtra = count($allMatters->where('principal',0));

        $nQuimestre = substr($quimestre,1,1);
        $data2 = json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/'.$quimestre.'/curso/'.$idCurso));
        if($tipo_libreta=='0'){
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre',compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution',  'dhi','confDHI', 'quimestre', 'now','representantes', 'pp1', 'pp2', 'pp3', 'pexa', 'pP', 'pR', 'pPQ1', 'notasMenores', 'n_parcial', 'periodo','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','seccion','matters','promedios','PromedioInsumo','area_pos','data2','allMatters'));
        }elseif($tipo_libreta=='1'){
           $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre2',compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'quimestre', 'now', 'dhi','confDHI','representantes','notasMenores', 'n_parcial', 'seccion', 'periodo','allMatters','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','promedios','PromedioInsumo','area_pos','data2'))->setOrientation('landscape');
        }else{
           $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre3',compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'quimestre', 'now','representantes','notasMenores', 'n_parcial', 'seccion', 'periodo','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','promedios','PromedioInsumo','area_pos','nQuimestre','allMatters','data2'))->setOrientation('landscape');
		}
		return $pdf->download('Libreta Quimestral.pdf');
    }
     public function libreta_old($idCurso, $quimestre){
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $asistenciaCurso = CourseAssistance::query()
            ->where('idCurso', $idCurso)
            ->whereIn('parcial', ["p1{$quimestre}","p2{$quimestre}","p3{$quimestre}"])
            ->get();

        $totalAsistenciaDelCurso = 0;
        foreach ($asistenciaCurso as $asistenciaCurso) {
            $totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
        }
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $studentsprofile = Student2Profile::getStudentsByCourse($idCurso);
        $students = Student2::whereIn('id', $studentsprofile->pluck('idStudent'))->get();
        $curso = Course::find($idCurso);
        $tutor = Administrative::find($curso->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $dhi = Matter::where(['idCurso' => $idCurso,'nombre' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0,'principal' => 0
        ])->first();
        $reps = [];
        foreach($students as $student){
            if( $student->idRepresentante != null)
                array_push($reps, $student->idRepresentante);
        }
        $representantes = Administrative::whereIn('id',$reps)->get();
        $matters = Matter::where('idCurso',$idCurso)->orderBy('nombre')->get();
        $materias = ['LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMÁTICA','CIENCIAS NATURALES', 'CIENCIAS SOCIALES',
            'ESTUDIOS SOCIALES', 'EDUCACIÓN FÍSICA', 'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'COMPUTACIÓN'];
        $materiasFijas = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],
            ['principal', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderByRaw("FIELD(nombreArea, 'LENGUA Y LITERATURA', 'MATEMÁTICA', 'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'EDUCACIÓN FÍSICA', 'INGLES')");
        $materiasExtra = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 0])->get();
        $proyecto = Matter::where('area', $materias)->where('area', 'PROYECTOS ESCOLARES')->get();

        #calificaciones
        $promediosP1 = [];
        $promediosP2 = [];
        $promediosP3 = [];
        foreach($matters as $matter){
            foreach ($parcialP as $par) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1'.$quimestre:
                        $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1'.$quimestre);
                        break;
                    case 'p2'.$quimestre:
                        $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2'.$quimestre);
                        break;
                    case 'p3'.$quimestre:
                        $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3'.$quimestre);
                        break;
                    case $quimestre:
                        $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id,$quimestre);
                        $recuperacion[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,$quimestre);
                        break;
                }
            }
            $promediosTotal[$matter->id] = [];
            $promediosFinal[$matter->id] = [];
            $division = count($parcialP)-1;
            $P1=0; $P2=0; $P3=0; $Ex=0;
            $variable ='';
            foreach($students as $s){
                if ((isset($promediosP1)) && ($promediosP1 != [])) {
                    $P1=$promediosP1[$matter->id][$s->id]['promedio'];
                    $variable.= '$P1 !=0 ';
                }else{
                    $promediosP1 = [];
                }
                if ((isset($promediosP2)) && ($promediosP2 != [])) {
                    $P2=$promediosP2[$matter->id][$s->id]['promedio'];
                    $variable.= ' && $P2 !=0 ';
                }else{
                    $promediosP2 = [];
                }
                if ((isset($promediosP3)) && ($promediosP3 != [])) {
                    $P3=$promediosP3[$matter->id][$s->id]['promedio'];
                    $variable.= ' && $P3 !=0 ';
                }else{
                    $promediosP3 = [];
                }
                if (isset($examenes)) {
                    $Ex=$examenes[$matter->id][$s->id];
                    $variable.= ' && $Ex != 0';
                }
                if($variable){// reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales =bcdiv( ($P1 +
                        $P2 +
                        $P3) /$division, '1', 2);
                    $promediosTotal[$matter->id][$s->id] =  bcdiv( ($parciales *0.8) + ($examenes[$matter->id][$s->id]*0.2), '1', 2);
                    $ex = ($examenes[$matter->id][$s->id] < $recuperacion[$matter->id][$s->id])?$recuperacion[$matter->id][$s->id]:$examenes[$matter->id][$s->id];
                    $promediosFinal[$matter->id][$s->id] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                }else{
                    $promediosTotal[$matter->id][$s->id] = 0;
                    $promediosFinal[$matter->id][$s->id] = 0;
                }
            }
        }
        $pp1=0; $pp2=0; $pp3=0; $pexa=0; $pP=0; $pR=0; $pPQ1=0;
        $now = Carbon::now();
        $seccion = $curso->seccion;
        $n_parcial = '';
        if($tipo_libreta=='0'){
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre',
                compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'promediosP1', 'dhi', 'promediosP2',
                'promediosP3', 'examenes', 'promediosTotal', 'proyecto', 'recuperacion', 'promediosFinal', 'confDHI', 'quimestre', 'now',
                'representantes', 'pp1', 'pp2', 'pp3', 'pexa', 'pP', 'pR', 'pPQ1', 'notasMenores', 'n_parcial', 'seccion', 'periodo',
                'confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP'
            ));
        }else{
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre2',
                compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'promediosP1', 'dhi', 'promediosP2',
                'promediosP3', 'examenes', 'promediosTotal', 'proyecto', 'recuperacion', 'promediosFinal', 'confDHI', 'quimestre', 'now',
                'representantes', 'pp1', 'pp2', 'pp3', 'pexa', 'pP', 'pR', 'pPQ1', 'notasMenores', 'n_parcial', 'seccion', 'periodo',
                'confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','nQuimestre'
            ));
        }
        return $pdf->download('Libreta Quimestral.pdf');
    }

    /*
	Libreta Quimestre por Estudiante libretaQuimestralAlumno
    */
    public function libretaQuimestralAlumno($idCurso, $quimestre, $idAlumno){
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
		$nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		$confDHI = ConfiguracionSistema::configuracionDHI();
        $students = Student2::where('id',$idAlumno)->orderBy('nivelDeIngles')->orderBy('apellidos')->get();
        $curso = Course::find($idCurso);
        $seccion = $curso->seccion;
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $tutor = Administrative::find($curso->idProfesor);
        $now = Carbon::now();
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $reps = [];
        $n_parcial = '';
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
		$dhi = Matter::where(['idCurso' => $idCurso, 'nombre' => 'DESARROLLO HUMANO INTEGRAL',
			'visible' => 0, 'principal' => 0
        ])->first();
        $asistenciaCursos = CourseAssistance::query()
			->where('idCurso', $idCurso)
			->whereIn('parcial', ["p1{$quimestre}","p2{$quimestre}","p3{$quimestre}"])
			->get();
        foreach($students as $student){
            if( $student->idRepresentante != null)
                array_push($reps, $student->idRepresentante);
        }
        $representantes = Administrative::whereIn('id',$reps)->get();
        $matters = Matter::where('idCurso',$idCurso)->orderBy('nombre')->get();
        $materias = [
            'LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMÁTICA',
            'CIENCIAS NATURALES', 'CIENCIAS SOCIALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN FÍSICA',
            'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'COMPUTACIÓN'
        ];
        $totalAsistenciaDelCurso = 0;
		foreach ($asistenciaCursos as $asistenciaCurso) {
			$totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
		}
        $allMatters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
        $materiasFijas = count($allMatters->where('principal',1));
        $materiasExtra = count($allMatters->where('principal',0));
            $data2 = json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/'.$quimestre.'/curso/'.$idCurso));
            $nQuimestre = substr($quimestre,1,1);
            if($tipo_libreta=='0'){
               $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre',compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution',  'dhi','confDHI', 'now','representantes', 'notasMenores', 'n_parcial', 'periodo','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','seccion','PromedioInsumo','data2','area_pos','allMatters','quimestre'));
            }elseif($tipo_libreta=='1'){
               $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre2', compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'dhi', 'confDHI', 'quimestre', 'now','representantes','notasMenores', 'n_parcial', 'seccion', 'periodo','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','PromedioInsumo', 'area_pos','nQuimestre','data2','allMatters'));
            }else{
                $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.libreta-por-quimestre3',compact('students', 'curso', 'tutor', 'materiasFijas', 'materiasExtra', 'institution', 'dhi', 'confDHI', 'quimestre', 'now','representantes','notasMenores', 'n_parcial', 'seccion', 'periodo','confComportamiento', 'totalAsistenciaDelCurso', 'nombre_representante_libreta_parcial','parcialP','PromedioInsumo', 'area_pos','nQuimestre','data2','allMatters'));
            }
        return $pdf->download('Libreta Quimestral.pdf');
    }
    /**/

    public function examenesPendientes($idCurso, $quimestre){
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $students = Student2::getStudentsByCourse($idCurso);
        $curso = Course::find($idCurso);
        $tutor = Administrative::find($curso->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $array_examen=[];

        $matters = Matter::where('idCurso',$idCurso)->where('principal',1)->get();
        $materias = [
            'LENGUA Y LITERATURA','LENGUA EXTRANJERA','MATEMÁTICA','CIENCIAS NATURALES','CIENCIAS SOCIALES','ESTUDIOS SOCIALES','EDUCACIÓN FÍSICA','EDUCACIÓN CULTURAL Y ARTÍSTICA','COMPUTACIÓN'];

        $materiasFijas = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 1])
            ->orderByRaw("FIELD(area,'LENGUA Y LITERATURA','MATEMÁTICA','CIENCIAS NATURALES','CIENCIAS SOCIALES','EDUCACIÓN CULTURAL Y ARTÍSTICA','EDUCACIÓN FÍSICA','LENGUA EXTRANJERA','COMPUTACIÓN')")
            ->get();

        $materiasExtra = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 0])->get();

        $proyecto = Matter::where('area', $materias)->where('area', 'PROYECTOS ESCOLARES')->get();
 foreach($matters as $matter){
            foreach ($parcialP as $par) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1'.$quimestre:
                        $promediosP1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p1'.$quimestre);
                        break;
                    case 'p2'.$quimestre:
                        $promediosP2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p2'.$quimestre);
                        break;
                    case 'p3'.$quimestre:
                        $promediosP3[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p3'.$quimestre);
                        break;
                    case $quimestre:
                        $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id,$quimestre);
                        foreach ($examenes[$matter->id] as $value) {
                            if ($value == 0) {
                              array_push($array_examen, $matter->id);
                            }
                        }
                        $recuperacion[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,$quimestre);
                        break;
                }
            }
            $promediosTotal[$matter->id] = [];
            $promediosFinal[$matter->id] = [];
            $division = count($parcialP)-1;
            $P1=0; $P2=0; $P3=0; $Ex=0;
            $variable ='';
            foreach($students as $s){
                if ((isset($promediosP1)) && ($promediosP1 != [])) {
                    $P1=$promediosP1[$matter->id][$s->id]['promedio'];
                    $variable.= '$P1 !=0 ';
                }else{
                    $promediosP1 = [];
                }
                if ((isset($promediosP2)) && ($promediosP2 != [])) {
                    $P2=$promediosP2[$matter->id][$s->id]['promedio'];
                     $variable.= ' && $P2 !=0 ';
                }else{
                    $promediosP2 = [];
                }
                if ((isset($promediosP3)) && ($promediosP3 != [])) {
                    $P3=$promediosP3[$matter->id][$s->id]['promedio'];
                    $variable.= ' && $P3 !=0 ';
                }else{
                    $promediosP3 = [];
                }
                if (isset($examenes)) {
                    $Ex=$examenes[$matter->id][$s->id];
                    $variable.= ' && $Ex != 0';
                }
                if($variable){// reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales =bcdiv( ($P1 +
                    $P2 +
                    $P3) /$division, '1', 2);
                    $promediosTotal[$matter->id][$s->id] =  bcdiv( ($parciales *0.8) + ($examenes[$matter->id][$s->id]*0.2), '1', 2);
                    $ex = ($examenes[$matter->id][$s->id] < $recuperacion[$matter->id][$s->id])?$recuperacion[$matter->id][$s->id]:$examenes[$matter->id][$s->id];
                    $promediosFinal[$matter->id][$s->id] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                }else{
                    $promediosTotal[$matter->id][$s->id] = 0;
                    $promediosFinal[$matter->id][$s->id] = 0;
                }
            }
        }
        $pp1=0; $pp2=0; $pp3=0; $pexa=0; $pP=0; $pR=0; $pPQ1=0;
        $now = Carbon::now();
        $seccion = $curso->seccion;
        $n_parcial = '';
        $matters = $matters->whereIn('id', $array_examen);
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.examenes-pendientes',
        compact('students','curso', 'promediosFinal','tutor','notasMenores','institution','periodo','matters','promediosP1','promediosP2','promediosP3','parcialP',
        'examenes','seccion','quimestre'));
        return $pdf->download('Examenes Pendientes.pdf');
    }
}
