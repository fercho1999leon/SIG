<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Sentinel;
use Exception;
use App\Student2Profile;
use App\Student2;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\ReportesExcelMatiz;
use App\Administrative;
use App\User;
use App\Usuario;

class ReportesExcelController extends Controller
{
    public function export(Request $request){
        Excel::create('Matriz Matriculados', function ($excel) use ( $request ) {
            $data = Student2::query('students2')
                ->select(
                        'students2.idProfile as id',
                        \DB::raw('(CASE
                        WHEN length(students2.ci) = 10 THEN "1"
                        ELSE "2"
                        END) AS tipoDocumentoId'), 
                        'ci as numeroIdentificacion',
                        \DB::raw('SPLIT(apellidos, " ", 1) as primerApellido'),
                        \DB::raw('SPLIT(apellidos, " ", 2) as segundoApellido'),
                        \DB::raw('SPLIT(nombres, " ", 1) as primerNombre'),
                        \DB::raw('SPLIT(nombres, " ", 2) as segundoNombre'), 
                        \DB::raw('(CASE
                        WHEN students2.sexo = "Masculino" THEN "1"
                        WHEN students2.sexo = "Femenino" THEN "2"
                        ELSE " "
                        END) AS sexoId'),
                        'students2_profile_per_year.genero as generoId',
                        'students2_profile_per_year.estado_civil as estadocivilId',
                        'students2_profile_per_year.Etnia_estudiante as etniaId',
                        'students2_profile_per_year.pueblo_nacionalidad as pueblonacionalidadId',
                        'students2_profile_per_year.tipos_de_sangre as tipoSangre',
                        'students2_profile_per_year.tienes_discapacidad as discapacidad',
                        'students2_profile_per_year.porcentaje_discapacidad as porcentajeDiscapacidad',
                        'students2_profile_per_year.carnet_conadis as numCarnetConadis',
                        'students2_profile_per_year.tipo_discapacidad as tipoDiscapacidad',
                        'students2.fechaNacimiento as fechaNacimiento',
                        'students2_profile_per_year.pais as paisNacionalidadId',
                        'students2_profile_per_year.genero as generoId',
                        \DB::raw('LPAD(students2_profile_per_year.provincia,2, 0) as provinciaNacimientoId'),
                        \DB::raw('LPAD(students2_profile_per_year.canton,4, 0) as cantonNacimientoId'),
                        'students2_profile_per_year.pais_residencia as paisResidenciaId',
                        \DB::raw('LPAD(students2_profile_per_year.provincia_residencia,2, 0) as provinciaResidenciaId'),
                        \DB::raw('LPAD(students2_profile_per_year.canton_residencia,4, 0) as cantonResidenciaId'),
                        'students2.tipoColegioId as tipoColegioId',//falta asociar valor
                        'students2.modalidadCarrera as modalidadCarrera', //falta asociar valor
                        'students2.jornadaCarrera as jornadaCarrera',//falta asociar valor
                        'students2.fechaInicioCarrera as fechaInicioCarrera', //no se encontro se tomo la fecha de creacion de usuario
                        'students2_profile_per_year.fecha_matriculacion as fechaMatricula',
                        'students2_profile_per_year.tipo_matricula as tipoMatriculaId',
                        'students2_profile_per_year.nivelAcademicoQueCursa as nivelAcademicoQueCursa', 
                        'students2.duracionPeriodoAcademico as duracionPeriodoAcademico', //falta asociar valor
                        'students2.haRepetidoAlMenosUnaMateria as haRepetidoAlMenosUnaMateria', //falta asociar valor
                        'courses.paralelo as paraleloId',
                        'students2.haPerdidoLaGratuidad as haPerdidoLaGratuidad', //falta asociar valor
                        'students2.recibePensionDiferenciada as recibePensionDiferenciada', //falta asociar valor
                        'students2.estudianteocupacionId as estudianteocupacionId', // Falta asociar
                        'students2.ingreso_actividad as ingresosestudianteId',

                        //no se encontro registro en las tablas asociadas 
                        'students2.bonodesarrolloId as bonodesarrolloId',
                        'students2.haRealizadoPracticasPreprofesionales as haRealizadoPracticasPreprofesionales',
                        'students2.nroHorasPracticasPreprofesionalesPorPeriodo as nroHorasPracticasPreprofesionalesPorPeriodo',
                        'students2.entornoInstitucionalPracticasProfesionales as entornoInstitucionalPracticasProfesionales',//falta
                        'students2.sectorEconomicoPracticaProfesional as sectorEconomicoPracticaProfesional',//falta
                        'students2.tipoBecaId as tipoBecaId',
                        'students2.primeraRazonBecaId as primeraRazonBecaId',
                        'students2.segundaRazonBecaId as segundaRazonBecaId',
                        'students2.terceraRazonBecaId as terceraRazonBecaId',
                        'students2.cuartaRazonBecaId as cuartaRazonBecaId',
                        'students2.quintaRazonBecaId as quintaRazonBecaId',
                        'students2.sextaRazonBecaId as sextaRazonBecaId',
                        'students2.porcientoBecaCoberturaArancel as porcientoBecaCoberturaArancel',
                        'students2.porcientoBecaCoberturaManuntencion as porcientoBecaCoberturaManuntencion',
                        'students2.financiamientoBeca as financiamientoBeca',
                        'students2.montoAyudaEconomica as montoAyudaEconomica',
                        'students2.montoCreditoEducativo as montoCreditoEducativo',
                        'students2.participaEnProyectoVinculacionSociedad as participaEnProyectoVinculacionSociedad',
                        'students2.tipoAlcanceProyectoVinculacionId as tipoAlcanceProyectoVinculacionId',
                        //hasta el momento esto tampoco se

                        'students2.facturacion_correo as correoElectronico',//no esta el correo e las tablas 
                        'students2_profile_per_year.telefono_movil as numeroCelular',
                        //Faltan estos datos 
                        'students2.nivelFormacionPadre as nivelFormacionPadre',
                        
                        'students2.nivelFormacionMadre as nivelFormacionMadre',
                        'students2.ingresoTotalHogar as ingresoTotalHogar',
                        'students2.cantidadMiembrosHogar as cantidadMiembrosHogar'

                        )
                ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->where('students2_profile_per_year.idCurso',$request->idcurso)
                ->get();
            foreach($data as $update){
                $update->correoElectronico = Usuario::where('id',(User::where('id',$update->id)->first())->userid)->first()->email;
            }
            $excel->setTitle('Matriz_Matriculados');
            $excel->setCreator('ISTRED')->setCompany('ISTRED');
            $excel->setDescription('Matriz de Matriculados');
            $excel->sheet('Matriz_Matriculados', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, NULL, 'A1');
            });
        })->export('xls');
        
        //return Excel::download(new ReportesExcelMatiz, 'users.xlsx');
    }
    public function exportDocente(){
        Excel::create('matriz_docentes', function ($excel) {
            $data = Administrative::query('users_profile')
                ->select(
                        'tipoDocumentoId',
                        'users_profile.ci as numeroIdentificacion',
                        \DB::raw(' SPLIT( apellidos, " ", 1) as primerApellido'),
                        \DB::raw(' SPLIT( apellidos, " ", 2) as segundoApellido'),
                        \DB::raw(' SPLIT( nombres, " ", 1) as primerNombre'),
                        \DB::raw(' SPLIT( nombres, " ", 2) as segundoNombre'),   
                        \DB::raw('(CASE
                        WHEN sexo = "Masculino" THEN "1"
                        WHEN sexo = "Femenino" THEN "2"
                        ELSE " "
                        END) AS sexoId'),
                        'genero as generoId',
                        'estadocivilId',
                        'etniaId',
                        'pueblo_nacionalidadId as pueblonacionalidadId',
                        'dDomicilio as direccionDomiciliaria',
                        'provinciaSufragio',
                        'movil as numeroCelular',
                        'correo as correoElectronico',
                        'tDomicilio as numDomicilio',
                        'discapacidad','porcentajeDiscapacidad',
                        'numCarnetDiscapacidad', 'tipoDiscapacidad','tipoEnfermedadCatastrofica',
                        'fNacimiento as fechaNacimiento','paisNacionalidadId','nivelFormacion',
                        'fechaIngresoIES','fechaSalidaIES','relacionLaboralIESId',
                        'ingresoConConcursoMeritos','escalafonDocenteId','cargoDirectivoId',
                        'tiempoDedicacionId', 'nombreUnidadAcademica','nroasignaturasdocente',
                        'nroHorasLaborablesSemanaEnCarreraPrograma','nroHorasClaseSemanaCarreraPrograma',
                        'nroHorasInvestigacionSemanaCarreraPrograma','nroHorasAdministrativasSemanaCarreraPrograma',
                        'nroHorasOtrasActividadesSemanaCarreraPrograma','nroHorasVinculacionSociedad',
                        'salarioMensual','docenciaTecnicoSuperior','docenciaTecnologico','estaEnPeriodoSabatico',
                        'fechaInicioPeriodoSabatico','estaCursandoEstudiosId','institucionDondeCursaEstudios',
                        'paisEstudiosId','tituloAObtener','poseeBecaId','tipoBecaId','montoBeca','financiamientoBecaId',
                        'pubRevistasCienInIndexadasId','numPubRevistasCientifIndexadas'
                )                  
                ->where('cargo', 'Docente')
                //->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->get();
       
            $excel->setTitle('Matriz_Docentes');
            $excel->setCreator('ISTRED')->setCompany('ISTRED');
            $excel->setDescription('Matriz de Docentes');
            $excel->sheet('Matriz_Docentes', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, NULL, 'A1');
            });
        })->export('xls');
    }
}
