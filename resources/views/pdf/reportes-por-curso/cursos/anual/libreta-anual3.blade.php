@php
    use App\Area;
    use App\Matter;
    $cont_pares =0; //creado para darle el salto de pagina cada dos estudiantes
    $sumaAsistencia=0;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Libreta Anual</title>
    <link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<header style="min-height: 0%"></header>
<style type="text/css">
     .new-page {
       page-break-before: always;
     }
</style>
<body>
    <main>
        @foreach($students->sortBy('apellidos') as $student)
        @include('partials.encabezados.libreta-anual-formato3', [
                'reportName' => 'Informe Cualitativo',
                'periodo' => $periodo,
                'informe' =>'',
                'tipo' =>'Libreta Anual',
                'course' =>$curso,
                'nombre' => ($student->apellidos!=null?$student->apellidos:$student->student->apellidos).' '.($student->nombres!=null?$student->nombres:$student->student->nombres)
            ])
                    @php
                    $cont_pares++;
                    @endphp
                            <table class="table" style="line-height:7px;">
                                    <tr>
                                        <td class="text-center bold">ASIGNATURA</td>
                                        @foreach($unidades_a as $uni)
                                        <td class="text-center bold" >{{$uni->nombre}}</td>
                                        @endforeach
                                        <td class="text-center bold">PM</td>
                                        <td class="text-center bold">MEJ</td>
                                        <td class="text-center bold">ESU</td>
                                        <td class="text-center bold">ERE</td>
                                        <td class="text-center bold">EGR</td>
                                        <td class="text-center bold">PMF</td>
                                        <td class="text-center bold">CUAL.</td>
                                    </tr>
                                    <tr>
                                        @foreach($area_pos as $Ap)
                                            @php
                                            $mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
                                            @endphp
                                            @if($mat_fij!= null)
                                                @foreach($mat_fij as $mp)
                                                    @foreach($anual[$student->id]->materias as $a_m)
                                                        @if($a_m->materiaId == $mp->id)
                                                            <td>{{$mp->nombre}}</td>
                                                            @foreach($unidades_a as $unid)
                                                                @foreach($a_m->quimestres as $nq)
                                                                    @if($nq->indicador == $unid->identificador )
                                                                            @if( $nq->promediop ==0 && $PromedioInsumo == 0)
                                                                                <td></td>
                                                                            @else
                                                                                <td class="text-center" style="padding: 0px !important; margin:0px !important;"
                                                                                    @if($nq->promediop < 7 && $notasMenores == "1")
                                                                                        style="color:red;"
                                                                                    @endif>
                                                                                    {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nq->promediop)['nota'] : bcdiv($nq->promediop, '1', 2)}}
                                                                                </td>
                                                                            @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                                @if( $a_m->promedio ==0 && $PromedioInsumo == 0)
                                                                    <td></td>
                                                                @else
                                                                    <td class="text-center" @if($a_m->promedio < 7 && $notasMenores == "1")style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedioFinal)['nota'] : bcdiv($a_m->promedio, '1', 2)}}
                                                                    </td>
                                                                @endif
                                                                    <td class="text-center bold" @if($a_m->recuperatorio < 7 && $notasMenores == "1" && $a_m->recuperatorio >0) style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->recuperatorio)['nota'] : (bcdiv($a_m->recuperatorio, '1', 2)==null ?: "") }}</td>
                                                                    <td class="text-center bold"  @if($a_m->supletorio < 7 && $notasMenores == "1" && $a_m->supletorio >0) style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->supletorio)['nota'] : (bcdiv($a_m->supletorio, '1', 2)==null ?: "" )}}</td>
                                                                    <td class="text-center bold" @if($a_m->remedial < 7 && $notasMenores == "1" && $a_m->remedial >0) style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->remedial)['nota'] : (bcdiv($a_m->remedial, '1', 2)==null ?: "" )}}</td>
                                                                    <td class="text-center bold" @if($a_m->gracia < 7 && $notasMenores == "1" && $a_m->gracia >0) style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->gracia)['nota'] : (bcdiv($a_m->gracia, '1', 2)==null ?: "" )}}</td>
                                                                @if( $a_m->promedioFinal ==0 && $PromedioInsumo == 0)
                                                                    <td></td>
                                                                    <td></td></tr>
                                                                @else
                                                                    <td class="text-center" @if($a_m->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>
                                                                        {{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedioFinal)['nota'] : bcdiv($a_m->promedioFinal, '1', 2)}}</td>
                                                                    <td class="text-center" @if($a_m->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>{{$mp->idEstructura!= null ? '' : App\Calificacion::notaCualitativaApr($a_m->promedioFinal)}}</td></tr>
                                                                @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>PROMEDIO</td>
                                        <td colspan="{{count($unidades_a)+5}}"></td>
                                        <td class="text-center">{{bcdiv($anual[$student->id]->promedioEstudiante, '1', 2)}}</td>
                                        <td class="text-center">{{App\Calificacion::notaCualitativaApr($anual[$student->id]->promedioEstudiante)}}</td>
                                    </tr>
                                    <tr>
                                        <td>COMPORTAMIENTO</td>
                                        @foreach($unidades_a as $unid)
                                            <td class="text-center">
                                                @forelse($student->student->comportamientos->where('parcial', $unid->identificador) as $comportamiento)
                                                    {{$comportamiento->nota}}
                                                @empty
                                                    -
                                                @endforelse
                                            </td>
                                        @endforeach
                                        <td colspan="5" class="text-center">-</td>
                                        <td  class="text-center">-</td>
                                        <td class="text-center">
                                            @forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
                                                {{$comportamiento->nota}}
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                    </tr>

                            </table>
                        @include('partials.reglamento-formato3', [
                        'asignaturaCualitativa' => false, 'inicial' => false
                        ])
                        <table class="table" style="line-height:7px;">
                            <tr>
                                <td width="20%" class="no-border">
                                    <table class="table">
                                        <tr>
                                            <td colspan="2" class="text-center" style="font-size: 8px !important;">
                                                INASISTENCIAS Y ATRASOS
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>DIAS DE ASISTENCIA</td>
                                            <td class="text-center">{{ $totalAsistenciaDelCurso }}</td>
                                        </tr>
                                        @foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
                                            <tr>
                                                <td class="uppercase">{{$titulo}}</td>
                                                <td class="text-center">
                                                    @foreach($unidades_a as $uni)
                                                        @php
                                                        $parcialP = App\ParcialPeriodico::parcialP($uni->id);
                                                        foreach ($parcialP as $par) {
                                                            $sumaAsistencia = $sumaAsistencia +$student->asistenciaParcial($par->identificador)[$tipoFalta];
                                                        }
                                                        @endphp
                                                    @endforeach
                                                    {{$sumaAsistencia}}
                                                    @php
                                                    $sumaAsistencia =0;
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td width="40%" class="no-border">
                                    <table class="table">
                                        <tr>
                                            <td colspan="2" class="text-center uppercase bold" style="font-size: 8px !important;">
                                                Asignaturas Cualitativas
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center uppercase">Positiva</td>
			                                <td style="font-size: 8px !important;">Actitudes positivas en habilidades trabajadas.</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center uppercase">Media</td>
                                            <td style="font-size: 8px !important;">Actitudes con ciertas dificultades en habilidades trabajadas.</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center uppercase">Critica</td>
                                            <td style="font-size: 8px !important;">Actitudes opuestas en habilidades trabajadas.</td>
                                        </tr>
                                    </table>    
                                    {{-- &nbsp; --}}
                                </td>
                                <td  class="no-border">
                                    <table class="table" >
                                        <tr>
                                        <td class="text-center" style="font-size: 8px !important;">OBSERVACIONES</td>
                                        </tr>
                                            <tr height="40">
                                                <td class="text-center" style="font-size: 9px !important;">
                                                    @if ($confComportamiento->valor == 'replicar')
                                                        @forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
                                                            {{$comportamiento->observacion}}
                                                        @empty
                                                            -
                                                        @endforelse
                                                    @else
                                                        @forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
                                                            {{$comportamiento->observacion}}
                                                        @empty
                                                            -
                                                        @endforelse
                                                    @endif

                                                </td>
                                            </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>




                        <table class="table">
                            <tr>
                                <td width="30%" class="no-border text-center" style="font-size: 9px !important;">
                                    <hr style="border:1px solid black;">
                                    {{$institution->representante1}}
                                    <br> {{$institution->cargo1}}
                                </td>
                                <td class="no-border" width="5%"></td>
                                <td width="30%" class="no-border text-center" style="font-size: 9px !important;">
                                    <hr style="border:1px solid black;">
                                    {{ $tutor == null ? "-" : $tutor->nombres }} {{ $tutor == null ? "-" : $tutor->apellidos }}
                                    <br> {{$tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'TUTOR' : 'TUTORA')}}
                                </td>
                                <td class="no-border" width="5%"></td>
                                <td width="30%" class="no-border text-center" style="font-size: 9px !important;">
                                    <hr style="border:1px solid black;">
                                    @if ($nombre_representante_libreta_parcial->valor == '1')
                                        @if ($student->representante != null)
                                            {{$student->representante->nombres}} {{$student->representante->apellidos}}
                                        @endif
                                        <br>
                                    @else
                                        <br>
                                    @endif
                                    REPRESENTANTE
                                </td>
                            </tr>
                        </table>
                    <table class="table">
                    </table>
                    @if ($cont_pares%2==0)
                        <p class="new-page">
                    @endif
        @endforeach
    </main>
</body>
</html>