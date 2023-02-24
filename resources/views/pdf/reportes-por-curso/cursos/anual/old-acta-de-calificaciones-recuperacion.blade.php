<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte de promedios por Clase</title>
</head>
@php
use App\Student2;
@endphp
<body class="actaCalificacionesParcial" style="position:relative">
	@foreach($matters as $matter)
		@include('partials.encabezados.reporte-formato-vertical')
		<table class="table">
			<tr>
				<th class="text-left up">NIVEL:
					@if($course->grado=='Segundo' || $course->grado=='Tercero' || $course->grado=='Cuarto' || $course->grado=='Quinto' || $course->grado=='Sexto' || $course->grado=='Septimo' || $course->grado=='Octavo' || $course->grado=='Noveno' || $course->grado=='Decimo')
						Educacion General Basica
					@endif
					@if($course->grado=='Primero de Bachillerato' || $course->grado=='Segundo de Bachillerato' || $course->grado=='Tercero de Bachillerato')
						Bachillerato General Unificado
					@endif
				</th>
				<th class="text-right up">FECHA: {{ $fechaA }}</th>
			</tr>
			<tr>
				<th class="text-left no-border up">
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
				</th>
			</tr>
			<tr>
				<th class="text-left no-border up">asignatura: {{ $matter->nombre }}</th>
				<th class="no-border up text-right">profesor:
					@if($profesores->where('id', $matter->idDocente)->first() != null)
						{{ $profesores->where('id', $matter->idDocente)->first()->apellidos }} {{ $profesores->where('id', $matter->idDocente)->first()->nombres }}
					@endif
				</th>
			</tr>
		</table>
		<table class="table">
			<tr height="140" >
				<td rowspan="2" width="5" class="bold text-center">No.</td>
				<td rowspan="2" class="bold text-center up">apellidos y nombres</td>
				<td colspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__1  up bold">primer quimestre</span>
					</p>
				</td>
				<td colspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__1 up bold">segundo quimestre</span>
					</p>
				</td>
				<td colspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__1 up bold">promedio anual</span>
					</p>
				</td>
				<td rowspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__2 up bold">recuperación</span>
					</p>
				</td>
				<td rowspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__2 up bold">supletorio</span>
					</p>
				</td>
				<td rowspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__2 up bold">remedial</span>
					</p>
				</td>
				<td rowspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__2 up bold">gracia</span>
					</p>
				</td>
				<td colspan="2" class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__1 up bold">promedio final</span>
					</p>
				</td>
			</tr>
			<tr >
				<td class="text-center up">cuant.</td>
				<td class="text-center up">cualit.</td>
				<td class="text-center up">cuant.</td>
				<td class="text-center up">cualit.</td>
				<td class="text-center up">cuant.</td>
				<td class="text-center up">cualit.</td>
				<td class="text-center up">cuant.</td>
				<td class="text-center up">cualit.</td>
			</tr>
			@php
				$s = Student2::getStudentsByCourse($course->id);

				foreach($s as $key => $student)
				{
					$supletorio = true;
					if(
						($promediosQ1[$matter->id][$student->id] == 0 || $promediosQ2[$matter->id][$student->id] == 0) ||
						( ($promediosQ2[$matter->id][$student->id] + $promediosQ1[$matter->id][$student->id])/2 > 7 )
					)
					{
						$supletorio = false;
					}

					if (!$supletorio){
						$s->forget($key);
					}

				}
			@endphp
			@foreach($s as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
				<td class="text-center"
				@if($notasMenores == "1")
					@if($promediosQ1[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosQ1[$matter->id][$student->id]!=0)
						style="color:red;"
					@endif
				@endif
				>{{ $promediosQ1[$matter->id][$student->id] }}</td>
				@if($promediosQ1[$matter->id][$student->id] >= 9)
					<td class="text-center up">DAR</td>
				@elseif($promediosQ1[$matter->id][$student->id] < 9 && $promediosQ1[$matter->id][$student->id] >= 7)
					<td class="text-center up">AAR</td>
				@elseif($promediosQ1[$matter->id][$student->id] < 7 && $promediosQ1[$matter->id][$student->id] > 4)
					<td class="text-center up">PAAR</td>
				@else
					<td class="text-center up">NAAR</td>
				@endif
				<td class="text-center"
				@if($notasMenores == "1")
					@if($promediosQ2[$matter->id][$student->id] < (int)$nota_menor->valor && $promediosQ2[$matter->id][$student->id]!=0)
						style="color:red;"
					@endif
				@endif
				>{{ $promediosQ2[$matter->id][$student->id] }}</td>
				@if($promediosQ2[$matter->id][$student->id] >= 9)
					<td class="text-center up">DAR</td>
				@elseif($promediosQ2[$matter->id][$student->id] < 9 && $promediosQ2[$matter->id][$student->id] >= 7)
					<td class="text-center up">AAR</td>
				@elseif($promediosQ2[$matter->id][$student->id] < 7 && $promediosQ2[$matter->id][$student->id] > 4)
					<td class="text-center up">PAAR</td>
				@else
					<td class="text-center up">NAAR</td>
				@endif
				@php
					$mostrar = $promediosQ2[$matter->id][$student->id] > 0 && $promediosQ1[$matter->id][$student->id] > 0? true:false;
					$total = ($promediosQ1[$matter->id][$student->id]+ $promediosQ2[$matter->id][$student->id])/2;
				@endphp
				<td class="text-center"
				@if($notasMenores == "1")
					@if($total < (int)$nota_menor->valor && $total!=0)
						style="color:red;"
					@endif
				@endif
				>{{ $mostrar ? bcdiv( $total , '1', 2): "" }}</td>
				@if($mostrar)
					@if($total > 9)
						<td class="text-center up">DAR</td>
					@elseif($total < 9 && $total > 6.99)
						<td class="text-center up">AAR</td>
					@elseif($total < 7 && $total > 4)
						<td class="text-center up">PAAR</td>
					@else
						<td class="text-center up">NAAR</td>
					@endif
				@else
					<td class="text-center up"></td>
				@endif
				<td class="text-center"></td>
				<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id]}}</td>
				<td class="text-center">{{ $remediales[$matter->id][$student->id] == 0 ? "" : $remediales[$matter->id][$student->id]}}</td>
				<td class="text-center">{{ $gracias[$matter->id][$student->id] == 0 ? "" : $gracias[$matter->id][$student->id]}}</td>
				<td class="text-center"
				@if($notasMenores == "1")
					@if($total < (int)$nota_menor->valor && $total!=0)
						style="color:red;"
					@endif
				@endif>{{ $mostrar && $total >= 7 ? bcdiv( $total , '1', 2): "" }}</td>
				@if( ($mostrar && $total >= 7) ||
				($supletorios[$matter->id][$student->id] > 7 || $remediales[$matter->id][$student->id] > 7 || $remediales[$matter->id][$student->id] > 7)
				)
					@if($total > 9)
						<td class="text-center up">DAR</td>
					@elseif($total < 9 && $total > 6.99)
						<td class="text-center up">AAR</td>
					@elseif($total < 7 && $total > 4)
						<td class="text-center up">PAAR</td>
					@else
						<td class="text-center up">NAAR</td>
					@endif
				@else
					<td class="text-center up"></td>
				@endif
			</tr>
			@endforeach
		</table>
		<br>
		<table class="table">
			<tr>
				<th class="text-left" width="50%">PROFESOR:<span style="display:inline-block;width:250px;border:1px solid black"></span></th>
				<th clasee="text-left" width="50%">FECHA DE ENTREGA:<span style="display:inline-block;width:250px;border:1px solid black"></span></th>
			</tr>
			<tr>
				<th class="text-left" style="padding-top: 35px !important;">
					TUTOR(A):<span style="display:inline-block;width:250px;border:1px solid black"></span>
				</th>
			</tr>
		</table>
		<div style="page-break-after:always;"></div>
	@endforeach
</body>

</html>