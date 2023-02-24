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
.table th,
.table td {
	font-size: 12pt !important;
}
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
		<tr class="text-center bold">
			<td colspan="5" class="text-center uppercase">rúbrica para la ficha de observación de clase</td>
		</tr>
		<tr>
			<td colspan="5"><span class="bold">OBJETIVO:</span> Describir de desempeño del docente en el aula, durante su práctica pedagógica.</td>
		</tr>
		<tr>
			<td colspan="5"><span class="bold">INSTRUCCIONES:</span> Marque con una x la columna que corresponda al valor seleccionado para el criterio respectivo.</td>
		</tr>
		<tr class="text-center uppercase bold">
			<td rowspan="2">criterios</td>
			<td colspan="3">escala valorativa</td>
			<td width="15%" rowspan="2">no aplica a las clases observacion</td>
		</tr>
		<tr class="text-center bold uppercase">
			<td>logrado</td>
			<td>en proceso</td>
			<td>en inicio</td>
		</tr>
		<tr>
			<td colspan="5" class="text-center uppercase bold" class="text-center uppercase bold">momento inicial(anticipación)</td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">1. relación motivación objetivo de la clase</td>
			<td>La actividad de motivación se relaciona con el objetivo de la clase y despierta el interés de los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>La actividad de motivación se relaciona con el objetivo de la clase, pero no genera interés de los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>No hay actividad de motivación, o la que se aplica no está relacionada con el objetivo de la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">2. conomientos previos o prerequisitos</td>
			<td>Formula preguntas o aplica actividades que permiten explorar los conocimientos previos de los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>La preguntas que formula o actividades que aplica para explorar los conocimientos previos de los estudiantes, no logran este propósito.
				<div class="ol__cuadro"></div>
			</td>
			<td>No aplica preguntas ni actividades para explorar los conocimientos previos de los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5" class="text-center uppercase bold">momento de desarrollo(construcción del conocimiento)</td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">3. estimulación del pensamiento crítico y creativo</td>
			<td>Se estimula constantemente el pensamiento crítico y creativo a través de preguntas y otro tipo de actividades que generan indagación, problematización, reflexión del estudiante.
				<div class="ol__cuadro"></div>
			</td>
			<td>Ocasionalmente se efectúa actividades que estimulan el pensamiento crítico y creativo del estudiante.
				<div class="ol__cuadro"></div>
			</td>
			<td>No se efectúa  actividades que estimulan el pensamiento crítico y creativo del estudiante.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">4. Ambiente interactivo y colaborativo</td>
			<td>Se plantean actividades que permiten que los estudiantes construyan el conocimiento, mediante la interacción (estudiante-docente) y el trabajo colaborativo.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente promueve el trabajo colaborativo; sin embargo, construye el conocimiento mediante diálogo heurístico con los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente utiliza un método esencialmente explicativo ilustrativo, que no promueve la participación activa de los estudiantes en la construcción del conocimiento.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">5. dominio del conocimiento disciplinar</td>
			<td>El docente demuestra conocimiento y dominio del tema que se está estudiando. Aborda los contenidos y desarrolla las actividades a través de una estructura lógica, con fluidez y coherencia.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente demuestra conocimiento del tema que se está estudiando, aunque no dominio. Los contenidos y actividades que propone son pertinentes, pero se presentan de manera desorganizada.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente no demuestra conocimiento del tema que esta estudiando. Los contenidos y las actividades los desarrolla sin estructura lógica ni coherencia.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">6. interdisciplinariedad</td>
			<td>Las actividades permiten, al estudiante, evidenciar claramente la relación del nuevo conocimiento con su entorno u otras áreas del saber.
				<div class="ol__cuadro"></div>
			</td>
			<td>Las actividades desarrolladas son poco relevantes o no pernitentes, lo que no permite establecer clara relación del nuevo u otras áreas del saber.
				<div class="ol__cuadro"></div>
			</td>
			<td>En el desarrollo de la clase no se genera interrrelación del nuevo conocimiento, con su entorno u otras áreas del saber.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">7. recursos didácticos</td>
			<td>Los recursos didácticos, materiales y metodológicos empleados, facilitan el logro del objetivo de la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td>Los recursos didácticos, materiales y metodológicos empleados, permiten un logro parcial del objetivo de la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td>El empleo inadecuado de los recursos didácticos, o la falta de alguno de ellos, impide que se logre el objetivo de la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">8. conclusiones, definiciones y otras generalizaciones</td>
			<td>Las conclusiones, definiciones y otras generalizaciones son elaboradas en su totalidad por los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>Las conclusiones, definiciones y otras generalizaciones son elaboradas en un mínimo porcentaje por los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>Las conclusiones, definiciones y otras generalizaciones son elaboradas en totalidad por el docente.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5"  class="text-center uppercase bold">momento de consolidación y evaluación</td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">9. Retroalimentación del docente</td>
			<td>Las participaciones de los estudiantes son retroalimentadas y enriquecidas por el docente y sus pares, de manera total , oportuna y eficaz.
				<div class="ol__cuadro"></div>
			</td>
			<td>Las participaciones de los estudiantes son retroalimentadas y enriquecidas por el docente y sus pares, eventualmente, de manera parcial o no eficaz.
				<div class="ol__cuadro"></div>
			</td>
			<td>Las participaciones de los estudiantes no son retroalimentadas o enriquecidas por el docente ni sus pares.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">10. evaluación formativa</td>
			<td>Se evalúa sobre los procesos y resultados de las actividades que realizan a los estudiantes, mediante reflexiones producto de autoevaluaciones y coevaluaciones.
				<div class="ol__cuadro"></div>
			</td>
			<td>Se evalúa sobre los procesos y resultados de las actividades que realizan a los estudiantes, solo mediante las reflexiones propuestas por el docente.
				<div class="ol__cuadro"></div>
			</td>
			<td>No se evalúa, o se evalúa esporádicamente, los procesos y resultados de las actividades que realizan los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold" class="text-center uppercase bold">11. evaluación sumativa</td>
			<td>
				<div class="ol__cuadro"></div>
			</td>
			<td>Se evalúa sobre los procesos y resultados de las actividades que realizan a los estudiantes, solo mediante las reflexiones propuestas por el docente.
				<div class="ol__cuadro"></div>
			</td>
			<td>No se evalúa, o se evalúa esporádicamente, los procesos y resultados de las actividades que realizan los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="5" class="text-center uppercase bold">Clima de aula</td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">12. evaluación sumativa</td>
			<td> El lenguaje verbal y no verbal que emplea el docente, crea un ambiente de respeto y calidez.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente mantiene un ambiente de respeto, pero se nota un clima de tensión y desconfianza entre los estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente no genera serenidad, ni crea un ambiente de calidez y confianza.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">13. manejo del comportamiento de los estudiantes</td>
			<td>El docente monitorea en forma preventiva; hay mínimas interrupciones de clase y la respuesta del docente a esas actitudes, es adecuada.
				<div class="ol__cuadro"></div>
			</td>
			<td>La forma en que el docente maneja la disciplina de los estudiantes apropiada; sin embargo, ocasionalmente algunos estudiantes interrumpen la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente ignora el comportamiento de los estudiantes que interrumpen el normal desenvolvimiento de la clase.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">14. ambiente democrático</td>
			<td>El docente ofrece oportunidades, para que todos los estudiantes expresen sus propias ideas sin distinción y participen en igualdad de condiciones.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente ofrece oportunidades pero se promueve la participación solo de un grupo de estudiantes.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente ofrece escasas oportunidades de participación a los estudiantes, centrando el protagonismo en el docente y no en el estudiante.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td class="text-center uppercase bold">15. Atención a estudiantes con necesidades educativas especiales(NEE)</td>
			<td>El docente adapta las estrategias pedagógicas para atender a los estudiantes con NEE.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente adapta parcialmente las estrategias pedagógicas para atender a los estudiantes con NEE.
				<div class="ol__cuadro"></div>
			</td>
			<td>El docente no adapta las estrategias pedagógicas para atender a los estudiantes con NEE.
				<div class="ol__cuadro"></div>
			</td>
			<td></td>
		</tr>
		{{-- tr>td+(td>.ol__cuadro)*3+td --}}
	</table>
</body>
</html>