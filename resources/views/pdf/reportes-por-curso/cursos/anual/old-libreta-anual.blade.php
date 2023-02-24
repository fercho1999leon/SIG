<!DOCTYPE html>
<html lang="es">
@php
	$unidades = $unidades_a->where('identificador','q1')->first();
	$parcialP = App\ParcialPeriodico::parcialP($unidades->id);
	$unidades2 = $unidades_a->where('identificador','q2')->first();
	$parcialP2 = App\ParcialPeriodico::parcialP($unidades2->id);
@endphp

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Anual</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
	@foreach($students as $student)
		@include('partials.encabezados.libreta-formato-horizontal')
		<table class="table m-0">
			<tr>
				<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>
				<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
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
				<td colspan="2" class="text-center">Recuperaciones</td>
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
				<td class="text-center">Q1</td>
				<td class="text-center">Q2</td>
			</tr>
			@php
				if($student->sexo == 'Masculino') {
					$promovido = 'promovido';
				} else {
					$promovido = 'promovida';
				}
				$ids = ['LENGUA Y LITERATURA', 'MATEMÁTICA', 'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES',
										'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'EDUCACIÓN FÍSICA', 'INGLES'];
				$mat = $materiasFijas->get()->whereIn('nombre', $ids)->sortBy(function($model) use ($ids) {
					return array_search($model->nombre, $ids);
				});
				$mat2 = $materiasFijas->get()->whereNotIn('nombre', $ids);
				$materiasFinal = $mat->merge($mat2);
				$mensaje = "Ha sido $promovido a {$gradoSiguiente}";
				$promediar = true;
				$promedios = [];
				$promediosFinal = 0;
				$promediosFinalOptativas = 0;
				$mostrar = true;
				$parcial_asistencia= '';
				$parcial_asistencia2= '';
				$suma_asistenciaQ1=0;
				$suma_asistenciaQ2=0;
			@endphp
			@foreach($materiasFinal->groupBy('area') as $key => $mFijas)

				@foreach($mFijas as $materia)
				<tr>
					<td class="pdfSubmateria uppercase">
					@if(count($mFijas) > 1)
						<img src="{{secure_asset('img/level-up.png')}}" alt="">
					@endif
						{{ $materia->nombre}}
					</td>
					@foreach($parcialP as $par )
					@php
					switch ($par->identificador) {
                    case 'p1q1':
                        $promedio1= bcdiv($promediosP1Q1[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'p2q1':
                          $promedio1= bcdiv($promediosP2Q1[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'p3q1':
                          $promedio1= bcdiv($promediosP3Q1[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'q1':
                       $promedio1= $examenesQ1[$materia->id][$student->idStudent];
                        break;
					}
					@endphp
					<td class="text-center">{{  bcdiv($promedio1, '1', 2) }}</td>
					@endforeach
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promediosTotalQ1[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promediosTotalQ1[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{  $promediosTotalQ1[$materia->id][$student->idStudent]== 0 ? "" : $promediosTotalQ1[$materia->id][$student->idStudent] }}</td>
					@foreach($parcialP2 as $par2 )
					@php
					switch ($par2->identificador) {
                    case 'p1q2':
                        $promedio2= bcdiv($promediosP1Q2[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'p2q2':
                          $promedio2= bcdiv($promediosP2Q2[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'p3q2':
                          $promedio2= bcdiv($promediosP3Q2[$materia->id][$student->idStudent]['promedio'], '1', 2);
                        break;
                    case 'q2':
                       $promedio2= $examenesQ2[$materia->id][$student->idStudent];
                        break;
					}
					@endphp
					<td class="text-center">{{  bcdiv($promedio2, '1', 2) }}</td>
					@endforeach
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promediosTotalQ2[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promediosTotalQ2[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{  $promediosTotalQ2[$materia->id][$student->idStudent]== 0 ? "" : $promediosTotalQ2[$materia->id][$student->idStudent] }}</td>
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promedioGeneral[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioGeneral[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{ $promedioGeneral[$materia->id][$student->idStudent]== 0 ? "" : $promedioGeneral[$materia->id][$student->idStudent] }}</td>
					<td class="text-center">{{  $recuperacionQ1[$materia->id][$student->idStudent]== 0 ? "" : bcdiv($recuperacionQ1[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{  $recuperacionQ2[$materia->id][$student->idStudent]== 0 ? "" : bcdiv($recuperacionQ2[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">
					@if( $promedioGeneralRecup[$materia->id][$student->idStudent] > 0 &&  $promedioGeneral[$materia->id][$student->idStudent] >= 7)
						{{ bcdiv($promedioGeneralRecup[$materia->id][$student->idStudent], '1', 2) }}
					@else
						{{ $promediar = false }}
					@endif
					</td>
					<td class="text-center">{{  $supletorios[$materia->id][$student->idStudent]== 0 ? "" : bcdiv($supletorios[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{  $remediales[$materia->id][$student->idStudent]== 0 ? "" : bcdiv($remediales[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{  $gracias[$materia->id][$student->idStudent]== 0 ? "" : bcdiv($gracias[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">
						@if( $promedioFinalQuimestre[$materia->id][$student->idStudent] > 0 &&  $promedioGeneral[$materia->id][$student->idStudent] >= 7)
							{{ bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2) }}
							@php
								$promediosFinal= $promediosFinal+bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2);
							@endphp
						@else
							<!--
								@if($supletorios[$materia->id][$student->idStudent] >= 7 || $remediales[$materia->id][$student->idStudent] >= 7 || $gracias[$materia->id][$student->idStudent] >= 7)
									{{ bcdiv($promedioGeneral[$materia->id][$student->idStudent], '1', 2) }}
								@endif
							-->
							@if( $supletorios[$materia->id][$student->idStudent] >= 7 )
								7.00
								@php
									$promediosFinal=$promediosFinal+7;
								@endphp
							@endif
							@if( $remediales[$materia->id][$student->idStudent] >= 7 )
								7.00
								@php
									$promediosFinal=$promediosFinal+7;
								@endphp
							@endif
							@if( $gracias[$materia->id][$student->idStudent] >= 7 )
								7.00
								@php
									$promediosFinal=$promediosFinal+7;
								@endphp
							@endif

							@if( $gracias[$materia->id][$student->idStudent]< 7 )
								@if($remediales[$materia->id][$student->idStudent]< 7)
									@if($supletorios[$materia->id][$student->idStudent]< 7)
										@php
											$mostrar = false;
										@endphp
									@endif
								@endif
							@endif
							{{ $promediar = false }}
						@endif
						</td>
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
							$mensaje = "Notas Incompletas";
						}

					@endphp
				@endforeach

			@endforeach
			<!-- DHI -->
			@if($dhi != null)
			<tr>
				<td class="uppercase bold">
					{{$dhi->nombre}}
				</td>
				<td colspan="{{(count($parcialP))+(count($parcialP2))+10}}" class="text-center">
					{{ $dhi["q1"] }}
				</td>
			</tr>
			@endif
			<tr class="bold">
				<td colspan="{{(count($parcialP))+(count($parcialP2))+11}}" class="uppercase">asignaturas adicionales </td>
			</tr>
			@foreach($materiasExtra->groupBy('area') as $key => $mExtras)

				@foreach($mExtras as $materia)

				<tr>
					<td class="pdfSubmateria uppercase">
					@if(count($mExtras) > 1)
						<img src="{{secure_asset('img/level-up.png')}}" alt="">
					@endif
						{{ $materia->nombre}}
					</td>
					<td class="text-center">{{  $promediosP1Q1[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP1Q1[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{  $promediosP2Q1[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP2Q1[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{  $promediosP3Q1[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP3Q1[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{  $examenesQ1[$materia->id][$student->idStudent] == 0 ? "" : $examenesQ1[$materia->id][$student->idStudent] }}</td>
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promedioGeneral[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioGeneral[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{  $promediosTotalQ1[$materia->id][$student->idStudent] == 0 ? "" : $promediosTotalQ1[$materia->id][$student->idStudent] }}</td>
					<td class="text-center">{{ $promediosP1Q2[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP1Q2[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{ $promediosP2Q2[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP2Q2[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{ $promediosP3Q2[$materia->id][$student->idStudent]['promedio'] == 0 ? "" : bcdiv($promediosP3Q2[$materia->id][$student->idStudent]['promedio'], '1', 2) }}</td>
					<td class="text-center">{{ $examenesQ2[$materia->id][$student->idStudent] == 0 ? "" : $examenesQ2[$materia->id][$student->idStudent] }}</td>
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promedioGeneral[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioGeneral[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{ $promediosTotalQ2[$materia->id][$student->idStudent] == 0 ? "" : $promediosTotalQ2[$materia->id][$student->idStudent] }}</td>
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promedioGeneral[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioGeneral[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{ $promedioGeneral[$materia->id][$student->idStudent] == 0 ? "" : $promedioGeneral[$materia->id][$student->idStudent] }}</td>
					<td class="text-center">{{ $recuperacionQ1[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($recuperacionQ1[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{ $recuperacionQ2[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($recuperacionQ2[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center"
					@if($notasMenores == "1")
						@if($promedioGeneral[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioGeneral[$materia->id][$student->idStudent]!=0)
							style="color:red;"
						@endif
					@endif
					>{{ $promedioGeneralRecup[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($promedioGeneralRecup[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{ $supletorios[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($supletorios[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{ $remediales[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($remediales[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{ $gracias[$materia->id][$student->idStudent] == 0 ? "" : bcdiv($gracias[$materia->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">
					@if( $promedioFinalQuimestre[$materia->id][$student->idStudent] > 0 &&  $promedioGeneral[$materia->id][$student->idStudent] >= 7)
							{{ bcdiv($promedioFinalQuimestre[$materia->id][$student->idStudent], '1', 2) }}
					@endif

						@if( $supletorios[$materia->id][$student->idStudent] >= 7 )
							7.00
						@endif
						@if( $remediales[$materia->id][$student->idStudent] >= 7 )
							7.00
						@endif
						@if( $gracias[$materia->id][$student->idStudent] >= 7 )
							7.00
						@endif

					</td>
				</tr>
					@php
						if($promedioGeneral[$materia->id][$student->idStudent] < 7 && $promedioGeneral[$materia->id][$student->idStudent] != 0){

							//validar si va a supletorio/remedial/gracia
							if ($supletorios[$materia->id][$student->idStudent] == 0){
								array_push($promedios, 'SUPLETORIO');
							}else if ($supletorios[$materia->id][$student->idStudent] >= 7 ){
								//array_push($promedios, 'PROMOVIDO');
							}else{
								if ($supletorios[$materia->id][$student->idStudent] < 7 && $remediales[$materia->id][$student->idStudent] == 0){
									array_push($promedios, 'REMEDIAL');
								}else if ($remediales[$materia->id][$student->idStudent] >= 7 ){
									//array_push($promedios, 'PROMOVIDO');
								}else {
									if ($remediales[$materia->id][$student->idStudent] < 7 && $gracias[$materia->id][$student->idStudent] == 0){
										array_push($promedios, 'GRACIA');
									}else if ($gracias[$materia->id][$student->idStudent] >= 7 ){
										//array_push($promedios, 'PROMOVIDO');
									} else {
										if ($gracias[$materia->id][$student->idStudent] < 7){
											//array_push($promedios, 'REPROBADO');
										}
									}
								}

							}
						}else{
							//array_push($promedios, 'PROMOVIDO');
						}
					@endphp
				@endforeach
			@endforeach
			@if($proyecto != null)
				<tr>
					@php
						$promedio = 0;
						$c = 0;
					@endphp

					<td>PROYECTOS ESCOLARES</td>
					@foreach($parcialP as $par )
					@php
					$notacualitativa= '';
					switch ($par->identificador) {
                    case 'p1q1':
                        if($promediosP1Q1[$proyecto->id][$student->idStudent]['promedio'] != 0){
                        $notacualitativa = App\Calificacion::notaCualitativa($promediosP1Q1[$proyecto->id][$student->idStudent]['promedio']);
                        }
                        break;
                    case 'p2q1':
                         if($promediosP2Q1[$proyecto->id][$student->idStudent]['promedio'] != 0){
						$notacualitativa = App\Calificacion::notaCualitativa($promediosP2Q1[$proyecto->id][$student->idStudent]['promedio']);
						}
					    break;
                    case 'p3q1':
                        if($promediosP3Q1[$proyecto->id][$student->idStudent]['promedio'] != 0){
						$notacualitativa = App\Calificacion::notaCualitativa($promediosP3Q1[$proyecto->id][$student->idStudent]['promedio']);
						}
                        break;
                    case 'q1':
                    	if($examenesQ1[$proyecto->id][$student->idStudent] != 0){
						$notacualitativa = App\Calificacion::notaCualitativa($examenesQ1[$proyecto->id][$student->idStudent]);
						}
                        break;
					}
					@endphp
					<td class="text-center">{{$notacualitativa}}</td>
					@endforeach
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
					@foreach($parcialP2 as $par2 )
					@php
						$notacualitativa2= '';
					switch ($par2->identificador) {
                    case 'p1q2':
                        if($promediosP1Q2[$proyecto->id][$student->idStudent]['promedio'] != 0){
                        $notacualitativa2 = App\Calificacion::notaCualitativa($promediosP1Q2[$proyecto->id][$student->idStudent]['promedio']);
                        }
                        break;
                    case 'p2q2':
                         if($promediosP2Q2[$proyecto->id][$student->idStudent]['promedio'] != 0){
						$notacualitativa2 = App\Calificacion::notaCualitativa($promediosP2Q2[$proyecto->id][$student->idStudent]['promedio']);
						}
					    break;
                    case 'p3q2':
                        if($promediosP3Q2[$proyecto->id][$student->idStudent]['promedio'] != 0){
						$notacualitativa2 = App\Calificacion::notaCualitativa($promediosP3Q2[$proyecto->id][$student->idStudent]['promedio']);
						}
                        break;
                    case 'q2':
                    	if($examenesQ2[$proyecto->id][$student->idStudent] != 0){
						$notacualitativa2 = App\Calificacion::notaCualitativa($examenesQ2[$proyecto->id][$student->idStudent]);
						}
                        break;
					}
					@endphp
					<td class="text-center">{{$notacualitativa2}}</td>
					@endforeach
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
						@if($promedioGeneral[$proyecto->id][$student->idStudent] != 0)
						@php
						$notacualitativa = App\Calificacion::notaCualitativa($promedioGeneral[$proyecto->id][$student->idStudent]);
						@endphp
						{{$notacualitativa}}
						@else
						-
						@endif
					</td>
					<td class="text-center">{{ $recuperacionQ1[$proyecto->id][$student->idStudent] == 0 ? "" : bcdiv($recuperacionQ1[$proyecto->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{ $recuperacionQ2[$proyecto->id][$student->idStudent] == 0 ? "" : bcdiv($recuperacionQ2[$proyecto->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">
						@if($promedioGeneralRecup[$proyecto->id][$student->idStudent] != 0)
							@php
						$notacualitativa = App\Calificacion::notaCualitativa($promedioGeneralRecup[$proyecto->id][$student->idStudent]);
						@endphp
						{{$notacualitativa}}
						@else
						-
						@endif
					</td>
					<td class="text-center">{{  $supletorios[$proyecto->id][$student->idStudent] == 0 ? "" : bcdiv($supletorios[$proyecto->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{  $remediales[$proyecto->id][$student->idStudent] == 0 ? "" : bcdiv($remediales[$proyecto->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">{{  $gracias[$proyecto->id][$student->idStudent] == 0 ? "" : bcdiv($gracias[$proyecto->id][$student->idStudent], '1', 2) }}</td>
					<td class="text-center">
						@if($promedioFinalQuimestre[$proyecto->id][$student->idStudent] != 0)
								@php
						$notacualitativa = App\Calificacion::notaCualitativa($promedioFinalQuimestre[$proyecto->id][$student->idStudent]);
						@endphp
						{{$notacualitativa}}
						@else
						-
						@endif
					</td>
				</tr>
				@endif
			<tr>
				<td class="uppercase">aprovechamiento</td>
				@foreach($parcialP as $par )
					@php
					switch ($par->identificador) {
                    case 'p1q1':
                        $aprovechamiento= bcdiv( $pp1q1[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'p2q1':
                          $aprovechamiento= bcdiv( $pp2q1[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'p3q1':
                          $aprovechamiento= bcdiv( $pp3q1[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'q1':
                       $aprovechamiento= bcdiv( $pExamenesQ1[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
					}
					@endphp
					<td class="text-center">{{  bcdiv($aprovechamiento, '1', 2) }}</td>
					@endforeach
				<td class="text-center">{{ bcdiv( $pPromediosQ1[$student->idStudent]/count($materiasFijas->get()), '1', 2) }}</td>
				@foreach($parcialP2 as $par2 )
					@php
					switch ($par2->identificador) {
                    case 'p1q2':
                        $aprovechamiento2= bcdiv( $pp1q2[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'p2q2':
                          $aprovechamiento2= bcdiv( $pp2q2[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'p3q2':
                          $aprovechamiento2= bcdiv( $pp3q2[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
                    case 'q2':
                       $aprovechamiento2= bcdiv( $pExamenesQ2[$student->idStudent]/count($materiasFijas->get()), '1', 2);
                        break;
					}
					@endphp
					<td class="text-center">{{  bcdiv($aprovechamiento2, '1', 2) }}</td>
					@endforeach
				<td class="text-center">{{ bcdiv( $pPromediosQ2[$student->idStudent]/count($materiasFijas->get()), '1', 2) }}</td>
				<td class="text-center">{{ bcdiv( $pPromediosTotal[$student->idStudent]/count($materiasFijas->get()), '1', 2) }}</td>
				<td colspan="2" class="text-center"></td>
				<td class="text-center">{{ bcdiv( $pPromediosTotalRecup[$student->idStudent]/count($materiasFijas->get()), '1', 2) }}</td>
				<td colspan="3" class="text-center"></td>
				<td class="text-center">
					<!--
					@if($promediar)
						{{ bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas->get()), '1', 2) }}
						@php
							if( $curso->grado=="Tercero de Bachillerato" &&  bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas->get()), '1', 2)>=7 ){
								$mensaje="Ha culminado la Educación Secundaria";
							}
						@endphp
					@endif
					-->

					@if( $mostrar==true)
						{{ bcdiv( $promediosFinal/count($materiasFijas->get()), '1', 2)}}
					@else

					@endif
				</td>
			</tr>
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
				<td colspan="8" class="text-center bold">
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
			<tr>
				<td colspan="19"></td>
			</tr>
			<tr class="">
				<td class="uppercase">asistencia(por horas de clase)</td>
				<td colspan="{{count($parcialP)}}" class="text-center uppercase"></td>
				<td class="text-center uppercase">total</td>
				<td colspan="{{count($parcialP2)}}" class="text-center uppercase"></td>
				<td class="text-center uppercase">total</td>
				<td colspan="7" class="text-center uppercase"></td>
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
					<td colspan="7" class="text-center"></td>
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
		<br>
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
		<div>
			<h4>

				@php
					$mensajeReprobado = '';
					foreach(array_unique($promedios) as $promedio){
						$mensajeReprobado.= 'Alumno '.$promedio;
					}
				@endphp
				@if(count($promedios) == 0)
					{{ $mensaje }}
				@else
					{{ $mensajeReprobado }}
				@endif
			</h4>
		</div>
		<div style="page-break-after:always;"></div>
		@endforeach
	</main>
</body>

</html>