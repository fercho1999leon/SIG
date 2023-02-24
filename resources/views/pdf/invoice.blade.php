<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Destrezas</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		<header class="header">
			<!-- #Importante, si el logo no queda centrado verticalmente, realziar ajuste en style="top: xx" o si desea mover mas a la derecha o izquierda,
			realizar ajustes en left: xx
			-->
			<div class="header__logo" style="top: 20px; left: 50px">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)                     src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
			</div>
			<div class="header__info text-center">
				<h1>{{ $institution->nombre }}</h1>
				<h3>QUIMESTRE {{ $quimestre }} - PARCIAL {{ $n_parcial }}</h3>
				<h3>Año Lectivo: {{$periodo}}</h3>
				<h3>REPORTE DESTREZAS</h3>
			</div>
		</header>
		<section class="section">
			<table class="table">
				<tr>
					<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>
					<td class="uppercase">{{ $student->nombres }} {{ $student->apellidos }}</td>
					<td class="uppercase bold bgDark text-right" width="50">Curso</td>
					<td class="uppercase">{{ $course->grado }} - {{ $course->paralelo }}</td>
					<td class="uppercase bold bgDark text-right" width="50">Tutor</td>
					<td class="uppercase">{{ $tutor->apellidos }} {{ $tutor->nombres }}</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td class="text-center uppercase bold bgDark">Destrezas</td>
					<td colspan="4" class="text-center uppercase bold bgDark">Quimestre {{ $quimestre }} - Parcial {{ $n_parcial }}</td>
				</tr>
				@foreach($matters as $matter)
				<tr>
					<td class="bold" colspan="5">{{ $matter->nombre}}</td>
				</tr>
				<tr>
					<td></td>
					<td class="text-center">I</td>
					<td class="text-center">EP</td>
					<td class="text-center">A</td>
					<td class="text-center">N/E</td>
				</tr>
				@if(count($destrezas->where('id', $matter->id) ) > 0)
					@foreach($destrezas->where('id', $matter->id) as $destreza)
					<tr>
						@if($destreza->descripcion != null)
							<td class="uppercase">{{ $destreza->descripcion }}</td>
						@else
							<td class="uppercase">-</td>
						@endif
						@php
							$jsonSupply = json_decode( $destreza->calificacion );
							$notaDestreza = "";
							foreach($jsonSupply as $key => $json){
							    if($key == $student->id)
							        $notaDestreza = $json;
							}
						@endphp
						<td class="text-center">
							@if($notaDestreza == "I") X @endif
						</td>
						<td class="text-center">
						@if($notaDestreza == "EP") X @endif
						</td>
						<td class="text-center">
						@if($notaDestreza == "A") X @endif
						</td>
						<td class="text-center">
						@if($notaDestreza == "N/E") X @endif
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">Esta clase no tiene destrezas Asignadas</td>
					</tr>
				@endif
				@endforeach
			</table>
			<table class="table w100">
				<tr>
					<td colspan="2" class="text-center bold uppercase bgDark">Escala de Evaluación de Destrezas(Educación Inicial)</td>
					<td width="10" class="no-border"></td>
					<td colspan="2" class="text-center bold uppercase bgDark">Asistencia</td>
				</tr>
				<tr>
					<td width="10%" class="text-center bold">I</td>
					<td>Iniciada</td>
					<td class="no-border"></td>
					<td width="15%">Faltas justificadas</td>
					<td>
					@if($student->p1q1FJ!=null)
						{{ $student->p1q1FJ }}
					@else
						0
					@endif
					</td>
				</tr>
				<tr>
					<td class="text-center bold">EP</td>
					<td>En Proceso</td>
					<td class="no-border"></td>
					<td>Faltas Injustificadas</td>
					<td>
					@if($student->p1q1FI!=null)
						{{ $student->p1q1FI }}
					@else
						0
					@endif
					</td>
				</tr>
				<tr>
					<td class="text-center bold">A</td>
					<td>Adquirida</td>
					<td class="no-border"></td>
					<td>Atrasos</td>
					<td>
					@if($student->p1q1A!=null)
						{{ $student->p1q1A }}
					@else
						0
					@endif
					</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td colspan="2" class="bgDark text-center uppercase bold">Recomendaciones</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td width="20" class="uppercase bold text-center no-border"style="padding-bottom:5px"  >Recomendaciones:  </td>
					<td class="borderBottom p-0">
					@if($student["p".$n_parcial."q".$quimestre."R"]!=null)
						{{ $student["p".$n_parcial."q".$quimestre."R"] }}
					@else
					-
					@endif
					</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td width="20" class="uppercase bold text-center no-border">Observaciones:  </td>
					<td class="borderBottom p-0">
					@if($student["p".$n_parcial."q".$quimestre."O"]!=null)
						{{ $student["p".$n_parcial."q".$quimestre."O"] }}
					@else
					-
					@endif
					</td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center ">
					<hr class="certificado__hr">
					<p class="uppercase bold">
					{{ $tutor->apellidos }} {{ $tutor->nombres }} <br> TUTOR
					</p>
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase bold">
					{{ $representante->apellidos }} {{ $representante->nombres }} <br> REPRESENTANTE
					</p>
				</div>
			</div>
		</section>
	</main>
</body>

</html>