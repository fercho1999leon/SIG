
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
		.titulo{
			text-align: center;
			padding-top: 3rem;
			padding-bottom: 3rem;
		}
		.formatoTabla{
			font-size: 11px;
			font-family: Arial, Helvetica, sans-serif;
			
		}
		.formato{
			width: 40%;
			font-weight: bold
		}
	</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>REPORTE INDIVIDUAL BIBLIOTECA </title>
</head>

<body>
    <div class="container">
		<div class="titulo">
			<h3>Reporte Bibliotecario Estudiantil</h3>
		</div>
		<h5>Datos del Estudiante</h5>
		<table class="table table-bordered formatoTabla">
			<tbody >
			  <tr>
				<td class="formato">C.I. Estudiante:</td>
				<td id="celCedula"> {{$datosEstudiante->ci}}</td>
			  </tr>
			  <tr>
				<td class="formato">Nombres del Estudiante:</td>
				<td id="celNombre">{{$datosEstudiante->nombres}} </td>
			  </tr>
			  <tr>
				<td class="formato">Apellidos del Estudiante:</td>
				<td id="celApellido">{{$datosEstudiante->apellidos}}</td>
			  </tr>
			  <tr>
				  <td class="formato">Carrera</td>
				  <td id="celCarrera">{{$datosEstudiante->nombreCarrera}}</td>
				</tr>
			  <tr>
				<td class="formato">Número de Matrícula</td>
				<td id="celMatricula">{{$datosEstudiante->numero_matriculacion}}</td>
			  </tr>
			  <tr>
				<td class="formato">Nivel / Semestre</td>
				<td id="celSemestre">{{$datosEstudiante->grado}}</td>
			  </tr>
			  
			</tbody>
		  </table>
		 <h5>Informe de Libros</h5>
		  <table class="table table-bordered formatoTabla">
			  <thead>
				  <tr>
					  <td class="formato">Libros consultados:</td>
					  {{--<td class="formato">Fecha de Ultima Entrada ala Biblioteca</td>
					  <td class="formato">Tiempo</td>--}}
				  </tr>
				 
			  </thead>
			  <tbody>
				  @foreach ($datosBiblitecaEstudiante as $datos)
				  <tr>
					<td>{{$datos->slug}}</td>
					{{--<td>{{$datos->last_entry}}</td>
					<td>{{$datos->minutos}}</td>--}}
				  </tr>	  
				  
				  @endforeach
				  
			  </tbody>
		  </table>
		<h5>Bibliotecas virtuales consultadas:</h5>
		<table class="table table-bordered formatoTabla">
			<thead>
				<tr>
					<td class="formato">Nombre de biblioteca</td>
					<td class="formato">Última Entrada</td>
					<td class="formato">Tiempo</td>
				</tr>
			</thead>
			<tbody>
				@foreach ($datosEstudiante['library_virtual_report'] as $datos)
					<tr>
						<td>{{$datos['name']}}</td>
						<td>{{$datos['session']}}</td>
						<td>{{$datos['time']}}</td>
					</tr>	  
				@endforeach
				
			</tbody>
		</table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>