<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte Anual de Aprendizaje</title>
</head>
@php
$nParcial = "";
$nQuimestre = "";

switch($parcial){
	case "p1q1":
	$nParcial = "1";
	$nQuimestre = "1";
	break;
	case "p2q1":
	$nParcial = "2";
	$nQuimestre = "1";
	break;
	case "p3q1":
	$nParcial = "3";
	$nQuimestre = "1";
	break;
	case "p1q2":
	$nParcial = "1";
	$nQuimestre = "2";
	break;
	case "p2q2":
	$nParcial = "2";
	$nQuimestre = "2";
	break;
	case "p3q2":
	$nParcial = "3";
	$nQuimestre = "2";
	break;

}
@endphp
<body>
	<div style="page-break-after:always;"></div>
	<header class="header mb-2">
		@include('partials.encabezados.informe-inicial-anual', [
			'informe' => $informe,
			'reportName' => 'Informe Cualitativo'
		])
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="2" class="text-center bold">No.</td>
				<td rowspan="2" class="text-center uppercase bold">Apellidos y nombres</td>
				@foreach($matters->take(7) as $matter)
					<td colspan="3" class="text-center uppercase bold">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->take(7) as $matter)				
					<td class="text-center uppercase bold">Q1</td>
					<td class="text-center uppercase bold">Q2</td>
					<td class="text-center uppercase bold">P</td>
				@endforeach
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="uppercase text-left">{{ $student->apellidos }} {{ $student->nombres }}</td>
                @foreach($matters->take(7) as $matter)
                    @php
                        $ambitosMaterias = $calificacionesAmbitos->where('idMateria', $matter->id)->where('idStudent', $student->id)->whereIn('Parcial', ['Q1','Q2','ANUAL']);
                        $notaDestreza = '';
                    @endphp
                    @if($ambitosMaterias->where('Parcial', 'Q1')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'Q1')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                    @if($ambitosMaterias->where('Parcial', 'Q2')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'Q2')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                    @if($ambitosMaterias->where('Parcial', 'ANUAL')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'ANUAL')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                @endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 2da hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.informe-de-aprendizaje', ['reportName' => 'Informe Cualitativo', 'informe' => $informe])
		</div>
		<table class="table whitespace-no" style="width:auto">
			<tr>
				<td width="5" rowspan="2" class="text-center bold">No.</td>
				@foreach($matters->slice(7)->take(8) as $matter)
					<td colspan="3" class="text-center uppercase bold">{{ $matter->nombre }}</td>
				@endforeach
				<td class="text-center uppercase bold">Comportamiento</td>
			</tr>
			<tr>
				@foreach($matters->slice(7)->take(8) as $matter)
					<td class="text-center uppercase bold">Q1</td>
					<td class="text-center uppercase bold">Q2</td>
					<td class="text-center uppercase bold">P</td>
				@endforeach
				<td class="text-center"></td>
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
                @foreach($matters->slice(7)->take(8) as $matter)
                    @php
                        $ambitosMaterias = $calificacionesAmbitos->where('idMateria', $matter->id)->where('idStudent', $student->id)->whereIn('Parcial', ['Q1','Q2','ANUAL']);
                        $notaDestreza = '';
                    @endphp
                    @if($ambitosMaterias->where('Parcial', 'Q1')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'Q1')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                    @if($ambitosMaterias->where('Parcial', 'Q2')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'Q2')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                    @if($ambitosMaterias->where('Parcial', 'ANUAL')->first() != null)
                        @php
                            $notaDestreza = $ambitosMaterias->where('Parcial', 'ANUAL')->first()->Calificacion;
                        @endphp
                        <td class="text-center uppercase">{{ $notaDestreza }}</td>
                    @else
                        <td class="text-center uppercase">  </td>
                    @endif
                @endforeach
				<td class="text-center uppercase">
				@if($comportamientos->where('idStudent', $student->idStudent)->first()!=null)
                    {{ $comportamientos->where('idStudent', $student->idStudent)->first()->nota }}
				@else
				@endif
				</td>
			</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="15%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
				</th>
				<th width="10%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
				</th>
				<th width="15%"></th>
			</tr>
		</table>
</header>
</body>
</html>