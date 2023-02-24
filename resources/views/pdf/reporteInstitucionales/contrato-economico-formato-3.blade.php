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
		<td class="no-border text-center bold" style="font-size: 12pt">CONVENIO DE PRESTACIÓN DE SERVICIOS</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify"><br>
			<span class="bold uppercase">CLÁUSULA PRIMERA: COMPARECIENTES.-</span><br>
            Intervienen en el presente instrumento, por una parte, por sus propios y personales derechos, {{ $student->representante->nombres != null ? (($student->representante->sexo === 'Masculino' ? 'el señor ' : 'la señora ').strToUpper($student->representante->apellidos)." ".strToUpper($student->representante->nombres)) : "el/la señor/a ________________________________________________________" }} , con cédula  de ciudadanía
            /pasaporte Nº {{ $student->representante->ci != null ? $student->representante->ci : "_________________________" }} con domicilio en {{ $student->representante->dDomicilio != null ? $student->representante->dDomicilio : "______________________________" }} con los siguientes números telefónicos  convencional {{ $student->representante->tDomicilio != null ? $student->representante->tDomicilio : "________________________" }} Celular {{ $student->representante->movil != null ? $student->representante->movil : "_______________________" }} Correo electrónico {{ $student->representante->correo != null ? $student->representante->correo : "_________________________________________________" }}, en su calidad de representante legal del estudiante: <br>
            Nombres: {{ $student->nombres }} <br>
            Apellidos: {{ $student->apellidos }} <br>
            Curso: {{ $curso }} <br>
            Fecha de nacimiento: {{ $student->fechaNacimiento != null ? $student->fechaNacimiento : "___________________________" }} <br>
            Nacionalidad: {{ $student->nacionalidad != null ? ucwords(strtolower($student->nacionalidad)) : "_____________________________" }} <br>
            C.I/pasaporte: {{ $student->ci != null ? $student->ci : "_______________________" }} <br>
            Dirección domiciliaria: {{ $student->direccion_domicilio != null ? $student->direccion_domicilio : "_________________________________________" }} <br>
            Parte a la que, en adelante, para efectos legales del presente Contrato de Servicios, será denominado como el REPRESENTANTE; y, por otra parte, {{ $owner }} {{ ucwords(strtolower($institution->nombre)) }}, representada por {{ $representativeInstitution }}, en su calidad de Representante legal; parte que, en adelante y para efectos de este instrumento, será denominada como la {{ $institutionSiglas }}
            <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA SEGUNDA: ANTECEDENTES.-</span> <br>
            2.1 <span style="padding-left: 15px"></span>La {{ $institutionSiglas }} es una <span class="bold">{{ $institutionType }}</span> que brinda educación integral a niños y jóvenes. <br>
            2.2 <span style="padding-left: 15px"></span>La {{ $institutionSiglas }} está ubicada en la {{$institution->direccion}}, en la ciudad de {{$institution->ciudad}} . <br>
            2.3 <span style="padding-left: 15px">EL REPRESENTANTE LEGAL de {{ $student->student->sexo == 'Masculino' ? 'el ' : 'la ' }} estudiante ha sido ampliamente informado, y acepta que está  de acuerdo  al régimen educativo, cultural, religioso, disciplinario y pedagógico; que se desarrolla en la {{ strtoupper($institution->nombre) }}, al igual con los Reglamentos y Código de convivencia de la institución,  además  de la Resolución de Cobro de Matrículas, Pensiones y más condiciones económicas.</span> <br>
            2.4 <span style="padding-left: 15px"></span>El presente Contrato se lo realiza en concordancia a la Resolución de la Junta Distrital Reguladora de Pensiones y Matrículas Establecimientos Educativos Particulares y Fiscomisionales,  Nº. 0000050-09D05-RM <br>
            Para el presente año lectivo 2021 – 2022 los valores que regirán para este período son: <br><br>
            
            <table style="border: 1px solid black; border-collapse: collapse; margin: auto;" width="90%">
                <tr>
                    <th class="text-center" style="border: 1px solid black !important;">Grados o Cursos</th>
                    <th class="text-center" style="border: 1px solid black !important;">Matrícula</th>
                    <th class="text-center" style="border: 1px solid black !important;">Pensión</th>
                </tr>
                <tr>
                    <td class="text-center">Inicial 2</td>
                    <td class="text-center">$ 64.50</td>
                    <td class="text-center">$ 103.20</td>
                </tr>
                <tr>
                    <td class="text-center">1º a 10º de Básica</td>
                    <td class="text-center">$ 67.92</td>
                    <td class="text-center">$ 108.67</td>
                </tr>
                <tr>
                    <td class="text-center">1º a 3º Bachillerato</td>
                    <td class="text-center">$ 70.92</td>
                    <td class="text-center">$ 113.48</td>
                </tr>
            </table><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA TERCERA: OBJETO.- </span> <br>
            Con lo antes expuestos, las partes acuerdan que {{ $student->student->sexo == 'Masculino' ? 'el ' : 'la ' }} estudiante identificado en la cláusula primera de este contrato, reciba los servicios educativos en base al  programa curricular y el plan de estudios, correspondiente al {{ $curso == null ? "grado o curso_____________________" : $curso }} y en base al proyecto académico de la {{ $institutionSiglas }}, como la formación en valores de acuerdo a la Filosofía Institucional.
            <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA CUARTA: OBLIGACIONES DE LA {{ $institutionSiglas }}- </span> La U.E.P   SE OBLIGA CON EL REPRESENTANTE, A LO SIGUIENTE: <br>
			4.1 <span style="padding-left: 15px"></span>Educar al alumno de acuerdo con el régimen vigente en la U.E.P., en cumplimiento a lo dispuesto  por el Ministerio de Educación y leyes de la materia.<br>
            4.2 <span style="padding-left: 15px"></span>Mantener las Instalaciones adecuadas y dar a los estudiantes las herramientas necesarias  para su aprendizaje, al igual que un cuerpo docente  y administrativo adecuado para el desarrollo de las actividades escolares.<br>
            4.3 <span style="padding-left: 15px"></span>Realizar la correspondiente planificación de las actividades educativas, al igual que la orientación pedagógica y técnica concerniente a los servicios educativos: determinando el número de horas, calendarios, fechas de clases y pruebas para evaluar el progreso del estudiante; designando los profesores, las aulas y adoptando las medidas pertinentes que exigen las actividades escolares. <br>
            4.4 <span style="padding-left: 15px"></span>Adoptar las medidas  de seguridad posible dentro y fuera del plantel que permitan una permanencia tranquila y saludable de los estudiantes.  Se incluye la intervención policial en acciones de prevención y control de tenencia, consumo y expendio d estupefacientes, alcohol, etc.  En salvaguarda del derecho a la salud física, mental y sicológica de los niños y jóvenes, contemplado en el Código de la Niñez y Adolescencia.<br><br>                        
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA QUINTA: OBLIGACIONES DEL REPRESENTANTE.- </span> EL REPRESENTANTE LEGAL SE OBLIGA CON LA {{ $institution->nombre }}, A LO SIGUIENTE: <br>
			5.1 <span style="padding-left: 15px"></span>Pagar puntualmente dentro los diez primeros días hábiles de cada mes  el valor de pensiones de su representado.<br>
            5.2 <span style="padding-left: 15px"></span>Cumplir y hacer cumplir fielmente a su representado el Reglamento Interno y el Código de Convivencia de la {{ $institutionSiglas }} vigentes, al igual que la Ley Organiza de Educación Intercultural y su Reglamento.<br>
            5.3 <span style="padding-left: 15px"></span>Aceptar las decisiones académicas  de la {{ $institutionSiglas }} por el bajo rendimiento y disciplinario de su/s representado/s, sustentado en la ley y Reglamento de Educación Intercultural.<br>
            5.4 <span style="padding-left: 15px"></span>Autorizar a la {{ ucwords(strtolower($institution->nombre)) }}, el uso de imagen de sus representados en concursos, redes sociales/actividades extracadémicas, etc.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA SEXTA: PLAZO Y RENOVACIÓN.- </span> El plazo de duración del presente Contrato corresponde al año lectivo {{ $periodoLectivo }} <br>
            Para proceder a la renovación del presente contrato, EL REPRESENTANTE LEGAL lo puede hacer con anticipación  por escrito a través  de la reservación correspondiente.  La renovación será aceptada por la {{ $institutionSiglas }} siempre y cuando  se haya cumplido a cabalidad las condiciones establecidas en el presente contrato durante su vigencia, así como los Reglamentos Internos y Código de Convivencia y Normativas vigentes, como el pago puntual de los servicios contratados. <br>
			Con la negativa de aceptación de matriculación, la {{ $institutionSiglas }} procederá a entregar los documentos personales y académicos necesarios a fin de que el REPRESENTANTE busque y matricule oportunamente al estudiante en otra institución educativa. <br>
            <br>
		</td>
	</tr>
	<tr> 
		<td class="no-border" style="text-align:justify">
            <span class="bold uppercase">CLÁUSULA SÉPTIMA: TERMINACIÓN DE CONTRATO.-  </span> <br>
            El presente contrato concluirá por las siguientes causas: <br>
			7.1 <span style="padding-left: 15px"></span>Por vencimiento del plazo, caso en el cual, culminará de pleno derecho en la forma prevista en la cláusula sexta.<br>
            7.2 <span style="padding-left: 15px"></span>Por voluntad DEL REPRESENTANTE, si una vez matriculado el estudiante, sus padres o representantes decidan retirarlo de la Institución, conforme al literal A de la Ley Orgánica Intercultural, no podrán solicitar el reembolso de las pensiones que hayan sido devengadas;  no obstante, para que le sean restituidos los valores cancelados por pensiones no devengadas, o para evitar el pago de dichas pensiones, los padres o representantes deberán comunicar el particular, en forma oportuna dentro de los primeros días del mes que se produzca el retiro, a la administración y a la Autoridad Interna del plantel de quien dependa el estudiante.<br>
            7.3 <span style="padding-left: 15px"></span>Por cumplimiento, durante su vigencia, de cualquiera de las cláusulas de este contrato por parte del REPRESENTANTE, o de los Reglamentos, Códigos de Convivencia o disposiciones de la {{ $institutionSiglas }}  Una vez producido  el incumplimiento, la {{ $institutionSiglas }} notificará  por escrito la terminación del contrato al representante otorgándole 15 días para que, de considerarlo pertinente, justifique el incumplimiento y evitar la terminación del contrato. En este caso la {{ $institutionSiglas }} conocerá y resolverá en el plazo de 15 días improrrogables. Si se ratifica la terminación del contrato. Esta causa de terminación surtirá todos los efectos legales, sin requerimiento o trámite judicial o administrativo alguno, proporcionando el servicio educativo al alumno hasta la finalización del período mensual.<br>
            7.4 <span style="padding-left: 15px"></span>Por acuerdo de las partes.<br>
			7.5 <span style="padding-left: 15px"></span>Por las demás causas previstas en la Ley Orgánica y Reglamento Educación Intercultural, Código de Convivencia, Código de honro y Reglamentos de la {{ $institutionSiglas }}<br>
			<br>                        
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold uppercase">CLÁUSULA OCTAVA: DECLARACIONES ESPECIALES.- </span> <br>            
			8.1 <span style="padding-left: 15px"></span>Las pensiones mensuales se pagarán en los diez primeros días de cada mes año lectivo, y no admitirán rebaja alguna por días feriados, vacaciones, ausencia del alumno o cierre del Plantel por fuerza mayor. <br>
            8.2 <span style="padding-left: 15px"></span>Las obligaciones económicas que el contratante asume por este contrato, las cumplirá regularmente hasta los diez primeros días de cada mes.<br>
            8.3 <span style="padding-left: 15px"></span>EL REPRESENTANTE LEGAL, declara en forma expresa que los fondos con los que cancelará los valores correspondientes a la educación del alumno, son lícitos y no provienen ni provendrán de negocios de lavado de dinero producto de narcotráfico de sustancias ilegales. En consecuencia, los padres de familia o representantes, eximen a la {{ $institutionSiglas }} de toda responsabilidad aún frente a terceros si esta declaración fuere falsa o errónea.<br>            
			<br> 
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA NOVENA: CONTROVERSIAS.-  </span> Las partes convienen que le presente contrato será cumplido de buena fe entre ellas y de cualquier  controversia que surja tratará de ser resuelta de mutuo acuerdo.  Sin embargo, para cualquier diferencia relacionada con o derivada de este contrato y su ejecución que no pueda ser arreglada entre los contratantes, cualquiera de ellas podrá pedir la intervención de un mediador del Centro de Arbitraje y Mediación de la Cámara de Comercio de Guayaquil y/o del Distrito Educativo que corresponde.  De ser el caso la Institución se Reserva el derecho de acudir a las Instancia judiciales respectivas.
			<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align:justify">
			<span class="bold uppercase">CLÁUSULA DÉCIMA: RATIFICACIÓN.-   </span> <br>            
			Por la constancia de lo estipulado y en testimonio de su conformidad y aceptación, las partes firman en {{ ucwords(strtolower($institution->ciudad)) }}, en {{ $fechaMesAno }}.
			<br><br>
		</td>
	</tr>
	
</table>
<table class="table">
	<tr>
		<td class="no-border" width="5%"></td>
		<td style="vertical-align: top !important; width: 35% !important;" class="no-border text-center">
			<b>{{$institution->nombre}}</b>  <br><br><br><br><br><br><br><br>
			____________________________________________<br><br>
			<span class="bold">C.C.Nº </span>_______________________________________
			
		</td>
		<td style="vertical-align:top !important;  " class="no-border" width="15%">
			<div class="header__logo">
				<img style="width: 100% !important;"
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="70"
					@endif
				alt="" width="70">
			</div>
		</td>
		<td style="vertical-align: top !important; width: 35% !important;"	 class="no-border text-center">
			<span class="bold">EL REPRESENTANTE </span><br><br><br><br><br><br><br><br><br>
			___________________________________________________<br><br>
			<span class="bold">C.C.Nº </span>_______________________________________<br><br><br><br><br><br>
		</td>
		<td class="no-border" width="5%"></td>
	</tr>
</table>
@endsection