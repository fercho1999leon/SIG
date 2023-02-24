<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado de promoción</title>
    <link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body>
	<main>
	@foreach($students as $student)
    @php
    $notas =$data2->where('estudianteId',$student->idStudent)->first();
    @endphp
		@include('partials.encabezados.certificado-formato2', [
			'reportName' => 'promoción'
		])
		<p class="just" style="line-height: 1.5">De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica de Educación Intercultural y demás
			normativas vigentes, certifica que
			@if($student->sexo=='Masculino')
				el estudiante:
			@else
				la estudiante:
            @endif
            <br><br>
        </p>
        <p class="text-center" style="line-height: 1.5">
            <span style="font-size: 20px;" class="bold uppercase">{{ $student->apellidos }} {{ $student->nombres }}</span>
        </p><br>
        <p class="just" style="line-height: 1.5">
             del <span class="bold uppercase text-align:center"> {{ $educacion }} </span>
			obtuvo las siguientes calificaciones durante el presente año lectivo {{ App\Institution::periodoLectivo() }}. </p>
		<table class="table">
			<!-- ENCABEZADO -->
			<tr>
				<td colspan="2" class="no-border"></td>
				<td class="text-center uppercase" colspan="2">PROMEDIO ANUAL</td>
			</tr>
			<tr>
				<td width="90" rowspan="2" class="text-center bold">ÁREA</td>
				<td width="90" rowspan="2" class="text-center uppercase bold">ASIGNATURA</td>
				<td width="15" rowspan="2" class="text-center bold">CALIFICACION CUANTITATIVA</td>
				<td width="125" rowspan="2" class="text-center bold">CALIFICACION CUALITATIVA</td>
			</tr>
			<!-- FILA VACIA -->
			<tr class="bgDark bold"></tr>
			<!-- FILAS DE MATERIAS FIJAS -->
            <tr>
            @foreach($areas as $area)
                <td class="text-center transporte__unidad__datos" rowspan="{{$area->numero}}">{{$area->nombreArea}}</td>
                @foreach($matters as $matter)
                    @if($matter->nombreArea == $area->nombreArea)
                        <td class="text-center capitalize">{{$matter->nombre}}</td>
                        @foreach($notas->materias as $n_m)
                            @if($n_m->materiaId == $matter->id)
                                <td class="text-center uppercase" >{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$n_m->promedioFinal)['nota'] : bcdiv($n_m->promedioFinal, '1', 2)}}</td>
                                @php
                                    $not1 = bcdiv($n_m->promedioFinal, '1', 2);
                                    if ($not1 >= 9) {
                                        $cualitativo1 = "Domina los aprendizajes requeridos";
                                    } else if ($not1 >= 7 && $not1 < 9) {
                                        $cualitativo1 = "Alcanza los aprendizajes requeridos";
                                    } else if ($not1 > 4 && $not1 < 7) {
                                        $cualitativo1 = "Esta proximo alcanzar los aprendizajes requeridos";
                                    } else {
                                        $cualitativo1 = "No alcanza los aprendizajes requeridos";
                                    }
                                @endphp
                                @if($matter->idEstructura!= null)
                                    <td class="text-center uppercase">
                                        {{App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$n_m->promedioFinal)['descripcion']}}
                                    </td>
                                    @else
                                    <td class="text-center" >{{ $cualitativo1 }}</td>
                                @endif</tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            <tr>
                <td class="text-center uppercase bold" colspan="2">PROMEDIO</td>
                <td class="text-center uppercase">{{bcdiv($notas->promedioEstudiante, '1', 2)}}</td>
                @php
                    $not = bcdiv($notas->promedioEstudiante, '1', 2);
                    if ($not >= 9) {
                        $cualitativo = "Domina los aprendizajes requeridos";
                    } else if ($not >= 7 && $not < 9) {
                        $cualitativo = "Alcanza los aprendizajes requeridos";
                    } else if ($not > 4 && $not < 7) {
                        $cualitativo = "Esta proximo alcanzar los aprendizajes requeridos";
                    } else {
                        $cualitativo = "No alcanza los aprendizajes requeridos";
                    }
                @endphp
                <td class="text-center" >{{ $cualitativo }}</td>
            </tr>
            <tr>
                <td  class="text-center bold" colspan="2">EVALUACION DE COMPORTAMIENTO (Cualitativo)</td>
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
                <td  class="text-center">
                    @if($comp!=null)
                        @if($comp == "A")
                            Muy Satisfactorio
                        @elseif($comp == "B")
                            Satisfactorio
                        @elseif($comp == "C")
                            Poco Satisfactorio
                        @elseif($comp == "D")
                            Mejorable
                        @elseif($comp == "E")
                            Insatisfactorio
                        @endif
                    @endif
                </td>
            </tr>            
            @php
                $calificacionCualitativaDhi = App\rangosCualitativo::getCalificacionCualitativadhi($dhi['exq1']);
            @endphp
            @if($dhi != null)            
                <tr>
                    <td  class="text-center uppercase">{{$dhi->area}}</td>
                    <td  class="text-center uppercase">{{$dhi->nombre}}</td>
                    <td  class="text-center uppercase">{{$dhi["exq1"]!= null ? $dhi['exq1']:'-' }}</td>
                    <td class="text-center uppercase">{{$calificacionCualitativaDhi == null ?'-': ($calificacionCualitativaDhi['descripcion'])}}</td>
                </tr>
            @endif
            </table>
            @php
                if ( $institution->cargo1 == 'Rector' || $institution->cargo1 == 'RECTOR' || $institution->cargo1 == 'DIRECTOR' || $institution->cargo1 == 'Director'){
                    $articulo = 'el ';
                }else {
                    $articulo = 'la ';
                }
                if ( $institution->cargo2 == 'Secretaria' || $institution->cargo2 = 'SECRETARIA'){
                    $articulo2 = 'la ';
                }else {
                    $articulo2 = 'el ';
                }
            @endphp
            @if($notas->promedioEstudiante!=0)
                <div class="certificadoDePromocion__header">
                    <p style="line-height: 1.5;">Por lo tanto
                        @if( $curso->grado != 'Tercero de Bachillerato')
                            es @if ($student->sexo == 'Masculino') promovido @else promovida @endif a 
                            <span class="uppercase bold">{{ $gradoSiguiente }} {{ $especializacionSig }}</span>
                        @else
                            aprueba el <span class="uppercase">TERCER AÑO DE BACHILLERATO.</span>
                        @endif
                        <br> Para certificar suscribe {{$articulo}} {{ $institution->cargo1 }}, con {{$articulo2}} {{ $institution->cargo2 }}.
                    </p>
                </div>
            @else
                <div class="certificadoDePromocion__header">
                <p style="line-height: 1.5;">
                    @if( $curso->grado != 'Tercero de Bachillerato')
                        Por lo tanto no es promovida a <span class="uppercase bold">{{ $gradoSiguiente }}</span>
                    @else
                        Por lo tanto no ha <span class="uppercase bold">culminado la instruccion secundaria</span>
                    @endif
                    <br>  Para certificar suscribe {{$articulo}} {{ $institution->cargo1 }}, con {{$articulo2}} {{ $institution->cargo2 }}.
                </p>
            @endif
        <br>
        <p>Dado y firmado en: {{ $institution->ciudad }}, {{ $institution->fechaCertificadoPromocion }}</p>
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
        </div><br><br><br><br>

        {{-- pie de pagina --}}
        <table class="table m-0">
            <tr>
                <th style="vertical-align:top;" class="no-border" width="50%">
                    <div class="header__logo" style="float: left">
                        <img src="{{ secure_asset('img/pie1.jpg') }}"  width="250" alt="">
                    </div>
                </th>
                <th style="vertical-align:top;" class="no-border" width="50%">
                    <div class="header__logo" style="float:right">
                        <img width="250" src=" {{secure_asset('img/pie2.jpg')}} " alt="">
                    </div>
                </th>
            </tr>
        </table>
        {{-- fin de pie de pagina --}}

        <div style="page-break-after:always;"></div>
	@endforeach
	</main>
</body>
</html>