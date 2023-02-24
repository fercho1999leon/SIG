@php
	use App\Area;
	use App\Matter;
	$cont_pares =0; //creado para darle el salto de pagina cada dos estudiantes
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Quimestral</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style type="text/css">
     .new-page {
       page-break-before: always;
     }
</style>
<body>
	<main>
		@foreach($students as $student)
		<header class="header m-0">
			<table class="table">
				<tr>
					<th style="vertical-align:top;" class="no-border">
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
								Promedio {{$quimestre == 'q1' ? 'Primer' : 'Segundo'}} Quimestre
							</h4>
						</div>
					</th>
					<th class="no-border" width="20%">
						<div class="header__logo" style="float: right">
								{{-- este codigo de abajo debe ser activado cuando se lea datos desde la base --}}
								{{-- <img src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png") : secure_asset("storage/$user_data->url_imagen") }}"
									class="img-circle circle-border m-b-md"
									alt="profile"
									width="70"
								> --}}
						</div>
					</th>
				</tr>
			</table>
		</header>
		<table class="table">
			<tr>
				<td class="no-border" width="25%">Estudiante:</td>
				<td class="no-border uppercase" width="25%">{{$student->nombres}} {{$student->apellidos}}</td>
				<td class="no-border" width="25%">Curso:</td>
				<td class="no-border uppercase" width="25%">{{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}</td>
			</tr>
			<tr>
				<td class="no-border">Profesor(a):</td>
				<td class="no-border uppercase">{{$tutor->nombres}} {{$tutor->apellidos}}</td>

				<td class="no-border">Período Lectivo:</td>
				<td class="no-border">{{$periodo}}</td>
			</tr>
		</table>
		<table class="table">
			<tr>
				<td style="vertical-align:top !important" width="49%" class="no-border">
					<table class="table">
						<tr>
							<td rowspan="3" class="text-center bold">ASIGNATURA</td>
							<td colspan="{{count($parcialP)}}" class="text-center bold">PARCIALES</td>
							<td rowspan="2" class="text-center bold">PROM. PARCIAL</td>
							<td colspan="2" class="text-center bold">QUIMESTRAL</td>
							<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO QUIMESTRAL</td>
						</tr>
						<tr>
							@for ($i = 0; $i < count($parcialP) -1; $i++)
							<td class="text-center">{{$parcialP[$i]->identificador}}</td>
							@endfor
							<td class="text-center">Prom.</td>
							<td class="text-center">Exa.</td>
							<td class="text-center">Prom.</td>
						</tr>
						<tr>
							@for ($i = 0; $i < count($parcialP) -1; $i++)
							<td class="text-center">10</td>
							@endfor
							<td class="text-center">10</td>
							<td class="text-center">--</td>
							<td class="text-center">10</td>
							<td class="text-center">--</td>
							<td class="text-center">EC</td>
							<td class="text-center">10</td>
						</tr>

						@php
						$cont_pares++; //sumo estudiantes;
							$ids = ['LENGUA Y LITERATURA', 'MATEMATICA', 'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES',
									'EDUCACION CULTURAL Y ARTISTICA', 'EDUCACION FISICA', 'INGLES'];
							if (count($students) >1){
								$mat = $materiasFijas->get()->whereIn('nombre', $ids)->sortBy(function($model) use ($ids) {
									return array_search($model->nombre, $ids);
								});
								$mat2 = $materiasFijas->get()->whereNotIn('nombre', $ids);
								$materiasFinal = $mat->merge($mat2);
							}else {
								$mat = $materiasFijas->whereIn('nombre', $ids)->sortBy(function($model) use ($ids) {
									return array_search($model->nombre, $ids);
								});
								$mat2 = $materiasFijas->whereNotIn('nombre', $ids);
								$materiasFinal = $mat->merge($mat2);
							}
							$contadorMaterias = 0;
							$sumaMaterias = 0;
							$visibleMaterias = true;
						@endphp
						@foreach($materiasFinal->groupBy('idArea') as $key => $mFijas)
							@php
								$prNota = [];
								$prI = 0;
								$prF = 0;
								$area = Area::find($key);
								$dependiente = $area != null ? $area->dependiente : false;

							@endphp

							@if(!$dependiente)
								@foreach($mFijas as $materia)
								<tr>
										<td class="uppercase">{{$materia->nombre}}</td>
									@php
										$porcentajeParcial= 80/100;
										$porcentajeExamen= 20/100;
										$pp1= 0;
										$pp2= 0;
										$pp3= 0;
										$promedioParcial= 0;
										$contadorMaterias++;
									@endphp
										@for ($i = 0; $i < count($parcialP) -1; $i++)
											@php
												$P_promediosparcial=0;
												switch ($parcialP[$i]->identificador) {
												case 'p1'.$quimestre:
												$ver_promedio1 ='';
												$promediosparcial = $promediosP1[$materia->id][$student->id]['promedio'];
												$pp1 = $pp1+bcdiv($promediosparcial, '1', 2);
												$P_promediosparcial=$pp1;
												if ($promediosparcial == 0) {
													$mostrarP1 = false;
												}
												break;
												case 'p2'.$quimestre:
												$ver_promedio2 ='';
												$promediosparcial = $promediosP2[$materia->id][$student->id]['promedio'];
												$pp2 = $pp2+bcdiv($promediosparcial, '1', 2);
												$P_promediosparcial=$pp2;
												if ($promediosparcial == 0) {
													$mostrarP2 = false;
												}
												break;
												case 'p3'.$quimestre:
												$ver_promedio3 ='';
												$promediosparcial = $promediosP3[$materia->id][$student->id]['promedio'];
												$pp3 = $pp3+bcdiv($promediosparcial, '1', 2);
												$P_promediosparcial=$pp3;
												if ($promediosparcial == 0) {
													$mostrarP3 = false;
												}
												break;
												case $quimestre:
												$ver_promedio4 ='';
												$promediosparcial = $examenes[$materia->id][$student->id];
												$pexa =$pexa+$examenes[$materia->id][$student->id];
												$P_promediosparcial=$pexa;
												if ($promediosparcial == 0) {
													$mostrarEX = false;
												}
												break;
												}
											@endphp
													<td class="text-center"
														@if($notasMenores == "1")
															@if($promediosparcial < 7 && $promediosparcial!=0)
																style="color:red;"
															@endif
														@endif
														>
														{{  bcdiv($promediosparcial, '1', 2) }}
														<span style="display: none">
															-{{ $P_promediosparcial}}
														</span>
													</td>
										@endfor
										@php
											$promedio =  bcdiv(($pp1+$pp2+$pp3)/(count($parcialP)-1), '1', 2);
											$promedioParcial= bcdiv($promedio*$porcentajeParcial, '1', 2);
											$promedioExamen= bcdiv($examenes[$materia->id][$student->id]*$porcentajeExamen, '1', 2);
										@endphp
										<td class="text-center">
											{{$promedio}}
										</td>
										<td class="text-center">
											{{$promedioParcial}}
										</td>
										<td class="text-center">
											@if($examenes[$materia->id][$student->id]!=0)
												{{ $examenes[$materia->id][$student->id] }}
												<span style="display: none">
													-{{ $pexa=$pexa+$examenes[$materia->id][$student->id] }}
												</span>
											@endif
										</td>
										<td class="text-center">
											@if($promedioExamen!=0)
												{{$promedioExamen}}
											@else
												@php
													$visibleMaterias = false;
												@endphp
											@endif
										</td>

										@if($promediosFinal[$materia->id][$student->id] != 0)
											<td class="text-center">
												@if( $promediosFinal[$materia->id][$student->id]>= 9)
													DAR
												@endif
												@if ( $promediosFinal[$materia->id][$student->id]<9 && $promediosFinal[$materia->id][$student->id]>=7)
													AAR
												@endif
												@if( $promediosFinal[$materia->id][$student->id]>4 && $promediosFinal[$materia->id][$student->id]<7)
													PAAR
												@endif
												@if( $promediosFinal[$materia->id][$student->id]>=0 && $promediosFinal[$materia->id][$student->id]<=4)
													NAAR
												@endif
											</td>
											<td class="text-center">
												{{$promediosFinal[$materia->id][$student->id]}}
												<span style="display: none">
													-{{ $pPQ1=$pPQ1+$promediosFinal[$materia->id][$student->id] }}
													{{$sumaMaterias = $sumaMaterias+$promediosFinal[$materia->id][$student->id]}}
												</span>
											</td>
										@else
											<td class="text-center"></td>
											<td class="text-center"></td>
										@endif
									</tr>
								@endforeach
					@else
								@php
									$contadorMaterias++;
									$mostrar1 = true;
									$mostrar2 = true;
									$mostrar3 = true;
									$mostrarex = true;
									$mostrarpr = true;
									$pr1 = 0;
									$pr2 = 0;
									$pr3 = 0;
									$ex = 0;
									$prf = 0;
									$materiaPrincipal = $mFijas->where('principal', 1)->first();
									$materiasArea = Matter::where(['idCurso' => $curso->id,'idArea' => $key])->get();

									$porcentajeParcial= 80/100;
									$porcentajeExamen= 20/100;

									$promedioParcial = 0;
								@endphp
								@foreach($materiasArea as $materia)
									@php
										if($promediosP1[$materia->id][$student->id]['promedio'] == 0) {
											$mostrar1 = false;
										}
										if($promediosP2[$materia->id][$student->id]['promedio'] == 0) {
											$mostrar2 = false;
										}
										if($promediosP3[$materia->id][$student->id]['promedio'] == 0) {
											$mostrar3 = false;
										}
										if($examenes[$materia->id][$student->id] == 0) {
											$mostrarex = false;
										}
										if($promediosFinal[$materia->id][$student->id] == 0) {
											$mostrarpr = false;
										}

										$pr1 += $promediosP1[$materia->id][$student->id]['promedio'];
										$pr2 += $promediosP2[$materia->id][$student->id]['promedio'];
										$pr3 += $promediosP3[$materia->id][$student->id]['promedio'];
										$ex += $examenes[$materia->id][$student->id];
										$prf += $promediosFinal[$materia->id][$student->id];
									@endphp
								@endforeach

								<tr>
									<td class="uppercase">{{$materiaPrincipal->nombre}}</td>
									<td class="text-center">
										{{  $mostrar1 ? bcdiv(($pr1 / 3), '1', 2) : '' }}
										<span style="display: none">
											-{{ $pp1=$pp1+bcdiv(($pr1 / 3), '1', 2)}}
										</span>
									</td>
									<td class="text-center">
										{{  $mostrar2 ? bcdiv(($pr2 / 3), '1', 2) : '' }}
										<span style="display: none">
											-{{ $pp2=$pp2+bcdiv(($pr2 / 3), '1', 2)}}
										</span>
									</td>
									<td class="text-center">
										{{ $mostrar3 ? bcdiv(($pr3 / 3), '1', 2) : ''}}
										<span style="display: none">
											-{{ $pp3=$pp3+bcdiv(($pr3 / 3), '1', 2)}}
										</span>
									</td>

									@php
										$promedioParcial= bcdiv((bcdiv(($pr1 / 3), '1', 2)+bcdiv(($pr2 / 3), '1', 2)+bcdiv(($pr3 / 3), '1', 2))/3, '1', 2);
									@endphp
									<td class="text-center">
										{{ $promedioParcial }}
									</td>
									<td class="text-center">
										{{bcdiv($promedioParcial*$porcentajeParcial, '1', 2)}}
									</td>


									<td class="text-center">
										{{ $mostrarex ? bcdiv(($ex/3), '1', 2) : '' }}
										<span style="display: none">
											-{{ $pexa=$pexa+($ex/3) }}
										</span>
									</td>
									<td class="text-center">
										{{ $mostrarex ? bcdiv(($ex/3)*$porcentajeExamen, '1', 2) : '' }}
										<span style="display: none">
											-{{ $pexa=$pexa+($ex/3) }}
										</span>
									</td>

									@if(($prf/3) != 0)
										<td class="text-center">
											@if( bcdiv(($prf/3), '1', 2)>= 9)
												DAR
											@endif
											@if ( bcdiv(($prf/3), '1', 2)<9 && bcdiv(($prf/3), '1', 2)>=7)
												AAR
											@endif
											@if( bcdiv(($prf/3), '1', 2)>4 && bcdiv(($prf/3), '1', 2)<7)
												PAAR
											@endif
											@if( bcdiv(($prf/3), '1', 2)>=0 && bcdiv(($prf/3), '1', 2)<=4)
												NAAR
											@endif
										</td>
										<td class="text-center">
											{{ $mostrarpr ? bcdiv(($prf/3), '1', 2) : ''}}
											<span style="display: none">
												-{{ $pPQ1=$pPQ1+($prf/3) }}


													{{$sumaMaterias = $sumaMaterias+bcdiv(($prf/3), '1', 2)}}
											</span>
										</td>
									@else
										<td class="text-center"></td>
										<td class="text-center"></td>
									@endif
								</tr>
							@endif
						@endforeach

						<tr><td colspan="{{count($parcialP)}}" class="no-border text-right">
							<td colspan="4" class="no-border text-right">PROMEDIO ACADÉMICO</td>
							@if($visibleMaterias==true)
								<td class="text-center">
									@if( bcdiv($sumaMaterias/$contadorMaterias, '1', 2)>= 9)
										DAR
									@endif
									@if ( bcdiv($sumaMaterias/$contadorMaterias, '1', 2)<9 && bcdiv($sumaMaterias/$contadorMaterias, '1', 2)>=7)
										AAR
									@endif
									@if( bcdiv($sumaMaterias/$contadorMaterias, '1', 2)>4 && bcdiv($sumaMaterias/$contadorMaterias, '1', 2)<7)
										PAAR
									@endif
									@if( bcdiv($sumaMaterias/$contadorMaterias, '1', 2)>=0 && bcdiv($sumaMaterias/$contadorMaterias, '1', 2)<=4)
										NAAR
									@endif
								</td>
								<td class="text-center">
									{{bcdiv($sumaMaterias/$contadorMaterias, '1', 2)}}
								</td>
							@else
								<td class="text-center"></td>
								<td class="text-center"></td>
							@endif
						</tr>
						@php
							$pPQ1= 0;
						@endphp

						<!-- Materias Optativas -->
						@foreach($materiasExtra->groupBy('area') as $key => $mExtra)
							@foreach($mExtra as $materia)
								@if($materia->nombre=='PROYECTOS' || $materia->nombre=='PROYECTOS ESCOLARES')
									<tr>
										<td class="uppercase">PROYECTOS ESCOLARES</td>
							@for ($i = 0; $i < count($parcialP) -1; $i++)
							@php
							switch ($parcialP[$i]->identificador) {

							case 'p1'.$quimestre:
							$promediosparcial_cualitativo = $promediosP1[$materia->id][$student->id]['promedio'];
							$pp1=$pp1+bcdiv($promediosparcial_cualitativo, '1', 2);
							break;
							case 'p2'.$quimestre:
							$promediosparcial_cualitativo = $promediosP2[$materia->id][$student->id]['promedio'];
							$pp2=$pp2+bcdiv($promediosparcial_cualitativo, '1', 2);
							break;
							case 'p3'.$quimestre:
							$promediosparcial_cualitativo = $promediosP3[$materia->id][$student->id]['promedio'];
							$pp3=$pp3+bcdiv($promediosparcial_cualitativo, '1', 2);
							break;
							}
							@endphp
							<td class="text-center">
									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>= 9)
										EX
									@endif

									@if ( bcdiv($promediosparcial_cualitativo, '1', 2)<9 && bcdiv($promediosparcial_cualitativo, '1', 2)>=7)
										MB
									@endif

									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>4 && bcdiv($promediosparcial_cualitativo, '1', 2)<7)
										B
									@endif

									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>=0 && bcdiv($promediosparcial_cualitativo, '1', 2)<4)
										R
									@endif
								</td>
								@endfor

										@php
											$promedioParcial = ($pp1+$pp2+$pp3)/(count($parcialP)-1);
										@endphp
										<td class="text-center">
											@if( bcdiv($promedioParcial, '1', 2)>= 9)
												EX
											@endif
											@if ( bcdiv($promedioParcial, '1', 2)<9 && bcdiv($promedioParcial, '1', 2)>=7)
												MB
											@endif
											@if( bcdiv($promedioParcial, '1', 2)>4 && bcdiv($promedioParcial, '1', 2)<7)
												B
											@endif
											@if( bcdiv($promedioParcial, '1', 2)>=0 && bcdiv($promedioParcial, '1', 2)<4)
												R
											@endif
										</td>
										<td class="text-center">
											@if( bcdiv($promedioParcial, '1', 2)>= 9)
												EX
											@endif
											@if ( bcdiv($promedioParcial, '1', 2)<9 && bcdiv($promedioParcial, '1', 2)>=7)
												MB
											@endif
											@if( bcdiv($promedioParcial, '1', 2)>4 && bcdiv($promedioParcial, '1', 2)<7)
												B
											@endif
											@if( bcdiv($promedioParcial, '1', 2)>=0 && bcdiv($promedioParcial, '1', 2)<4)
												R
											@endif
										</td>

										<td colspan="2" class="text-center">
											@if( bcdiv($examenes[$materia->id][$student->id], '1', 2)>= 9)
												EX
											@endif

											@if ( bcdiv($examenes[$materia->id][$student->id], '1', 2)<9 && bcdiv($examenes[$materia->id][$student->id], '1', 2)>=7)
												MB
											@endif

											@if( bcdiv($examenes[$materia->id][$student->id], '1', 2)>4 && bcdiv($examenes[$materia->id][$student->id], '1', 2)<7)
												B
											@endif

											@if( bcdiv($examenes[$materia->id][$student->id], '1', 2)>=0 && bcdiv($examenes[$materia->id][$student->id], '1', 2)<4)
												R
											@endif
											<span style="display: none">
												-{{ $pexa=$pexa+$examenes[$materia->id][$student->id] }}
											</span>
										</td>
										<td colspan="2" class="text-center">
											@if( $promediosFinal[$materia->id][$student->id]>= 9)
												EX
											@endif

											@if ( $promediosFinal[$materia->id][$student->id]<9 && $promediosFinal[$materia->id][$student->id]>=7)
												MB
											@endif

											@if( $promediosFinal[$materia->id][$student->id]>4 && $promediosFinal[$materia->id][$student->id]<7)
												B
											@endif

											@if( $promediosFinal[$materia->id][$student->id]>=0 && $promediosFinal[$materia->id][$student->id]<4)
												R
											@endif
											<span style="display: none">
												-{{ $pPQ1=$pPQ1+$promediosFinal[$materia->id][$student->id] }}
											</span>
										</td>
										<!-- Se reinicia los valores-->
										@php
											$promedio = 0;
											$promedioParcial = 0;

											$promedioExamen = 0;
											$promedioParcialMateria = 0;
										@endphp
									</tr>
								@else
									<tr>
										<!-- Se reinicia los valores-->
										@php
											$promedio = 0;
											$promedioParcial = 0;

											$pp1 = 0;
											$pp2 = 0;
											$pp3 = 0;
											$promedioExamen = 0;
											$promedioParcialMateria = 0;
										@endphp
										<td class="uppercase">{{ $materia->nombre }}</td>
										<td class="text-center">
											{{  bcdiv($promediosP1[$materia->id][$student->id]['promedio'], '1', 2) }}
											<span style="display: none">
												-{{ $pp1=$pp1+bcdiv($promediosP1[$materia->id][$student->id]['promedio'], '1', 2)}}
											</span>
										</td>
										<td class="text-center">
											{{  bcdiv($promediosP2[$materia->id][$student->id]['promedio'], '1', 2) }}
											<span style="display: none">
												-{{ $pp2=$pp2+bcdiv($promediosP2[$materia->id][$student->id]['promedio'], '1', 2)}}
											</span>
										</td>
										<td class="text-center">
											{{  bcdiv($promediosP3[$materia->id][$student->id]['promedio'], '1', 2) }}
											<span style="display: none">
												-{{ $pp3=$pp3+bcdiv($promediosP3[$materia->id][$student->id]['promedio'], '1', 2)}}
											</span>
										</td>

										@php
											$porcentajeParcial = 80/100;
											$porcentajeExamen = 20/100;

											$promedio = bcdiv(($pp1+$pp2+$pp3)/3, '1', 2);
											$promedioParcial = bcdiv($promedio*$porcentajeParcial, '1', 2);

											$promedioExamen = bcdiv($examenes[$materia->id][$student->id]*$porcentajeExamen, '1', 2);

											$promedioParcialMateria = bcdiv($promedioParcial+$promedioExamen, '1', 2);
										@endphp
										<td class="text-center">
											{{ $promedio }}
										</td>
										<td class="text-center">
											{{ $promedioParcial }}
										</td>

										<td class="text-center">
											{{ $examenes[$materia->id][$student->id] }}
											<span style="display: none">
												-{{ $pexa=$pexa+$examenes[$materia->id][$student->id] }}
											</span>
										</td>
										<td class="text-center">
											{{ $promedioExamen }}
										</td>
										<td class="text-center">
											@if( $promedioParcialMateria>= 9)
												DAR
											@endif
											@if ( $promedioParcialMateria<9 && $promedioParcialMateria>=7)
												AAR
											@endif
											@if( $promedioParcialMateria>4 && $promedioParcialMateria<7)
												PAAR
											@endif
											@if( $promedioParcialMateria>=0 && $promedioParcialMateria<=4)
												NAAR
											@endif
										</td>
										<td class="text-center">{{ $promedioParcialMateria }}</td>
									</tr>
								@endif
							@endforeach
						@endforeach

						{{-- DHI --}}
						@if($dhi != null)
							<tr></tr>
							<tr>
								<td class="uppercase">{{$dhi->nombre}}</td>
								@for ($i = 0; $i < count($parcialP) -1; $i++)
						@php
						$P_promediosparcial=0;
						switch ($parcialP[$i]->identificador) {
						case 'p1'.$quimestre:
						$nota_dhi = $dhi["p1$quimestre"];
						break;
						case 'p2'.$quimestre:
						$nota_dhi = $dhi["p2$quimestre"];
						break;
						case 'p3'.$quimestre:
						$nota_dhi = $dhi["p3$quimestre"];
						break;
						case $quimestre:
						$nota_dhi = $dhi["$quimestre"];
						break;
						}
						@endphp
						<td class="text-center">
							{{$nota_dhi}}
						</td>
					@endfor
						<td class="text-center">-</td>
						<td class="text-center">-</td>
						<td class="text-center" colspan="2">-</td>
						<td class="text-center" colspan="2"> {{$dhi["$quimestre"]}}</td>
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
						<tr height="60">
							<td colspan="2" class="text-center">
								<h2 class="uppercase">
									@if($quimestre=='q1')
										@if($confComportamiento->valor == 'replicar')
											@forelse($student->comportamientos->where('parcial', 'p3q1') as $comportamiento)
												{{$comportamiento->observacion}}
											@empty
											@endforelse
										@else
											@foreach($student->comportamientos->where('parcial', 'q1') as $comportamiento)
												@if($comportamiento->observacion != null)
													{{$comportamiento->observacion}}
												@endif
											@endforeach
										@endif
									@else
										@if($confComportamiento->valor == 'replicar')
											@forelse($student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
												{{$comportamiento->observacion}}
											@empty

											@endforelse
										@else
											@foreach($student->comportamientos->where('parcial', 'q2') as $comportamiento)
												@if($comportamiento->observacion != null)
													{{$comportamiento->observacion}}
												@endif
											@endforeach
										@endif
									@endif
								</h2>
							</td>
						</tr>
						<tr>
							<td class="text-right no-border">COMPORTAMIENTO</td>
							<td class="text-center">
								@if($quimestre == 'q1')
									@if($confComportamiento->valor !== 'crear')
										@forelse($student->comportamientos->where('parcial', 'p3q1') as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@else
										@forelse($student->comportamientos->where('parcial', 'q1') as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@endif
								@else
									@if($confComportamiento->valor !== 'crear')
										@forelse($student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@else
										@forelse($student->comportamientos->where('parcial', 'q2') as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@endif
								@endif
							</td>
						</tr>
						<tr>
							<td colspan="2" class="no-border"></td>
						</tr>
						<tr>
							<td class="text-right no-border">DIAS DE ASISTENCIA</td>
							<td class="text-center">
								{{$totalAsistenciaDelCurso}}
							</td>
						</tr>
						@php
							$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
								->where('idStudent', $student->id)
								->first();
						@endphp
						@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
							<tr>
								<td class="text-right no-border uppercase">{{$titulo}}</td>
								<td class="text-center">
									{{$estudiante->asistenciaParcial("p1{$quimestre}")[$tipoFalta] + $estudiante->asistenciaParcial("p2{$quimestre}")[$tipoFalta] +$estudiante->asistenciaParcial("p3{$quimestre}")[$tipoFalta]}}
								</td>
							</tr>
						@endforeach
					</table>
				</td>
			</tr>
		</table>
		@include('partials.reglamento', [
				'asignaturaCualitativa' => false
			])
		<br>
		<table class="table">
			<tr>
				<td width="30%" class="no-border text-center">
					<hr style="border:1px solid black;">
					{{ $tutor->apellidos }} {{ $tutor->nombres }}
					<br> MAESTR{{$tutor->sexo == 'Masculino' ? 'O' : 'A'}}
				</td>
				<td class="no-border" width="5%"></td>
				<td width="30%" class="no-border text-center">
					<hr style="border:1px solid black;">
					{{$institution->representante1}}
					<br> Directora
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
		<p class="new-page">
		@endforeach
	</main>
</body>

</html>