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
			@include('partials.encabezados.reporte-formato-vertical', [ 'tipo' => 0 ])
			<table class="table">
				<tr>
					<th class="text-left up" style="font-size: 10px !important;">NIVEL:
						@if($course->grado=='Segundo' || $course->grado=='Tercero' || $course->grado=='Cuarto' || $course->grado=='Quinto' || $course->grado=='Sexto' || $course->grado=='Septimo' || $course->grado=='Octavo' || $course->grado=='Noveno' || $course->grado=='Decimo')
							Educacion General Basica
						@endif
						@if($course->grado=='Primero de Bachillerato' || $course->grado=='Segundo de Bachillerato' || $course->grado=='Tercero de Bachillerato')
							Bachillerato General Unificado
						@endif
					</th>
					<th class="text-right up" style="font-size: 10px !important;">FECHA: {{ $fechaA }}</th>
				</tr>
				<tr>
					<th class="text-left no-border up" style="font-size: 10px !important;">
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
					<th class="text-left no-border up" style="font-size: 10px !important;">asignatura: {{ $matter->nombre }}</th>
					<th class="no-border up text-right" style="font-size: 10px !important;">profesor:
							{{ $tutor->nombres }} {{ $tutor->apellidos }}
					</th>
				</tr>
			</table>
			<table class="table">
				<tr height="140" >
					<td rowspan="2" width="5" class="bold text-center">No.</td>
					<td rowspan="2" class="bold text-center up" style="font-size: 12px !important;">apellidos y nombres</td>
					<td colspan="2" class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="actaDeCalificacionesRecuperacion__1  up bold" style="font-size: 10px !important;">primer quimestre</span>
						</p>
					</td>
					<td colspan="2" class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="actaDeCalificacionesRecuperacion__1 up bold" style="font-size: 10px !important;">segundo quimestre</span>
						</p>
					</td>
					<td colspan="2" class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="actaDeCalificacionesRecuperacion__1 up bold" style="font-size: 10px !important;">promedio anual</span>
						</p>
					</td>
				</tr>
				<tr >
					<td class="text-center up" style="font-size: 10px !important;">cuant.</td>
					<td class="text-center up" style="font-size: 10px !important;">cualit.</td>
					<td class="text-center up" style="font-size: 10px !important;">cuant.</td>
					<td class="text-center up" style="font-size: 10px !important;">cualit.</td>
					<td class="text-center up" style="font-size: 10px !important;">cuant.</td>
					<td class="text-center up" style="font-size: 10px !important;">cualit.</td>
				</tr>
				@foreach($mostrar as $datos)
					@if($datos['nota']->materiaId == $matter->id)
						@php
						$estudiante = $students->where('idStudent',$datos['idEstudiante'])->first();
						@endphp
						<tr>
							<td class="text-center" style="font-size: 10px !important;">{{ $loop->iteration }}</td>
							<td class="up" style="font-size: 10px !important;">{{ $estudiante->apellidos }} {{ $estudiante->nombres }}</td>

							@foreach($datos['nota']->quimestres as $n_q)
                                <td class="text-center" @if($n_q->promediop < 7 && $notasMenores == "1") style="color:red; font-size: 10px !important;" @else style="font-size: 10px !important;" @endif>
                                    {{ ($n_q->promediop!=0?$n_q->promediop:'') }}
                                </td>
                                <td class="text-center" style="font-size: 10px !important;">{{App\Calificacion::notaCualitativaApr($n_q->promediop)}}</td>
							@endforeach
							<td class="text-center" @if($datos['nota']->promedioAnual < 7 && $notasMenores == "1" && $datos['nota']->promedioAnual!=0) style="color:red; font-size: 10px !important;" @else style="font-size: 10px !important;" @endif>
                                {{$datos['nota']->promedioAnual}}
                            </td>
                            <td class="text-center" style="font-size: 10px !important;">{{App\Calificacion::notaCualitativaApr($datos['nota']->promedioAnual)}}</td>
						</tr>
					@endif
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
</body>
</html>
