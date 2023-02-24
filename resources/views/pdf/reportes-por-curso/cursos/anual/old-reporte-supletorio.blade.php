<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Supletorio</title>
</head>

<body>
	@include('partials.encabezados.reporte-formato-horizontal', [
		'reportName' => 'supletorio'
	])
	<p class="bold">
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
	</p>
	<table class="table whitespace-no">
		<tr height="165">
			<td rowspan="2" width="5" class="bold text-center">No.</td>
			<td rowspan="2" class="bold text-center up">apellidos y nombres</td>
			<td rowspan="2" class="text-center" width="5">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="actaDeCalificacionesRecuperacion__1 bold up">comportamiento</span>
				</p>
			</td>
			@foreach($matters->where('principal', 1)  as $matter)
			<td colspan="3" class="text-center" height="150">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="up bold">{{ $matter->nombre }}</span>
				</p>
			</td>
			@endforeach
		</tr>
		<tr height="20">
			@foreach($matters->where('principal', 1)  as $matter)
				<td class="text-center up">pq</td>
				<td class="text-center up">sup.</td>
				<td class="text-center up">p.f.</td>
			@endforeach
		</tr>
		@php
		$esSupletorios = [];
		@endphp
		@foreach($students as $student)
		<tr>
		@php
		$esSupletorios[$student->id] = "APROBADO";
		$pFinal = 0;
		@endphp
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
			<td class="text-center bold up">
			@if($student["p3q2C"]!=null)
				{{ $student["p3q2C"] }}
			@else
				-
			@endif
			</td>
			@foreach($matters->where('principal', 1) as $matter)
			@if($promediosAnuales[$matter->id][$student->id] < 7 && $promediosAnuales[$matter->id][$student->id] >= 5 && $promediosAnuales[$matter->id][$student->id] != 0)
				<td class="text-center"
				@if($notasMenores == "1")
					@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0)
						style="color:red;"
					@endif
				@endif
				>{{ $promediosAnuales[$matter->id][$student->id] }}</td>
				@php
					if($promediosAnuales[$matter->id][$student->id]< 7){
						if($supletorios[$matter->id][$student->id]==0)
							$esSupletorios[$student->id] = "SUPLETORIO";
						else if( $supletorios[$matter->id][$student->id]<7 )
							$esSupletorios[$student->id] = "REMEDIAL";
						}

				@endphp

				<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
				<td class="text-center"
				@if($notasMenores == "1")
					@if($promediosFinales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosFinales[$matter->id][$student->id]!=0)
						style="color:red;"
					@endif
				@endif >
					{{ $supletorios[$matter->id][$student->id] < 7 ? "" : 7 }}
				</td>
			@else
				<td class="text-center"></td>
				<td class="text-center"></td>
				<td class="text-center"></td>
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
	@include('partials.encabezados.libretas-ministerial', ['reportName' => 'Reporte supletorio'])
	<p class="bold" style="visibility: hidden">
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
	</p>
	<table class="table whitespace-no" style="width: auto;">
		<tr height="165">
			<td rowspan="2" width="5" class="bold text-center">No.</td>
			@foreach($matters->where('principal', 0) as $matter)
			<td colspan="3" class="text-center">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="actaDeCalificacionesRecuperacion__1 bold up">{{ $matter->nombre }}</span>
				</p>
			</td>
			@endforeach
			<td rowspan="2" class="text-center" width="500">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="actaDeCalificacionesRecuperacion__1 bold up">observaciones</span>
				</p>
			</td>
		</tr>
		<tr height="20">
			@foreach($matters->where('principal', 0) as $matter)
				<td class="text-center up">pq</td>
				<td class="text-center up">sup.</td>
				<td class="text-center up">p.f.</td>
			@endforeach
		</tr>
		@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				@foreach($matters->where('principal', 0) as $matter)
					@if($promediosAnuales[$matter->id][$student->id] < 7 && $promediosAnuales[$matter->id][$student->id] >= 5 && $promediosAnuales[$matter->id][$student->id] != 0)
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->id]!=0)
								style="color:red;"
							@endif
						@endif
						>{{ $promediosAnuales[$matter->id][$student->id] }}</td>
						@php
						if($promediosAnuales[$matter->id][$student->id]< 7){
							if($supletorios[$matter->id][$student->id]==0)
								$esSupletorios[$student->id] = "SUPLETORIO";
							else if( $supletorios[$matter->id][$student->id]<7 )
								$esSupletorios[$student->id] = "REMEDIAL";
						}
						@endphp
						<td class="text-center">{{ $supletorios[$matter->id][$student->id] }}</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosFinales[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosFinales[$matter->id][$student->id]!=0)
								style="color:red;"
							@endif
						@endif
						>{{ $promediosFinales[$matter->id][$student->id] }}</td>
					@else
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
					@endif
				@endforeach
				<td class="text-center up">
						{{ $esSupletorios[$student->id] }}
				</td>
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
</body>

</html>