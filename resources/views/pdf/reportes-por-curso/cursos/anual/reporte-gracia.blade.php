<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Gracia</title>
</head>
@php
$cont =1;
@endphp

<body>
	@include('partials.encabezados.reporte-formato-horizontal', [
		'reportName' => 'Gracia'
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
				<td class="text-center up">gra.</td>
				<td class="text-center up">p.f.</td>
			@endforeach
		</tr>
		@foreach($students as $student)
			@php
			$reprobado[$student->id] = false;
			$gracia[$student->id] = false;
			$aprobado[$student->id] =  false;
			$notas = new \Illuminate\Support\Collection($mostrar[$student->id]);
			@endphp
			@if($notas->count()>0)
				<tr>
					<td class="text-center">{{ $cont++ }}</td>
					<td class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
					<td></td>
					@foreach($matters->where('principal', 1) as $matter)
						@php
						$notas_materia = $notas->where('materiaId',$matter->id)->first();
						@endphp
							@if($notas_materia!=null)
								@php
								if($notas_materia->gracia<7 && $notas_materia->gracia > 0 ){
									$reprobado[$student->id] = true;
								}elseif($notas_materia->gracia == 0){
									$gracia[$student->id] = true;
								}else{
									$aprobado[$student->id] =  true;
								}
								@endphp
							<td class="text-center" @if($notas_materia->promedio < 7 && $notasMenores == "1" && $notas_materia->promedio !=0)
							style="color:red;" @endif>{{bcdiv($notas_materia->promedio, '1', 2)}}</td>
							<td class="text-center" @if($notas_materia->gracia < 7 && $notasMenores == "1" && $notas_materia->gracia !=0)style="color:red;" @endif>{{bcdiv($notas_materia->gracia, '1', 2)}}</td>
							<td class="text-center" @if($notas_materia->promedioFinal < 7 && $notasMenores == "1" && $notas_materia->promedioFinal !=0)style="color:red;" @endif>{{bcdiv($notas_materia->promedioFinal, '1', 2)}}</td>
							@else
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
							@endif
					@endforeach
				</tr>
			@endif
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
				<td class="text-center up">gra.</td>
				<td class="text-center up">p.f.</td>
			@endforeach
		</tr>
		@foreach($students as $student)
			@php
			$notas = new \Illuminate\Support\Collection($mostrar[$student->id]);
			@endphp
			@if($notas->count()>0)
				<tr>
					<td class="text-center">{{ $cont++ }}</td>
					@foreach($matters->where('principal', 0) as $matter)
						@php
						$notas_materia = $notas->where('materiaId',$matter->id)->first();
						@endphp
							@if($notas_materia!=null)
								<td class="text-center" @if($notas_materia->promedio < 7 && $notasMenores == "1" && $notas_materia->promedio !=0)style="color:red;" @endif>{{bcdiv($notas_materia->promedio, '1', 2)}}</td>
								<td class="text-center" @if($notas_materia->gracia < 7 && $notasMenores == "1" && $notas_materia->gracia !=0)style="color:red;" @endif>{{bcdiv($notas_materia->gracia, '1', 2)}}</td>
								<td class="text-center" @if($notas_materia->promedioFinal < 7 && $notasMenores == "1" && $notas_materia->promedioFinal !=0)style="color:red;" @endif>{{bcdiv($notas_materia->promedioFinal, '1', 2)}}</td>
							@else
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
							@endif
					@endforeach
					<td>
					@if($reprobado[$student->id])
						REPROBADO
					@elseif($gracia[$student->id])
					GRACIA
					@else
					APROBADO
					@endif</td>
				</tr>
			@endif
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