<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Factura</title>
	<link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
table td,
table th,
span,
p {
	font-size: 7.5pt !important;
}
.row {
	margin: 0 !important;
}
[class^='col-xs-'] {
	padding: 0 !important;
}
</style>
<body>
	<main>
		<table class="table" style="width:98%; margin-right:auto; margin-left:auto;">
			<tr>
				<td class="no-border" width="45%">
					@include('partials.factura.factura-pension')
				</td>
				<td class="no-border" width="10%"></td>
				<td class="no-border" width="45%">
					@include('partials.factura.factura-pension')
				</td>
			</tr>
		</table>
			
	</main>
</body>

</html>