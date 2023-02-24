<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
	<title>Resumen de calificaciones</title>
</head>
@php
$n_parcial = "";
$quimestre = "";
switch ($parcial) {
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
<body class="actaCalificacionesParcial">
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
					<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
					<h3 class="up"> Quimestre {{$quimestre}} </h3>
					<h3 class="up">
						Resumen de calificaciones
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border up">Grado:
			@if( $course->grado!=null)
                {{ $course->grado }}               
            @endif
			de 
				@if($course->seccion == "EI")
					Educación inicial
				@elseif($course->seccion == "EGB")
					Educación general básica
				@else($course->seccion == "BGU")
					Bachillerato general unificado
				@endif
			 
			@if( $course->paralelo!=null )
				paralelo: 
                {{ $course->paralelo }}
            @endif
            @if( $course->especializacion!=null )
				especializacion: 
                {{ $course->especializacion }}
            @endif
            , jornada: {{ $institution->jornada }}
			<span style="margin-right: 1rem"></span>
			</td>
			<td class="no-border up text-right">Fecha: {{ $now->format('m/d/Y') }}</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table class="table white-space-no">
		<tr>
			<td width="20%" colspan="2" class="text-center uppercase">rangos de equivalencia</td>
			@foreach($matters as $matter)
			<td class="text-center no-border">
				<p class="s-calificaciones__materia">
					<span class="up bold">{{ $matter->nombre}}</span>
				</p>
			</td>
			@endforeach
		</tr>
		<tbody class="resumenCalificaciones__tbody">
			<tr>
				<td colspan="2" class="text-center up">domina los aprendizajes</td>
				@php 
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
							if( $promedios[$matter->id][$student->id] >= 9 ){
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{ $c[$matter->id] }}
				</td>
				@endforeach
			</tr>
			<tr>
				<td class="text-center up">dar</td>
				
				<td class="text-center up">9.00 - 10.00</td>
				@php 
					$ac = [];
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$ac[$matter->id] = 0;
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
							if( $promedios[$matter->id][$student->id] > 9 ){
								$ac[$matter->id] += $promedios[$matter->id][$student->id];
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">
					{{  bcdiv( ( ($c[$matter->id] / $totalEstudiantes)*100 ), '1', 2) }}%
				</td>
				@endforeach
			</tr>
		</tbody>
		<tbody class="resumenCalificaciones__tbody">
			<tr>
				<td colspan="2" class="text-center up">alcanza los aprendizajes requeridos</td>
				@php 
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
						if( $promedios[$matter->id][$student->id] > 7 && 
							$promedios[$matter->id][$student->id] < 9){
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{ $c[$matter->id] }}
				</td>
				@endforeach
			</tr>
			<tr>
				<td class="text-center up">aar</td>
				<td class="text-center up">7.00 - 8.99</td>
				@php 
					$ac = [];
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$ac[$matter->id] = 0;
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
							if( $promedios[$matter->id][$student->id] > 7 && 
							$promedios[$matter->id][$student->id] < 9){
								$ac[$matter->id] += $promedios[$matter->id][$student->id];
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{  bcdiv( ( ($c[$matter->id] / $totalEstudiantes)*100 ), '1', 2) }}%
				</td>
				@endforeach
			</tr>
		</tbody>
		<tbody class="resumenCalificaciones__tbody">
			<tr>
				<td colspan="2" class="text-center up">esta proximo a alcanzar los aprendizajes requeridos</td>
				@php 
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
						if( $promedios[$matter->id][$student->id] > 4 && 
							$promedios[$matter->id][$student->id] < 7){
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{ $c[$matter->id] }}
				</td>
				@endforeach
			</tr>
			<tr>
				<td class="text-center up">paar</td>
				<td class="text-center up">4.01 - 6.99</td>
				@php 
					$ac = [];
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$ac[$matter->id] = 0;
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
						if( $promedios[$matter->id][$student->id] > 4 && 
							$promedios[$matter->id][$student->id] < 7){
								$ac[$matter->id] += $promedios[$matter->id][$student->id];
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{  bcdiv( ( ($c[$matter->id] / $totalEstudiantes)*100 ), '1', 2) }}%
				</td>
				@endforeach
			</tr>
		</tbody>
		<tbody class="resumenCalificaciones__tbody">
			<tr>
				<td colspan="2" class="text-center up">no alcanza los aprendizajes requeridos</td>
				@php 
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
						if( $promedios[$matter->id][$student->id] > 0.1 && 
							$promedios[$matter->id][$student->id] < 4){
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{ $c[$matter->id] }}
				</td>
				@endforeach
			</tr>
			<tr>
				<td class="text-center up">naar</td>
				<td class="text-center up">0.00 - 4.00</td>
				@php 
					$ac = [];
					$c = [];
				@endphp
				@foreach($matters as $matter)
				@php
				$ac[$matter->id] = 0;
				$c[$matter->id] = 0;
				@endphp
					@foreach($students as $student)
						@php 	
						if( $promedios[$matter->id][$student->id] > 0.1 && 
							$promedios[$matter->id][$student->id] < 4){
								$ac[$matter->id] += $promedios[$matter->id][$student->id];
								$c[$matter->id] += 1;
							}
						@endphp
					@endforeach
				<td class="text-center">				
					{{  bcdiv( ( ($c[$matter->id] / $totalEstudiantes)*100 ), '1', 2) }}%
				</td>
				@endforeach
			</tr>
		</tbody>
		<tr>
			<td rowspan="2" colspan="2" class="text-center up">no presentados</td>
			@php 
				$c = [];
			@endphp
			@foreach($matters as $matter)
			@php
			$c[$matter->id] = 0;
			@endphp
				@foreach($students as $student)
					@php 	
					if( $promedios[$matter->id][$student->id] == 0){
							$c[$matter->id] += 1;
						}
					@endphp
				@endforeach
			<td class="text-center">				
				{{ $c[$matter->id] }}
			</td>
			@endforeach
		</tr>
		<tr>
			@php 
				$ac = [];
				$c = [];
			@endphp
			@foreach($matters as $matter)
			@php
			$ac[$matter->id] = 0;
			$c[$matter->id] = 0;
			@endphp
				@foreach($students as $student)
					@php 	
					if( $promedios[$matter->id][$student->id] == 0){
							$ac[$matter->id] += $promedios[$matter->id][$student->id];
							$c[$matter->id] += 1;
						}
					@endphp
				@endforeach
			<td class="text-center">				
				{{  bcdiv( ( ($c[$matter->id] / $totalEstudiantes)*100 ), '1', 2) }}%
			</td>
			@endforeach
		</tr>
	</table>
</body>

</html>