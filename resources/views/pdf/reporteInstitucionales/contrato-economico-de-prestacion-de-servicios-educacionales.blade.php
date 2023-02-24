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
		<td class="no-border bold" style="font-size: 12pt">Contrato Económico de Prestación de Servicios Educacionales AÑO LECTIVO {{$periodoLectivo}}</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			Conste por el presente documento, el Contrato Económico de prestación de servicios educacionales al que hace 
			referencia la Disposición General de conformidad al Acuerdo Ministerial No. 2017-00006-A, con fecha de enero del 2017, 
			suscrito por el señor Freddy Peñafiel Larrea, Ministro de Educación el mismo que se celebrará al tenor de las siguientes 
			cláusulas: <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">PRIMERA: Intervinientes:</span> Participan de forma libre y voluntaria en la celebración del presente contrato, por
			una parte {{$student->representante->sexo === 'Masculino' ? 'el Señor' : 'la Señora'}} {{strToUpper($student->representante->apellidos)}} {{strToUpper($student->representante->nombres)}} titular de cédula de identidad No. {{$student->representante->ci}} con dirección
			domiciliaria: {{strToUpper($student->representante->dDomicilio)}} del cantón {{$institution->ciudad}}, con número de
			teléfono convencional: {{$student->representante->tDomicilio}} teléfono celular: {{$student->representante->movil}} Correo electrónico: {{$student->representante->correo}} en
			calidad de representante legal. Quien en lo posterior podrá denominarse como
			él(la) REPRESENTANTE, quien comparece a nombre de él(la) estudiante: {{$student->nombres}}  {{$student->apellidos}} de  {{$curso}},
			por otra parte el Gerente General y/o la {{$institution->cargo5}} {{$institution->representante5}} como representante de la
			{{$institution->nombre}} quien en lo posterior podrá denominarse como
			UNIDAD EDUCATIVA o la INSTITUCIÓN EDUCATIVA. <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">SEGUNDA: Antecedentes:</span> La {{$institution->nombre}}, es una institución
			particular auto financiada, de Derecho Privado, legalmente reconocida por las autoridades de educación que
			brinda
			servicio educativo bajo las leyes de la República LOEI y la Constitución, la cual brinda educación integral
			de excelencia
			en los niveles de 
				@if($institution->ei!=null)
					{{$institution->ei}},
				@endif
				@if($institution->egb!=null)
					{{$institution->egb}}
				@endif
				@if($institution->bgu!=null)
					y {{$institution->bgu}}
				@endif
				   , recibiendo como contraprestación el monto económico fijado
			por la Junta
			Reguladora de Costos educativos establecido en el articulo 17 del Acuerdo Ministerial No MINEDUC-ME
			2015-00094-A por concepto de matrícula y pensiones, siendo estos rubros su única fuente de ingreso que nos
			permite
			brindar todos los servicios ofertados y una educación de calidad. <br>
			El (la) representante, consiente y conocedor de su responsabilidad de participar en el proceso educativo de
			su
			representado/a, ha escogido libremente el modelo educativo que ofrece NUESTRA INSTITUCIÓN. <br>
			EI REPRESENTANTE se ha informado adecuada y ampliamente de la filosofia, visión, misión, modelo Pedagógico
			que
			constan en el Código de Convivencia en el modelo educativo Institucional y en las Políticas internas
			vigentes en la
			Institución educativa e iniciado el proceso de matriculación a través de: la Inscripción, evaluaciones
			pedagógicas,
			entrevista psicológica, revisión y verificación de documentos, actualización de datos informativos
			personales, firma y
			entrega del presente contrato de servicios, firma de libro de matrícula y entrega de documentación requerida
			a la
			Secretaria del Plantel. <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">TERCERA: Objeto del contrato:</span> La {{$institution->nombre}}, en unidad de criterio {{$student->representante->sexo == 'Masculino' ? 'el Sr.' : 'la Sra.'}} {{strToUpper($student->representante->apellidos)}} {{strToUpper($student->representante->nombres)}}, se compromete a cumplir con las disposiciones del presente compromiso: la Institución educativa tiene como objetivo brindar todos los elementos necesarios para entregar una educación de calidad: por su parte el o la representante legal se compromete a realizar los pagos oportunos de cada mes durante los 10 meses determinados por la ley. Este acuerdo mutuo permitirá una conclusión de año escolar de paz y sana convivencia entre las partes.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">CUARTO: Contraprestación del servicio Educativo:</span> El Representante se obliga a pagar los
			valores fijados por concepto de Matricula y pensiones mensuales autorizado para el presente
			año lectivo {{$periodoLectivo}}. <span class="bold">La Matricula</span> se cancelará como pago único dentro del plazo establecido por el Ministerio de educación, durante el mes de {{$inicio}} dicho valor no superará el 75% del valor correspondiente a la pensión autorizada. <span class="bold">El valor de las pensiones,</span> se fijará un valor prorrateado en 10 mensualidades desde {{$inicio}} a {{$fin}} respectivamente, dicho valor noexcederá el autorizado por la autoridad educativa, el cual deberá ser cancelado durante los {{$dias}} primeros días de cada mes, mediante depósitos @if ($institution->ruc != '0926655945001') utilizando el código del estudiante, o en colecturía del plantel mediante pagos con tarjeta de crédito o débito @else , transferencias o colecturía en el plantel @endif. <span class="bold">El valor de Otros
			Rubros,</span> no están cubiertos o considerados dentro de los valores de matrícula pensiones. Los libros, útiles escolares, fotocopiados, uniformes, trajes o disfraces para eventos artísticos, culturales, deportivos o sociales, programas de estudios u otra actividad extracurricular que los padres de familia autoricen y participen de manera voluntaria, deberán ser cancelados
			directamente al proveedor del bien o servicio. Según las medidas de protección para con
			nuestros estudiantes dispuestos en el art 135 de la LOEI sería recomendable contratación de
			seguro de accidentes, dicho valor se cancelará al agente recaudador tal como lo determina el
			art. 21 del acuerdo ministerial 94A del 2015.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">QUINTA: Forma de pago, plazos, compromisos y obligaciones:</span> La Institución se obliga a dar educación de calidad y calidez, en la forma y modo constante y permanente en su Proyecto Educativo Institucional (PEI). Código de convivencia y demás reglamentos y normativas que rige la Institución, con sujeción a la Constitución de la República, Ley Orgánica de educación intercultural, Su reglamento y demás disposiciones válidas y legales de la Autoridad de educación Competente. EI REPRESENTANTE del estudiante se obliga a:<br>
			<div style="padding-left: 15px">1. Cancelar el valor correspondiente de matrícula oportunamente.</div>
            <div style="padding-left: 15px">2. Cancelar Ios valores por concepto de pensiones mediante deposito en efectivo o cheque en la entidad bancaria asignada, en colecturía del plantel se realizará cobros 
                @if ($institution->ruc != '0926655945001') mediante tarjeta de crédito o débito @else en efectivo @endif
                , los mismos que serán notificados a partir del primer día de cada mes y deberán realizar oportunamente dentro de los {{$dias}} primeros días de cada mes.</div>
			<div style="padding-left: 15px">3. Se legalizará la matrícula de los estudiantes una vez aprobada y entregada toda la documentación solicitada en secretaria del plantel y firma del representante legal en el libro de matrícula.</div>
			<div style="padding-left: 15px">4. Informar a Ia Institución Educativa, en el menor tiempo posible, cualquier situación que interfiera en el cumplimiento del presente contrato. El NO pago de Ia Matricula y/o Ia entrega del presente Contrato de prestación de Servicios educativos dentro de las fechas establecidas por nuestra Institución educativa, serán considerados como una manifestación voluntaria de NO continuar utilizando los servicios educativos y por tanto deja en libertad a nuestra Institución de disponer del cupo, en beneficio de otro estudiante.</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<div style="padding-left: 15px">5. La mora en el pago de un mes de pensión, pasados los {{$dias}} primeros días del mes se considera un atraso lo cual será notificado de forma verbal, vía agenda o telefónica, se notificará al representante legal por oficio escrito y citará a una entrevista con el abogado de Ia Institución para acordar compromisos de pago y/o acudir al Centro de Mediación Distrital o a la dependencia de la Función Judicial en la ciudad de {{$institution->ciudad}} para suscribir el correspondiente acuerdo de pago mediante acta de mediación, amparados en lo establecido en el artículo 190 de la Constitución de Ia Republica. artículos 44 y 47 de la Ley de Arbitraje y Mediación, el Reglamento del mencionado centro y Ias demás normas aplicables o a la Jurisdicción Civil.</div>
			<div style="padding-left: 15px">6. En caso de que el REPRESENTANTE incumpla el pago de los valores concernientes a los rubros estipulados en la Cláusula quinta de este contrato, deberá hacer uso de la asignación de cupo en otro establecimiento educativo que lo realice el Distrito educativo en donde esté ubicado su domicilio, para el lectivo {{$periodoLectivo}} en cumplimiento a lo dispuesto en el Memorando No MINEDUC-SASRE-2014-00908-M del 08 de diciembre del 2014, suscrito por el Subsecretario de Apoyo, Seguimiento Regulación de Ia Educación, sin perjuicio a acciones legales que se tomen por el cobro de las pensiones adeudadas. Se adjuntará copia notariada del presente Contrato de prestaci6n de Servicios como justificativo para el cumplimiento de lo acordado; y en beneficio del estudiante, para que no conculque su Derecho a la educación, siendo obligación del Estado proporcionar este servicio público en forma gratuita.</div>
			<div style="padding-left: 15px">7. El REPRESENTANTE. Sr/Sra. {{strToUpper($student->representante->apellidos)}} {{strToUpper($student->representante->nombres)}} debe y promete que pagará, a la orden y a favor de la Institución educativa, conforme con lo que determina la ley, la suma equivalente al valor total de 10 meses de pensiones prorrateadas, reconociendo esta obligación suscrita y aceptada en el presente contrato, exigible en juicio ejecutivo ante uno de los jueces de lo civil del Cantón y {{$institution->ciudad}}.</div>
			<div style="padding-left: 15px">8. El REPRESENTANTE en aras de garantizar la integridad de su representado y del grupo humano con el que se rodea consciente de manera libre y voluntaria, autoriza a que la {{$institution->nombre}}, cuando lo considere conveniente, realice revisiones de mochilas, termos, loncheras, a fin de asegurar que ningún líquido o sustancia extraña a las tareas educacionales ingrese a la Institución, dando cumplimiento a lo que dispone el Acuerdo Ministerial No. 208-13 de fecha 8 de julio del 2013, suscrito por el Ministerio de Educación.</div> 
			<div style="padding-left: 15px">9. EL REPRESENTANTE autoriza a la {{$institution->nombre}}, que por motivos de imagen institucional (no comercial), sean presentadas en las redes sociales, fotos, videos, entre otros, de sus representados, relacionados a las actividades escolares tales como eventos académicos, deportivos, culturales, cívicos, etc., que muestren los logros de los estudiantes dentro de la institución y en representación de ella.</div>
			<div style="padding-left: 15px">10. EL REPRESENTANTE en aras de garantizar el aprendizaje de su representado, es necesario que no permita que su representado/a traiga celulares a la institución, ya que no está considerado un recurso obligatorio como útiles escolares para el alumno, solamente previa autorización y planificación, se permitirá el uso del mismo; caso contrario el celular será retirado y entregado a inspectoría, dando cumplimiento a lo que dispone el Acuerdo Ministerial NO. 0070-14 de fecha 17 de abril del 2014, suscrito por el Ministerio de Educación.</div>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
            <span class="bold">SEXTA: Retiro del estudiante o Suspensión de servicios:</span> Si el REPRESENTANTE decide 
            @if ($institution->ruc != '0926655945001') y en forma escrita expresa el deseo de @endif
            retirar a su representado de la Institución Educativa, no podrá reclamar la devolución del valor de matrícula, ni los valores que cubra el costo de los servicios facturados hasta la fecha de la notificación escrita.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">SEPTIMA: Duración:</span> El presente contrato tiene duración de un año lectivo.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold">OCTAVA: Ratificación:</span> Las partes firman y ratifican el total contenido del presente contrato en forma libre y voluntaria y por así convenir a sus intereses económicos, para constancia de lo cual suscriben en la ciudad de {{$institution->ciudad}}, a la fecha del {{App\Fechas::fechaActual()}} obligándose a reconocer su firma y rúbrica ante el o Notario competente, de ser requeridos.
			<br><br><br><br><br><br>
		</td>
	</tr>
</table>
<table class="table">
	<tr>
		<td class="no-border" width="5%"></td>
		<td class="no-border text-center">
			Institución Educativa <br><br> ____________________________________________<br><br>
			CI:_______________________________________
		</td>
		<td class="no-border" width="10%"></td>
		<td class="no-border text-center">
			Representante del estudiante  <br><br> ___________________________________________________<br><br> {{$student->representante->nombres}} {{$student->representante->apellidos}} <br> CI:{{$student->representante->ci}}
		</td>
		<td class="no-border" width="5%"></td>
	</tr>
</table>
@endsection