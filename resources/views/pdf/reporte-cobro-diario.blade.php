<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de cobros</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">

</head>
<body>
	<main>
		<div class="actaCalificaciones__titulo">
			<p class="text-center uppercase bold"> nombre institución</p>
			<p class="text-center uppercase">año lectivo: 2018 - 2019</p>
			<p class="text-center uppercase">cobros en colecturia</p>
		</div>
		<table class="table">
			<tr class="uppercase"
				<td class="no-border text-left">Día: 26 octubre 2018</td>
				<td class="no-border text-right">Fecha de Reporte: 26/oct/2018</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark uppercase" height="40">
				<td rowspan="2" class="text-center">Alumno</td>
				<td rowspan="2" class="text-center">Curso</td>
				<td rowspan="2" class="text-center">Valor Doc.</td>
				<td class="text-center" colspan="4">Formas de Cobro</td>
				<td rowspan="2" class="text-center">Total Cobrado</td>
				<td rowspan="2" class="text-center">Saldo Actual</td>
			</tr>
			<tr class="bgDark uppercase">
				<td class="text-center">Efectivo</td>
				<td class="text-center">Cheque Post Fechado</td>
				<td class="text-center">Deposito</td>
				<td class="text-center">Tarjeta</td>
			</tr>
			<tr>
				<td>Usuario: --------</td>
			</tr>
			<tr>
				<td>Factura Secundaria</td>
			</tr>
			<tr>
				<td class="uppercase">nombre---------------</td>
				<td>tercer grado - basica elemental - b</td>
				<td class="text-center">182.00</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">182.00</td>
				<td class="text-center">-</td>
			</tr>
			<tr class="bgDark">
				<td colspan="2" class="text-right">Suman Factura Secundaria ===> </td>
				<td class="text-center">1,630.65</td>
				<td class="text-center">908.00</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">575.65</td>
				<td class="text-center">1,630.65</td>
				<td class="text-center">-</td>
			</tr>
			<tr>
				<td>Recibo de Caja Secundaria</td>
			</tr>
			<tr>
				<td class="uppercase">nombre--------</td>
				<td>Segundo Grado - Basica Elemental</td>
				<td class="text-center">172.00</td>
				<td class="text-center">82.00</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">82.00</td>
				<td class="text-center">90.00</td>
			</tr>
			<tr class="bgDark">
				<td colspan="2" class="text-right">Suman Recibo de Caja Secundaria ===> </td>
				<td class="text-center">576.00/td>
				<td class="text-center">272.00</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">272.00</td>
				<td class="text-center">304.00</td>
			</tr>
			<tr class="bgDark">
				<td colspan="2" class="text-right">Totales por usuario ===> </td>
				<td class="text-center">2,206.65</td>
				<td class="text-center">1,180.00</td>
				<td class="text-center">-</td>
				<td class="text-center">-</td>
				<td class="text-center">575.65</td>
				<td class="text-center">1,902.65</td>
				<td class="text-center">304.00</td>
			</tr>
		</table>
		<br>
	</main>
	{{-- <div style="page-break-after:always;"></div> --}}
</body>

</html>