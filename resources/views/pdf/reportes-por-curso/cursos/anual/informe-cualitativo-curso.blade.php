<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Informe Cualitativo</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body class="informeCualitativo">
	<main>
	@foreach($students as $student)
		@php
			$student2 = $students2->where('idStudent',$student->id)->first();
		@endphp
		<div class="container">
			@include('partials.encabezados.informe-cualitativo-final', [
				'reportName' => 'Informe Cualitativo', 
				'informe' => $informe
			])
			<br>
			<table class="table table__informeCualitativo">
				<tr>
					<td class="uppercase no-border">coordinación zonal {{ $institution->coordinacionZonal }}</td>
					<td class="text-right uppercase no-border">distrito: {{ $institution->distrito }}</td>
				</tr>
				<tr>
					<td class="uppercase no-border">institución: {{ $institution->nombre }}</td>
					<td class="text-right uppercase no-border">codigo amie: {{ $institution->codigoAmie }}</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center no-border uppercase">año lectivo {{$periodo}}</td>
				</tr>
			</table>
			<br>
			<table class="table table__informeCualitativo">
				<tr>
				<td class="no-border">Apellidos y Nombres del Infante: <br><span class="uppercase informeCualitativo__nameAlumno">{{ $student->apellidos }} {{ $student->nombres }}</span> </td>
				</tr>
			</table>
		<p class="no-margin bold">Fecha de nacimiento: {{ $student->fechaNacimiento}}</p>
			<br>
			<table class="table table__informeCualitativo__principal">
				<tr>
					<td colspan="5" class="uppercase text-center table__informeCualitativo__principal--titulo">reporte de desarollo integral</td>
				</tr>
				<tr>
					<td class="no-border"></td>
				</tr>
				<tr>
					<td width="10" class="text-center bold uppercase">No.</td>
					<td width="250" class="text-center bold uppercase">ámbitos de desarrollo y aprendizaje</td>
					<td width="5" class="text-center bold uppercase">iniciada</td>
					<td width="5" class="text-center bold uppercase">en proceso</td>
					<td width="5" class="text-center bold uppercase">adquirida</td>
				</tr>
				@foreach($matters as $matter)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					<td>{{ $matter->nombre }}</td>
					@php
						$notaDestreza  = $destrezas->where('id', $matter->id)->where('idStudent', $student2->id)->first();
					@endphp
					@if($notaDestreza != null)
						<td class="text-center">
							@if($notaDestreza->Calificacion == "I") X @endif
						</td>
						<td class="text-center">
						@if($notaDestreza->Calificacion == "EP") X @endif
						</td>
						<td class="text-center">
						@if($notaDestreza->Calificacion == "A") X @endif
						</td>
					@else
						<td class="text-center"></td>
						<td class="text-center"></td>
						<td class="text-center"></td>
					@endif
				</tr>					
				@endforeach
			</table>
			<table class="table table__informeCualitativo__principal">
				<tr>
					<td class="text-center uppercase bold">Escala de estimación cualitativa de destrezas:</td>
				</tr>
				<tr>
					<td>
						<span class="bold">INICIADA:</span> Inicia el desarollo de destrezas <br>
						<span class="bold">EN PROCESO:</span> En proceso de desarrollo de destrezas <br>
						<span class="bold">ADQUIRIDA:</span> Adquiere el desarrollo de destrezas 
					</td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					@if( $course->grado == "Inicial 1" || $course->grado == "Inicial 2" )
						<p class="uppercase" style="font-size: 12px">
							{{ $institution->representante3 }} <br> {{ $institution->cargo3 }}
						</p> 
					@else
						<p class="uppercase" style="font-size: 12px">
							{{ $institution->representante4 }} <br> {{ $institution->cargo4 }}
						</p> 
					@endif
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase" style="font-size: 12px">
						{{ $tutor->apellidos }} {{ $tutor->nombres }} <br> tutor
					</p> 
				</div>
			</div>
		</div>
        <div style="page-break-after:always;"></div>

        @endforeach
	</main>
</body>

</html>