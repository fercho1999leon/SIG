
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Recibo</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">

</head>
<style>
	body .table td,
	 {
		padding: 20px !important;
		font-size: 8pt !important;
	}
</style>
<body>
	<main>
		<table class="table">
			<tr>
				<td width="45%" class="no-border">
					@include('partials.factura.recibo')
				</td>
				<td width="10%" class="no-border"></td>
				<td width="45%" class="no-border">
					@include('partials.factura.recibo')
				</td>
			</tr>
		</table>
		
	</main>
</body>

</html>