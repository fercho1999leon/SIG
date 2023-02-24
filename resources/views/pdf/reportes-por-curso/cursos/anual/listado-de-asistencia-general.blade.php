<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
	<title>Listado de Asistencia</title>
</head>
<body class="actaCalificacionesParcial">
	@include('partials.encabezados.reporte-institucional', [
		'reportName' => 'Registro de asistencia'
		])
	<br>
	<section class="actaCalificacionesParcial__section">
		<h3 class="up">CURSO: {{ $course->grado }} {{ $course->paralelo }} - {{ $course->especializacion }} {{$desde!='' ? "Desde: ".$desde : ''}} {{$hasta!='' ? "Hasta: ".$hasta : ''}}</h3>
		<br>
		<table class="table">
			<tr height="30">
				<td class="text-center" colspan="2">Nombre</td>
				@foreach($matters as $materia)
				<td class="text-center">
					{{$materia->nombre}}
					<!--<p class="s-calificaciones__materia">
						<span class="bold up" style="position: relative;right: 62px;">{{$materia->nombre}}</span>
					</p>-->
				</td>
				@endforeach
				<td class="text-center">ESTATUS</td>
			</tr>
			<tr>
				<td class="text-center">No.</td>
				<td class="text-center">Fechas</td>
				@foreach($matters as $materia)
				<td class="text-center">
					<table>
						@php
								$fechas_h = \App\DailyAssistance::query()
								->where('idCurso', $course->id)
								->where('idMateria', $materia->id)
								->when($desde != '' , function ($q) use($desde){
						        return $q->where('fecha','>=', $desde);
						        })
						        ->when($hasta != '' , function ($q) use($hasta){
						        return $q->where('fecha','<=', $hasta);
						        })
								->groupBy('fecha')->orderBy('fecha')
								->get();
								//dd($fechas_h);
								@endphp
						<tr height="150">@foreach($fechas_h  as $fech)
							<td width="20">
								<p class="s-calificaciones__materia">
								<span class="bold up" style="position: relative;right: 62px;">{{$fech->fecha}}</span>
								</p>
							</td>
							@endforeach
						</tr>
					</table>
				</td>
				@endforeach
				<td>
					<table>
						<tr height="150">
							<td width="20">
								<p class="s-calificaciones__materia">
								<span class="bold up" style="position: relative;right: 62px;">Asistio</span>
								</p>
							</td>
							<td width="20">
								<p class="s-calificaciones__materia">
								<span class="bold up" style="position: relative;right: 62px;">No Asistio</span>
								</p>
							</td>
							<td width="20">
								<p class="s-calificaciones__materia">
								<span class="bold up" style="position: relative;right: 62px;">Atrasado</span>
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			@foreach($students as $key =>$student)
			@php
			$cont_Si[$key]=0;
			$cont_No[$key]=0;
			$cont_A[$key]=0;
			@endphp
			<tr>
				<td class="text-center">{{ $count++ }}</td>
				<td class="up">
					{{ $student->apellidos}} {{ $student->nombres}}
					<span style="display: none">
						@if($student->sexo == 'Masculino')
							{{$studentsM++}}
						@else
							{{$studentsF++}}
						@endif
					</span>
				</td>
				@foreach($matters as $materia)
				<td class="text-center">
					<table>
						<tr>
						@php
						$fechas_h = \App\DailyAssistance::query()
								->where('idCurso', $course->id)
								->where('idMateria', $materia->id)
								->when($desde != '' , function ($q) use($desde){
						        return $q->where('fecha','>=', $desde);
						        })
						        ->when($hasta != '' , function ($q) use($hasta){
						        return $q->where('fecha','<=', $hasta);
						        })
								->groupBy('fecha')->orderBy('fecha')
								->get();
								if ($fechas_h!='') {
									foreach ($fechas_h as $f) {
								$fechas_estudiante = \App\DailyAssistance::query()
								->where('idCurso', $course->id)
								->where('idMateria', $materia->id)
								->where('idEstudiante', $student->idStudent)
								->where('fecha', $f->fecha)
								->groupBy('fecha')->orderBy('fecha')
								->first();
								@endphp
								@if($fechas_estudiante!='')
								<td width="20">
								@php
									if($fechas_estudiante->estado=='ASISTIO'){
										$cont_Si[$key]++;
								echo 'Si';
								}elseif($fechas_estudiante->estado=='NO ASISTIO'){
									$cont_No[$key]++;
								echo 'No';
								}elseif($fechas_estudiante->estado=='ATRASADO'){
								echo 'A';
									$cont_A[$key]++;
								}
								@endphp
								</td>
								@else
								<td width="20">

								</td>
								@endif
								@php
								}
								}
								@endphp
						</tr>
					</table>
				</td>
				@endforeach
				<td>
					<table>
						<tr>
							<td width="20">
								{{$cont_Si[$key]}}
							</td>
							<td width="20">
								{{$cont_No[$key]}}
							</td>
							<td width="20">
								{{$cont_A[$key]}}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			@endforeach
			<tr>
				<td class="text-left vertical-align" colspan="2">{{ $studentsM }} <img src="{{secure_asset('img/hombreS.svg')}}" width="12" alt="">, {{ $studentsF }} <img src="{{secure_asset('img/mujerS.svg')}}" width="12" alt=""></td>
				<td colspan="24" class="text-left vertical-align"></td>
			</tr>
		</table>
	</section>
</body>

</html>