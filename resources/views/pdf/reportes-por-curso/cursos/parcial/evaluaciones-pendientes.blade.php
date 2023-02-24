<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Evaluaciones Calificaciones</title>
	<link rel="stylesheet" href="{{secure_asset('css/pdf/pdf.css') }}">
</head>
@php
$cont= 0;
$n_parcial = "";
$quimestre = "";
$mostrar=1;
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
$cantEst= 0;
@endphp
<body>
@foreach($matters as $matter)
	<main>
		@php
			$cantEst= 0;
		@endphp
		@foreach($students as $student)
			<!-- Valido que el estudiante si tenga evaluacion-->
			@foreach($supplies[$matter->id] as $supply)
				@if( $supply->es_aporte==1  && $promedios[$matter->id][$supply->id][$student->id]['promedio'] == 0)
					@foreach($supplies[$matter->id] as $supply)
						@if($promedios[$matter->id][$supply->id][$student->id]['promedio'] == 0)
							@php
								$cantEst++;
							@endphp	
						@endif
					@endforeach
							
				@endif
				@php
					$cont= 0;
				@endphp
			@endforeach
		@endforeach
		
		
		@if($cantEst>0)
			


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
							<h3 class="up"> semestre {{$quimestre}} - modulo {{$n_parcial}} </h3>
							<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
							<h3 class="up">
								actas de evaluaciones pendientes
							</h3>
						</div>
					</th>
					<th class="no-border" width="20%">
					</th>
				</tr>
			</table>
			<table class="w100">
				<tr>
				@php
					$nivel = "";
					switch($course->grado){
						case "Primero de Bachillerato":
						$nivel = "Bachillerato General Unificado";
						break;
						case "Segundo de Bachillerato":
						$nivel = "Bachillerato General Unificado";
						break;
						case "Tercero de Bachillerato":
						$nivel = "Bachillerato General Unificado";
						break;
						case "Inicial 1":
						$nivel = "Educación inicial";
						break;
						case "Inicial 2":
						$nivel = "Educación inicial";
						break;
						case "Primero":
						$nivel = "Educación Básica General";
						break;
						case "Segundo":
						$nivel = "Educación Básica General";
						break;
						case "Tercero":
						$nivel = "Educación Básica General";
						break;
						case "Cuarto":
						$nivel = "Educación Básica General";
						break;
						case "Quinto":
						$nivel = "Educación Básica General";
						break;
						case "Sexto":
						$nivel = "Educación Básica General";
						break;
						case "Septimo":
						$nivel = "Educación Básica General";
						break;
						case "Octavo":
						$nivel = "Educación Básica General";
						break;
						case "Noveno":
						$nivel = "Educación Básica General";
						break;
						case "Decimo":
						$nivel = "Educación Básica General";
						break;
					}
				@endphp
				</tr>
				<tr>
					<td class="text-left uppercase">{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}</td>
					<td class="text-right uppercase">Fecha: {{ $now->format('d/m/Y') }}</td>
				</tr>
				<tr>
				<td class="text-left uppercase">Asignatura: <span class="uppercase">{{ $matter->nombre }}</span></td>
					@php
					$teacher = $teachers->where('id', $matter->id)->first();
					@endphp
					<td class="text-right uppercase">Profesor: <span class="uppercase">
					@if($teacher != null)
					{{ $teacher->apellidos }} {{ $teacher->nombres }}
					@endif
					</span></td>
				</tr>
			</table>
			<table class="table">
				<tr class="bgDark">
					<td class="text-center">No.</td>
					<td>NOMBRE</td>
					@foreach($supplies[$matter->id] as $supply)
					<td class="text-center">
						<div class="">
							{{ $supply->nombre}}
						</div>
					</td>
					@endforeach
					<td class="text-center">
						<span class="actaCalificaciones__act">Nota Parcial</span>
					</td>
				</tr>
				@foreach($students as $student)
					<!-- Valido que el estudiante si tenga evaluacion-->
					@foreach($supplies[$matter->id] as $supply)
						@if( $supply->es_aporte==1  && $promedios[$matter->id][$supply->id][$student->id]['promedio'] == 0)
							<tr>
								<td  class="text-center">
									{{ ++$cont }}</td>
								<td class="whitespace-no">
									{{ $student->apellidos}} {{ $student->nombres }} 
								</td>
								@foreach($supplies[$matter->id] as $supply)
									@if($promedios[$matter->id][$supply->id][$student->id]['promedio'] != 0)
										<td class="text-center"> 
											{{  bcdiv($promedios[$matter->id][$supply->id][$student->id]['promedio'], '1', 2) }}
										</td>				
									@else
										<td class="text-center"></td>		
									@endif
								@endforeach
								<td class="text-center"></td>
								
							</tr>
						@endif
					@endforeach
				@endforeach
			</table>
			<table class="w100">
				<tr>
					<td>Profesor:_______________</td>
					<td>Fecha Entrega:_______________</td>
				</tr>
			</table>
	








		@endif
		@php
			$cantEst= 0;
		@endphp
	</main>
	<div style="page-break-after:always;"></div>
@endforeach
</body>
</html>