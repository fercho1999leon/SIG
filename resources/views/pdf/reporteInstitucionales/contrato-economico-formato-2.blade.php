@extends('layouts.master-reportes')
@section('content')
@section('style')
	<style>
		.table td,
		.table th {
			font-size: 9pt !important;
		}
	</style>
@endsection
<table class="table">
	<tr>
		<td class="no-border text-center bold" style="font-size: 12pt">CONVENIO DE PRESTACIÓN DE SERVICIOS EDUCATIVOS</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			Conste por el presente documento, el Convenio de Prestación de Servicios Educativos el mismo que se celebra al tenor de las siguientes cláusulas: <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">PRIMERA: Intervinientes:</span> Participan en forma libre y voluntaria en la celebración del presente convenio, por una parte {{$student->.R.->sexo === 'Masculino' ? 'el Señor' : 'la Señora'}} {{strToUpper($student->.R.->apellidos)}} {{strToUpper($student->.R.->nombres)}}, a nombre y en representación {{$student->sexo === 'Masculino' ? 'del' : 'de la'}} menor: {{$student->nombres}}  {{$student->apellidos}} y, por otra parte, <span class="bold">la {{$institution->nombre}}</span>, por los derechos que representa en calidad de <span class="bold">GERENTE GENERAL</span> de la Compañía <span class="bold">{{$institution->razon_social}}</span>, quien es la Promotora de la {{ ucwords(strtolower($institution->nombre)) }}, a quienes en lo posterior y para efectos del presente instrumento se los podrá denominar como "el (la) .R.", "el (la) estudiante" y la “Unidad Educativa", “la promotora” o "la Institución”, respectivamente. <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">SEGUNDA: GLOSARIO DE TÉRMINOS:</span> Para efectos del presente contrato entiéndase los siguientes términos de la siguiente forma: <br>
            <span class="bold uppercase">CÓDIGO DE CONVIVENCIA. –</span> De conformidad con lo establecido por el art. 89 del Reglamento General a la Ley Orgánica de Educación Intercultural, el Código de Convivencia de la {{ ucwords(strtolower($institution->nombre)) }} es un documento público de cumplimiento obligatorio que comprende los principios fundacionales, objetivos, métodos, acuerdos, compromisos, faltas, procedimientos regulatorios, acciones educativas disciplinarias, entre otros a fin de garantizar la convivencia pacífica de los miembros de la comunidad educativa. <br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CONTRAPRESTACIÓN DEL SERVICIO EDUCATIVO:</span> Se entiende como servicio educativo, la oferta que efectúa la institución en la formación y educación, bajo el sistema escolarizado de los niños y jóvenes de conformidad a su PEI, y comprende las actividades y servicios de clases en todo su sistema de educación, controles y seguridad interna, materiales de uso común como laboratorios de computación, física,  química y biología, enfermería y primeros auxilios para emergencias médicas, implementos deportivos, canchas, biblioteca, tutorías, asesoría estudiantil, servicio pedagógico, psicopedagógico y toda actividad propia del sistema educativo programado en el PEI. La contraprestación del servicio educativo que brinda la institución, al (la) estudiante, constituye el costo de operación que, el (la) .R. se obliga a pagar de manera prorrateada y corresponde a los valores fijados por concepto de matrícula y pensiones, por cada año lectivo. <br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">LA MATRÍCULA:</span> De conformidad a la normativa legal vigente, la matricula corresponde al 75% del valor de la pensión neta fijada por las Autoridades Educativas. En este sentido, este valor deberá ser cancelado en las fechas notificadas al .R. del estudiante, la cual no excederá del mes de abril del 2021. Se exceptúan aquellos padres de familia que bajo su responsabilidad y petición expresa soliciten el pago adelantado de este valor. <br>
            El suscriptor del presente contrato, acepta que una vez suscrito el presente documento no podrá solicitar reembolso por el pago de la matrícula. <br>
            La forma y canal de pago de la matrícula será notificada al .R. legal por parte del establecimiento educativo, siendo este aceptado por el padre o madre de familia.<br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">LA PENSIÓN:</span> Se conoce como “pensión”, al valor fijado por la Autoridad Educativa competente, para el pago por el servicio educativo por el año lectivo, prorrateado en diez (10) cuotas de pago mensuales y que equivale al costo por estudiante, para cubrir los gastos e inversiones que genera la prestación del servicio que brinda la Institución, la misma que debe ser pagado por el (los) .R. (s) del (los) estudiantes, como contraprestación del servicio que reciben. <br>
            Los pagos de las pensiones se realizarán en 10 cuotas mensuales que iniciarán desde {{ App\Fechas::obtenerMes( date('m',strtotime($periodo->fecha_inicial)) ) }} del {{ date('Y',strtotime($periodo->fecha_inicial)) }} hasta {{ App\Fechas::obtenerMes( date('m',strtotime($periodo->fecha_final)) ) }} del {{ date('Y',strtotime($periodo->fecha_final)) }}. Los meses antes señalados podrán estar sujetos a cambio en razón de lo que disponga el Ministerio de Educación en el Cronograma Escolar {{ $periodoLectivo }}. <br>
            El pago de los valores por concepto de pensiones y matrículas, será efectuado mediante depósito o transferencia bancaria a la cuenta corriente No. 07337272 del Banco del Pacifico, o mediante tarjeta de débito o de crédito, o cancelando en efectivo en las ventanillas de colecturía del plantel, emitiéndose como constancia el comprobante respectivo, el mismo que constituye la única evidencia del cumplimiento. <br>
            La forma y canal de pago de la matrícula será notificada al .R. legal por parte del establecimiento educativo, siendo este aceptado por el padre o madre de familia. <br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">SERVICIO INCLUSIVO:</span> El servicio educativo de la Institución es inclusivo para niños y jóvenes con dificultad en el aprendizaje que se encuentren consideradas como leves y dentro del primer grado de dificultad, siempre que no sean combinadas. <br>
            La Unidad Educativa NO es un centro de educación especial, por lo que, si el estudiante necesita más apoyo para mejorar o superar su conducta o aprendizaje, deberá buscar un centro de educación especial que puedan brindarle el tratamiento y educación adecuada. <br>
			No obstante, aquello, a criterio de la Institución, se podrá autorizar que ingresen y laboren, profesionales o personas especializadas en esas áreas para brindarles atención complementaria con servicio fijo o itinerante, en los casos de complejidad intermedia o mediana, para efectuar acompañamiento y apoyo personalizado al estudiante, a costa y bajo responsabilidad del .R. y la Institución no adquiere ninguna obligación o compromiso con dicho personal de apoyo. <br>
            Para poder aplicar o sujetarse al programa de inclusión, es necesario que así se determine en el respectivo convenio y contar con evaluaciones externas iniciales y periódicas, para verificar el avance del programa y su conveniencia para la formación, aprendizaje y continuidad del estudiante en el programa inclusivo. De no existir las evaluaciones y compromiso del .R. se aplicará el programa escolarizado general o regular. <br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			
            Si luego de haberse matriculado el menor, se estableciere que necesita apoyo especial del programa de inclusión, su .R. deberá cumplir con el programa de inclusión de la Institución, sus condiciones y requisitos. La no aceptación o implementación del programa de inclusión, deslinda de toda responsabilidad a la institución, por el poco o deficiente avance educativo en el proceso formativo escolarizado y será causal de no renovación del contrato de prestación de servicios educativos para el siguiente periodo lectivo. <br>
            En caso de necesitar ayuda externa, esta será pagada por el padre de familia sin condicionamiento de ningún tipo.
            <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">TERCERA: ANTECEDENTES: UNO:</span> "La {{ ucwords(strtolower($institution->nombre)) }}, es una Unidad Educativa auto financiada, de carácter particular, legalmente reconocida y autorizada por las autoridades de educación, cuya Promotora es la Compañía <span class="bold">{{$institution->razon_social}}</span> que brinda servicios educativos en la forma y modo señalado en la Constitución y Leyes de la República del Ecuador, recibiendo como contraprestación del servicio educativo el monto económico fijado en legal forma por concepto de pensiones y matrícula, el cual constituye, su única fuente de ingreso para brindar educación de calidad. <br>
            <span class="bold uppercase">DOS:</span> El (la) .R., conocedor y aceptando sin condición de ningún tipo, la misión, visión, filosofía, principios, Proyecto Educativo Institucional - PEI, Código de Convivencia, metodología de aprendizaje y demás reglamentación y normatividad interna de la Unidad Educativa y luego de una serie de análisis y comparaciones de su oferta educativa con la de otras instituciones, ha solicitado matrícula en la Institución para su representado el (la) estudiante (referidos en la cláusula primera), para el periodo lectivo {{ $periodoLectivo }} en el {{ $curso }}, para lo cual ha presentado la solicitud de matrícula que está como anexo al presente instrumento contractual, el cual, no genera derecho alguno, sino que constituye una mera expectativa.
            <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CUARTA: OBJETO DEL CONVENIO:</span> El presente convenio tiene como objeto regular las relaciones contractuales entre las partes, una vez que ha sido aceptada la matriculación y se hubiere pagado el valor de la misma y que en definitiva está relacionado al proceso de enseñanza aprendizaje y al pago que como contraprestación a este servicio realizan los padres de familia.
            <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">QUINTA: VALOR DE PENSIONES Y MATRÍCULAS:</span> Para el presente periodo lectivo, el (la) .R. cancelará por concepto de matrícula el valor de $ {{ $matricula }} ( {{ NumerosEnLetras::convertir($matricula) }} Dólares de los Estados Unidos de América) y por pensiones el valor de ${{ $totalapagar }} ( {{ NumerosEnLetras::convertir($totalapagar) }} Dólares de los Estados Unidos de América) <br>
            En caso de incumplimiento del pago antes señalado, dentro del mes, el (la) .R. cancelará el máximo valor autorizado por la Junta Reguladora de Pensiones y Matrículas de la Educación Particular y Fiscomisional por matrículas y pensiones.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">SEXTA: COMPROMISOS Y OBLIGACIONES:</span> Las partes en razón de lo señalado en el presente instrumento se comprometen y obligan a lo siguiente: <br>
			<span class="bold">5.1. El .R.:</span><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> a.	Cumplir la Constitución de la República, la Ley y la reglamentación en materia educativa;</div>
			<div style="padding-left: 15px"> b.	Garantizar que sus representados asistan regularmente y correctamente uniformados al centro educativo en caso de asistir de manera presencial o ingresar a las clases de manera virtual, durante el periodo de educación obligatoria, de conformidad con la modalidad educativa;</div>
			<div style="padding-left: 15px"> c.	Apoyar y hacer seguimiento al aprendizaje de sus representados y atender los llamados y requerimientos de las y los profesores y autoridades de plantel;</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> d.	Cumplir los compromisos y obligaciones adquiridas con el DECE, profesores o autoridades del plantel educativo.</div>
			<div style="padding-left: 15px"> e.	Participar en la evaluación de las y los docentes y de la gestión de las instituciones educativas;</div>
			<div style="padding-left: 15px"> f.	Respetar leyes, reglamentos y normas de convivencia en su relación con las instituciones educativas;</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> g.	Propiciar un ambiente de aprendizaje adecuado en su hogar, organizando espacios dedicados a las obligaciones escolares y a la recreación y esparcimiento, en el marco del uso adecuado del tiempo;</div>
			<div style="padding-left: 15px"> h.	Participar en las actividades extracurriculares que complementen el desarrollo emocional, físico y psico - social de sus representados y representadas; </div>
			<div style="padding-left: 15px"> i.	Apoyar y motivar a sus representados y representadas, especialmente cuando existan dificultades en el proceso de aprendizaje, de manera constructiva y creativa;</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> j.	Participar con el cuidado, mantenimiento y mejoramiento de las instalaciones físicas de las instituciones educativas, sin que ello implique erogación económica;</div>
			<div style="padding-left: 15px"> k.	Contribuir y participar activamente en la aplicación permanente de los derechos y garantías constitucionales.</div>
			<div style="padding-left: 15px"> l.	Cumplir oportunamente con todas las obligaciones para con la institución.</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> m.	Pagar puntualmente los valores de pensiones y matrículas;</div>
			<div style="padding-left: 15px"> n.	Controlar que sus representados al salir de sus casas, hacia la institución se encuentren aseados y bien uniformados, con sus implementos de estudio, tareas o trabajos; al igual que enviar el lunch recomendado, para una correcta dieta alimenticia; por tanto, estos deben ser realizados al inicio de la jornada académica (clases) no durante las mismas;</div>
			<div style="padding-left: 15px"> o.	Controlar que sus representados no traigan a la institución educativa sustancias u objetos prohibidos o que no tengan relación con la actividad educativa;</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> p.	Aceptar la distribución de profesores, materias y horarios de conformidad a la oferta educativa de la institución, así como la asignación o cambio de paralelo que se le asigne por circunstancia formativas, académicas o disciplinarias, sin que exista derecho a reclamo alguna por dicha medida;</div>
			<div style="padding-left: 15px"> q.	Mantener actualizada la información relacionada a teléfono, dirección domiciliaria, correo electrónico y demás datos personales;</div>
			<div style="padding-left: 15px"> r.	A revisar el correo electrónico y el aula virtual por ser la vía acordada para mantener una comunicación fluida con el .R. del estudiante, dándole a conocer sobre el accionar diario, hoja de vida, tareas, citaciones, noticias, comunicaciones y demás asuntos relacionados con el accionar educativo, a la vez, los .R. podrán comunicarse con los directivos y profesores, simplificando la interrelación entre la Unidad Educativa y el .R., por lo cual se comprometen a revisarlos día a día, en forma periódica;</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> s.	Presentar dentro de los plazos señalados para el efecto, la solicitud de matrícula para al siguiente periodo lectivo;</div>
			<div style="padding-left: 15px"> t.	Hacer seguimiento y responder a los llamados que envía el establecimiento educativo, por intermedio del internet o el aula virtual;</div>
			<div style="padding-left: 15px"> u.	Acatar estrictamente, lo dispuesto en el literal t) artículo 2 de la Ley Orgánica de Educación Intercultural, que determina la convivencia pacífica y respetuosa en el trato de las relaciones internas de la comunidad educativa, y su inobservancia así como la mora en las obligaciones de contraprestación de servicios causará la perdida de los beneficios otorgados voluntariamente por la institución, como becas y descuentos en pensiones, así como, se convierte en causal para la no concesión de matrícula para el próximo año lectivo.</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px"> v.	A no grabar mediante medios electrónicos las conversaciones mantenidas con profesores, personal administrativo o directivo.</div>
			<div style="padding-left: 15px"> w.	A suscribir sin condición alguna las actas de reuniones mantenidas en el establecimiento educativo, sin protesto de ningún tipo.</div>
			<div style="padding-left: 15px"> x.	Cumplir con lo dispuesto en el presente convenio.</div>
			El incumplimiento de uno de los literales, constantes en el presente numeral, será causal suficiente para la no renovación de la matrícula para el siguiente periodo lectivo. 
		</td>
	</tr>																					
			
			<br><br>		
	<tr> 
		<td class="no-border" style="text-align:justify">
            <span class="bold uppercase">SEPTIMA: DURACIÓN:</span> El presente convenio tiene una duración de un año lectivo, el cual, podrá ser renovado siempre que exista la voluntad manifiesta por escrito de las partes, dentro de los plazos que para el efecto indique la Unidad Educativa y que se hayan cumplido de forma puntual las obligaciones económicas, así como, los términos del presente instrumento. <br>
            Por lo que, se deja expresa constancia que ambas partes podrán solicitar, de forma independiente, hasta con 30 días previos a la finalización del periodo lectivo la decisión de no renovación del presente instrumento. <br>
            El no actualizar datos e inscribir a su representado para el próximo período lectivo en las fechas que la Institución determine, así como el no pago de la (s) cuota (s) de pensión (es) educativa (s) o el incumplimiento de alguna obligación con la institución, constituye desistimiento tácito de la renovación del contrato, en cuyo caso, la institución asignará el cupo del (los) representado (s) a otro (s) estudiante (s) que lo (s) requiera (n).
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">OCTAVA: DE LA TERMINACIÓN DEL CONVENIO:</span> El presente convenio concluirá por las siguientes causas: <br>
			1) Por el vencimiento del plazo, caso en el cual, culminará de pleno derecho. <br>
			2) Por voluntad o acuerdo de ambas partes. <br>
			3) Por fallecimiento del (la) estudiante. <br>
			4) <span class="bold">Por fallecimiento del .R. del estudiante</span>, a menos que otra persona con derecho suficiente asuma la representación del educando. En lo relativo al pago de pensiones, se estará a lo establecido en la Ley Orgánica de Educación Intercultural. <br>
			5) Por suspensión de actividades de la unidad educativa por más de sesenta días o por cierre definitivo. <br>
			6) Por voluntad del .R.. Si una vez matriculado el alumno, sus progenitores o .R. deciden retirarlo de la institución, deberán comunicar de inmediato a los directivos del centro educativo. No se podrá solicitar el reembolso de la matrícula ni de las pensiones que hayan sido devengadas. El .R. se compromete a cancelar los valores correspondientes a los servicios educativos y adicionales voluntarios recibidos a favor del estudiante que representa, hasta el último período mensual de asistencia al plantel.  7) Por incumplimiento de cualquiera de las cláusulas que se establecen en este convenio, Código de Convivencia, o por incumplimiento de disposiciones emanadas de las autoridades de la institución y que correspondan al desarrollo de los programas educativos.<br>
			8) Por cambio o designación del .R. legal del menor, sin que haya sido aceptado por la institución educativa. <br>
			9) Por voluntad de una de las partes, manifiesta dentro del término legal. <br>
			10) Por las demás causas previstas en el ordenamiento jurídico del país, Código de Convivencia y Reglamentos de la institución. <br>
			11) Por suspensión definitiva del estudiante, en caso de cometer faltas muy graves.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">NOVENA: DE LA MORA DEL .R. LEGAL DEL ESTUDIANTE:</span> En caso de mora del padre de familia o .R. del menor, esto es, el incumplimiento del pago de lo señalado en la Cláusula Quinta del presente contrato, el Promotor, podrá interponer las acciones contempladas en el Código Orgánico General de Procesos, por lo que “el (la) .R.”, se obliga para con la Promotora desde el momento de la interposición de la demanda o de la notificación de la deuda por parte de los abogados externos al pago de los rubros vencidos, así como de los costos procesales y honorarios del profesional contratado que serán del 10% del monto total adeudado. <br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			En caso de falta de pago o atrasos permanentes en los pagos, la Unidad Educativa Particular Americus Mundus Novus por medio de su Promotora se reserva el derecho de revisar la matrícula para el siguiente año lectivo, e informar a la autoridad competente de su incumplimiento para que el mismo asigne un colegio fiscal, y de esta manera garantizar el derecho a la educación de los estudiantes. <br>
			Así mismo, en caso de atrasos permanentes o de estar en mora a la finalización del periodo lectivo, la Unidad Educativa Particular Americus Mundus Novus por medio de su Promotora, no renovará la matrícula a él (la) .R., sin que este tenga derecho a interponer reclamo de cualquier tipo ante las autoridades administrativas o judiciales. <br>
			Por otra parte, el padre de familia en caso de querer retirar a su representando una vez finalizado el periodo lectivo, se obliga, en caso de estar en mora, a realizar un convenio de pago, para posteriormente recibir los documentos académicos de su representado. 
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DECIMA: DEL SEGURO DE ACCIDENTES PERSONALES: </span> De conformidad a la normativa expedida por el Ministerio de Educación, en el Acuerdo Ministerial MINEDUC-ME-2017-00006-A, se pone a consideración de los padres de familia un seguro de accidentes personales, en aras de cubrir posibles lesiones que pueda tener el estudiante dentro de la institución educativa. En caso de que el padre o .R. no acepte dicho seguro en forma expresa, deslinda de responsabilidad a la Unidad Educativa y su Promotor, en relación al posible accidente y sus consecuencias. <br>
			Al momento de suscribir este contrato, el .R. manifiesta que ha recibido la información sobre el seguro de accidentes, como proceder para activar el uso de la póliza, de los montos a cubrir por concepto de deducibles y los valores máximos de indemnización o gastos médicos que cubre el seguro, comprometiéndose el .R., a cubrir el saldo que faltare por pagar por costos médicos, medicinas o internamiento en casas de salud donde hubiera sido llevado el accidentado. <br>
			En caso de un accidente dentro de la Unidad Educativa, es de responsabilidad de la Institución prestarle los primeros auxilios al estudiante, a llamar al ECU 911 para que brinde la asistencia que fuere del caso y llamar al (los) .R. (s) para que concurra (n) al establecimiento para que traslade al (los) estudiante (s) a alguna casa de salud, en caso necesario, deslindando de esta forma a la institución educativa y a su Promotores de cualquier responsabilidad, relacionado al accidente. <br>
			En caso que “el (la) .R.” tenga un seguro de accidentes personales propio ya sea nacional o internacional, deberá notificar de dicho particular a “la institución” al momento de la matrícula y por escrito con todos los datos para poder solicitar la ayuda en los casos que sean necesarios. 
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DÉCIMA PRIMERA: DE LOS SERVICIOS COMPLEMENTARIOS: </span> Existen otros valores que se cobran en forma periódica o esporádica y que han sido solicitados y aceptados en forma expresa y voluntaria por el (la) .R. legal del (la) estudiante, que corresponden a servicios no educativos o complementarios, que son prestados por la institución o facilitados para que los preste otras personas naturales o jurídicas dentro de la Institución, como son, entre otros, plataforma virtual, transporte escolar, seguro de accidentes o de apoyo profesional para educación especial, los que no constituyen elemento propio de la prestación del servicio de educación y no están comprendidos o cubiertos dentro del concepto de pensión y matrícula, por lo que tienen que ser pagados en forma directa por los padres o .R. legales de los estudiantes. Tampoco están cubiertos o considerados dentro de los valores de matrículas y pensiones, los libros, cuadernos, y demás útiles escolares, o implementos o materiales de trabajo de aprendizaje, uniformes, disfraces de presentación para eventos u obras de arte, o equipos para eventos deportivos,  sistemas externos de apoyo educativo tecnológico, computadoras personales, IPad o Tabletas, materiales o implementos para la ejecución de proyectos educativos o alquiler de locales o escenarios para incorporaciones, ceremonias o baile de graduados; los cuales deberán ser pagados en forma directa y sin protesto por el .R. legal del estudiante al proveedor del bien o servicio, o por intermedio de la Institución, si es que se brinda esa facilidad en beneficio del .R.. <br>
			Reconozco que la Unidad Educativa, posee un permiso de funcionamiento que le permite ofertar una educación escolarizada con modalidad presencial, por ende, el uso de plataformas digitales, conectividad y las herramientas tecnológicas en línea corresponden a un servicio no educativo que debe ser cubierto de manera directa por el padre de familia al ser complementario, al no estar incluida en el monto de la pensión educativa. En la eventualidad que por cualquier circunstancia de caso fortuito o  fuerza mayor, en los casos de emergencia sanitaria o, por disposición del COE Nacional, Ministerio de Educación o del COE Cantonal,  se suspenda la asistencia presencial a clases y deba utilizarse este tipo de servicio no educativo para dar clases en línea autorizo de manera expresa que se contrate los servicios de un proveedor externo para que proporcione el servicio no educativo de apoyo tecnológico para recibir clases en línea de manera digital, mientras dure la suspensión. <br>
			El proveedor externo entregará la clave y demás herramientas para que mi representado pueda hacer uso de la plataforma digital, la misma que podrá ser utilizada mientras se cumpla con la obligación de pagar puntualmente las pensiones, toda vez que, al dejar de hacerlo, el proveedor externo podrá suspender el servicio, así la institución educativa continúe produciendo su material pedagógico. 
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DECIMA SEGUNDA: SOBRE LAS EXCURSIONES, GIRAS DE OBSERVACION y SALIDAS DE LA INSTITUCIÓN:</span> De conformidad a la normativa vigente las instituciones educativas pueden realizar excursiones y giras de observación. En este sentido los .R. legales se comprometen a dar respuesta a las solicitudes de permiso, así como a cubrir los valores que por concepto de estas actividades se generen, siempre que los mismos, no contravengan la normativa de igual o mayor jerarquía expedida por la Autoridad Educativa Nacional. <br>
			Lo señalado anteriormente, también será aplicado para aquellas salidas de la institución que se encuentren establecidas en el cronograma escolar notificado por el establecimiento educativo al .R. del estudiante. 
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DECIMA TERCERA: SOBRE LAS BECAS Y DESCUENTOS:</span> La PROMOTORA, podrá conceder becas o descuentos a los estudiantes, cuando se hayan destacado en actividades académicas o estudiantiles, por razones económicas o por aquellas que considere la Dirección General o Rectorado del Establecimiento Educativo. <br>
			Dicho lo anterior el padre de familia o .R. legal se obliga para con la institución educativa en el caso que ostente su representado una beca o descuento, a mantener durante el periodo lectivo un promedio de muy bueno, una conducta mínima de A y a estar al día en sus obligaciones económicas. <br>
			En caso que el .R. que tenga descuento, incumpla lo señalado en el párrafo precedente y no cancele durante el mes en curso, perderá ese beneficio. Si su accionar es repetitivo por dos ocasiones consecutivas o no, se procederá con el retiro definitivo de este descuento. <br>
			En caso que el .R. que tenga una beca, incumpla lo señalado en el párrafo segundo de la presente cláusula y se retrase en más de 60 días en el pago de la pensión, la institución podrá retirar de forma definitiva la beca.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DECIMA CUARTA: AUTORIZACIÓN DE USO DE IMÁGENES.-</span> EL/LOS .R./S LEGALES autoriza/n  expresamente a la {{ ucwords(strtolower($institution->nombre)) }} para que las fotos tomadas a los estudiantes, en cualquiera de sus formatos digitales o físicos, u otras imágenes tomadas por medios mecánicos o electrónicos, sean utilizados en sus publicaciones, material informativo, publicidades, página web, videos, cortometrajes, periódico escolar o cualquier otro medio de comunicación o publicitario para uso exclusivo a los fines educativos y promocionales de la Unidad Educativa. <br>
			Así mismo, el .R. acepta que en el interior de las aulas de clases y en espacios comunes de confluencia estudiantil, se graben las actividades de sus hijos, para con esto poder precautelar la disciplina de los mismos, así como, la calidad de proceso de aprendizaje dentro del aula de clases.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DECIMA QUINTA: USO DE REDES SOCIALES. -</span> El/Los .R. Legales, se obligan por medio del presente documento a no usar en sus redes sociales logos o marcas de la institución educativa, así como, a no mencionar su nombre con fines de desacreditación. <br>
			El incumplimiento de la presente Cláusula será causal suficiente para la no renovación del presente instrumento contractual.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DÉCIMA SEXTA: TÍTULO EJECUTIVO: </span> Para todos los efectos, y por contener obligaciones claras, expresas y por ser determinable su exigibilidad, las partes acuerdan que el presente contrato presta mérito ejecutivo ante juez competente y constituye título ejecutivo.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">DÉCIMA SÉPTIMA: TRÁMITE Y COMPETENCIA: CLÁUSULA COMPROMISORIA: </span> Cualquiera cuestión o controversia originadas en este convenio o relacionadas con él, serán resueltas por arbitraje en la Cámara de Arbitraje y Mediación de la Universidad de Especialidades Espíritu Santo de acuerdo con las reglas de la Ley de Arbitraje y Mediación y del Reglamento de dicho Centro. Las partes convienen además en lo siguiente: <br>
			a.- Los árbitros serán seleccionados conforme lo establecido en la Ley de Arbitraje y Mediación. <br>
			b.- Las partes renuncian a la jurisdicción ordinaria, se obligan a acatar el laudo que expida el Tribunal Arbitral y se compromete a no interponer ningún recurso en contra del mismo. <br>
			c.- Para la ejecución de medidas cautelares el Tribunal Arbitral está facultado para solicitar de los funcionarios públicos, judiciales, policiales y administrativos su cumplimiento, sin que sea necesario recurrir a juez ordinario alguno. <br>
			d.- El Tribunal Arbitral está integrado por un árbitro. <br>
			e.- El arbitraje será en derecho. <br>
			f.- El procedimiento arbitral será confidencial. <br>
			g.- El lugar de arbitraje será las instalaciones de la Cámara de Arbitraje y Mediación de la Universidad de Especialidades Espíritu Santo". <br>
			En relación a la mora de “el (la) .R.)” será resuelta, en caso de así decidirlo el Promotor, por uno de los Jueces de las Unidades Judiciales del Consejo de la Judicatura, de conformidad a lo determinado en el Código Orgánico General de Procesos. <br>
			Para constancia de lo acordado, las partes suscriben el presente convenio en el cantón {{ $institution->ciudad }}, el día {{App\Fechas::fechaActual()}}.
			<br><br>
		</td>
	</tr>
</table>
<table class="table">
	<tr>
		<td class="no-border" width="5%"></td>
		<td class="no-border text-left">
			____________________________________________<br><br>
			Nombre del .R.: {{ ucwords(strtolower($student->.R.->nombres)) }} {{ ucwords(strtolower($student->.R.->apellidos)) }} <br>
			Dirección Dom: {{ $student->.R.->dDomicilio }}<br>
			Correo Electrónico para notificaciones: {{ $student->.R.->correo }}<br>
			Teléfono Móvil: {{ $student->.R.->movil }}<br>
			Teléfono Convencional: {{ $student->.R.->tDomicilio }}<br>
		</td>
		<td class="no-border" width="10%"></td>
		<td class="no-border text-center">
			___________________________________________________<br><br><span class="bold">.R. Legal </span><br><br><br><br>
		</td>
		<td class="no-border" width="5%"></td>
	</tr>
</table>
@endsection