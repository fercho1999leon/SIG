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
// condicional si salen 2 o 3 hojas dependiendo la cantidad de materias
$numeroDeMaterias = count($matters);

$esSupletorios = [];		
foreach($students as $student){
	$esSupletorios[$student->id] = "APROBADO";		
	foreach($matters as $matter){
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
	<table class="table">
		<tr>
		<td width="30%" class="no-border up">{{ $institution->jornada }}</td>
		<td width="40%" class="no-border up text-center"></td>
		<td width="30%" class="no-border up text-right">
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
		<tr class="bgDark">
			<td width="5" rowspan="3" class="bold text-center">No.</td>
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
		<tr height="130">
			@foreach($matters->take(6) as $matter)
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 1</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 2</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio anual</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">supletorio</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">remedial</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">gracia</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio final</span>
					</p>
				</td>
			@endforeach
		</tr>
		@foreach($students as $student)
		<tr>
		<td class="text-center">{{ $loop->iteration }}</td>
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
					<td class="text-center"></td>
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
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2 }}</h4>
			</th>
			<th width="10%"></th>
		</tr>
	</table>
	<div style="page-break-after:always;"></div>
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
	<table class="table">
		<tr class="bgDark">
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
		<tr height="130">
			@foreach($matters->slice(6)->take(9) as $matter)
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 1</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 2</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio anual</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">supletorio</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">remedial</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">gracia</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio final</span>
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
					<td class="text-center"></td>
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
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2 }}</h4>
			</th>
			<th width="10%"></th>
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
	<table class="table">
		<tr class="bgDark">
			<td rowspan="3" width="5" class="text-center">No.</td>
			@foreach($matters->slice(15)->take(5) as $matter)
				<td colspan="7" class="text-center up bold">{{ $matter->nombre }}</td>
			@endforeach	
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
		<tr height="130">
			@foreach($matters->slice(15)->take(5) as $matter)
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 1</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">quimestre 2</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio anual</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">supletorio</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">remedial</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">gracia</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">promedio final</span>
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
					<td class="text-center"></td>
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
			<td class="up">{{ $esSupletorios[$student->id] }}</td>
		</tr>
		@endforeach
	</table>
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2 }}</h4>
			</th>
			<th width="10%"></th>
		</tr>
	</table>
</body>

</html>