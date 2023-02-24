<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/print.css')}} " media="print">
	<link rel="stylesheet" href=" {{secure_asset('css/print.css')}} ">
	<link rel="stylesheet" href="{{secure_asset('css/no-print.css')}}">
	<title>Junta de curso</title>
</head>
<body>
	<main>
		<header class="header mb-2">
			<!-- #Importante, si el logo no queda centrado verticalmente, realziar ajuste en style="top: xx" o si desea mover mas a la derecha o izquierda,
					realizar ajustes en left: xx
					-->
			<div class="header__logo" style="top: 6px;">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)                     src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="55" alt="">
			</div>
			<div class="header__info text-center">
				<h1 class="h1 uppercase"> nombre de la institución </h1>
				<h3 class="uppercase h2">acta de la junta quimestral de docentes de grado o curso</h3>
			</div>
		</header>
		<br>
		<br>
		<table class="table">
			<tr class="bgDark">
				<td colspan="7" class="text-center uppercase">datos informativos</td>
			</tr>
			<tr>
				<td width="30">Docente Tutor</td>
				<td class="uppercase">Msc. Herrera Moreira Patricio danilo</td>
				<td width="30" rowspan="2" class="text-center">Forma</td>
				<td class="bold uppercase">ordinaria</td>
				<td width="20"> </td>
				<td>Hora de inicio:</td>
				<td></td>
			</tr>
			<tr>
				<td>Curso: </td>
				<td class="uppercase">tercero de bachillerato ciencias</td>
				<td class="bold uppercase">extraordinaria</td>
				<td></td>
				<td>Hora fin:</td>
				<td></td>
			</tr>
			<tr>
				<td>Parcial:</td>
				<td class="uppercase">Segundo Parcial - Quimestre 1</td>
				<td>Sección:</td>
				<td colspan="2" class="uppercase">matutina</td>
				<td>Año Lectivo</td>
				<td>2018 - 2019</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="4" class="text-center bold uppercase">orden del día</td>
			</tr>
			<tr>
				<td width="44%" class="text-center uppercase">puntos tratados</td>
				<td width="6%" class="text-center">SI</td>
				<td width="6%" class="text-center">NO</td>
				<td width="44%" class="text-center">observación</td>
			</tr>
			<tr>
				<td>1.- Constatación del quórum:</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>2.- Lectura y aprobación del acta anterior:</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>3.- Análisis de rendimiento académico y toma de resoluciones: <br>Lectura del informe de docente turor. <br>Lectura del informe de docentes de asignaturas.</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>4.- Análisis de comportamiento(informe de inspección):</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>5.- Análisis de estímulos a estudiantes.</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>6.- Resoluciones.</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>7.- Varios</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="4" class="text-center uppercase">Asistencia</td>
			</tr>
			<tr class="bgDark">
				<td width="35%" class="text-center uppercase">asignatura</td>
				<td width="35%" class="text-center uppercase">docente</td>
				<td width="15%" class="text-center uppercase">firma</td>
				<td width="15%" class="text-center uppercase">asistencia</td>
			</tr>
			<tr>
				<td class="uppercase">lenguaje y literatura</td>
				<td class="uppercase">Msc. herrera moreira patricio</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td class="text-center uppercase">lectura y aprobación de resoluciones propuestas por la junta anterior</td>
			</tr>
			<tr>
				<td>---</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td class="up text-center">resoluciones</td>
			</tr>
			<tr>
				<td>---</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="4" class="text-center uppercase">Analisis del rendimiento académico quiemstral(promedio menosres a 7)</td>
			</tr>
			<tr class="bgDark">
				<td width="35%" class="text-center uppercase">asignatura</td>
				<td width="35%" class="text-center uppercase">estudiante</td>
				<td width="10%" class="text-center uppercase">calificación</td>
				<td width="20%" class="text-center uppercase">resolución</td>
			</tr>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="3" class="text-center uppercase">promedios por asignaturas del quimestre</td>
			</tr>
			<tr class="bgDark">
				<td width="40%" class="text-center uppercase">asignatura</td>
				<td width="40%" class="text-center uppercase">docente</td>
				<td width="20%" class="text-center uppercase">nota / parcial</td>
			</tr>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="3" class="text-center uppercase">promedios por asignaturas del quimestre</td>
			</tr>
			<tr class="bgDark">
				<td width="40%" class="text-center uppercase">asignatura</td>
				<td width="40%" class="text-center uppercase">docente</td>
				<td width="20%" class="text-center uppercase">nota / parcial</td>
			</tr>
			<tr>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		</table>
		<h3>aqui va el grafico</h3>
		<table class="table">
			<tr height="140" class="bgDark"> 	
				<td width="5" >No.</td>
				<td class="text-center up">Apellidos y nombres</td>
				<td class="text-center no-border" width="20">
					<p class="s-calificaciones__materia ">
						<span class="up actaDeCalificacionesRecuperacion__3">nombre de la materia</span>
					</p>
				</td>
			</tr>
			<tr>
				<td class="text-center">1</td>
				<td class="up">nombre del estudiante</td>
				<td class="text-center">x</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="5" class="text-center up">informe del dece</td>
			</tr>
			<tr class="bgDark">
				<td colspan="5" class="text-center up">informe de inspección / fj = falta justificadas FI = faltas</td>
			</tr>
			<tr class="bgDark">
				<td class="text-center up">estudiante</td>
				<td class="text-center up">calificación</td>
				<td class="text-center up">F.J.</td>
				<td class="text-center up">F.I.</td>
				<td class="text-center up">resolución</td>
			</tr>
			<tr>
				<td class="up">nombre del estudiante</td>
				<td class="text-center">0.00</td>
				<td class="text-center"> </td>
				<td class="text-center"> </td>
				<td>0.00</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td colspan="6" class="text-center up">informe de inspección quimestral del registro anecdótico (número anotaciones)</td>
			</tr>
			<tr class="bgDark">
				<td class="text-center up">estudiante</td>
				<td class="text-center up">por atrasos</td>
				<td class="text-center up">por respeto</td>
				<td class="text-center up"> por honest.</td>
				<td class="text-center up">por respons.</td>
				<td class="text-center up">por uniforme</td>
			</tr>
			<tr>
				<td class="up">nombre del estudiante</td>
				<td class="text-center">0</td>
				<td class="text-center">0</td>
				<td class="text-center">0</td>
				<td class="text-center">0</td>
				<td class="text-center">0</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td class="up">estímulo deportivo</td>
			</tr>
			<tr>
				<td>---</td>
			</tr>
			<tr class="bgDark">
				<td class="up">varios</td>
			</tr>
			<tr>
				<td>---</td>
			</tr>
			<tr>
				<td class="no-border"></td>
			</tr>
			<tr>
				<td>Siendo las_________se da por finalizada la junta de Grado/Curso. Para constancia firman: <br><br><br> </td>
			</tr>
		</table>
		<table class="table" style="width:50%; margin: 0 auto;">
			<tr class="bgDark">
				<td class="up">tutor año o curso</td>
				<td class="up">secretario (a)</td>
			</tr>
			<tr>
				<td class="up">msc. herrera moreia patricio danilo</td>
				<td class="up">espinoza molina fanny</td>
			</tr>
			<tr>
				<td>Firma:</td>
				<td>Firma:</td>
			</tr>
		</table>
	</main>
</body>