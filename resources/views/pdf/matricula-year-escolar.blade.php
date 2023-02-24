<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}" />
	<title>MATRICULA AÑO ESCOLAR</title>
</head>

<body>
	<table class="table mb-2">
		<tr>
			<th width="20%">
				<img src=" {{secure_asset('img/logo-ministerio.png')}} " width="60" alt="">
			</th>
			<th width="60%">
				<div class="header__info text-center">
					<h1>Nombre de la institución</h1>
					<h3 class="up">ficha de matricula año escolar 2018 - 2019</h3>
				</div>
			</th>
			<th width="20%">
				N. de Matrícula asignado 00000
			</th>
		</tr>
	</table>
	<table class="table uppercase">
		<tr>
			<th width="33.3%">Año escolar:-----</th>
			<th width="33.3%">Paralelo:-----</th>
			<th width="33.3%">Fecha de matrícula:-----</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="4">1.- DATOS ALUMNO:</th>
		</tr>
		<tr>
			<th colspan="2">número de cedula: -----------</th>
			<th>Edad: --</th>
			<th>Fecha de nacimiento: ----/--/--</th>
		</tr>
		<tr>
			<th>Lugar de nacimiento: --------</th>
			<th>Tipo de sangre:----</th>
			<th colspan="2">Nacionalidad: ----</th>
		</tr>
		<tr>
			<th colspan="2">domicilio: provincia:-----</th>
			<th>cantón:-----</th>
			<th>Parroquia:------</th>
		</tr>
		<tr>
			<th colspan="4">dirección: ----------------------</th>
		</tr>
		<tr>
			<th>Vive con: Padre: --</th>
			<th>Madre: --</th>
			<th>Ambos: --</th>
			<th>Otro(s) Especificar: ------</th>
		</tr>
		<tr>
			<th>número de hermanos: --</th>
			<th>lugar que ocupa entre los hermanos: --</th>
			<th colspan="2">tipo de parto: ------</th>
		</tr>
		<tr>
			<th colspan="4">cursos que ha repetido: ---</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="3" class="bold">
				2.- Datos de la(s) escuela(s) anterior(es):
			</th>
		</tr>
		<tr>
			<th>Escuela: --</th>
			<th>Nivel: --</th>
			<th>año: --</th>
		</tr>
		<tr>
			<th>Escuela: --</th>
			<th>Nivel: --</th>
			<th>año: --</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="3">3.- datos de los padres:</th>
		</tr>
		<tr>
			<th colspan="2">nombre del padre: --------</th>
			<th>ci: --------</th>
		</tr>
		<tr>
			<th>estado civil:----</th>
			<th colspan="2">dirección:-------</th>
		</tr>
		<tr>
			<th>teléfono casa: -------</th>
			<th>teléfono móvil: ---------</th>
			<th>trabajo: -------</th>
		</tr>
		<tr>
			<th>profesión u oficio:----</th>
			<th colspan="2">Lugar de trabajo: ----</th>
		</tr>
		<tr>
			<th colspan="3">correo electrónico:-----</th>
		</tr>
		<tr>
			<th colspan="2">nombre de la madre: --------</th>
			<th>ci: --------</th>
		</tr>
		<tr>
			<th>estado civil:----</th>
			<th colspan="2">dirección:-------</th>
		</tr>
		<tr>
			<th>teléfono casa: -------</th>
			<th>teléfono móvil: ---------</th>
			<th>trabajo: -------</th>
		</tr>
		<tr>
			<th>profesión u oficio:----</th>
			<th colspan="2">Lugar de trabajo: ----</th>
		</tr>
		<tr>
			<th colspan="3">correo electrónico:-----</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="3">datos del representante:</th>
		</tr>
		<tr>
			<th colspan="2">nombre: --------</th>
			<th>ci: --------</th>
		</tr>
		<tr>
			<th>estado civil:----</th>
			<th colspan="2">dirección:-------</th>
		</tr>
		<tr>
			<th>teléfono casa: -------</th>
			<th>teléfono móvil: ---------</th>
			<th>trabajo: -------</th>
		</tr>
		<tr>
			<th>profesión u oficio:----</th>
			<th colspan="2">Lugar de trabajo: ----</th>
		</tr>
		<tr>
			<th colspan="3">correo electrónico:-----</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th>5.- motivo por el cual se cambia a esta escuela:</th>
		</tr>
		<tr>
			<th>-----------------------------------</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th>6.- salud del (la) estudiante:</th>
		</tr>
		<tr>
			<th>
				ha estado en tratamiento: neurológico: si -- no -- psicopedagógico: si -- no -- Otro: (especifique)------------
			</th>
		</tr>
		<tr>
			<th>
				en la actualidad se encuentra en tratamiento: si -- (especifique): -------- no: --
			</th>
		</tr>
		<tr>
			<th>
				posee contraindicación médica para realizar actividad física y/o deportiva: si -- no --
			</th>
		</tr>
		<tr>
			<th>
				es alérgico a algún medicamento o alimento: si -- (especifique) ----- no --
			</th>
		</tr>
		<tr>
			<th>
				posee antecedentes de transtornos de aprendizaje, déficit atencional, otros: si ----- no --
			</th>
		</tr>
		<tr>
			<th>posee seguro escolar: no --- si -- especifique: ----</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="2">7.- en caso de una emergencia comunicar a:</th>
		</tr>
		<tr>
			<th>nombre: -----</th>
			<th>teléfono: -----</th>
		</tr>
		<tr>
			<th colspan="2">
				persona que puede retirar al estudiante en caso de emergencia(además del representante):
			</th>
		</tr>
		<tr>
			<th>nombre: --------</th>
			<th>ci: ----</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="2">
				8.- a nombre de quien se emiten las facturas de pensiones:
			</th>
		</tr>
		<tr>
			<th>nombre: ------</th>
			<th>ci: -----</th>
		</tr>
		<tr>
			<th>dirección</th>
			<th>teléfono: ---</th>
		</tr>
	</table>

	<table class="table uppercase matriculaAnioEscolar__border">
		<tr>
			<th colspan="4">documentos que entregador por el apoderado:</th>
		</tr>
		<tr>
			<th colspan="2">fotocopia de c.i. del (la) niño(a): --</th>
			<th colspan="2">
				fotocopia de la c.i. de los padres y/o representante: --
			</th>
		</tr>
		<tr>
			<th colspan="2">fotocopia del carnet de vacunación: --</th>
			<th colspan="2">certificado de matricula: --</th>
		</tr>
		<tr>
			<th>libreta escolar original y 1 copia: --</th>
			<th>prueba de admisión: --</th>
			<th>certificado de puntualidad en los pagos: --</th>
			<th>5 fotos tamaño carnet: --</th>
		</tr>
	</table>
</body>

</html>