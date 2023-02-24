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
		@include('partials.encabezados.certificado', [
			'reportName' => 'promoción'
		])
		<br>
		<p class="just" style="line-height: 1.5">De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica de Educación Intercultural y demás
			normativas vigentes, certifica que
			@if(  $student->sexo=='Masculino')
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
		<br>
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
			@php
			$contPasado = 0;
			@endphp
			@foreach($materiasFijas->groupBy('area') as $key => $mFijas)
				@php
					$number = 0;
				@endphp
                @foreach($mFijas as $materia)
                    @if (!$materia->getArea->dependiente)
                        <tr>
                            @if(count($mFijas) > 1)
                                @if ($number == 0)
                                    <td class="pdfSubmateria uppercase" rowspan=" {{count($mFijas)}} ">
                                        {{ $key }}
                                        <span style="display:none;">
                                            {{$number++}}
                                        </span>
                                    </td>
                                @endif
                            @else
                                <td class="pdfSubmateria uppercase">
                                    {{ $key }}
                                </td>
                            @endif
                            <td class="pdfSubmateria uppercase">
                                {{ $materia->nombre}}
                            </td>
                            <td class="text-center"
                            @if($notasMenores == "1")
                                @if($promedioFinalQuimestre[$materia->id][$student->idStudent] < (int)$nota_menor->valor && $promedioFinalQuimestre[$materia->id][$student->idStudent]!=0)
                                    style="color:red;"
                                @endif
                            @endif
                            >{{ str_replace(".", ",", bcdiv($promedioFinalQuimestre[$materia->id][$student->idStudent], '1', 2))  }}
                                <span style="display: none">
                                @if( bcdiv($promedioFinalQuimestre[$materia->id][$student->idStudent], '1', 2)>=7)
                                    {{$contPasado++}}
                                @endif

                                </span>
                            </td>
                            <td class="pdfSubmateria uppercase">
                                @php
                                    $number = $promedioFinalQuimestre[$materia->id][$student->idStudent];
                                    $numLetras = str_replace("un", "uno",
                                                    str_replace("venti", "veinti",
                                                        str_replace("con", "coma", NumerosEnLetras::convertir(bcdiv($promedioFinalQuimestre[$materia->id][$student->idStudent], '1', 2)) ) ) );

                                    if ( round($number - floor($number), 2) > 0 && round($number - floor($number), 2) < 0.1)
                                    {
                                        $letras = explode(" ", $numLetras);
                                        $numLetras = $letras[0]." ".$letras[3]." cero ".$letras[4];
                                    }
                                @endphp
                                {{ $numLetras }}
                                {{ ($number - floor($number)) == 0 ? 'coma cero cero' : '' }}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $materia->getArea->nombre}}</td>
                            <td>{{ $materia->nombre}}</td>
                            @php
                                $materiasArea = App\Matter::where(['idCurso' => $student->idCurso,'idArea' => $materia->getArea->id])->get();
                                $pr1 = 0;
                                $pr2 = 0;
                                foreach ($materiasArea as $materia) {
                                    $pr1 += $promediosFinalQ1[$materia->id][$student->idStudent];
                                    $pr2 += $promediosFinalQ2[$materia->id][$student->idStudent];
                                }
                                $pr1 = bcdiv($pr1/ count($materiasArea), '1', 2);
                                $pr2 = bcdiv($pr2/ count($materiasArea), '1', 2);
                                $prf = bcdiv(($pr1 + $pr2) / 2, '1', 2);
                            @endphp
                            <td class="text-center">{{$prf}}</td>
                            <td class="uppercase">
                                @php
                                    $number = $prf;
                                    $numLetras = str_replace("un", "uno",
                                                    str_replace("venti", "veinti",
                                                        str_replace("con", "coma", NumerosEnLetras::convertir($prf) ) ) );

                                    if ( round($number - floor($number), 2) > 0 && round($number - floor($number), 2) < 0.1)
                                    {
                                        $letras = explode(" ", $numLetras);
                                        $numLetras = $letras[0]." ".$letras[3]." cero ".$letras[4];
                                    }
                                @endphp
                                {{ $numLetras }}
                                {{ ($number - floor($number)) == 0 ? 'coma cero cero' : '' }}
                            </td>
                        </tr>
                    @endif
				@endforeach
			@endforeach
			@if( $proyecto!=null)
			<tr>
				<td class="uppercase">{{ $proyecto->area }}</td>
				<td>{{ $proyecto->nombre }}</td>
				<td class="text-center uppercase">ex</td>
				<td style="font-size:8px">Demuestra destacado desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un excelente aporte
					a su formación integral</td>
			</tr>
			@endif
			<tr>
				<td  class="text-center uppercase bold">PROMEDIO</td>
				<td  class="text-center uppercase"></td>
				<td  class="text-center uppercase">{{ str_replace(".", ",", bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas), '1', 2) ) }}</td>
				<td  class="text-center uppercase">
					@php
						$number = $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas);
						$numLetras = str_replace("con", "coma", NumerosEnLetras::convertir(bcdiv($pPromediosTotalFinal[$student->idStudent]/count($materiasFijas), '1', 2)) );
					@endphp
					{{$numLetras}}
					{{ (substr($number,0,4) - floor($number)) == 0 ? 'coma cero cero' : '' }}
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
		</table>
		@if( $contPasado==count($materiasFijas))
			<div class="certificadoDePromocion__header">
			<p style="line-height: 1.5;">Por lo tanto
				@if( $curso->grado != 'Tercero de Bachillerato')
			es @if ($student->sexo == 'Masculino') promovido @else promovida @endif a <span class="uppercase bold">{{ $gradoSiguiente }} {{ $especializacionSig }}</span>
				@else
					ha <span class="uppercase bold">culminado la instruccion secundaria</span>
				@endif
				<br> Para constancia suscriben en unidad de acto el {{ $institution->cargo1 }}, con la SECRETARÍA del plantel quien certifica.
			</p>
		</div>
		@else
			<div class="certificadoDePromocion__header">
			<p style="line-height: 1.5;">@if( $curso->grado != 'Tercero de Bachillerato')
				Por lo tanto no es promovida a <span class="uppercase bold">{{ $gradoSiguiente }}</span>
			@else
			Por lo tanto no ha <span class="uppercase bold">culminado la instruccion secundaria</span>
			@endif

				<br> Para constancia suscriben en unidad de acto el {{ $institution->cargo1 }}, con la SECRETARÍA del plantel quien certifica.
			</p>
		@endif
		<br>
		<p class="uppercase">{{ $institution->ciudad }}, {{ $institution->fechaCertificadoPromocion }}</p>
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