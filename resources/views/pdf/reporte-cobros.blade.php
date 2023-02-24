<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de Cobros</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">

</head>
<body>
	@include('partials.encabezados.reporte-institucional',[
		'reportName' => 'Listado de documentos de cobro'
	])
	<table class="table">
		<tr>
			<td>Desde: ----</td>
			<td>Hasta: ----</td>
			<td>Fecha: ----</td>
		</tr>
	</table>
	<table class="table">
		<tr class="bgDark">
			<td class="text-center uppercase">No. Doc.</td>
			<td class="text-center uppercase">Fecha</td>
			<td class="text-center uppercase">Cliente</td>
			<td class="text-center uppercase">SubTotal</td>
			<td class="text-center uppercase">IVA</td>
			<td class="text-center uppercase">Total</td>
			<td class="text-center uppercase">Estudiante</td>
			<td class="text-center uppercase">Curso</td>
		</tr>
		<tr>
			<td class="text-center">0000</td>
			<td class="text-center">02/ago/2018</td>
			<td>nombre cliente</td>
			<td class="text-center">000.00</td>
			<td class="text-center"></td>
			<td class="text-center">000.00</td>
			<td>nombre estudiante</td>
			<td>curso etc etc etc</td>
		</tr>
	</table>
</body>
</html>