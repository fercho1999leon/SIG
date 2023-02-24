<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Acta de Calificaciones</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
.table td,
.table th {
	font-size: 7pt !important;
}
</style>
<body>
	@foreach ($materias as $materia)
		@php
		$students = App\Student2Profile::getStudentsByCourse($materia->idCurso);
		@endphp
		@while (count($students) > $valorInicial)
			@include('partials.reportes.actaDeControlInsumos', [])
			@php
				$valorInicial += $valor;
				$count += $valor;
			@endphp
		@endwhile
		@if (count($students) <= $valorInicial)
			@include('partials.reportes.actaDeControlInsumos', [])
			@php
				$valorInicial = $valor;
				$count = 1;
			@endphp
		@endif

	@endforeach
</body>

</html>
