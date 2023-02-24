<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Archivo 1</title>
</head>
<style>

</style>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top" class="no-border" width="20%">
				<div class="header__logo" style="float: left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3 class="m-0 h1 uppercase"> nombre de la institucion </h3>
					<h4 class="m-0 bold uppercase">año lectivo: --</h4>
					<h4 class="m-0 bold uppercase">archivo 2</h4>
				</div>
			</th>
			<th class="no-border" width="20%">
				<div style="text-align:right">
					<img src="{{secure_asset("img/logo-ministerio2.png")}}" width="150">
				</div>
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="13" class="text-center uppercase bold">ficha de observación de clase</td>
			<td width="5%" class="text-center bold">No.</td>
		</tr>
		<tr>
			<td colspan="14" class="text-center uppercase bold">datos informativos</td>
		</tr>
		<tr class="text-center">
			<td rowspan="2" width="15%">nombre de la institución</td>
			<td colspan="2" rowspan="2">----</td>
			<td rowspan="2">ubicación</td>
			<td>zona</td>
			<td>distrito</td>
			<td>circuito</td>
			<td rowspan="2" colspan="2">dirección institución</td>
			<td rowspan="2" colspan="2">---</td>
			<td width="15%" rowspan="2">jornada:</td>
			<td rowspan="2" colspan="2">----</td>
		</tr>
		<tr>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td rowspan="2">nombre del docente</td>
			<td rowspan="2" colspan="6"></td>
			<td rowspan="2" colspan="2">contenido:</td>
			<td>área</td>
			<td colspan="">asignatura</td>
			<td rowspan="2">fecha:</td>
			<td rowspan="2" colspan="2">--</td>
		</tr>
		<tr>
			<td>--</td>
			<td>--</td>
		</tr>
		<tr>
			<td>grado o curso:</td>
			<td colspan="2">hola mundo</td>
			<td>paralelo</td>
			<td colspan="3">--</td>
			<td colspan="2">subnivel:</td>
			<td colspan="2"></td>
			<td>No. de estudiantes:</td>
			<td colspan="2">--</td>
		</tr>
		<tr>
			<td colspan="14"><span class="bold">OBJETIVO DE LA FICHA:</span> Recolectar información de los procesos enseñanzas y apredizajes durante el período de clase.</td>
		</tr>
		<tr>
			<td colspan="14"><span class="bold">INSTRUCCIONES:</span> Marque una x en el caso casillero que corresponda a su conformidad con alguno de los criterios enunciados.</td>
		</tr>
	</table>
	<table class="table">
		<tr class="text-center bold">
			<td>
				CRITERIOS GENERALES <br>
				Estos criterios se relacionan con los tres momentos de los procesos de enseñanza y aprendizaje(excepto el criterio No 1-2)
			</td>
			<td>Totalmente de acuerdo</td>
			<td>En desacuerdo(Argumente la respuesta)</td>
		</tr>
		<tr>
			<td>1. la clase se inicia con puntualidad de acuerdo al horario institucional.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>2. Entrega la planificación de la clase.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>3. Se realiza las instrucciones previas.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>4. El docente desarrolla su clase en un ambiente limpio y organizado.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>5. Las actividades desarrolladas en clase guardan relación con la planificación microcurricular.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>6. El objetivo se da a conocer durante el desarrollo de la clase.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>7. La relación entre los elementos del currículo (objetivos, destreza con criterio de desempeño, recursos didácticos, estrategias metodológicas e indicadores de evaluación) se evidencia durante el desarrollo de las actividades.</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>8. El tiempo es distribuido de modo que se cumplan los objetivos propuestos, mediante todas las actividades planificadas.</td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<table class="table uppercase">
		<tr>
			<td colspan="6" class="text-center bold">PROCESOS DE ENSEÑANZA Y APRENDIZAJE</td>
		</tr>
		<tr>
			<td colspan="6"><span class="bold">INSTRUCCIONES:</span> <span style="text-transform: lowercase">
				Marque una x en el casillero que corresponda a su conformidad con alguno de los
					criterios enunciados.
			</span></td>
		</tr>
		<tr class="text-center bold">
			<td>criterios</td>
			<td colspan="4">escala valorativa</td>
			<td rowspan="2">observación</td>
		</tr>
		<tr class="text-center bold">
			<td>momento inicial (anticipación)</td>
			<td>logrado 4</td>
			<td>en proceso 3</td>
			<td>en inicio 2</td>
			<td>no aplica 1</td>
		</tr>
		<tr>
			<td>1. relación motivación-objetivo de la clase</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>2. conocimientos previos o prerrequisitos</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="text-center bold">
			<td>momento de desarrollo (construcción del conocimiento)</td>
			<td>logrado</td>
			<td>en proceso</td>
			<td>en inicio</td>
			<td>no aplica</td>
			<td>observaciones</td>
		</tr>
		<tr>
			<td>3. estimulación del pensamiento crítico y creativo</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>4. ambiente interactivo y colaborativo</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>5. dominio del conocimiento disciplinar</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>6. interdisciplinariedad</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>7. recursos didácticos</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>8. conclusiones, definiciones y otras generalizaciones</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="text-center bold">
			<td>momento de consolidación y evaluación</td>
			<td>logrado</td>
			<td>en proceso</td>
			<td>en inicio</td>
			<td>no aplica</td>
			<td>observación</td>
		</tr>
		<tr>
			<td>9. retroalimentación del docente</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>10. evaluación formativa</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>11. evaluación sumativa</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="text-center bold">
			<td>clima de aula</td>
			<td>logrado</td>
			<td>en proceso</td>
			<td>en inicio</td>
			<td>no aplica</td>
			<td>observación</td>
		</tr>
		<tr>
			<td>12. promoción del respeto</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>13. manejo del comportamiento de los estudiantes</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>14. ambiente democrático</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>15. atención a estudiantes con necesidades educativasa especiales(nee)</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<table class="table bold uppercase">
		<tr>
			<td colspan="2" class="text-center">firmas</td>
		</tr>
		<tr class="text-center">
			<td>
				coordinadora de la sección
			</td>
			<td>Inspección</td>
		</tr>
		<tr>
			<td>firma</td>
			<td>firma</td>
		</tr>
		<tr>
			<td>firma</td>
			<td>firma</td>
		</tr>
	</table>
	<h3 class="m-0">
		OBSERVACIONES GENERALES
	</h3>
	<p style="line-height: 2" class="mb-2">
		. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 
	</p>
	<h3 class="m-0">
		RECOMENDACIONES
	</h3>
	<p style="line-height: 2" class="mb-2">
		. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 
	</p>
	<table class="table text-center bold uppercase">
		<tr>
			<td class="no-border" colspan="4">TABLA DE VALORES</td>
		</tr>
		<tr>
			<td>Logrado <br>4</td>
			<td>En proceso <br>3</td>
			<td>En inicio <br>2</td>
			<td>no aplica <br>1</td>
		</tr>
	</table>
	<table class="table text-center bold uppercase">
		<tr>
			<td>3.80 - 4.00</td>
			<td>AA</td>
			<td width="25%">suma total</td>
			<td></td>
		</tr>
		<tr>
			<td>2.50 - 3.79</td>
			<td>A</td>
			<td>categoría</td>
			<td></td>
		</tr>
		<tr>
			<td>1.00 - 2.49</td>
			<td>B</td>
			<td colspan="2" rowspan="2">nota: <span style="text-transform: lowercase">el valor total de los items se dividirá para el numero total de preguntas</span></td>
		</tr>
		<tr>
			<td>
				0.99 a menos
			</td>
			<td>c</td>
		</tr>
	</table>
</body>
</html>