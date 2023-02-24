@extends('layouts.master-reportes')
@section('content')
@section('style')
	<style>
		.table td {
			/* font-size: 7pt !important; */
			font-size: 12pt !important;
		}
	</style>
@endsection
<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="text-align:right">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
					@endif 
				alt="" width="70">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h3>SOLICITUD DE MATRÍCULA</h3>
				<h3>{{ $institution->nombre }}</h3>
			</div>
		</th>
		<th class="no-border" width="20%">
		</th>
	</tr>
</table>
<table class="table">
	<tr>
		<td class="no-border">{{$institution->ciudad}}, {{$fecha}} <br><br></td>
	</tr>
	<tr>
		<td class="no-border bold">SEÑOR(A)<BR> RECTOR(A) DE LA {{$institution->nombre}} <br>Ciudad.<br><br></td>
	</tr>
	<tr>
		<td class="no-border">Señor(a) RECTOR(A)<br><br></td>
	</tr>
	<tr>
		<td class="no-border"style="text-align: justify">{{$student->representante->nombres}} {{$student->representante->apellidos}} en mi calidad de representante del (la) menor {{$student->nombres}} {{$student->apellidos}}, considerando la visión, misión, objetivos y principios de la <span class="bold">{{$institution->nombre}},</span>  libre y voluntariamente solicito a usted, se sirva autorizar la respectiva matrícula para mi representado (a), que ha sido promovido (a) para el {{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}} para el periodo lectivo {{$student->periodoLectivo->nombre}} <br><br>En caso de ser aceptada mi solicitud de matrícula, expresamente me comprometo a:</td>
	</tr>
	<tr>
		<td class="no-border"style="text-align: justify">1. Conocer la normativa legal y reglamentaria que rige el sistema educativo en el Ecuador en general y en particular, el sistema de estudios de la <span class="bold">{{$institution->nombre}},</span> su Proyecto Educativo Institucional (PEI), el Código de Convivencia y demás Reglamentos especificos y regulaciones internas, que me han sido proporcionadas; normatividad a la que me comprometo respetar y hacer que mi representado (a) la respete y la observe en su accionar dentro y fuera de la Institución.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">2. Preocuparme todos los dias de la formación integral de mi representado (a), es decir, a velar para que mi hogar se convierta en propulsor de los mismos anhelos y valores que propugna la {{$institution->nombre}}, tanto en el aspecto moral, fisico, como en el disciplinario y académico.<br><br></td>
	</tr>
	<tr>
		<td class="no-border">3. Respetar a sus autoridades, personal docente, administrativo y de servicios.<br><br></td>
	</tr>
	<tr>
		<td class="no-border">4. Acatar las decisiones y resoluciones institucionales.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">5. Cumplir con las obligaciones voluntariamente contraídas, en especial: la puntualidad en el ingreso a clases de mi representado (a), la observancia de su aseo y correcto uso del uniforme; el pago a tiempo de las expensas educativas (matrícula y diez pensiones por servicios educativos, desde {{$pagoInicioFin ?? '-----'}}.<br><br></td>
	</tr>
	<tr>
		<td class="no-border">6. Respaldar a las autoridades y proteger el buen nombre institucional.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">7. Responder económicamente, por los daños que mi representado (a) causare, consciente o inconscientemente, a los bienes de la Institución o de terceras personas.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">8. Entregar en Secretaria General la documentación solicitada, previa a la matriculación, debidamente legalizada, en los plazos determinados, en especial la referente a los antecedentes académicos, de conducta, de salud y cuidado médico del (la) estudiante, y a asumir todas las consecuencias que legalmente se deriven por el incumplimiento de esta obligación.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">9. Me comprometo a respetar los cambios de paralelos que se hicieron con los estudiantes, sea por logistica o para mejorar su formación conductual.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">10. Deslindar de toda responsabilidad a la {{$institution->nombre}}, en el evento que se sucedieren actos insólitos, imprevistos extraños a la vida educativa, fuera de la institución. La {{$institution->nombre}} garantiza la seguridad integral de nuestros representados dentro de la institución, en las horarios establecidos por el plantel.<br>La {{$institution->nombre}} es una Institución muy seria, respetada y responsable, a quien estoy confiando voluntariamente la custodia y educación de mi representado.<br><br></td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">11. Asistir en el día y hora que sea citado para tratar asuntos relacionados con el avance en la formación y educación de mi representado y me comprometo a controlar su tiempo libre fuera de las aulas escolares para el cumplimiento de las tareas, estudio dirigido y las lecciones, así como el cumplimiento en sus trabajos y deberes.<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">12. Abrir todos los días la página del aula virtual de la {{$institution->nombre}} y mi correo electrónico, para revisar las notificaciones y citaciones que me efectúe la Institución, novedades y avances académicos de mi(s) representado(s).<br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border" style="text-align: justify">13. Finalmente me comprometo a colaborar para que esta Institución Educativa sea para mi(s) representado(a-os-as), la prolongación de mi hogar. Para los efectos correspondiente, declaro que los datos personales del alumno(a) sus padres y de (la) representante, declarados en el reverso de esta solicitud de matricula son verídicos; y autorizo en forma expresa para que las comunicaciones escritas, ya sea mediante circulares o misivas personales o de cualquier tipo de información me las envien con mi representado(a); o indistintamente, la envíen a la dirección domiciliaria consignada, mensaje al teléfono celular, o al correo electrónico que tengo señalado en mis datos personales. Espero que la matrícula solicitada sea concedida bajo los compromisos y obligaciones anteriormente descritos, los mismos que tendrán validez durante todo el tiempo que mi representado (a) estudie en la {{$institution->nombre}}, en cualquiera de sus niveles. <br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border">
			Muy atentamente. <br><br><br>
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<div style="border-top:1px solid black; width:300px;"></div><br> Firma del (la) representante <br> Cédula No. {{$student->representante->ci}}
		</td>
	</tr>
</table>
@endsection