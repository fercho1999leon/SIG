<!DOCTYPE html>
<html lang="es">
@php
	$unidades = $unidades_a->where('identificador','q1')->first();
	$parcialP = App\ParcialPeriodico::parcialP($unidades->id);
	$unidades2 = $unidades_a->where('identificador','q2')->first();
	$parcialP2 = App\ParcialPeriodico::parcialP($unidades2->id);
	$mensaje = App\Calificacion::gradoSiguiente($curso->grado);
	$suma_asistenciaQ1 = 0;
	$suma_asistenciaQ2 = 0;
	
@endphp
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Anual</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
	@foreach($students as $student)
		@php
			$supletorio= false;
			$remedial= false;
			$gracia= false;
			$incompleto = false;
		@endphp
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual',
			])
		<table class="table m-0">
			<tr>
				<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>
				<td class="uppercase">{{ $student->student->apellidos }} {{ $student->student->nombres }}</td>
				<td class="uppercase bold bgDark text-right" width="50">Curso</td>
				<td class="uppercase">{{ $curso->grado }} {{ $curso->paralelo }} {{ $curso->especializacion }}</td>
				<td class="uppercase bold bgDark text-right" width="50">Tutor</td>
				<td class="uppercase">
				@if($tutor != null)
					{{ $tutor->apellidos }} {{ $tutor->nombres }}
				@endif
				</td>
			</tr>
		</table>
		<table class="table whitespace-no mt-1">
			<tr class="bold">
				<td width="160" rowspan="2" class="text-center uppercase">asignaturas</td>
				<td colspan="{{count($parcialP)+1}}" class="text-center">Quimestre 1</td>
				<td colspan="{{count($parcialP2)+1}}" class="text-center">Quimestre 2</td>
				<td rowspan="2" class="text-center">PROM</td>
				<td rowspan="2" class="text-center">RECU</td>
				<td rowspan="2" class="text-center">PROM</td>
				<td rowspan="2" class="text-center">SUP.</td>
				<td rowspan="2" class="text-center">REM.</td>
				<td rowspan="2" class="text-center">GRA.</td>
				<td rowspan="2" class="text-center">PROMEDIO FINAL</td>
			</tr>
			<tr class="bold">
				@foreach($parcialP as $par )
					<td class="text-center bold">{{$par->nombre}}</td>
				@endforeach
				<td class="text-center">PROM</td>
				@foreach($parcialP2 as $par2 )
					<td class="text-center bold">{{$par2->nombre}}</td>
				@endforeach
				<td class="text-center">PROM</td>
			</tr>
			<tr>
				@foreach($area_pos as $Ap)
					@php
					$mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',1)->sortBy('posicion');
					@endphp
					@if($mat_fij!= null)
						@foreach($mat_fij as $mp)
							@foreach($anual[$student->id]->materias as $a_m)
								@if($a_m->materiaId == $mp->id)
									@foreach($quimestre1[$student->id]->materias as $nq1)
										@if($nq1->materiaId == $mp->id)
											<td>{{$mp->nombre}}</td>
											@foreach($parcialP as $par )
											@php
											$nota =0;
											$notas_materia = new \Illuminate\Support\Collection($nq1->parciales);
											$nota = $notas_materia->where('indicador', $par->identificador)->first()->promediop;
											@endphp
												@if($nota ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($nota < 7 && $notasMenores == "1") style="color:red;"@endif>
													{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nota)['nota'] : (bcdiv($nota, '1', 2)==0?'':bcdiv($nota, '1', 2))}}</td>
												@endif
											@endforeach
											@if($nq1->promedioquimestral ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold"@if($nq1->promedioquimestral < 7 && $notasMenores == "1") style="color:red;"@endif>
													{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nq1->promedioquimestral)['nota'] : (bcdiv($nq1->promedioquimestral, '1', 2)==0?'':bcdiv($nq1->promedioquimestral, '1', 2))}}</td>
											@endif
										@endif
									@endforeach
									@foreach($quimestre2[$student->id]->materias as $nq2)
										@if($nq2->materiaId == $mp->id)
											@foreach($parcialP2 as $par2 )
											@php
											$nota =0;
											$notas_materia = new \Illuminate\Support\Collection($nq2->parciales);
											$nota = $notas_materia->where('indicador', $par2->identificador)->first()->promediop;
											@endphp
												@if($nota ==0 && $PromedioInsumo == 0)
													<td></td>
													@else
													<td class="text-center bold" @if($nota < 7 && $notasMenores == "1") style="color:red;"@endif>
														{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nota)['nota'] : (bcdiv($nota, '1', 2)==0?'':bcdiv($nota, '1', 2))}}</td>
												@endif
											@endforeach
											@if($nq2->promedioquimestral ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($nq2->promedioquimestral < 7 && $notasMenores == "1") style="color:red;"@endif>
													{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nq2->promedioquimestral)['nota'] : (bcdiv($nq2->promedioquimestral, '1', 2)==0?'':bcdiv($nq2->promedioquimestral, '1', 2))}}</td>
											@endif
										@endif
									@endforeach
									@php
									if ($a_m->supletorio==0 && $a_m->promedioFinal<7 && $a_m->promedioFinal>=5 ) {
									    $supletorio= true;
									}elseif(!$supletorio && $a_m->promedioFinal <7 && $a_m->remedial ==0 && $a_m->promedioFinal !=0){
									    $remedial= true;
									}elseif($a_m->supletorio>=0 && $a_m->promedioFinal <7 && $a_m->remedial >=0 && $a_m->gracia ==0 && $a_m->promedioFinal !=0){
									    $gracia= true;
									}elseif ($a_m->promedioFinal ==0) {
                                        $incompleto= true;
                                    }
									@endphp
											@if($a_m->promedio ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($a_m->promedio < 7 && $notasMenores == "1") style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedio)['nota'] : (bcdiv($a_m->promedio, '1', 2)==0?'':bcdiv($a_m->promedio, '1', 2))}}</td>
											@endif
											<td class="text-center bold" @if($a_m->recuperatorio < 7 && $notasMenores == "1" && $a_m->recuperatorio >0) style="color:red;"@endif>{{$mp->idEstructura!= null ?App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->recuperatorio)['nota'] : (bcdiv($a_m->recuperatorio, '1', 2)==0?'':bcdiv($a_m->recuperatorio, '1', 2))}}</td>
											@if($a_m->promedioAnual ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($a_m->promedioAnual < 7 && $notasMenores == "1") style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedioAnual)['nota'] : (bcdiv($a_m->promedioAnual, '1', 2)==0?'':bcdiv($a_m->promedioAnual, '1', 2))}}</td>
											@endif
											<td class="text-center bold" @if($a_m->supletorio < 7 && $notasMenores == "1" && $a_m->supletorio >0) style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->supletorio)['nota'] : (bcdiv($a_m->supletorio, '1', 2)==0?'':bcdiv($a_m->supletorio, '1', 2))}}</td>
											<td class="text-center bold" @if($a_m->remedial < 7 && $notasMenores == "1" && $a_m->remedial >0) style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->remedial)['nota'] : (bcdiv($a_m->remedial, '1', 2)==0?'':bcdiv($a_m->remedial, '1', 2))}}</td>
											<td class="text-center bold" @if($a_m->gracia < 7 && $notasMenores == "1" && $a_m->gracia >0) style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->gracia)['nota'] : (bcdiv($a_m->gracia, '1', 2)==0?'':bcdiv($a_m->gracia, '1', 2))}}</td>
											@if($a_m->promedioFinal ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($a_m->promedioFinal < 7 && $notasMenores == "1" && $a_m->promedioFinal >0) style="color:red;"@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedioFinal)['nota'] : (bcdiv($a_m->promedioFinal, '1', 2)==0?'':bcdiv($a_m->promedioFinal, '1', 2))}}</td>
											@endif
											</tr>
								@endif
							@endforeach
						@endforeach
					@endif
				@endforeach
			<tr>
				<td class="text-center bold">PROMEDIO ACADÉMICO</td>
				<td colspan="{{count($parcialP)+count($parcialP2)+8}}" class="text-center bold"></td>
				<td class="text-center bold">{{$anual[$student->id]->promedioEstudiante == 0 ? '':bcdiv($anual[$student->id]->promedioEstudiante, '1', 2)}}</td>
			</tr>
			<tr>
				<td class="text-center bold">ASIGNATURAS ADICIONALES</td>
				<td colspan="{{count($parcialP)+count($parcialP2)+9}}" class="text-center bold"></td>
			</tr>
			<tr>
				@foreach($area_pos as $Ap)
					@php
					$mat_ext = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',0)->sortBy('posicion');
					@endphp
					@if($mat_ext!= null)
						@foreach($mat_ext as $me)
							@foreach($anual[$student->id]->materias as $a_m_e)
								@if($a_m_e->materiaId == $me->id)
									@foreach($quimestre1[$student->id]->materias as $nq1)
										@if($nq1->materiaId == $me->id)
											<td>{{$me->nombre}}</td>
											@foreach($parcialP as $par )
											@php
											$nota =0;
											$notas_materia = new \Illuminate\Support\Collection($nq1->parciales);
											$nota = $notas_materia->where('indicador', $par->identificador)->first()->promediop;
											@endphp
											@if($nota ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($nota < 7 && $notasMenores == "1") style="color:red;"@endif>
												{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nota)['nota'] : (bcdiv($nota, '1', 2)==0?'':bcdiv($nota, '1', 2))}}</td>
											@endif
											@endforeach
											@if($nq1->promedioquimestral ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($nq1->promedioquimestral < 7 && $notasMenores == "1") style="color:red;"@endif>
												{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nq1->promedioquimestral)['nota'] : (bcdiv($nq1->promedioquimestral, '1', 2)==0?'':bcdiv($nq1->promedioquimestral, '1', 2))}}</td>
											@endif
										@endif
									@endforeach
									@foreach($quimestre2[$student->id]->materias as $nq2)
										@if($nq2->materiaId == $me->id)
											@foreach($parcialP2 as $par2 )
											@php
											$nota =0;
											$notas_materia = new \Illuminate\Support\Collection($nq2->parciales);
											$nota = $notas_materia->where('indicador', $par2->identificador)->first()->promediop;
											@endphp
												@if($nota ==0 && $PromedioInsumo == 0)
													<td></td>
													@else
													<td class="text-center bold" @if($nota < 7 && $notasMenores == "1") style="color:red;"@endif>
													{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nota)['nota'] : (bcdiv($nota, '1', 2)==0?'':bcdiv($nota, '1', 2))}}</td>
												@endif
											@endforeach
												@if($nq2->promedioquimestral ==0 && $PromedioInsumo == 0)
												<td></td>
												@else
												<td class="text-center bold" @if($nq2->promedioquimestral < 7 && $notasMenores == "1") style="color:red;"@endif>
												{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nq2->promedioquimestral)['nota'] : (bcdiv($nq2->promedioquimestral, '1', 2)==0?'':bcdiv($nq2->promedioquimestral, '1', 2))}}</td>
												@endif
										@endif
									@endforeach
									@if($me->nombre == 'PROYECTOS ESCOLARES') @endif
									@if($a_m_e->promedio ==0 && $PromedioInsumo == 0)
									    <td></td>
									@else
                                        <td class="text-center bold" @if($a_m_e->promedio < 7 && $notasMenores == "1") style="color:red;" @endif >
                                            {{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$a_m_e->promedio)['nota'] : (bcdiv($a_m_e->promedio, '1', 2)==0?'':bcdiv($a_m_e->promedio, '1', 2))}}
                                        </td>
									@endif
									<td class="text-center bold" @if($a_m_e->recuperatorio < 7 && $notasMenores == "1" && $a_m_e->recuperatorio >0) style="color:red;"@endif>
										{{$me->idEstructura!= null ?'' : (bcdiv($a_m_e->recuperatorio, '1', 2)==0?'':bcdiv($a_m_e->recuperatorio, '1', 2))}}
                                    </td>
                                    @if($a_m_e->promedioAnual ==0 && $PromedioInsumo == 0)
                                        <td></td>
                                    @else
										<td class="text-center bold" @if($a_m_e->promedioAnual < 7 && $notasMenores == "1") style="color:red;"@endif>
											{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$a_m_e->promedioAnual)['nota'] : (bcdiv($a_m_e->promedioAnual, '1', 2)==0?'':bcdiv($a_m_e->promedioAnual, '1', 2))}}
                                        </td>
									@endif
									<td class="text-center bold"  @if($a_m_e->supletorio < 7 && $notasMenores == "1" && $a_m_e->supletorio >0) style="color:red;"@endif>
										{{$me->idEstructura!= null ? '' : (bcdiv($a_m_e->supletorio, '1', 2)==0?'':bcdiv($a_m_e->supletorio, '1', 2))}}
                                    </td>
									<td class="text-center bold" @if($a_m_e->remedial < 7 && $notasMenores == "1" && $a_m_e->remedial >0) style="color:red;"@endif>
										{{$me->idEstructura!= null ? '' : (bcdiv($a_m_e->remedial, '1', 2)==0?'':bcdiv($a_m_e->remedial, '1', 2))}}
                                    </td>
									<td class="text-center bold" @if($a_m_e->gracia < 7 && $notasMenores == "1" && $a_m_e->gracia >0) style="color:red;"@endif>
										{{$me->idEstructura!= null ? '' : (bcdiv($a_m_e->gracia, '1', 2)==0?'':bcdiv($a_m_e->gracia, '1', 2))}}
                                    </td>
									@if($a_m_e->promedioFinal ==0 && $PromedioInsumo == 0)
										<td></td>
									@else
										<td class="text-center bold" @if($a_m_e->promedioFinal < 7 && $notasMenores == "1") style="color:red;"@endif>
											{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$a_m_e->promedioFinal)['nota'] : (bcdiv($a_m_e->promedioFinal, '1', 2)==0?'':bcdiv($a_m_e->promedioFinal, '1', 2))}}
                                        </td>
									@endif
								</tr>
								@endif
							@endforeach
						@endforeach
					@endif
				@endforeach
			</tr>
			@if($dhi != null)
			<tr>
				<td class="uppercase bold">
					{{$dhi->nombre}}
				</td>
				@if($confDHI->valor == 'QUIMESTRAL')
					<td colspan="{{count($parcialP)+1}}" class="text-center">
						{{$dhi['q1']}}
					</td>
					<td colspan="{{count($parcialP2)+1}}" class="text-center">
						{{$dhi['q2']}}
					</td>
					<td colspan="6" class="text-center"></td>
					<td colspan="6" class="text-center">{{$dhi["exq1"]}}</td>
				@else
				@foreach($parcialP as $par )
						@php
						$nota_dhi ='-';
						$q_dhi ='q1';
						switch ($par->identificador) {
						case 'p1'.$q_dhi:
						$nota_dhi = $dhi["p1$q_dhi"];
						break;
						case 'p2'.$q_dhi:
						$nota_dhi = $dhi["p2$q_dhi"];
						break;
						case 'p3'.$q_dhi:
						$nota_dhi = $dhi["p3$q_dhi"];
						break;
						case $q_dhi:
						$nota_dhi = $dhi["$q_dhi"];
						break;
						}
						@endphp
						<td class="text-center"  colspan="{{$par->identificador=='q1' ? 2: '' }}">
							{{$nota_dhi}}
						</td>
					@endforeach
					@foreach($parcialP2 as $par2 )
						@php
						$nota_dhi ='-';
						$q_dhi2 ='q2';
						switch ($par2->identificador) {
						case 'p1'.$q_dhi2:
						$nota_dhi = $dhi["p1$q_dhi2"];
						break;
						case 'p2'.$q_dhi2:
						$nota_dhi = $dhi["p2$q_dhi2"];
						break;
						case 'p3'.$q_dhi2:
						$nota_dhi = $dhi["p3$q_dhi2"];
						break;
						case $q_dhi2:
						$nota_dhi = $dhi["$q_dhi2"];
						break;
						}
						@endphp
						<td class="text-center" colspan="{{$par2->identificador=='q2' ? 2: '' }}">
							{{$nota_dhi}}
						</td>
					@endforeach
					<td colspan="6" class="text-center"></td>
					<td colspan="6" class="text-center">{{$dhi["exq1"]}}</td>
				@endif
			</tr>
			@endif
			<tr>
				<td class="uppercase">Comportamiento</td>
				@for ($i = 0; $i < (count($parcialP)-1); $i++)
						@php
						switch ($parcialP[$i]->identificador) {
						case 'p1q1':
						$parcial_comp = 'p1q1';

						break;
						case 'p2q1':
						$parcial_comp = 'p2q1';

						break;
						case 'p3q1':
						$parcial_comp = 'p3q1';

						break;
						case 'q1':
						$parcial_comp =  'q1';
						break;
						}
						@endphp
				<td class="text-center bold">
						@forelse($student->student->comportamientos->where('parcial',$parcial_comp) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
				</td>
				@endfor
				<td class="text-center bold" colspan="2">
					@if($confComportamiento->valor !== 'crear')

							@forelse($student->student->comportamientos->where('parcial', $parcialP[(count($parcialP)-2)]->identificador) as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'q1') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
				</td>
				@for ($i = 0; $i < (count($parcialP2)-1); $i++)
						@php
						switch ($parcialP2[$i]->identificador) {
						case 'p1q2':
						$parcial_comp2 = 'p1q2';
						break;
						case 'p2q2':
						$parcial_comp2 = 'p2q2';
						break;
						case 'p3q2':
						$parcial_comp2 = 'p3q2';
						break;
						case 'q2':
						$parcial_comp2 =  'q2';
						break;
						}
						@endphp
				<td class="text-center bold">
						@forelse($student->student->comportamientos->where('parcial',$parcial_comp2) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
				</td>
				@endfor
				<td class="text-center bold" colspan="2">
					@if ($confComportamiento->valor !== 'crear')
						@forelse($student->student->comportamientos->where('parcial', $parcialP2[(count($parcialP2)-2)]->identificador) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
					@else
						@forelse($student->student->comportamientos->where('parcial', 'q2') as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
					@endif
				</td>
				<td colspan="7" class="text-center bold">
					@if ($confComportamiento->valor == 'replicar')
						@forelse($student->student->comportamientos->where('parcial',  $parcialP2[(count($parcialP2)-2)]->identificador) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
					@else
						@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
					@endif
				</td>
			</tr>
			<tr class="">
				<td class="uppercase">asistencia(por horas de clase)</td>
				<td colspan="{{count($parcialP)}}" class="text-center uppercase"></td>
				<td class="text-center uppercase">total</td>
				<td colspan="{{count($parcialP2)}}" class="text-center uppercase"></td>
				<td class="text-center uppercase">total</td>
				<td colspan="6" class="text-center uppercase"></td>
				<td class="text-center uppercase">total</td>
			</tr>
			@foreach (['faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas', 'atrasos' => 'Atrasos'] as $tipoFalta => $titulo)
				<tr>
					<td>{{$titulo}}</td>
					@php
						$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
							->where('idStudent', $student->idStudent)
							->first();
					@endphp
					@for ($i = 0; $i < (count($parcialP)-1); $i++)
						@php
						switch ($parcialP[$i]->identificador) {
						case 'p1q1':
						$parcial_asistencia = 'p1q1';
						break;
						case 'p2q1':
						$parcial_asistencia = 'p2q1';
						break;
						case 'p3q1':
						$parcial_asistencia = 'p3q1';
						break;
						case 'q1':
						$parcial_asistencia =  'q1';
						break;
						}
						$suma_asistenciaQ1 = $suma_asistenciaQ1 + $estudiante->asistenciaParcial($parcial_asistencia)[$tipoFalta];
						@endphp
						<td class="text-center">{{$estudiante->asistenciaParcial($parcial_asistencia)[$tipoFalta]}}</td>
					@endfor
					<td class="text-center"></td>
					<td class="text-center">
						{{$suma_asistenciaQ1}}
					</td>
					@for ($i = 0; $i < (count($parcialP2)-1); $i++)
						@php
						switch ($parcialP2[$i]->identificador) {
						case 'p1q2':
						$parcial_asistencia2 = 'p1q2';
						break;
						case 'p2q2':
						$parcial_asistencia2 = 'p2q2';
						break;
						case 'p3q2':
						$parcial_asistencia2 = 'p3q2';
						break;
						case 'q2':
						$parcial_asistencia2 =  'q2';
						break;
						}
						$suma_asistenciaQ2 = $suma_asistenciaQ2 + $estudiante->asistenciaParcial($parcial_asistencia2)[$tipoFalta];
						@endphp
						<td class="text-center">{{$estudiante->asistenciaParcial($parcial_asistencia2)[$tipoFalta]}}</td>
					@endfor
					<td class="text-center"></td>
					<td class="text-center">
						{{$suma_asistenciaQ2}}
					</td>
					<td colspan="6" class="text-center"></td>
					<td class="text-center">
						@php
							$totalFaltas = $suma_asistenciaQ1+$suma_asistenciaQ2;
							$suma_asistenciaQ1=0;//igualo a cero el contador de asistencias por q1
							$suma_asistenciaQ2=0; //igualo a cero el contador de asistencias por q2

						@endphp
						{{$totalFaltas}}
					</td>
				</tr>
			@endforeach
		</table>
		<table class="table">
			<tr>
				<td class="no-border">
					<p>
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
					</p>
					<div style="border-top:2px solid black"></div>
				</td>
			</tr>
			<tr>
				<td class="no-border uppercase bold" width="50%">observaciones</td>
			</tr>
		</table>
		<br>
		<br>
		<table class="table">
			<tr>
				<td class="no-border" width="20%"></td>
				<td width="20%" class="text-center no-border uppercase" style="border-top:2px solid black !important">
					@if ($nombre_representante_libreta_parcial->valor == '1')
						@if ($student->representante != null)
							{{$student->representante->apellidos}} {{$student->representante->nombres}}
						@endif
						<br>
					@else
						<br>
					@endif
					<span class="bold">
						Representante
					</span>
				</td>
				<td class="no-border" width="20%"></td>
				<td class="text-center no-border uppercase text-center bold" width="20%" style="border-top:2px solid black !important">Tutor</td>
				<td class="no-border" width="20%"></td>
			</tr>
		</table>
			@if($supletorio)
			{{'Alumno: SUPLETORIO'}}
			@elseif($remedial)
			{{'Alumno: REMEDIAL'}}
			@elseif($gracia)
			{{'Alumno: GRACIA'}}
            @elseif($incompleto)
			{{'NOTAS INCOMPLETAS'}}
			@else
			<h4>
				@if($curso->grado=="Tercero de Bachillerato")
				{{ $mensaje }}
				@else
				Ha sido promovido a {{$mensaje }}
				@endif
			</h4>
			@endif
		</div>
		<div style="page-break-after:always;"></div>
	@endforeach
	</main>
</body>
</html>