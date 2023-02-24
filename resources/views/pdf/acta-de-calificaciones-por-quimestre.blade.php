<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/print.css')}} " media="print">
	<link rel="stylesheet" href=" {{secure_asset('css/print.css')}} ">
	<link rel="stylesheet" href="{{secure_asset('css/no-print.css')}}">
	<title>Acta de calificaciones por quimestre</title>
</head>

<body class="actaCalificacionesParcial">
	@foreach($matters as $matter)
	<header class="actaCalificacionesParcial__header">
		<h3 class="up">{{ $institution->nombre }}</h3>
		<h3 class="up">acta de calificaciones del {{ $Quimestre }} quimestre</h3>
		<h3 class="up">Año Lectivo: {{$institution->periodoLectivo}}  </h3>
	</header>
	<br>
	
	<table class="table">
		<tr>
			<td class="no-border up">Nivel: {{ $educacion }}</td>
			<td class="no-border up text-right">Fecha: {{$now->format('d/m/Y')}}</td>
		</tr>
		<tr>
			<td class="no-border up">{{ $curso->grado }} {{ $curso->paralelo }}</td>
		</tr>
		<tr>
			<td class="no-border up">asignatura: {{ $matter->nombre }}</td>
			<td class="no-border up text-right">profesor: castro ricardo</td>
		</tr>
	</table>
	<section class="actaCalificacionesParcial__section">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<td rowspan="2" class="text-center" width="10">No.</td>
				<td rowspan="2" class="text-center">Nombre</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">primer parcial</span>
					</p>
				</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">segundo parcial</span>
					</p>
				</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">tercer parcial</span>
					</p>
				</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">promedio parcial</span>
					</p>
				</td>
				<td class="text-center no-border" rowspan="2">
					<p class="s-calificaciones__materia">
						<span class="up">80% del promedio parcial</span>
					</p>
				</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">examen quimestral</span>
					</p>
				</td>
				<td class="text-center no-border" rowspan="2">
					<p class="s-calificaciones__materia">
						<span class="up">20% del examen quimestral</span>
					</p>
				</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">nota del quimestre</span>
					</p>
				</td>
			</tr>
			<tr>
				<td class="up text-center">n</td>
				<td class="up text-center">n</td>
				<td class="up text-center">n</td>
				<td class="up text-center">n</td>
				<td class="up text-center">n</td>
				<td class="up text-center">n</td>
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td>{{ $student->apellidos }} {{ $student->nombres }}</td>
				<td class="text-center">
				@if($promediosP1[$matter->id][$student->id]['promedio'] != 0)
					{{ bcdiv($promediosP1[$matter->id][$student->id]['promedio'], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($promediosP2[$matter->id][$student->id]['promedio'] != 0)
					{{ bcdiv($promediosP2[$matter->id][$student->id]['promedio'], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($promediosP3[$matter->id][$student->id]['promedio'] != 0)
					{{ bcdiv($promediosP3[$matter->id][$student->id]['promedio'], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($promediosTotal[$matter->id][$student->id] != 0)
					{{ bcdiv($promediosTotal[$matter->id][$student->id], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($promedios80[$matter->id][$student->id] != 0)
					{{ bcdiv($promedios80[$matter->id][$student->id], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center"></td>
				<td class="text-center"></td>
				<td class="text-center"></td>
			</tr>
			@endforeach
		</table>
		<div class="firmas-grid">
			<div class="firmas-item">
				<div class="firmas-hr"></div>
				<h3>Profesor:</h3>
			</div>
			<div class="firmas-item">
				<div class="firmas-hr"></div>
				<h3>Fecha de Entrega:</h3>
			</div>
		</div>
	</section>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div style="page-break-after:always;"></div>

	@endforeach
</body>

</html>