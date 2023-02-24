<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Informe Parcial</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body>
	<main>
		<header class="header mb-2">
			<!-- #Importante, si el logo no queda centrado verticalmente, realziar ajuste en style="top: xx" o si desea mover mas a la derecha o izquierda,
					realizar ajustes en left: xx
					-->
			<div class="header__logo" style="top: 20px; left: 25px">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)                     src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="">
			</div>
			<div class="header__info text-center">
				<h1>Escuela Educativa "Fedeerico Gonzalez Suárez"</h1>
				<h3>Año Lectivo: {{$institution->periodoLectivo}}  </h3>
				<h3>REPORTE DE ESTUDIANTES Y FAMILIARES</h3>
			</div>
		</header>
		
		<section class="section">
			<p class="section__estudiante uppercase">Estudiante: </p>
			<p class="section__estudiante uppercase">Curso: {{ $course->grado }} - {{ $course->paralelo }}</p>
			<table class="table">
				<tr>
					<td width="40%" colspan="4" class="text-center bold uppercase bgDark">Información del Estudiante</td>
					<td width="30%" colspan="2" class="text-center bold uppercase bgDark">Información del Padre</td>
				</tr>
				<tr>
					<td width="10"></td>
					<td width="120" class="text-center bold">Apellidos y nombres</td>
					<td class="text-center bold">Fecha de Nacimiento</td>
					<td class="text-center bold">Télefono domicilio</td>
					<td class="text-center bold">Apellidos y Nombres</td>
					<td class="text-center bold">Email</td>
				</tr>
				@foreach($students as $student)
				<tr>
					<td class="text-center">1</td>
					<td>{{ $student->nombres }} {{ $student->apellidos }}</td>
					<td class="text-center">{{ $student->fechaNacimiento }}</td>
					<td class="text-center">{{ $student->telefono }}</td>
					<td>{{ $representantes->where('id', $student->idRepresentante)->first()->nombres }} {{ $representantes->where('id', $student->idRepresentante)->first()->apellidos }}</td>
					<td class="text-center">{{ $representantes->where('id', $student->idRepresentante)->first()->correo }}</td>
				</tr>
				@endforeach
			</table>
		</section>
		
	</main>
</body>

</html>