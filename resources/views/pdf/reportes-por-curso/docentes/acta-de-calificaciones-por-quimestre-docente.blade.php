<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Acta de calificaciones por quimestre</title>
</head>
<style>
.table td,
.table th {
    font-size: 7pt !important;
}
</style>
<body class="actaCalificacionesParcial">
	@foreach($matters as $matter)
    @php
        $curso = $cursos->where('id', $matter->idCurso)->first();
        switch($curso->grado){
            case "Inicial 1":
                $educacion = "Educación General Básica - Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = "Educación General Básica - Educacion Inicial";
            break;
            case "Primero":
                $educacion = "Educación General Básica - Preparatoria";
            break;
            case "Segundo":
                $educacion = "Educación General Básica - Basica Elemental";
            break;
            case "Tercero":
                $educacion = "Educación General Básica - Basica Elemental";
            break;
            case "Cuarto":
                $educacion = "Educación General Básica - Basica Elemental";
            break;
            case "Quinto":
                $educacion = "Educación General Básica - Basica Media";
            break;
            case "Sexto":
                $educacion = "Educación General Básica - Basica Media";
            break;
            case "Septimo":
                $educacion = "Educación General Básica - Basica Media";
            break;
            case "Octavo":
                $educacion = "Educación General Básica - Basica Superior";
            break;
            case "Noveno":
                $educacion = "Educación General Básica - Basica Superior";
            break;
            case "Decimo":
                $educacion = "Educación General Básica - Basica Superior";
            break;
            case "Primero de Bachillerato":
                $educacion = "Bachillerato General Unificado";
            break;
            case "Segundo de Bachillerato":
                $educacion = "Bachillerato General Unificado";
            break;
            case "Tercero de Bachillerato":
                $educacion = "Bachillerato General Unificado";
            break;
        }

    @endphp
	<header class="actaCalificacionesParcial__header">
		<h3 class="up text-center m-0">{{ $institution->nombre }}</h3>
		<h3 class="up text-center m-0">acta de calificaciones del {{ $Quimestre }} quimestre</h3>
		<h3 class="up text-center m-0">año lectivo {{$periodo}}  </h3>
	</header>
	<br>

	<table class="table bold">
		<tr>
			<td class="no-border up">Nivel: {{ $educacion }}</td>
			<td class="no-border up text-right">Fecha: {{$now->format('d/m/Y')}}</td>
		</tr>
		<tr>
			<td class="no-border up">{{ $curso->grado }} {{$curso->especializacion}} {{ $curso->paralelo }}</td>
		</tr>
		<tr>
		@if(strlen($curso->especializacion) > 0)
			<td class="no-border up">{{ $curso->especializacion }}</td>
		@endif
		</tr>
		<tr>
			<td class="no-border up">asignatura: {{ $matter->nombre }}</td>
			<td class="no-border up text-right">profesor: {{ $docente->apellidos }} {{ $docente->nombres }}</td>
		</tr>
	</table>
	<section class="actaCalificacionesParcial__section">
		<br>
		<br>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<td rowspan="2" class="text-center" width="10">No.</td>
				<td rowspan="2" class="text-center up">Nombre</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">primer parcial</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">segundo parcial</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">tercer parcial</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">promedio parcial</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important" rowspan="2">
					<p class="s-calificaciones__materia">
						<span class="up bold">80% del promedio parcial</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">examen quimestral</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important" rowspan="2">
					<p class="s-calificaciones__materia">
						<span class="up bold">20% del examen quimestral</span>
					</p>
				</td>
				<td class="text-center no-border" style="font-size: 5pt !important">
					<p class="s-calificaciones__materia">
						<span class="up bold">nota del quimestre</span>
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
			@foreach($students->where('idCurso', $curso->id) as $student)
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
				<td class="text-center">
				@if($examenes[$matter->id][$student->id] != 0)
					{{ bcdiv($examenes[$matter->id][$student->id], '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($examenes[$matter->id][$student->id] != 0)
					{{ bcdiv(($examenes[$matter->id][$student->id]*0.2), '1', 2) }}
				@else
				-
				@endif
				</td>
				<td class="text-center">
				@if($examenes[$matter->id][$student->id] != 0 && $promedios80[$matter->id][$student->id] != 0)
					{{ bcdiv( (($examenes[$matter->id][$student->id]*0.2) + $promedios80[$matter->id][$student->id]) , '1', 2) }}
				@else
				-
				@endif
				</td>
			</tr>
			@endforeach
		</table>
		<table class="table">
			<tr>
				<th></th>
			</tr>
		</table>
		<br>
		<table class="table">
			<tr>
				<th width="10%"></th>
				<th width="35%">
					<hr style="border:1px solid black;">
					<h3 class="m-0 text-center">Profesor</h3>
				</thw>
				<th width="10%"></th>
				<th width="35%">
					<hr style="border:1px solid black; ">
					<h3 class="m-0 text-center">Fecha de Entrega</h3>
				</th>
				<th width="10%"></th>
			</tr>
		</table>
	</section>
	<div style="page-break-after:always;"></div>
	@endforeach
</body>

</html>