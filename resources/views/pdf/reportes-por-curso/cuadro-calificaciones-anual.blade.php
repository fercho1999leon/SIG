<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Cuadro Calificaciones Anual</title>
</head>

<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="10%">
				<div class="header__logo" style="float: left">
					<img width="50" src=" {{secure_asset('img/logo/logo.png')}} " alt="">
				</div>
			</th>
			<th class="no-border" width="80%">
				<div class="header__info text-center">
					<h1>nombre institucion</h1>
					<h3 class="up">
						Cuadro de calificaciones añoLectivo  
					</h3>
					<h3 class="up"> Año Lectivo añoLectivo </h3>
				</div>
			</th>
			<th style="vertical-align:top;" class="no-border" width="10%">
				<div class="header__logo" style="float:right">
					<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
				</div>
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<th class="up text-left">Octavo de educación General Básica A</th>
			<th class="up text-right">Jornada MAtutina</th>
		</tr>
	</table>
	<table class="table">
		<tr height="150" class="bgDark">
			<td class="text-center">No.</td>
			<td class="text-center">Nómina</td>
			<td class="text-center">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="actaDeCalificacionesRecuperacion__1 bold up">Nombre de la materia</span>
				</p>
			</td>
			<td class="text-center">
				<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
					<span class="actaDeCalificacionesRecuperacion__1 bold up">Comportamiento</span>
				</p>
			</td>
			<td class="text-center up">Observaciones</td>
		</tr>
		<tr>
			<td class="text-center">1</td>
			<td class="up">Nombre del estudiante</td>
			<td class="text-center">0.00</td>
			<td>A</td>
			<td>Observación.....</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">------</h4>
				<h4 class="firma--size m-0 uppercase text-center">-----</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">-----</h4>
				<h4 class="firma--size m-0 uppercase text-center">--------</h4>
			</th>
			<th width="10%"></th>
		</tr>
	</table>
</body>

</html>