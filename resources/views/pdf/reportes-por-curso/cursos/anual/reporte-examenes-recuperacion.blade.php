<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte de Recuperacion</title>
</head>
@php
$cont =1;
@endphp
<body class="actaCalificacionesParcial" style="position:relative">
	<div style="page-break-after:always;"></div>
	@include('partials.encabezados.reporte-formato-horizontal', [
		'reportName' => 'recuperación'
	])
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
	<table class="table whitespace-no">
		<tr>
			<td rowspan="3" width="5" class="text-center">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres</td>
			<td colspan="{{ 5*count($matters->where('principal' , 1) ) }}" class="text-center up">aportan al promedio</td>
		</tr>
		<tr>
		@foreach($matters->where('principal', 1)->take(6) as $matter)
			<td colspan="5" class="text-center up">{{ $matter->nombre }}</td>
		@endforeach
		</tr>
		<tr>
		@foreach($matters->where('principal', 1)->take(6) as $matter)
			<td class="text-center up">q1</td>
			<td class="text-center up">q2</td>
			<td class="text-center up">p</td>
			<td class="text-center up">r</td>
			<td class="text-center up">p.f</td>
		@endforeach
		</tr>
		@foreach($students as $student)
			@php
			$notas = new \Illuminate\Support\Collection($mostrar[$student->id]);
			@endphp
			@if($notas->count()>0)
				<tr>
					<td class="text-center">{{ $cont++ }}</td>
					<td class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
					@foreach($matters->where('principal', 1)->take(6) as $matter)
						@php
						$notas_materia = $notas->where('materiaId',$matter->id)->first();
						@endphp
							@if($notas_materia!=null)
								<td class="text-center">{{bcdiv($notas_materia->quimestres[0]->promediop, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->quimestres[1]->promediop, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->promedio, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->recuperatorio, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->promedioAnual, '1', 2)}}</td>
							@else
								<td class="text-center"></td>
								<td class="text-center"></td>
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
	<div style="visibility:hidden">
		@include('partials.encabezados.reporte-formato-horizontal', [
			'reportName' => 'recuperación'
		])
	</div>
	<table class="table whitespace-no">
		<tr>
			<td rowspan="3" width="5" class="text-center">No.</td>
			<td colspan="{{(6*count($matters->where('principal', 1)->slice(6)->take(6)))+1}}" class="text-center up">aportan al promedio</td>
		</tr>
		<tr>
			@foreach($matters->where('principal', 1)->slice(6)->take(6) as $matter)
				<td colspan="5" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
			<td rowspan="2" class="text-center up">prom.</td>
		</tr>
		<tr>
		@foreach($matters->where('principal', 1)->slice(6)->take(6) as $matter)
			<td class="text-center up">q1</td>
			<td class="text-center up">q2</td>
			<td class="text-center up">p</td>
			<td class="text-center up">r</td>
			<td class="text-center up">p.f</td>
		@endforeach
		</tr>
		@php
		$cont = 1;
		@endphp
		@foreach($students as $student)
			@php
			$notas = new \Illuminate\Support\Collection($mostrar[$student->id]);
			@endphp
				@if($notas->count()>0)
				<tr>
					<td class="text-center">{{ $cont++ }}</td>
					@foreach($matters->where('principal', 1)->slice(6)->take(10) as $matter)
						@php
						$notas_materia = $notas->where('materiaId',$matter->id)->first();
						@endphp
							@if($notas_materia!=null)
								<td class="text-center">{{bcdiv($notas_materia->quimestres[0]->promediop, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->quimestres[1]->promediop, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->promedio, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->recuperatorio, '1', 2)}}</td>
								<td class="text-center">{{bcdiv($notas_materia->promedioAnual, '1', 2)}}</td>
							@else
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
							@endif
					@endforeach
					<td class="text-center">{{ bcdiv($promedios_Finales[$student->id][0], '1', 2)}}</td>

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
	<div style="visibility:hidden">
		@include('partials.encabezados.reporte-formato-horizontal', [
			'reportName' => 'recuperación'
		])
	</div>
	<table class="table whitespace-no">
		<tr>
			<td rowspan="3" width="5" class="text-center">No.</td>
			@if(count($matters->where('principal' , 0)) != 0)
				<td colspan="{{ 5*count($matters->where('principal' , 0) ) }}" class="text-center up">no aportan al promedio</td>
			@endif
			<td rowspan="3" class="text-center up">comportamiento</td>
			<td rowspan="3" class="text-center up">observaciones</td>
		</tr>
		@if(count($matters->where('principal' , 0)) != 0)
		<tr>
			@foreach($matters->where('principal', 0)->take(6) as $matter)
				<td colspan="5" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		@endif
		<tr>
		@if(count($matters->where('principal' , 0)) != 0)
			@foreach($matters->where('principal', 0)->take(6) as $matter)
				<td class="text-center up">q1</td>
				<td class="text-center up">q2</td>
				<td class="text-center up">p</td>
				<td class="text-center up">r</td>
				<td class="text-center up">p.f</td>
			@endforeach
		@endif
		</tr>
		@php
		$cont=1;
		@endphp
		@foreach($students as $student)
			@php
			$notas = new \Illuminate\Support\Collection($mostrar[$student->id]);
			@endphp
				@if($notas->count()>0)
					<tr>
						<td class="text-center">{{ $cont++ }}</td>
						@if(count($matters->where('principal' , 0)) != 0)
							@foreach($matters->where('principal', 0)->take(6) as $matter)
								@php
								$notas_materia = $notas->where('materiaId',$matter->id)->first();
								@endphp
								@if($notas_materia!=null)
									<td class="text-center">{{bcdiv($notas_materia->quimestres[0]->promediop, '1', 2)}}</td>
									<td class="text-center">{{bcdiv($notas_materia->quimestres[1]->promediop, '1', 2)}}</td>
									<td class="text-center">{{bcdiv($notas_materia->promedio, '1', 2)}}</td>
									<td class="text-center">{{bcdiv($notas_materia->recuperatorio, '1', 2)}}</td>
									<td class="text-center">{{bcdiv($notas_materia->promedioAnual, '1', 2)}}</td>
								@else
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
								@endif
							@endforeach
									<td class="text-center">
				                        @if($confComportamiento->valor !== 'crear')
											@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
												{{$comportamiento->nota}}
											@empty
												-
											@endforelse
										@else
											@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
												{{$comportamiento->nota}}
											@empty
												-
											@endforelse
										@endif
				                    </td>
				                     <td class="text-center">{{$student->student->comportamientos->where('parcial', 'anual')->first()['observacion']}}</td>
							@endif
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