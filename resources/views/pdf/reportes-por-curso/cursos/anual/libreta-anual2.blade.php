@php
	use App\Area;
    use App\Matter;
    $count =0;
    $sumaAsistencia=0;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Anual</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		@foreach($students as $student)
			<header class="header m-0">
				<table class="table">
					<tr>
						<th style="vertical-align:top" class="no-border" width="20%">
							<div class="header__logo" style="float: left">
								<img
									@if(DB::table('institution')->where('id', '1')->first()->logo == null)
										src="{{ secure_asset('img/logo/logo.png') }}"
									@else
										src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="70"
									@endif
								alt="" width="70">
							</div>
						</th>
						<th class="no-border" width="60%">
							<div class="header__info text-center">
								<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
								<h4 class="m-0 bold uppercase">
									Promedio Final
								</h4>
							</div>
						</th>
						<th class="no-border" width="20%">
							<div class="header__logo" style="float: right">
								<div class="profile-element">
									<img src="{{secure_asset("img/icono_persona.png")}}" width="70">
								</div>
							</div>
						</th>
					</tr>
				</table>
			</header>
			<table class="table">
				<tr>
					<td class="no-border" width="15%">Estudiante:</td>
					<td class="no-border" width="15%">{{$student->nombres}} {{$student->apellidos}}</td>
					<td class="no-border" width="15%">Grado/curso:</td>
					<td class="no-border" width="15%">{{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}</td>
				</tr>
				<tr>
					<td class="no-border">Profesor(a):</td>
					<td class="no-border">
						@if($tutor != null)
							{{ $tutor->apellidos }} {{ $tutor->nombres }}
						@endif
					</td>
					<td class="no-border">Período Lectivo:</td>
					<td class="no-border">{{ $periodo }}</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td style="vertical-align:top !important" width="49%" class="no-border">
						<table class="table">
							<tr>
								<td rowspan="3" class="text-center bold">ASIGNATURA</td>
								<td colspan="2" class="text-center bold">QUIMESTRES</td>
								<td rowspan="3" class="text-center bold">SUMA</td>
								<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO QUIMESTRAL</td>
								<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO FINAL</td>
							</tr>
							<tr>
								@foreach($unidades_a as $unid)
									<td class="text-center bold">{{$unid->nombre}}</td>
								@endforeach
							</tr>
							<tr>
								@foreach($unidades_a as $unid)
									<td class="text-center bold">10</td>
								@endforeach
								<td class="text-center">EC</td>
								<td class="text-center">10</td>
								<td class="text-center">EC</td>
								<td class="text-center">10</td>
							</tr>
							<tr>
							@foreach($area_pos as $Ap)
								@php
								$mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',1)->sortBy('posicion');
								@endphp
								@if($mat_fij!= null)
									@foreach($mat_fij as $mp)
										@php
										$s_m =0;
										@endphp
										@foreach($anual[$student->id]->materias as $a_m)
											@if($a_m->materiaId == $mp->id)
												<td>{{$mp->nombre}}</td>
												@foreach($unidades_a as $unid)
													@foreach($a_m->quimestres as $nq)
														@if($nq->indicador == $unid->identificador )
															@php
															$s_m += $nq->promediop;
															@endphp
																@if( $nq->promediop ==0 && $PromedioInsumo == 0)
																	<td></td>
																	@else
																	<td class="text-center" @if($nq->promediop < 7 && $notasMenores == "1")style="color:red;"@endif>
																		{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nq->promediop)['nota'] : bcdiv($nq->promediop, '1', 2)}}</td>
																@endif
														@endif
													@endforeach
												@endforeach
												<td class="text-center">
													{{$mp->idEstructura!= null ?'': bcdiv($s_m, '1', 2)}}</td>
												@if( $a_m->promedio ==0 && $PromedioInsumo == 0)
													<td></td>
													<td></td>
													@else
													<td class="text-center" @if($a_m->promedio < 7 && $notasMenores == "1")style="color:red;"@endif>{{$mp->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($a_m->promedio)}}
														</td>
													<td class="text-center" @if($a_m->promedio < 7 && $notasMenores == "1")style="color:red;"@endif>
														{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedio)['nota'] : bcdiv($a_m->promedio, '1', 2)}}</td>
												@endif
												@if( $a_m->promedioFinal ==0 && $PromedioInsumo == 0)
													<td></td>
													<td></td></tr>
													@else
													<td class="text-center" @if($a_m->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>
														{{$mp->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($a_m->promedioFinal)}}</td>
													<td class="text-center" @if($a_m->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>
														{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$a_m->promedioFinal)['nota'] : bcdiv($a_m->promedioFinal, '1', 2)}}</td></td></tr>
												@endif
											@endif
										@endforeach
									@endforeach
								@endif
							@endforeach
							<tr>
								<td class="no-border uppercase bold" colspan="{{count($unidades_a)+4}}">PROMEDIO ACADÉMICO</td>
								<td class="text-center">{{App\Calificacion::notaCualitativaApr($anual[$student->id]->promedioEstudiante)}}</td>
								<td class="text-center">{{bcdiv($anual[$student->id]->promedioEstudiante, '1', 2)}}</td>
							</tr>
							<tr>
							@foreach($area_pos as $Ap)
								@php
								$mat_ext = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',0)->sortBy('posicion');
								@endphp
								@if($mat_ext!= null)
									@foreach($mat_ext as $me)
										@php
										$s_m_e=0;
										@endphp
										@foreach($anual[$student->id]->materias as $a_m_e)
												@if($a_m_e->materiaId == $me->id)
													<td>{{$me->nombre}}</td>
													@foreach($unidades_a as $unid)
														@foreach($a_m_e->quimestres as $nq_e)
															@if($nq_e->indicador == $unid->identificador )
															@php
															$s_m_e += $nq_e->promediop;
															@endphp
																@if( $nq_e->promediop ==0 && $PromedioInsumo == 0)
																	<td></td>
																	@else
																	<td class="text-center" @if($nq_e->promediop < 7 && $notasMenores == "1")style="color:red;"@endif>
																		 {{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nq_e->promediop)['nota'] : bcdiv($nq_e->promediop, '1', 2)}}</td>
																@endif
															@endif
														@endforeach
													@endforeach
													<td class="text-center">{{$me->idEstructura!= null ? '':$s_m_e}}</td>
													@if( $a_m_e->promedio ==0 && $PromedioInsumo == 0)
														<td></td>
														<td></td>
														@else
														<td class="text-center" @if($a_m_e->promedio < 7 && $notasMenores == "1")style="color:red;"@endif>
															{{$me->idEstructura!= null ? '' : App\Calificacion::notaCualitativaApr($a_m_e->promedio)}}</td>
														<td class="text-center" @if($a_m_e->promedio < 7 && $notasMenores == "1")style="color:red;"@endif>
															{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$a_m_e->promedio)['nota'] : bcdiv($a_m_e->promedio, '1', 2)}}</td>
													@endif
													@if( $a_m_e->promedioFinal ==0 && $PromedioInsumo == 0)
														<td></td>
														<td></td></tr>
														@else
														<td class="text-center" @if($a_m_e->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>
															{{$me->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($a_m_e->promedioFinal)}}</td>
														<td class="text-center" @if($a_m_e->promedioFinal < 7 && $notasMenores == "1")style="color:red;"@endif>
															{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$a_m_e->promedioFinal)['nota'] : bcdiv($a_m_e->promedioFinal, '1', 2)}}</td></tr>
													@endif
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
										<td colspan="" class="text-center">
											{{$dhi['q1']}}
										</td>
										<td colspan="" class="text-center">
											{{$dhi['q2']}}
										</td>
										<td colspan="4" class="text-center"></td>
										<td colspan="" class="text-center">{{$dhi["exq1"]}}</td>
							@endif
						</table>
					</td>
					<td width="2%" class="no-border"></td>
					<td width="49%" class="no-border">
						<table class="table">
							<tr>
								<td colspan="2" class="text-center">OBSERVACIONES</td>
							</tr>
							<tr height="60">
								<td colspan="2" class="text-center">
									<h2>
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
									</h2>
								</td>
							</tr>
							<tr>
								<td class="text-right no-border">COMPORTAMIENTO</td>
								<td class="text-center">
									@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
										{{$comportamiento->nota}}
									@empty
										-
									@endforelse
								</td>
							</tr>
							<tr>
								<td colspan="2" class="no-border"></td>
							</tr>
							<tr>
								<td class="text-right no-border">DIAS DE ASISTENCIA</td>
								<td class="text-center">
									{{ $totalAsistenciaDelCurso }}
								</td>
							</tr>
							@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
								<tr>
									<td class="text-right no-border">{{$titulo}}</td>
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
				</tr>
			</table>

			@include('partials.reglamento', [
					'asignaturaCualitativa' => false, 'inicial' => false
				])
			<br>
			<table class="table">
				<tr>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
					{{ $tutor == null ? "-" : $tutor->apellidos }} {{ $tutor == null ? "-" : $tutor->nombres }}
					<br> {{$tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'TUTOR' : 'TUTORA')}}
					</td>
					<td class="no-border" width="5%"></td>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
					{{$institution->representante1}}
					<br> {{$institution->cargo1}}
					</td>
					<td class="no-border" width="5%"></td>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
						@if ($nombre_representante_libreta_parcial->valor == '1')
							@if ($student->representante != null)
								{{$student->representante->apellidos}} {{$student->representante->nombres}}
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
				<tr>
					<td class="no-border text-center">
						{{$institution->direccion}}
					</td>
				</tr>
			</table>
			{{-- @if ($count % 2 == 0) --}}
				<div style="page-break-after:always;"></div>
			{{-- @endif --}}
			@php
				$count++
			@endphp
		@endforeach
	</main>
</body>
</html>