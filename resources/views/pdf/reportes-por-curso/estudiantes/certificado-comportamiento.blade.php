<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado Comportamiento</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
	h3 {
		line-height: 1.5;
	}
</style>
<body>
	<main>
		<div class="container">
			@include('partials.encabezados.certificados-estudiantiles', [
				'reportName' => 'Certificado de comportamiento'
			])
			<br>
			<br>
			<div class="row">
				<div class="col-xs-12 certificado__descripcion">
					<p class="text-center">CERTIFICO:</p>
					<p>Que @if($student->sexo == "Masculino") el @else la @endif estudiante <strong class="uppercase">{{ $student->nombres }} {{ $student->apellidos }}</strong> del 
						<span class="uppercase">{{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}, jornada:</span>
						{{ $institution->jornada }}, ha obtenido la calificación de <strong class="uppercase">{{ $student->comportamientos()->where('parcial', $parcial)->first()->nota }}</strong>, durante su permanencia en este Plantel en el presente periodo lectivo.</p>
					<p>{{ $institution->ciudad }}, {{ $hoy }}</p>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase">
					{{ $institution->representante1 }} <br> RECTOR
					</p> 
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase">
					{{ $institution->representante2 }}<br> secretaria general
					</p> 
				</div>
			</div>
		</div>
	</main>
</body>

</html>