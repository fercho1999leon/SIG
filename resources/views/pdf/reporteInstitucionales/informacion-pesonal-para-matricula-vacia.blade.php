<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ficha de datos</title>
	<link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
	.hdVida__table td,
	.hdVida__table th {
		font-size: 8pt !important;
	}
</style>
<body class="hdVida__body" style="padding:7.5px">
	<main>
		<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)                     src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif style="position: absolute" width="50" alt="">
		<header class="hdVida__header text-center">
			<p class="uppercase bold">{{ $institution->nombre}}</p>
			<p>Año lectivo: {{App\Institution::periodoLectivo()}} </p>
		</header>
		<br>
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px">
			<tr>
				<td colspan="4" class="text-center bg-none">
					<strong>DATOS DEL ESTUDIANTE</strong> 
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<strong>Nombres y Apellidos:</strong>
					<span class="uppercase">
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Grado / Curso:</strong>
					<span class="uppercase">
					</span>
				</td>
				<td colspan="3">
					<span class="uppercase"></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
				</td>
				<td colspan="2">
					<strong>Teléfono domicilio:</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Fecha de nacimiento:</strong>
				</td>
				<td colspan="2">
					<strong>Edad:</strong>
				</td>
				<td>
					<strong>C.I:</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Estado civil padres:</strong>
				</td>
				<td>
					<strong>Movilización:</strong>
					</span>
				</td>
				<td colspan="2">
					<strong>Con quién vive:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Institución Anterior:</strong>
				</td>
				<td colspan="2">
					<strong>Discapacidad:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<strong>Correo:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Disciplina o deporte que practica:</strong>
				</td>
				<td colspan="2">
					<strong>Actividad artística que practica:</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Enfermedades:</strong>
				</td>
				<td colspan="2">
					<strong>Alergias:</strong>
				</td>
				<td>
					<strong>Tipo de sangre:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Inclusión:</strong>
				</td>
				<td colspan="2">
					<strong>Seguro:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Contacto emergencia 1:</strong>
				</td>
				<td colspan="2">
					<strong>Telefono contacto emergencia 1:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Contacto emergencia 2:</strong>
				</td>
				<td colspan="2">
					<strong>Telefono contacto emergencia 2:</strong>
				</td>
			</tr>
		</table>
		<table class="hdVida__table">
			<tr>
				<td colspan="3" class="text-center bg-none">
					<strong>DATOS DE PADRES Y REPRESENTANTE</strong>
				</td>
			</tr>
		</table>
		{{-- Datos del padre y de la madre --}}
		@foreach (['padre', 'madre'] as $padre)
			<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
				<tr>
					<td class="bold" colspan="3"></td>
				</tr>
				<tr>
					<td>
						<strong>Nombres:</strong>
					</td>
					<td colspan="2">
						<strong>C.I:</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Domicilio:</strong>
					</td>
					<td colspan="2">
						<strong>Teléfono:</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Email:</strong>
					</td>
					<td colspan="2">
						<strong>Nacionalidad:</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Lugar de trabajo:</strong>
					</td>
					<td colspan="2">
						<strong>Teléfono:</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Dir. Trabajo:</strong>
					</td>
					<td colspan="2">
						<strong>Cargo Actividad:</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Estudios:</strong>
					</td>
					<td colspan="2">
						<strong>Religión:</strong>
					</td>
				</tr>
				<tr>
					<td width="35%">
						<strong>Estado civil:</strong>
					</td>
					<td width="35%">
						<strong>Profesión:</strong>
					</td>
					<td width="30%">
						<strong>Fecha Nacimiento:</strong>
					</td>
				</tr>
			</table>
		@endforeach
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
			<tr>
				<td colspan="4" class="bold">Representante Legal</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Nombres:</strong>
				</td>
				<td colspan="2">
					<strong>C.I:</strong> 
				</td>
			</tr>
			<tr>
				<td width="33%" colspan="2">
					<strong>Correo:</strong>
				</td>
				<td width="33%">
					<strong>Fecha Nacimiento:</strong>
				</td>
				<td width="33%">
					<strong>Sexo:</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
				</td>
				<td colspan="2">
					<strong>Teléfono:</strong>
				</td>
			</tr>
		</table>
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
			<tr>
				<td class="bold" colspan="2">Representante Financiero</td>
			</tr>
			<tr>
				<td>
					<strong>Nombres</strong>
				</td>
				<td>
					<strong>C.I:</strong> 
				</td>
			</tr>
			<tr>
				<td>
					<strong>Correo:</strong>
				</td>
				<td>
					<strong>Fecha Nacimiento:</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Domicilio:</strong>
				</td>
				<td>
					<strong>Teléfono:</strong>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<div class="row">
		<div class="col-xs-6 p-0 text-center">
			<hr class="certificado__hr">
			<p class="uppercase bold">
				{{ $institution->representante2 }}
			</p>
			<p style="font-size:10px" class= "bold">
				{{ $institution->cargo2 }}
			</p>
		</div>
		<div class="col-xs-6 p-0 text-center">
			<hr class="certificado__hr">
			<p class="uppercase bold">
			</p>
			<p style="font-size:10px" class="bold">
			</p>
		</div>
		
	</main>
</body>

</html>