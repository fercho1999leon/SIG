@php
	use App\Area;
    use App\Matter;
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
					<td class="no-border" width="25%">Estudiante:</td>
					<td class="no-border" width="25%">{{$student->nombres}} {{$student->apellidos}}</td>
					<td class="no-border" width="25%">Grado/curso:</td>
					<td class="no-border" width="25%">{{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}</td>
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
			@php
				$ids = ['LENGUA Y LITERATURA', 'MATEMATICA', 'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES','EDUCACION CULTURAL Y ARTISTICA', 'EDUCACION FISICA', 'INGLES'];
				$mat = $materiasFijas->get()->whereIn('nombre', $ids)->sortBy(function($model) use ($ids) {
						return array_search($model->nombre, $ids);
				});
								$mat2 = $materiasFijas->get()->whereNotIn('nombre', $ids);
								$materiasFinal = $mat->merge($mat2);
								$contadorMaterias = 0;
								$sumaMaterias = 0;
								$visibleMaterias = true;
								if($student->sexo == 'Masculino') {
									$promovido = 'promovido';
								} else {
									$promovido = 'promovida';
								}

								$mensaje = "Ha sido $promovido a {$gradoSiguiente}";
								$promediar = true;
								$promedios = [];
								$promediosFinal = 0;
								$promedioFinalMateria = 0;
								$promediosFinal_Final = 0;
								$promediosFinalOptativas = 0;
								$mostrar = true;
								$sumaAsistencia= 0;
								$a=0;
			@endphp

			@php
				$contadorPromedioFinal = 0;
			@endphp
			@foreach($materiasFinal->groupBy('idArea') as $key => $mFijas)
				@php
					$area = Area::find($key);
					$dependiente = $area != null ? $area->dependiente : false;
				@endphp
				@if(!$dependiente)
					@foreach($mFijas as $materia)
							@php
								if(bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<7 ){
									$contadorPromedioFinal++;
								}
							@endphp
					@endforeach
				@endif
			@endforeach

			<table class="table">
				<tr>
					<td style="vertical-align:top !important" width="49%" class="no-border">
						<table class="table">
							<tr>
								<td rowspan="3" class="text-center bold">ASIGNATURA</td>
								<td colspan="2" class="text-center bold">QUIMESTRES</td>
								<td rowspan="3" class="text-center bold">SUMA</td>
								<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO QUIMESTRAL</td>
								@if($contadorPromedioFinal!=0)
								<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO FINAL</td>
								@endif
							</tr>
							<tr>
								<td class="text-center bold">1ero</td>
								<td class="text-center bold">2do</td>
							</tr>
							<tr>
								<td class="text-center">10</td>
								<td class="text-center">10</td>
								<td class="text-center">EC</td>
								<td class="text-center">10</td>
								@if($contadorPromedioFinal!=0)
								<td class="text-center">EC</td>
								<td class="text-center">10</td>
								@endif
							</tr>
							@foreach($materiasFinal->groupBy('idArea') as $key => $mFijas)
								@php
									$area = Area::find($key);

									$dependiente = $area != null ? $area->dependiente : false;
								@endphp
								@if(!$dependiente)
									@foreach($mFijas as $materia)
									<tr>
										<td>{{ $materia->nombre }}</td>
										<td class="text-center">{{  $promediosTotalQ1[$materia->id][$student->idStudent]== 0 ? "" : $promediosTotalQ1[$materia->id][$student->idStudent] }}</td>
										<td class="text-center">{{  $promediosTotalQ2[$materia->id][$student->idStudent]== 0 ? "" : $promediosTotalQ2[$materia->id][$student->idStudent] }}</td>
										<td class="text-center">{{ $promediosTotalQ1[$materia->id][$student->idStudent] + $promediosTotalQ2[$materia->id][$student->idStudent]}}</td>
										<td class="text-center">
											@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>= 9)
												DAR
											@endif
											@if ( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<9 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>=7)
												AAR
											@endif
											@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>4 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<7)
												PAAR
											@endif
											@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>=0 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<=4)
												NAAR
											@endif
										</td>
										<td class="text-center">
										{{ bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2) }}
										</td>
										@if($contadorPromedioFinal!=0)
											<td class="text-center">
												@if( $supletorios[$materia->id][$student->idStudent]>= 7 || $remediales[$materia->id][$student->idStudent]>= 7 || $gracias[$materia->id][$student->idStudent]>= 7 )
													AAR
												@else
													@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>= 9)
														DAR
													@endif
													@if ( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<9 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>=7)
														AAR
													@endif
													@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>4 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<7)
														PAAR
													@endif
													@if( bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>=0 && bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)<=4)
														NAAR
													@endif
												@endif
											</td>
											<td class="text-center">
												@if( $supletorios[$materia->id][$student->idStudent]>= 7 || $remediales[$materia->id][$student->idStudent]>= 7 || $gracias[$materia->id][$student->idStudent]>= 7 )
													7
												@endif
												@if(bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)>=7)
													{{bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2)}}
												@endif
											</td>
										@endif
										@php
											if( $supletorios[$materia->id][$student->idStudent]>= 7 || $remediales[$materia->id][$student->idStudent]>= 7 || $gracias[$materia->id][$student->idStudent]>= 7){
												$promediosFinal_Final = $promediosFinal_Final+7;
												$promediosFinal = $promediosFinal+bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2);
											}else{
												$promediosFinal = $promediosFinal+bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2);
												$promediosFinal_Final = $promediosFinal_Final+bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2);
											}
										@endphp
									</tr>
									@php
										if($promedioGeneral[$materia->id][$student->idStudent] < 7 && $promedioGeneral[$materia->id][$student->idStudent] != 0){

											//validar si va a supletorio/remedial/gracia
											if ($supletorios[$materia->id][$student->idStudent] == 0){
												array_push($promedios, 'Supletorio');
											}else if ($supletorios[$materia->id][$student->idStudent] >= 7 ){
												//array_push($promedios, 'PROMOVIDO');
											}else{
												if ($supletorios[$materia->id][$student->idStudent] < 7 && $remediales[$materia->id][$student->idStudent] == 0){
													array_push($promedios, 'Remedial');
												}else if ($remediales[$materia->id][$student->idStudent] >= 7 ){
													//array_push($promedios, 'PROMOVIDO');
												}else {
													if ($remediales[$materia->id][$student->idStudent] < 7 && $gracias[$materia->id][$student->idStudent] == 0){
														array_push($promedios, 'Gracia');
													}else if ($gracias[$materia->id][$student->idStudent] >= 7 ){
														//array_push($promedios, 'PROMOVIDO');
													} else {
														if ($gracias[$materia->id][$student->idStudent] < 7){
															array_push($promedios, 'REPROBADO');
														}
													}
												}
											}
										}elseif($promedioGeneral[$materia->id][$student->idStudent] == 0) {
											$mensaje = "";
										}

									@endphp
									@endforeach
								@else
									@php
										$mostrar1 = true;
										$mostrar2 = true;
										$mostrar3 = true;
										$mostrarex = true;
										$mostrarpr = true;
										$pr1 = 0;
										$pr2 = 0;
										$prf = 0;
										$materiasArea = Matter::where(['idCurso' => $curso->id,'idArea' => $key])->get();
										$materiaPrincipal = $materiasArea->where('principal', 1)->first();

										$porcentajeParcial= 80/100;
										$porcentajeExamen= 20/100;

										$promedioParcial = 0;
									@endphp

									@foreach($materiasArea as $materia)
									@php
										$pr1 += $promediosTotalQ1[$materia->id][$student->idStudent];
										$pr2 += $promediosTotalQ2[$materia->id][$student->idStudent];
										$prf += $promedioGeneral[$materia->id][$student->idStudent]
									@endphp
									@endforeach
									@php
										$pr1 = bcdiv($pr1/ count($materiasArea), '1', 2);
										$pr2 = bcdiv($pr2/ count($materiasArea), '1', 2);
                                        $prf = bcdiv(($pr1 + $pr2) / 2, '1', 2);

									@endphp
									<tr>
										<td class="uppercase">{{$materiaPrincipal->nombre}}</td>
										<td class="text-center">{{  $pr1 == 0 ? "" : $pr1  }}</td>
										<td class="text-center">{{  $pr2 == 0 ? "" : $pr2 }}</td>
										<td class="text-center">{{ $pr1  + $pr2}}</td>
										<td class="text-center">
											@if( bcdiv($prf, '1', 2)>= 9)
												DAR
											@endif
											@if ( bcdiv($prf, '1', 2)<9 && bcdiv($prf, '1', 2)>=7)
												AAR
											@endif
											@if( bcdiv($prf, '1', 2)>4 && bcdiv($prf, '1', 2)<7)
												PAAR
											@endif
											@if( bcdiv($prf, '1', 2)>=0 && bcdiv($prf, '1', 2)<=4)
												NAAR
											@endif
										</td>
										<td class="text-center">
                                            {{$prf}}
										</td>
										@if($contadorPromedioFinal!=0)
										<td class="text-center">
											@if( bcdiv($prf, '1', 2)>= 9)
												DAR
											@endif
											@if ( bcdiv($prf, '1', 2)<9 && bcdiv($prf, '1', 2)>=7)
												AAR
											@endif
											@if( bcdiv($prf, '1', 2)>4 && bcdiv($prf, '1', 2)<7)
												PAAR
											@endif
											@if( bcdiv($prf, '1', 2)>=0 && bcdiv($prf, '1', 2)<=4)
												NAAR
											@endif
										</td>
										<td class="text-center">
											{{ bcdiv($prf, '1', 2) }}
											@php
												$promedioFinalMateria=bcdiv($prf, '1', 2);
											@endphp
										</td>
										@endif
										@php
											$promediosFinal = $promediosFinal+bcdiv($prf, '1', 2);
											$promediosFinal_Final = $promediosFinal_Final+bcdiv($prf, '1', 2);
										@endphp
									</tr>
									@php
										if($promedioGeneral[$materia->id][$student->idStudent] < 7 && $promedioGeneral[$materia->id][$student->idStudent] != 0){

											//validar si va a supletorio/remedial/gracia
											if ($supletorios[$materia->id][$student->idStudent] == 0){
												array_push($promedios, 'Supletorio');
											}else if ($supletorios[$materia->id][$student->idStudent] >= 7 ){
												//array_push($promedios, 'PROMOVIDO');
											}else{
												if ($supletorios[$materia->id][$student->idStudent] < 7 && $remediales[$materia->id][$student->idStudent] == 0){
													array_push($promedios, 'Remedial');
												}else if ($remediales[$materia->id][$student->idStudent] >= 7 ){
													//array_push($promedios, 'PROMOVIDO');
												}else {
													if ($remediales[$materia->id][$student->idStudent] < 7 && $gracias[$materia->id][$student->idStudent] == 0){
														array_push($promedios, 'Gracia');
													}else if ($gracias[$materia->id][$student->idStudent] >= 7 ){
														//array_push($promedios, 'PROMOVIDO');
													} else {
														if ($gracias[$materia->id][$student->idStudent] < 7){
															array_push($promedios, 'REPROBADO');
														}
													}
												}

											}
										}elseif($promedioGeneral[$materia->id][$student->idStudent] == 0) {
											$mensaje = "";
										}

									@endphp
								@endif
							@endforeach
							<tr>
								<td class="no-border" colspan="4">PROMEDIO ACADÉMICO</td>
								<td class="text-center">
									@if( bcdiv($promediosFinal, '1', 2)>= 9)
										DAR
									@endif
									@if ( bcdiv($promediosFinal, '1', 2)<9 && bcdiv($promediosFinal, '1', 2)>=7)
										AAR
									@endif
									@if( bcdiv($promediosFinal, '1', 2)>4 && bcdiv($promediosFinal, '1', 2)<7)
										PAAR
									@endif
									@if( bcdiv($promediosFinal, '1', 2)>=0 && bcdiv($promediosFinal, '1', 2)<=4)
										NAAR
									@endif
								</td>
								@php

								@endphp
								<td class="text-center">{{ bcdiv( $promediosFinal/count($materiasFijas->get()), '1', 2)}}	</td>
								@if($contadorPromedioFinal!=0)
								<td class="text-center">
									@if( bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)>= 9)
										DAR
									@endif
									@if ( bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)<9 && bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)>=7)
										AAR
									@endif
									@if( bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)>4 && bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)<7)
										PAAR
									@endif
									@if( bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)>=0 && bcdiv($promediosFinal_Final/count($materiasFijas->get()), '1', 2)<=4)
										NAAR
									@endif
								</td>
								<td class="text-center">
									{{ bcdiv( $promediosFinal_Final/count($materiasFijas->get()), '1', 2)}}
								</td>
								@endif
							</tr>
							<tr>
								<td class="no-border" colspan="6"></td>
							</tr>
							@if($proyecto != null)
							<tr>
								<td>PROYECTOS ESCOLARES</td>
								<td class="text-center">
									@if($promediosTotalQ1[$proyecto->id][$student->idStudent] != 0)
									@php
										$notacualitativa = App\Calificacion::notaCualitativa($promediosTotalQ1[$proyecto->id][$student->idStudent]);
									@endphp
										{{$notacualitativa}}
									@else
										-
									@endif
								</td>
								<td class="text-center">
									@if($promediosTotalQ2[$proyecto->id][$student->idStudent] != 0)
										@php
										$notacualitativa = App\Calificacion::notaCualitativa($promediosTotalQ2[$proyecto->id][$student->idStudent]);
									@endphp
										{{$notacualitativa}}
									@else
										-
									@endif
								</td>
								<td class="text-center">
									@php
										$prProyecto = $promediosTotalQ2[$proyecto->id][$student->idStudent] + $promediosTotalQ2[$proyecto->id][$student->idStudent];
									@endphp
									@if($prProyecto != 0)
									@php
										$notacualitativa = App\Calificacion::notaCualitativa($prProyecto);
									@endphp
										{{$notacualitativa}}
									@else
										-
									@endif
								</td>
								<td class="text-center">
										@if( bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)>= 9)
										DAR
									@endif
									@if ( bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)<9 && bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)>=7)
										AAR
									@endif
									@if( bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)>4 && bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)<7)
										PAAR
									@endif
									@if( bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)>=0 && bcdiv($promedioGeneralRecup[$proyecto->id][$student->idStudent], '1', 2)<=4)
										NAAR
									@endif
								</td>
								<td class="text-center">
									@if($promedioGeneralRecup[$proyecto->id][$student->idStudent] != 0)
										@php
										$notacualitativa2 = App\Calificacion::notaCualitativa($promedioGeneralRecup[$proyecto->id][$student->idStudent]);
									@endphp
										{{$notacualitativa2}}
									@else
										-
									@endif
								</td>
							</tr>
							@endif
							<!-- DHI -->
							@if($dhi != null)
							<tr>
								<td class="uppercase bold">
									{{$dhi->nombre}}
								</td>
								<td colspan="5" class="text-center">
									{{ $dhi["exq1"] }}
								</td>
							</tr>
							@endif
						</table>
					</td>
					<td width="2%" class="no-border"></td>
					<td width="49%" class="no-border">
						<table class="table">
							<tr>
								<td colspan="2" class="text-center">OBSERVACIONES</td>
							</tr>
							@php
								$mensajeReprobado = '';
								foreach(array_unique($promedios) as $promedio){
									$mensajeReprobado.= 'Alumno '.$promedio;
								}
							@endphp
							<tr height="60">
								<td colspan="2" class="text-center">
									<h2>
										@if ($confComportamiento->valor === 'replicar')
											@if(count($promedios) == 0)
											{{ $mensaje }}
											@else
												{{ $mensajeReprobado }}
											@endif
										@else
											@forelse($student->student->comportamientos->where('parcial', 'anual')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo) as $comportamiento)
												{{ $comportamiento->observacion }}
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
						Maestra
					</td>
					<td class="no-border" width="5%"></td>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
						Directora
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
						Representante
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
			@if ($count % 2 == 0)
				<div style="page-break-after:always;"></div>
			@endif
			@php
				$count++
			@endphp
		@endforeach
	</main>
</body>

</html>