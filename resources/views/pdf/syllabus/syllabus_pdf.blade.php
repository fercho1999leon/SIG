@php
use App\Http\Controllers\StudentController;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;
use App\PreCoRequisitos;
use App\Informacion;
use App\Matter;
use App\PeriodoLectivo;
use App\DescripcionSyllabus;
use App\RequestUser;
use App\PerfilEgreso;
use App\ReferenciaApa;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ContenidoController;

$unidades = UnidadController::getUnidadesBySyllabus($syllabus->id);
$materia = Matter::find($syllabus->materia_id);
$periodoLectivo = PeriodoLectivo::find($materia->idPeriodo);

use App\Http\Controllers\InstitutionController;
$nombreInstituto = str_replace('"', '', InstitutionController::getInstitution()->nombre);
$leheaderstituto = str_replace('"', '', InstitutionController::getInstitution()->lema);
$contador = 1;
$horasTotales = 0;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Syllabus {{ $syllabus->nombre }}</title>
    <link rel="stylesheet" href="{{ secure_asset('css/syllabus/syllabus.css') }}" />
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-250">
    <!--ENCABEZADO LOGO/INSTITUCION-->
    @include('partials.encabezados.reporte_global.reporte_global_encabezado_institution')
    {{-- I. Información general --}}
    <div class="container-sm">
        @php
            $informacion_general = Informacion::where('syllabus_id', $syllabus->id)->first();
        @endphp
        <h4 class="text-uppercase textoSubtitulo">I. Información general</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead class="contenido">
                <tr>
                    <th style="width: 10%">1.1</th>
                    <td style="width: 40%" class="titular">Carrera</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $carrera->nombre }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.2</th>
                    <td style="width: 40%" class="titular">Asignatura</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $materia->nombre }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.3</th>
                    <td style="width: 40%" class="titular">Código de Asignatura</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">
                        {{ $informacion_general->codigo_asignatura }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.4</th>
                    <td style="width: 40%" class="titular">Créditos</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $informacion_general->creditos }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">1.5</th>
                    <td style="width: 40%" class="titular">Nivel</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $semestre->nombsemt }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.7</th>
                    <td style="width: 40%" class="titular">Unidad de Organización Curricular</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">
                        {{ $informacion_general->unidad_curricular }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.7</th>
                    <td style="width: 40%" class="titular">Tipo de Asignatura</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">
                        {{ $informacion_general->tipo_asignatura }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.8</th>
                    <td style="width: 40%" class="titular">Periodo Lectivo</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $periodoLectivo->nombre }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">1.9</th>
                    <td style="width: 40%" class="titular">Profesor de la Asignatura</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase">{{ $docente->nombres }}
                        {{ $docente->apellidos }} </td>
                </tr>
                <tr>
                    <th style="width: 10%">1.10</th>
                    <td style="width: 40%" class="titular">Horas Semanales</td>
                    <td style="width: 50%" colspan="6" class="text-uppercase textoMiddle">
                        {{ $informacion_general->horas_semanales }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.11</th>
                    <td style="width: 40%" class="titular">Horas Clase Totales</td>
                    <td style="width: 100%" colspan="6" class="text-uppercase textoMiddle">
                        {{ $informacion_general->horas_clase }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.11.1</th>
                    <td style="width: 40%" class="titular">Detalles de Horas</td>
                    <td style="width: 10%" colspan="1" class="titular">Teóricas</td>
                    <td style="width: 10%" class="text-uppercase textoMiddle">
                        {{ $informacion_general->teoricas }}</td>
                    <td style="width: 10%" colspan="1" class="titular">Prácticas</td>
                    <td style="width: 10%" class="text-uppercase textoMiddle">
                        {{ $informacion_general->practicas }}</td>
                    <td style="width: 10%" colspan="1" class="titular">Autónomas</td>
                    <td style="width: 10%" class="text-uppercase textoMiddle">
                        {{ $informacion_general->autonomas }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.12</th>
                    <td style="width: 40%" class="titular">Horas de Tutorías Totales</td>
                    <td style="width: 50%" colspan="6" class="textoMiddle">
                        {{ $informacion_general->horas_tutoria }}</td>
                </tr>
                <tr>
                    <th style="width: 10%">1.12.1</th>
                    <td style="width: 40%" class="titular">Detalle de Horas</td>
                    <td style="width: 10%" colspan="1" class="titular">Presenciales</td>
                    <td style="width: 10%" class="text-uppercase textoMiddle">
                        {{ $informacion_general->presenciales }}</td>
                    <td style="width: 10%" colspan="1" class="titular">Virtuales</td>
                    <td style="width: 10%" class="text-uppercase textoMiddle">
                        {{ $informacion_general->virtuales }}</td>
                    <td style="width: 10%" colspan="2" class="titular"></td>
                </tr>
            </thead>
        </table>
    </div>
    {{-- II. Prerrequisitos y correquisitos --}}
    <div class="container-sm saltoPagina">
        @php
            $pre_co_requisitos = PreCoRequisitos::where('syllabus_id', $syllabus->id)->first();
        @endphp
        <h4 class="text-uppercase textoSubtitulo">II. Prerrequisitos y correquisitos</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th colspan="2" style="width: 50%" class="titular textoMiddle">Prerrequisitos</th>
                    <th colspan="2" style="width: 50%" class="titular textoMiddle">correquisitos</th>
                </tr>
                <tr>
                    <th style="width: 25%" class="titular textoMiddle">Asignatura</th>
                    <th style="width: 25%" class="titular textoMiddle">Código</th>
                    <th style="width: 25%" class="titular textoMiddle">Asignatura</th>
                    <th style="width: 25%" class="titular textoMiddle">Código</th>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <th colspan="1" style="width: 25%" class="contenido text-uppercase textoMiddle">
                        {{ $pre_co_requisitos->materia_pre }}</th>
                    <th colspan="1" style="width: 25%" class="contenido text-uppercase textoMiddle">
                        {{ $pre_co_requisitos->materia_pre_cod }}</th>
                    <th colspan="1" style="width: 25%" class="contenido text-uppercase textoMiddle">
                        {{ $pre_co_requisitos->materia_co }}</th>
                    <th colspan="1" style="width: 25%" class="contenido text-uppercase textoMiddle">
                        {{ $pre_co_requisitos->materia_co_cod }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- III. Descripción de la asignatura --}}
    @php
        $descripcion_syllabus = DescripcionSyllabus::where('syllabus_id', $syllabus->id)->first();
    @endphp
    <div class="container-sm">

        <h4 class="text-uppercase textoSubtitulo">III. Descripción de la asignatura</h4>
        <p class="text-uppercase contenido">{{ $descripcion_syllabus->descripcion }}</p>

    </div>
    {{-- IV. Objetivo de la asignatura --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">IV. Objetivo de la asignatura</h4>
        <p class="text-uppercase contenido">{{ $descripcion_syllabus->objetivo }}</p>

    </div>
    {{-- V. Resultados de aprendizaje de la asignatura --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">V. Resultados de aprendizaje de la asignatura</h4>
        <p class="text-uppercase contenido">{{ $descripcion_syllabus->resultados }}</p>
    </div>
    {{-- VI. Contribución de la asignatura en la formación del profesional
            (perfil de egreso) --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">VI. Contribución de la asignatura en la formación del profesional
            (perfil de egreso)</h4>
        <p class="text-uppercase contenido">{{ $descripcion_syllabus->contribucion }}</p>
    </div>
    {{-- VII. Competencias genéricas de la asignatura (seleccionadas por los
            docentes de las 27 competencias genéricas del TUNING, de 3 a 5 por asignatura) --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">VII. Competencias genéricas de la asignatura (seleccionadas por los
            docentes de las 27 competencias genéricas del TUNING, de 3 a 5 por asignatura)</h4>
        <p class="text-uppercase contenido">{{ $descripcion_syllabus->competencias }}</p>
    </div>
    {{-- VIII. Unidades curriculares --}}
    <div class="container-sm saltoPagina">
        <h4 class="text-uppercase textoSubtitulo">VIII. Unidades curriculares</h4>
        @foreach ($unidades as $unidad)
            <h5 class="text-uppercase" id="textoUnidad">Unidad {{ $contador++ }}</h5>
            <table class="table table-bordered">
                <tr>
                    <th colspan="17" class="text-uppercase contenido">
                        <strong class="titular">Nombre de la unidad:</strong> {{ $unidad->nombre_unidad }}
                    </th>
                </tr>
                <tr>
                    <th colspan="17" class="text-uppercase contenido">
                        <strong class="titular">Objetivo de la unidad:</strong> {{ $unidad->objetivo }}
                    </th>
                </tr>
                <tr>
                    <th colspan="17" class="text-uppercase contenido">
                        <strong class="titular">Resultados de aprendizaje de la unidad:</strong>
                        {{ $unidad->aprendizaje }}
                    </th>
                </tr>

                <tr class="text-light text-center" style="background-color: white;">
                    <th colspan="2" class="text-uppercase titularTabla textoMiddle">Contenido</th>
                    <th colspan="1" class="text-uppercase titularTabla textoMiddle">Horas Totales</th>
                    <th colspan="1" class="text-uppercase titularTabla textoMiddle">Horas Prácticas</th>
                    <th colspan="1" class="text-uppercase titularTabla textoMiddle">Horas Autónomas</th>
                    <th colspan="4" class="text-uppercase titularTabla textoMiddle">
                        Actividades de trabajo
                        autónomo,
                        actividades de investigación y vinculación con la sociedad</th>
                    <th colspan="1" class="text-uppercase titularTabla textoMiddle">Mecánismo de Evaluación
                    </th>
                </tr>

                <tbody class="text-primary">
                    @php
                        $contenidos = ContenidoController::getContenidosByUnidad($unidad->id);
                    @endphp
                    @foreach ($contenidos as $contenido)
                        @if ($unidad->id == $contenido->unidad_id)
                            <tr>
                                <th colspan="2" class="text-uppercase contenido textoMiddle">
                                    {{ $contenido->titulo }}
                                </th>
                                <th colspan="1" class="text-uppercase contenido textoMiddle">
                                    {{ $contenido->horas_clase }}</th>
                                <th colspan="1" class="text-uppercase contenido textoMiddle">
                                    {{ $contenido->horas_practicas }}</th>
                                <th colspan="1" class="text-uppercase contenido textoMiddle">
                                    {{ $contenido->horas_autonomas }}</th>
                                <th colspan="4" class="text-uppercase contenido textoLargo textoMiddle">
                                    {{ $contenido->actividades }}
                                </th>
                                <th colspan="1" class="text-uppercase contenido textoMiddle">
                                    {{ $contenido->evaluacion }}
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="17" class="text-uppercase contenido">
                            <strong class="titular">Metodología de aprendizaje: </strong>
                            {{ $unidad->metodologia }}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="17" class="text-uppercase contenido">
                            <strong class="titular">Recursos didácticos: </strong> {{ $unidad->recursos }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        @endforeach
    </div>
    {{-- IX. Relación de la asignatura con los resultados de aprendizaje del Perfil de Egreso de la carrera --}}
    <div class="container-sm saltoPagina">
        
        <h4 class="text-uppercase textoSubtitulo">IX. Relación de la asignatura con los resultados de aprendizaje del
            Perfil de Egreso de la carrera</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th colspan="2" class="titular textoMiddle">Resultados de aprendizaje del Perfil
                        de Egreso de la carrera
                        (copiar los elaborados para cada unidad)
                    </th>
                    <th colspan="2" class="titular textoMiddle">Contribución ALTA - MEDIA - BAJA
                        (al logro de los R. de A. del Perfil de Egreso de la Carrera)
                    </th>
                    <th colspan="2" class="titular textoMiddle">Evidencias de Aprendizaje.
                        El estudiante es capaz de: (evidencias del aprendizaje: conocimientos, habilidades y valores)
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unidades as $unidad)
                    @php
                         $perfil_egreso = PerfilEgreso::where('unidad_id', $unidad->id)->first();
                    @endphp
                    @if ($perfil_egreso != null)
                        @if ($unidad->id == $perfil_egreso->unidad_id)
                        <tr>
                            <th colspan="2" class="contenido text-uppercase textoMiddle">{{$unidad->aprendizaje}}</th>
                            <th colspan="2" class="contenido text-uppercase textoMiddle">{{$perfil_egreso->contribucion}}</th>
                            <th colspan="2" class="contenido text-uppercase textoMiddle">{{$perfil_egreso->evidencias}}</th>
                        </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- X. Evaluación del estudiante por resultados de aprendizaje --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">X. Evaluación del estudiante por resultados de aprendizaje</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th colspan="4" class="titular textoMiddle">Técnicas</th>
                    <th colspan="1" class="titular textoMiddle">Valoración (puntos)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="2" rowspan="2" class="contenido text-uppercase textoMiddle">Gestión formativa (30%)
                    </th>
                    <td colspan="2" class="contenido text-uppercase textoMiddle">Trabajo individual,
                        autónomo y/o virtual</td>
                    <th rowspan="2" colspan="1" class="contenido text-uppercase textoMiddle">(3 puntos)
                    </th>
                </tr>
                <tr>
                    <td colspan="2" class="contenido text-uppercase textoMiddle">Lecciones orales o
                        escritas</td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="2" class="contenido text-uppercase textoMiddle">Gestión práctica (30%)
                    </th>
                    <td colspan="2" class="contenido text-uppercase textoMiddle">Trabajos grupales</td>
                    <th rowspan="2" colspan="1" class="contenido text-uppercase textoMiddle">(3 puntos)
                    </th>
                </tr>
                <tr>
                    <td colspan="2" class="contenido text-uppercase textoMiddle">Trabajos integradores</td>

                </tr>
                <tr>
                    <th colspan="2" class="contenido text-uppercase textoMiddle">Validación y acreditación (40%)
                    </th>
                    <td colspan="2" class="contenido text-uppercase textoMiddle">Evaluación escrita</td>
                    <th rowspan="2" colspan="1" class="contenido text-uppercase textoMiddle">(4 puntos)
                    </th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="titular textoMiddle">Total</th>
                    <th colspan="1" class="titular textoMiddle">(10 puntos)</th>
                </tr>
            </tfoot>
        </table>
    </div>
    {{-- XI. Referencias bibliográficas (citar con APA última edición) --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">XI. Referencias bibliográficas (citar con APA última edición)</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th colspan="2" class="titular textoMiddle">Referencias Bibliográfica
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                $referencias = ReferenciaApa::all()->where('syllabus_id', $syllabus->id);
                @endphp
                @if ($referencias != null)
                    @foreach ($referencias as $referencia)
                        <tr>
                            <th colspan="2" class="contenido text-uppercase">{{$referencia->referencias}}</th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- XII. Revisión y Aprobación --}}
    <div class="container-sm">
        <h4 class="text-uppercase textoSubtitulo">XII. Revisión y Aprobación</h4>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th colspan="2" class="titular textoMiddle">Realizado por:</th>
                    <th colspan="2" class="titular textoMiddle">Aprobado por:</th>
                    <th colspan="2" class="titular textoMiddle">Validado por:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="2" class="contenido text-uppercase textoMiddle">Firma del docente</th>
                    <th colspan="2" class="contenido text-uppercase textoMiddle">Firma del coordinador</th>
                    <th colspan="2" class="contenido text-uppercase textoMiddle">Firma de vicerrectorado
                    </th>
                </tr>
                <tr>
                    <th colspan="2" class="contenido text-uppercase textoMiddle">{{ $docente->nombres }}
                        {{ $docente->apellidos }}</th>
                    <th colspan="2" class="contenido text-uppercase textoMiddle"></th>
                    <th colspan="2" class="contenido text-uppercase textoMiddle"></th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="titular">Fecha: </th>
                    <th colspan="2" class="titular">Fecha: </th>
                    <th colspan="2" class="titular">Fecha: </th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
