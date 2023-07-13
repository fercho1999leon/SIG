@php
$rol = Sentinel::getUser()
    ->roles()
    ->first()->name;
$user_data = session('user_data');
$estudiante = session('estudiante');
$tMessages = session('tMessages');
use App\Student2;
use App\Http\Controllers\StudentController;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;
use App\RequestUser;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ParcialController;
use App\Http\Controllers\InstitutionController;
use App\ALetras;

$nombreInstituto = str_replace('"', '', InstitutionController::getInstitution()->nombre);
$leheaderstituto = str_replace('"', '', InstitutionController::getInstitution()->lema);
$estudiantes = StudentController::getStudentsByCourse($curso->id);
$number = 1;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/acta_global/acta_global.css') }}" />
    <title>Acta de Calificaciones</title>
</head>

<body>
    <div class="container">
        <div class="row ">
            <!-- Titulo del Acta de Calificaciones-->
            <!--ENCABEZADO LOGO/INSTITUCION-->
            @include('partials.encabezados.reporte_global.reporte_global_encabezado_institution')
            <div class="row" style="margin-top: -30px;">
                <div class="col-xs-12 text-center">
                    <h1 id="tipoReporte" class="p-3 ">
                        ACTA DE CALIFICACIONES
                    </h1>
                </div>
            </div>
            <!-- Encabezado Datos -->
            @include('partials.encabezados.reporte_global.reporte_global_encabezado_informativo')
            <table id="acta_global" class="table table-bordered">
            <thead style="background-color: black;">
                    <tr >
                        <th rowspan="2" class="text-uppercase" style="min-width:18px;max-width:18px">N°</th>
                        <th rowspan="2" class="text-uppercase" style="min-width:180px; max-width:180px">APELLIDOS Y NOMBRES</th>
                        <th rowspan="2" class="text-uppercase" style="min-width:48px;max-width:48px">Porcentaje de Asistencia</th>
                        <th colspan="3" class="text-uppercase" >Proceso Académico</th>
                        <th colspan="2" class="text-uppercase" style="min-width:48px;max-width:48px">Calificación</th>
                    </tr>
                    <tr>
                        <th class="text-uppercase" style="min-width:44px;max-width:44px">Gestión Formativa (30%)</th>
                        <th class="text-uppercase" style="min-width:44px;max-width:44px">Gestión Practica (30%)</th>
                        <th rowspan="2" class="text-uppercase" style="min-width:54px;max-width:54px">Validación y Acreditación
                            (40%)</th>
                        <th class="text-uppercase" style="min-width:38px;max-width:38px">Total en Números</th>
                        <th class="text-uppercase" style="min-width:128px;max-width:128px">Total en Letras</th>
                    </tr> 
                </thead>
            </table>
            <table id="acta_global" class="table table-bordered">
                

                <tbody class="text-black">
                    {{-- @foreach ($estudiantes as $estudiante)
                        <tr>
                            <th class="text-uppercase">
                                <strong>@php echo $number++; @endphp</strong>
                            </th>
                            <th class="text-uppercase">{{ $estudiante->apellidos }} {{ $estudiante->nombres }}</th>
                            <th class="text-uppercase">N/A</th>
                            <th class="text-uppercase">3.00</th>
                            <th class="text-uppercase">3.00</th>
                            <th class="text-uppercase">4.00</th>
                            <th class="text-uppercase">0</th>
                            <th class="text-uppercase">Cuatro</th>
                        </tr>
                    @endforeach --}}
                    @php
                        $asistenciatotal = App\DailyAssistance
                            ::select(array('*', DB::raw('COUNT(idEstudiante) as asistencia')))
                            ->where('idCurso', $course->id)
                            ->where('idMateria', $materia_id)
                            ->groupBy('idEstudiante')
                            ->get()->max('asistencia');
                    @endphp
                   
                    @foreach($students as $student)
                    
                                <tr>
                                    <th class="text-uppercase">
                                        <strong>{{$loop->iteration}}</strong>
                                    </th>
                                    <th class="text-uppercase" style="min-width:170px; max-width:170px" style="text-align: start; padding-left: 6px;">{{$student->apellidos}}, {{$student->nombres}}
                                    </th>
                                    
                                        <strong></strong>
                                        
                                    </th>

                                    @php
                                        $asistencia = App\DailyAssistance
                                            ::where('idCurso', $course->id)
                                            ->where('idMateria', $materia_id)
                                            ->where('idEstudiante', $student->idStudent)
                                            //->where('idSchedule', $hora->id)
                                            ->where('estado', 'ASISTIO')
                                            ->get()->count();
                                    @endphp
                                <th class="text-uppercase" style="min-width:48px;max-width:48px">
                                    {{$asistencia ? bcdiv(($asistencia*100)/$asistenciatotal, '1', 2).'%' : '-'}}
                                </th>

                                    @foreach($supplies as $key => $supply)
                                    @php
                                        $std = $data->where('estudianteId', $student->idStudent)->first();
                                        $mats = new \Illuminate\Support\Collection($std->parcial);
                                        $mat = $mats->where('materiaId',  $validar->id)->first();
                                        $supps = new \Illuminate\Support\Collection($mat->insumos);
                                        //dd($std,$mats,$mat,$supps);
                                        if($supply->nombre == "GESTION TEORICA"){
                                            $promedios = $supps->where('insumoId',  $supply->id)->first();                                           
                                        }
                                        if($supply->nombre == "GESTION PRACTICA"){
                                            $promedios2 = $supps->where('insumoId',  $supply->id)->first();
                                        }     
                                        if($supply->nombre == "VALIDACION"){
                                            $promedios3 = $supps->where('insumoId',  $supply->id)->first();
                                        }                                 
                                    @endphp
                                    @endforeach
                                    <th class="text-uppercase" style="min-width:44px;max-width:44px">
                                        {{ bcdiv($promedios->nota, '1', 2) }}
                                    </th>
                                    <th class="text-uppercase" style="min-width:44px;max-width:44px">
                                        {{ bcdiv($promedios2->nota, '1', 2) }}
                                    </th>
                                    <th class="text-uppercase" style="min-width:44px;max-width:44px">
                                        {{ bcdiv($promedios3->nota, '1', 2) }}
                                    </th>
                                        @php
                                        $std = $data->where('estudianteId', $student->idStudent)->first();
                                        $mats = new \Illuminate\Support\Collection($std->parcial);
                                        $mat = $mats->where('materiaId',  $validar->id)->first();
                                    
                                        @endphp
                                    <th class="text-uppercase" style="min-width:38px;max-width:38px">
                                    {{ bcdiv($mat->promedioFinal, '1', 2) }}
                                    </th>
                                    <th class="text-uppercase" style="min-width:120px;max-width:120px">
                                        @php
                                        $formatter = new ALetras();
                                       echo $formatter->toMoney(bcdiv($mat->promedioFinal, '1', 2), 2, '', '');
                                        @endphp
                                    </th>
                                </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
            <!--FOOTER INFORMATIVO-->
            @include('partials.footers.reporte_global.reporte_global_footer_firmas')
        </div>
    </div>
    <script type="text/javascript" src="{{ secure_asset('js/jquery-3.3.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('js/bootstrap.js') }}"></script>
    <script>
        $("#acta_global tbody tr td").each(function(element) {
            if ($(this).text() < 7) {
                $(this).css('color', 'red');
            }
        });
    </script>
</body>

</html>
