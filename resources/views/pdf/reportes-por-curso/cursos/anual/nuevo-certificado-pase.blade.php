<!DOCTYPE html>
<html lang="es">
@php
$numeroEstudiantes = count($students);
$cont =0;
@endphp
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado pase de año</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
	p {
		font-size: 18px;
	}
</style>
<body>
	<main>
    @foreach($students as $student)
        @if ($formato->valor == 0)
            @include('partials.encabezados.certificado', [
                'reportName' => 'pase de año'
            ])
        @elseif($formato->valor == 1)
            @include('partials.encabezados.certificado-pase-2', [
                'reportName' => 'pase de año'
            ])
        @endif
		@php
            $cont++;
            $notas = $data2->where('estudianteId',$student->id)->first();
        @endphp

        @if ($formato->valor == 1)
            <p>A petición de la parte interesada y por disposición del Rectorado de la
                <span class="uppercase">{{ $institution->nombre }}</span>
                certifica que
                @if( $student->sexo=='Masculino' )
                    el estudiante:
                @else
                    la estudiante:
                @endif
            </p>
        @elseif($formato->valor == 0)
            <p>La suscrita Rectoría de la 
                <span class="uppercase">{{ $institution->nombre }}</span><br>
                A petición de la parte interesada certifica que
                @if( $student->sexo=='Masculino' )
                    el estudiante:
                @else
                    la estudiante:
                @endif
            </p>
        @endif
		<br>
		<h3 class="text-center bolf uppercase">{{ $student->apellidos }} {{ $student->nombres }}</h3>
		<br>
		@if( $notas->promedioEstudiante > 7)
			<p>
                Aprobó el <span> {{ $educacion }}</span>
                @if( $curso->grado != "Tercero de Bachillerato")
				    siendo promovido al {{ $gradoSiguiente }}
				@endif
                asistiendo normalmente a clases y obteniendo una calificación global en:
            </p>
			<br>
			<table class="table">
				<tr>
					<td style="font-size: 15px !important;" class="bold uppercase no-border text-right" width="48%">aprovechamiento:</td>
					<td class="no-border"></td>
					<td style="font-size: 15px !important;" class="bold uppercase no-border text-left" width="48%">{{bcdiv(  $notas->promedioEstudiante, '1', 2)}}</td>
				</tr>
				<tr>
					<td style="font-size:15px !important;" class="bold uppercase no-border text-right">disciplina:</td>
					<td class="no-border"></td>
					<td style="font-size:15px !important;" class="bold uppercase no-border text-left">
						 @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', $ultimoP) as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
					</td>
				</tr>
            </table>
            @if ($formato->valor == 0)
                <p>Además hacemos constar que los documentos del estudiante están en trámite por legalización en la Dirección Distrital.</p>
                <p> Asi consta en los libros de calificaciones de la Secretaría del Plantel.</p>
                <p>Certificación que se hace en honor a la verdad, para los fines pertinentes.</p>
            @elseif($formato->valor == 1)
                <p>Es todo lo que puedo  certificar en honor a la verdad y remitiéndome a los datos entregados por el Dpto. de secretaria del plantel. Los Documentos del estudiante están en trámite en el Distrito 5 para su debida legalización.</p>
                <p>Autorizo al peticionario dar del presente Certificado el uso que crea conveniente.</p>
            @endif
			<br>
			<p class="text-right">{{ $institution->ciudad }}, {{ $fechaA }}</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		@else
			<p>No Aprobó el <span class="uppercase"> {{ $educacion }} </span> teniendo que repetir el {{ $educacion }}</p>
			<p>Asistiendo normalmente a clases y obteniendo una calificación global en:</p>
			<br>
			<table class="table">
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right" width="48%">aprovechamiento:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left" width="48%">{{bcdiv(  $notas->promedioEstudiante, '1', 2)}}</td>
				</tr>
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right">disciplina:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left">
						 @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial',$ultimoP) as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
					</td>
				</tr>
			</table>
			<p>Además hacemos constar que los documentos del estudiante están en trámite por legalización en la Dirección Distrital.</p>
			<p> Asi consta en los libros de calificaciones de la Secretaría del Plantel.</p>
			<p>Certificación que se hace en honor a la verdad, para los fines pertinentes.</p>
			<br>
			<p class="text-right">{{ $institution->ciudad }}, {{ $fechaA }}</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		@endif
		<div class="row">
            @php
                if ($formato->valor == 0) {
                    $fmato = 'col-xs-6 p-0';
                } else {
                    $fmato = '';
                }
            @endphp
			<div class="{{$fmato}} text-center ">
				<hr class="certificado__hr">
				<p class="uppercase">
					{{ $institution->representante1 }}
					<br> {{ $institution->cargo1 }}
				</p>
            </div>
            @if ($formato->valor == 0)
                <div class="{{$fmato}} text-center">
                    <hr class="certificado__hr">
                    <p class="uppercase">
                        {{ $institution->representante2 }}
                        <br> {{ $institution->cargo2 }}
                    </p>
                </div>
            @endif
		</div>
		@if($cont != $numeroEstudiantes)
		    <div style="page-break-after:always;"></div>
        @endif
	@endforeach
	</main>
</body>
</html>