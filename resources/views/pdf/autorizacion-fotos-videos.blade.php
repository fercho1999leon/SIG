<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Autorización de Movilización Estudiantil</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
.table td,
.table th {
	 font-size: 11pt !important;
	 padding: 8px !important;
 }
</style>
<body>
	<br>
	<table class="table">
		<tr height="25"></tr>
		<tr>
			<td class="no-border bold text-center uppercase">No autorización toma de fotos y/o videos para uso de pedagógico, administrativo, psicológico y/o publicitario.<br></td>
		</tr>
		<tr height="25"></tr>
		<tr>
			<td class="no-border text-left">{{$institution->ciudad}}, {{$fecha}}<br><br><br></td>
		</tr>
		<tr>
			<td class="no-border bold">
				Señores, <br>{{$institution->nombre}}<br>Ciudad.
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<td class="no-border">De mis consideraciones:</td>
		</tr>
		<tr height="50"></tr>
		<tr>
			<td class="line no-border" style="text-align: justify">
					Yo, 
					<span class="bold">{{strtoupper($student->representante->apellidos)}} {{strtoupper($student->representante->nombres)}}</span>, representante legal del estudiante <span class="bold">{{strtoupper($student->apellidos)}} {{strtoupper($student->nombres)}}</span> del <span class="uppercase bold">{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</span>, No autorizo la toma de fotos y/o videos de mi representado para fines administrativos, pedagógicos, psicológicos y publicitarios, así como el uso y publicación de los mismos de forma en que la institución considere necesaria, siempre y cuando se respeten los derechos y se vele por el bienestar de mi representado.		
				</span>
			</td>
		</tr>
		<tr height="50"></tr>
		<tr>
			<td class="no-border">Atentamente,</td>
		</tr>
		<tr height="100"></tr>
		<tr>
			<td class="text-center no-border">
				<span style="display:inline-block;width:350px;border-top:black solid 1px;margin-top:3px">
					<span class="uppercase">
						{{$student->representante->apellidos}} {{$student->representante->nombres}} <br>CI: {{$student->representante->ci}}
					</span> 
					<br>
					Representante
				</span>
			</td>
		</tr>
	</table>

</body>

</html>