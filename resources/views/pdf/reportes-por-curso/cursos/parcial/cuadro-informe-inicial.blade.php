<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
	<title>Cuadro Informe Inicial</title>
</head>
<body>
	@include('partials.encabezados.informe-inicial-parcial')
	<br>
	<table class="table">
		<tr height="140">
			<td width="5" rowspan="2" class="text-center bold">No.</td>
			<td rowspan="2" class="text-center uppercase bold">Apellidos y nombres</td>
			@foreach($matters as $matter)		
				<td class="text-center" width="5">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="actaDeCalificacionesRecuperacion__1 bold up"> {{$matter->nombre}} </span>
					</p>
				</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters as $matter)		
				<td class="text-center uppercase bold">PRO</td>
			@endforeach
		</tr>
		@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td width="220" class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
			@foreach($matters as $matter)		
				@if($destrezas->where('id', $matter->id)->first() != null)
					@php
						$jsonSupply = json_decode( $destrezas->where('id', $matter->id)->first()->calificacion ); 
						$notaDestreza = "";
						foreach($jsonSupply as $key => $json){
							if($key == $student->id)
								$notaDestreza = $json;
						}
					@endphp
					<td class="text-center uppercase bold">{{ $notaDestreza }}</td>
				@else
					<td class="text-center uppercase bold"> - </td>
				@endif
			@endforeach
		</tr>
		@endforeach
	</table>
	<br>
	<br>
</body>
</html>