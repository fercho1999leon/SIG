<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Sabana por curso</title>
</head>
@php
$numeroDeMaterias = count($matters);
$numeroDeEstudiantes = count($students);
$cantidadDeEstudiantePorHoja = 15;

$esSupletorios = [];	
$aprovechamiento = [];	
foreach($students as $student){
	$esSupletorios[$student->id] = "APROBADO";		
	$aprovechamiento[$student->id] = 0;
	foreach($matters as $matter){
		$aprovechamiento[$student->id] += $promediosAnuales[$matter->id][$student->id];
		if($promediosAnuales[$matter->id][$student->id] < 7 && $promediosAnuales[$matter->id][$student->id] != 0 ){
			if($supletorios[$matter->id][$student->id] == 0)
				$esSupletorios[$student->id] = "SUPLETORIO";
			else if($remediales[$matter->id][$student->id] == 0)
				$esSupletorios[$student->id] = "REMEDIAL";
			else if($gracias[$matter->id][$student->id] == 0)
				$esSupletorios[$student->id] = "GRACIA";
		}else if ($promediosAnuales[$matter->id][$student->id] == 0)
			$esSupletorios[$student->id] = "NOTAS INCOMPLETAS";
	}
}
@endphp
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top" class="no-border" width="20%">
				<div class="header__logo" style="float: left">
					<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
					<h4 class="m-0 up">
						Cuadro de calificaciones finales
					</h4>
					<h4 class="m-0 bold uppercase"><small> año lectivo {{$institution->periodoLectivo}} </small> </h4>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table m-0">
		<tr>
		<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
		<td width="50%" class="no-border up text-right">
			@if($course->grado=='Segundo') 
				Segundo Grado de Educacion General Elemental
			@endif
			@if($course->grado=='Tercero') 
				Tercer Grado de Educacion General Elemental
			@endif
			@if($course->grado=='Cuarto') 
				Cuarto Grado de Educacion General Elemental
			@endif
			@if($course->grado=='Quinto') 
				Quinto Grado de Educacion General Media
			@endif
			@if($course->grado=='Sexto') 
				Sexto Grado de Educacion General Media
			@endif
			@if($course->grado=='Septimo') 
				Septimo Grado de Educacion General Media
			@endif
			@if($course->grado=='Octavo') 
				Octavo Grado de Educacion General Superior
			@endif
			@if($course->grado=='Noveno') 
				Noveno Grado de Educacion General Superior
			@endif
			@if($course->grado=='Decimo') 
				Decimo Grado de Educacion General Superior
			@endif
			@if($course->grado=='Primero de Bachillerato')
				Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
			@endif
			@if($course->grado=='Segundo de Bachillerato')
				Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
			@endif
			@if($course->grado=='Tercero de Bachillerato')
				Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
			@endif
			{{ $course->paralelo }} 
		</td>
		</tr>
	</table>
	<table class="table whitespace-no">
		<tr height="40">
			<td width="5" rowspan="3" class="text-center">No.</td>
			<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
			<td rowspan="3" width="5" class="text-center up bold">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="up bold">Comportamiento</span>
				</p>
			</td>
			@foreach($matters->take(6) as $matter)
				<td colspan="7" class="text-center up bold">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr height="130">
			@foreach($matters->take(6) as $matter)
				<td colspan="7" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">{{ $matter->nombre }}</span>
					</p>
				</td>
			@endforeach
		</tr>
		<tr height="40">
			@foreach($matters->take(6) as $matter)
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">q1</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">q2</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">pro</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">sup</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">rem</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">gra</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">p.f</span>
					</p>
				</td>
			@endforeach
		</tr>
		@php
			$primeraEstructura = false;
		@endphp
		@while ($numeroDeEstudiantes > $cantidadDeEstudiantePorHoja)
			@if ($primeraEstructura == true)
				<table class="table">
			@endif
			@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantePorHoja) as $student)
				<tr>
					<td class="text-center">{{ $loop->iteration + $sliceEstudiantes}}</td>
					<td width="300" class="up">{{ $student->apellidos }} {{ $student->nombres }} </td>
					<td class="text-center">{{ $student->p3q2C}}</td>
					@foreach($matters->take(6) as $matter)
						<td class="text-center"> {{ $promediosQ1[$matter->id][$student->id] == 0 ? "" : $promediosQ1[$matter->id][$student->id] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->id] == 0 ? "" : $promediosQ2[$matter->id][$student->id] }}</td>
						<td class="text-center"
						@if($notasMenores == "1") 
							@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
								style="color:red;"
							@endif
						@endif >
						{{ $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] }}</td>	
						@if( $promediosAnuales[$matter->id][$student->id] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">{{ $promediosFinales[$matter->id][$student->id] }}</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)

								@else
									7
								@endif
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
			</table>
			<br>
			<br>
			<br>
			<table class="table">
				<tr>
					<th width="35%"></th>
					<th width="30%">
						<hr style="border:1px solid black;">
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
					</th>
					<th width="35%"></th>
				</tr>
			</table>
			<div style="page-break-after:always;"></div>
			@php
				$numeroDeEstudiantes -= $cantidadDeEstudiantePorHoja;
				$sliceEstudiantes += $cantidadDeEstudiantePorHoja;
				$primeraEstructura = true;
			@endphp
		@endwhile
	<table class="table">
		@foreach($students->slice($cantidadDeEstudiantePorHoja)->take($numeroDeEstudiantes) as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration + $sliceEstudiantes}}</td>
				<td width="300" class="up">{{ $student->apellidos }} {{ $student->nombres }} </td>
				<td class="text-center">{{ $student->p3q2C}}</td>
				@foreach($matters->take(6) as $matter)
					<td class="text-center"> {{ $promediosQ1[$matter->id][$student->id] == 0 ? "" : $promediosQ1[$matter->id][$student->id] }} </td>
					<td class="text-center">{{ $promediosQ2[$matter->id][$student->id] == 0 ? "" : $promediosQ2[$matter->id][$student->id] }}</td>
					<td class="text-center"
					@if($notasMenores == "1") 
						@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
							style="color:red;"
						@endif
					@endif >
					{{ $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] }}</td>	
					@if( $promediosAnuales[$matter->id][$student->id] >= 7)
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center">{{ $promediosFinales[$matter->id][$student->id] }}</td>
					@else
						<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
						<td class="text-center">
							@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)

							@else
								7
							@endif
						</td>
					@endif
				@endforeach
			</tr>
		@endforeach
	</table>
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<th width="35%"></th>
			<th width="30%">
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
			</th>
			<th width="35%"></th>
		</tr>
	</table>
	<div style="page-break-after:always;"></div>
	@if ($numeroDeMaterias < 16)
		{{-- 2da hoja --}}
		<table class="table">
			<tr>
				<th style="vertical-align:top" class="no-border" width="20%">
					<div class="header__logo" style="float: left">
						<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
					</div>
				</th>
				<th class="no-border" width="60%">
					<div class="header__info text-center">
						<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
						<h4 class="m-0 up">
							Cuadro de calificaciones finales
						</h4>
						<h4 class="m-0 bold uppercase"><small> año lectivo {{$institution->periodoLectivo}} </small> </h4>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<table class="table m-0">
			<tr>
				<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
				<td width="50%" class="no-border up text-right">
					@if($course->grado=='Segundo') 
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero') 
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto') 
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto') 
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto') 
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo') 
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo') 
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno') 
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo') 
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					{{ $course->paralelo }} 
				</td>
			</tr>
		</table>
		<table class="table">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>			
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">{{ $matter->nombre }}</td>
				@endforeach
				@if($proyecto != null)
					<td colspan="7" class="text-center up bold">{{ $proyecto->nombre }}</td>
				@endif
				<td rowspan="3" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">aprovechamiento</span>
					</p>
				</td>
				<td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="130">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
				@if($proyecto != null)
				<td colspan="7" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">{{ $proyecto->nombre }}</span>
					</p>
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach	
				@if($proyecto != null)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endif
			</tr>
			@foreach($students as $student)

				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center"> {{ $promediosQ1[$matter->id][$student->id] == 0 ? "" : $promediosQ1[$matter->id][$student->id] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->id] == 0 ? "" : $promediosQ2[$matter->id][$student->id] }}</td>
						<td class="text-center"
						@if($notasMenores == "1") 
							@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
								style="color:red;"
							@endif
						@endif >
						{{$promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] }}</td>	
							@if( $promediosAnuales[$matter->id][$student->id] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">{{ $promediosFinales[$matter->id][$student->id] }}</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)
			
									@else
										7
									@endif
								</td>
							@endif
					@endforeach	
					@if($proyecto != null)
						<td class="text-center">
						@if($promediosQ1[$proyecto->id][$student->id] != 0)
							@if( $promediosQ1[$proyecto->id][$student->id]>= 9)
								EX
							@endif 
							@if ( $promediosQ1[$proyecto->id][$student->id]<9 && $promediosQ1[$proyecto->id][$student->id]>=7)
								MB
							@endif
							@if( $promediosQ1[$proyecto->id][$student->id]>4 && $promediosQ1[$proyecto->id][$student->id]<7)
								B
							@endif
							@if( $promediosQ1[$proyecto->id][$student->id]==4)
								R
							@endif
							@if( $promediosQ1[$proyecto->id][$student->id]<4)
								R
							@endif	
						@endif
						</td>
						<td class="text-center">
						@if($promediosQ2[$proyecto->id][$student->id] != 0)
							@if( $promediosQ2[$proyecto->id][$student->id]>= 9)
								EX
							@endif 
							@if ( $promediosQ2[$proyecto->id][$student->id]<9 && $promediosQ2[$proyecto->id][$student->id]>=7)
								MB
							@endif
							@if( $promediosQ2[$proyecto->id][$student->id]>4 && $promediosQ2[$proyecto->id][$student->id]<7)
								B
							@endif
							@if( $promediosQ2[$proyecto->id][$student->id]==4)
								R
							@endif
							@if( $promediosQ2[$proyecto->id][$student->id]<4)
								R
							@endif	
						@endif
						</td>
						<td class="text-center"
						@if($notasMenores == "1") 
							@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
								style="color:red;"
							@endif
						@endif >
						@if($promediosAnuales[$proyecto->id][$student->id] != 0)
							@if( $promediosAnuales[$proyecto->id][$student->id]>= 9)
								EX
							@endif 
							@if ( $promediosAnuales[$proyecto->id][$student->id]<9 && $promediosAnuales[$proyecto->id][$student->id]>=7)
								MB
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->id]>4 && $promediosAnuales[$proyecto->id][$student->id]<7)
								B
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->id]==4)
								R
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->id]<4)
								R
							@endif	
						@endif
						</td>	
						@if( $promediosAnuales[$matter->id][$student->id] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">
								@if($promediosFinales[$proyecto->id][$student->id] != 0)
								@if( $promediosFinales[$proyecto->id][$student->id]>= 9)
									EX
								@endif 
								@if ( $promediosFinales[$proyecto->id][$student->id]<9 && $promediosFinales[$proyecto->id][$student->id]>=7)
									MB
								@endif
								@if( $promediosFinales[$proyecto->id][$student->id]>4 && $promediosFinales[$proyecto->id][$student->id]<7)
									B
								@endif
								@if( $promediosFinales[$proyecto->id][$student->id]==4)
									R
								@endif
								@if( $promediosFinales[$proyecto->id][$student->id]<4)
									R
								@endif	
							@endif
							</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)
		
								@else
									7
								@endif
							</td>
						@endif
					@endif
					<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->id]/$numeroDeMaterias), '1', 2) }}</td>	
					<td class="up">{{ $esSupletorios[$student->id] }}</td>
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="35%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
				</th>
				<th width="35%"></th>
			</tr>
		</table>
	@else
		{{-- 2da hoja --}}
		<table class="table">
			<tr>
				<th style="vertical-align:top" class="no-border" width="20%">
					<div class="header__logo" style="float: left">
						<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
					</div>
				</th>
				<th class="no-border" width="60%">
					<div class="header__info text-center">
						<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
						<h4 class="m-0 up">
							Cuadro de calificaciones finales
						</h4>
						<h4 class="m-0 bold uppercase"><small> año lectivo {{$institution->periodoLectivo}} </small> </h4>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<table class="table m-0">
			<tr>
				<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
				<td width="50%" class="no-border up text-right">
					@if($course->grado=='Segundo') 
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero') 
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto') 
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto') 
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto') 
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo') 
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo') 
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno') 
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo') 
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					{{ $course->paralelo }} 
				</td>
			</tr>
		</table>
		<table class="table">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>			
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr height="130">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
			</tr>
			<tr height="40">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach	
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				@foreach($matters->slice(6)->take(9) as $matter)
				<td class="text-center"> {{ $promediosQ1[$matter->id][$student->id] == 0 ? "" : $promediosQ1[$matter->id][$student->id] }} </td>
					<td class="text-center">{{ $promediosQ2[$matter->id][$student->id] == 0 ? "" : $promediosQ2[$matter->id][$student->id] }}</td>
					<td class="text-center"
					@if($notasMenores == "1") 
						@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
							style="color:red;"
						@endif
					@endif >
					{{ $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] }}</td>	
					@if( $promediosAnuales[$matter->id][$student->id] >= 7)
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center">{{ $promediosFinales[$matter->id][$student->id] }}</td>
					@else
						<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
						<td class="text-center">
							@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)

							@else
								7
							@endif
						</td>
					@endif
				@endforeach	
			</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="35%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
				</th>
				<th width="35%"></th>
			</tr>
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 3era hoja --}}
		<table class="table">
			<tr>
				<th style="vertical-align:top" class="no-border" width="20%">
					<div class="header__logo" style="float: left">
						<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
					</div>
				</th>
				<th class="no-border" width="60%">
					<div class="header__info text-center">
						<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
						<h4 class="m-0 up">
							Cuadro de calificaciones finales
						</h4>
						<h4 class="m-0 bold uppercase"><small> año lectivo {{$institution->periodoLectivo}} </small> </h4>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<table class="table m-0">
			<tr>
				<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
				<td width="50%" class="no-border up text-right">
					@if($course->grado=='Segundo') 
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero') 
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto') 
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto') 
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto') 
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo') 
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo') 
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno') 
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo') 
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					{{ $course->paralelo }} 
				</td>
			</tr>
		</table>
		<table class="table" style="width:auto">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>
				@foreach($matters->slice(15)->take(5) as $matter)
					<td colspan="7" class="text-center up bold">{{ $matter->nombre }}</td>
				@endforeach	
				<td rowspan="3" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">aprovechamiento</span>
					</p>
				</td>
				<td rowspan="3" class="up text-center">observaciones</td>	
			</tr>
			<tr height="130">
				@foreach($matters->slice(15)->take(5) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
			</tr>
			<tr height="40">
				@foreach($matters->slice(15)->take(5) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach		
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				@foreach($matters->slice(15)->take(5) as $matter)
				<td class="text-center"> {{ $promediosQ1[$matter->id][$student->id] == 0 ? "" : $promediosQ1[$matter->id][$student->id] }} </td>
					<td class="text-center">{{ $promediosQ2[$matter->id][$student->id] == 0 ? "" : $promediosQ2[$matter->id][$student->id] }}</td>
					<td class="text-center"
					@if($notasMenores == "1") 
						@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0) 
							style="color:red;"
						@endif
					@endif >
					{{ $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] == 0 ? "" : $promediosAnuales[$matter->id][$student->id] }}</td>	
					@if( $promediosAnuales[$matter->id][$student->id] >= 7)
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center">{{ $promediosFinales[$matter->id][$student->id] }}</td>
					@else
						<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id] }}</td>
						<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id] }}</td>
						<td class="text-center">
							@if( $supletorios[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] < 7 && $gracias[$matter->id][$student->id] < 7)
	
							@else
								7
							@endif
						</td>
					@endif
				@endforeach	
				<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->id]/$numeroDeMaterias), '1', 2) }}</td>	
				
				<td class="up">{{ $esSupletorios[$student->id] }}</td>
			</tr>
			@endforeach
		</table>
	@endif
</body>

</html>