<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Listado de Calificaciones Pendientes por Curso</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
@php
$n_parcial = "";
$quimestre = "";
switch ($parcial){
	case "p1q1":
		$n_parcial = "1";
		$quimestre = "1";
	break;
	case "p2q1":
		$n_parcial = "2";
		$quimestre = "1";
	break;
	case "p3q1":
		$n_parcial = "3";
		$quimestre = "1";
	break;
	case "p1q2":
		$n_parcial = "1";
		$quimestre = "2";
	break;
	case "p2q2":
		$n_parcial = "2";
		$quimestre = "2";
	break;
	case "p3q2":
		$n_parcial = "3";
		$quimestre = "2";
	break;

}
@endphp
<body>
	<main>
		<table class="table">
			<tr>
				<th style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
				</th>
				<th class="no-border" width="60%">
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">
							semestre {{$quimestre}} - modulo {{$n_parcial}}
						</h3>
						<h3 class="up">Año Lectivo: {{$periodo->nombre}}  </h3>
						<h3 class="up">
							Calificaciones Pendientes
						</h3>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<br>
		<table class="w100">
			<tr>
				<td class="text-left uppercase">{{ $course->grado}} {{ $course->paralelo }} {{ $course->especializacion }}</td>
			</tr>
		</table>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td class="text-center bold" width="10">No.</td>
				<td class="text-center bold">NOMBRE</td>
				<td class="text-center bold">MATERIA</td>
				<td class="text-center bold">PROFESOR</td>
				@foreach ($insumos[$matters->first()->id] as $insumo)
					<td class="text-center bold" width="18">{{$insumo->nombre}}</td>
				@endforeach
			</tr>
			@foreach($matters as $matter)
				@foreach($students as $student)
				@php
					$c = 0;
				@endphp
					@foreach($insumos[$matter->id] as $key => $insumo)
						@if($promedios[$matter->id][$insumo->id][$student->idStudent]['promedio'] == 0)
							@php	
								$c++;  
							@endphp
						@endif
					@endforeach

					@if($c > 0)
					<tr>
						<td class="text-center">{{ $loop->iteration }}</td>
						<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
						<td class="uppercase">{{ $matter->nombre }}</td>
						<td class="uppercase">
						@if($docentes->where('id', $matter->idDocente)->first() != null)
							{{ $docentes->where('id', $matter->idDocente)->first()->profile->apellidos }} {{ $docentes->where('id', $matter->idDocente)->first()->profile->nombres}}
						@endif
						</td>				
						@foreach($insumos[$matter->id] as $key => $insumo)
							@if($promedios[$matter->id][$insumo->id][$student->idStudent]['promedio'] == 0)
								<td class="text-center bold">x</td>
							@else
								<td class="text-center bold"></td>
							@endif
						@endforeach
					</tr>
					@endif
				@endforeach
			@endforeach
		</table>
	</main>
</body>

</html>