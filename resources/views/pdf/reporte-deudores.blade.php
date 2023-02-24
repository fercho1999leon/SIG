<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de cobros</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">

</head>
<style>
	td {
		font-size: 12px !important;
	}
</style>
<body>
	<main>
		<div class="actaCalificaciones__titulo">
			<p class="text-center uppercase bold mb-05"> nombre institución</p>
			<p class="text-center uppercase mb-05">año lectivo: 2018 - 2019</p>
			<p class="text-center uppercase mb-05">Sección: educación inicial</p>
			<p class="text-center uppercase mb-05">deudores por curso de pensión</p>
		</div>
		<br>
		<table class="table">
			<tr>
				<td class="no-border uppercase">
					<p>Desde: ----</p>
				</td>
				<td class="no-border uppercase text-right">
					<p>Hasta: Septiembre</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="no-border uppercase">
					<p>Fecha: 25 Octubre 2018</p>
				</td>
			</tr>
		</table>
		<table class="table">
			<tr class="uppercase bgDark">
				<td class="text-center">alumno</td>
				<td class="text-center">rubros deuda</td>
				<td class="text-center">Deuda Total</td>
				<td class="text-center">Estado</td>
			</tr>
			<tr>
				<td colspan="4" class="uppercase">
					Curso: 3 - 4 años inicial 2 A
				</td>
			</tr>
			<tr class="uppercase">
				<td>
					1 torres talledo amelia elizabeth
				</td>
				<td>Jul-Pensión, AGO-Pensión, SEP-Pensión</td>
				<td class="text-center">471.00</td>
				<td></td>
			</tr>
			<tr class="uppercase">
				<td>
					2 rodriguez morales thiago alessandra
				</td>
				<td>Jul-Pensión, AGO-Pensión, SEP-Pensión</td>
				<td class="text-center">571.00</td>
				<td></td>
			</tr>
			<tr class="uppercase">
				<td>
					3 rodriguez salinas erick armanda
				</td>
				<td>Sep- pensión</td>
				<td class="text-center">157.00</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right uppercase bold">suman</td>
				<td class="text-center">1,199.00</td>
				<td></td>
			</tr>
			<tr>
				<td class="text-right uppercase bold" colspan="2">total</td>
				<td class="text-center">1,999.00</td>
				<td></td>
			</tr>
		</table>
		<br>
	</main>
	{{-- <div style="page-break-after:always;"></div> --}}
</body>

</html>