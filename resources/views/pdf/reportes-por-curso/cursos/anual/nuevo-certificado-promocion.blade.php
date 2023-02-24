<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado de promoción </title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body>
	<main>
	@foreach($students as $student)
    @php
    $notas =$data2->where('estudianteId',$student->idStudent)->first();
    if($notas == null)
    @endphp
		@include('partials.encabezados.certificado', [
			'reportName' => 'promoción'
		])
		<br>
		<p class="just" style="line-height: 1.5">De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica de Educación Intercultural y demás
			normativas vigentes, certifica que
			@if($student->sexo=='Masculino')
				el estudiante
			@else
				la estudiante
			@endif
			<span class="bold uppercase">{{ $student->apellidos }} {{ $student->nombres }}</span> del
			<span class="bold uppercase">
				{{ $educacion }}
				@if($curso->paralelo!=null)
					@if($curso->seccion!='BGU')
						,Paralelo: {{ $curso->paralelo }}
					@else
						{{ $curso->especializacion }}, Paralelo: {{ $curso->paralelo }}
					@endif
				@endif
			</span>, obtuvo las siguientes calificaciones
			durante el presente año lectivo: </p>
		<table class="table">
			<!-- ENCABEZADO -->
			<tr>
				<td colspan="2" class="no-border"></td>
				<td class="text-center uppercase" colspan="2">Calificaciones</td>
			</tr>
			<tr>
				<td width="90" rowspan="2" class="text-center">ÁREAS</td>
				<td width="90" rowspan="2" class="text-center uppercase">ASIGNATURAS</td>
				<td width="15" rowspan="2" class="text-center">NÚMERO</td>
				<td width="125" rowspan="2" class="text-center">LETRAS</td>
			</tr>
			<!-- FILA VACIA -->
			<tr class="bgDark bold">
			</tr>
			<!-- FILAS DE MATERIAS FIJAS -->
            <tr>
            @foreach($areas as $area)
                <td class="text-center uppercase" rowspan="{{$area->numero}}">{{$area->nombreArea}}</td>
                @foreach($matters as $matter)
                    @if($matter->nombreArea == $area->nombreArea)
                        <td class="text-center uppercase" >{{$matter->nombre}}</td>
                        @foreach($notas->materias as $n_m)
                            @if($n_m->materiaId == $matter->id)
                                <td class="text-center uppercase" >{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$n_m->promedioFinal)['nota'] : bcdiv($n_m->promedioFinal, '1', 2)}}</td>
                                @php
                                    $number = bcdiv($n_m->promedioFinal, '1', 2);
                                    $numLetras = str_replace("un", "uno",
                                                    str_replace("venti", "veinti",
                                                        str_replace("con", "coma", NumerosEnLetras::convertir(bcdiv($n_m->promedioFinal, '1', 2)) ) ) );
                                    if ( round($number - floor($number), 2) > 0 && round($number - floor($number), 2) < 0.1)
                                    {
                                        $letras = explode(" ", $numLetras);
                                        $numLetras = $letras[0]." ".$letras[3]." cero ".$letras[4];
                                    }
                                @endphp
                                @if($matter->idEstructura!= null)
                                    <td class="text-center uppercase">
                                        {{App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$n_m->promedioFinal)['descripcion']}}
                                    </td>
                                    @else
                                    <td class="text-center uppercase" >
                                        {{ $numLetras }}
                                        {{ ($number - floor($number)) == 0 ? ' coma cero cero' : '' }}
                                    </td>
                                @endif</tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            <tr><td class="text-center uppercase bold">PROMEDIO</td>
                <td class="text-center"></td>
                <td class="text-center uppercase">{{bcdiv($notas->promedioEstudiante, '1', 2)}}</td>
                @php
                                    $number = bcdiv($notas->promedioEstudiante, '1', 2);
                                    $numLetras = str_replace("un", "uno",
                                                    str_replace("venti", "veinti",
                                                        str_replace("con", "coma", NumerosEnLetras::convertir(bcdiv($notas->promedioEstudiante, '1', 2)) ) ) );
                                    if ( round($number - floor($number), 2) > 0 && round($number - floor($number), 2) < 0.1)
                                    {
                                        $letras = explode(" ", $numLetras);
                                        $numLetras = $letras[0]." ".$letras[3]." cero ".$letras[4];
                                    }
                                @endphp
                                <td class="text-center uppercase" >
                                {{ $numLetras }}
                                {{ ($number - floor($number)) == 0 ? ' coma cero cero' : '' }}
                                </td>
            </tr>
           <tr>
                <td  class="text-center uppercase bold">COMPORTAMIENTO</td>
                <td  class="text-center uppercase"></td>
                <td  class="text-center uppercase">
                    @if($confComportamiento->valor !== 'crear')
                        @forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
                            {{$comportamiento->nota}}
                            @php
                                $comp = $comportamiento->nota;
                            @endphp
                        @empty
                            @php
                                $comp = null;
                            @endphp
                            -
                        @endforelse
                    @else
                        @forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
                            {{$comportamiento->nota}}
                            @php
                                $comp = $comportamiento->nota;
                            @endphp
                        @empty
                            @php
                                $comp = null;
                            @endphp
                            -
                        @endforelse
                    @endif
                </td>
                <td  class="text-center uppercase">
                    @if($comp!=null)
                        @if($comp == "A")
                            Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social
                        @elseif($comp == "B")
                            Cumple con los compromisos establecidos para la sana convivencia social
                        @elseif($comp == "C")
                            Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social
                        @elseif($comp == "D")
                            Falla reiteradamente en el cumplimiento del os compromisos establecidos para la sana convivencia social
                        @elseif($comp == "E")
                            No cumple con los compromisos establecidos para la sana convivencia social
                        @endif
                    @endif
                </td>
            </tr>
            @if($dhi != null)
                <tr>
                    <td  class="text-center uppercase">{{$dhi->area}}</td>
                    <td  class="text-center uppercase">{{$dhi->nombre}}</td>
                    <td  class="text-center uppercase">{{$dhi["exq1"]!= null ? $dhi['exq1']:'-' }}</td>
                    <td class="text-center uppercase">{{App\rangosCualitativo::getCalificacionCualitativadhi($dhi['exq1'])['descripcion']}}</td>
                </tr>
            @endif
            </table>
            @if($notas->promedioEstudiante!=0)
            <div class="certificadoDePromocion__header">
            <p style="line-height: 1.5;">Por lo tanto
                @if( $curso->grado != 'Tercero de Bachillerato')
            es @if ($student->sexo == 'Masculino') promovido @else promovida @endif a <span class="uppercase bold">{{ $gradoSiguiente }} {{ $especializacionSig }}</span>
                @else
                aprueba el <span class="uppercase bold">TERCER AÑO DE BACHILLERATO</span>
                @endif
                <br> Para constancia suscriben en unidad de acto el/la {{ $institution->cargo1 }}, con el/la {{ $institution->cargo2 }} del plantel quien certifica.
            </p>
        </div>
        @else
            <div class="certificadoDePromocion__header">
            <p style="line-height: 1.5;">@if( $curso->grado != 'Tercero de Bachillerato')
                Por lo tanto no es promovida a <span class="uppercase bold">{{ $gradoSiguiente }}</span>
            @else
            Por lo tanto no ha <span class="uppercase bold">culminado la instruccion secundaria</span>
            @endif

                <br> Para constancia suscriben en unidad de acto el/la {{ $institution->cargo1 }}, con el/la {{ $institution->cargo2 }} del plantel quien certifica.
            </p>
        @endif
        <br>
        <p class="uppercase text-right">{{ $institution->ciudad }}, {{ $institution->fechaCertificadoPromocion }}</p>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
		<div style="page-break-after:always;"></div>
	@endforeach
	</main>
</body>
</html>