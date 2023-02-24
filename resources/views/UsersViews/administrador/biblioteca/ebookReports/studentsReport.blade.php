
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
			width: 20%;
			font-weight: bold
		}
	</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>REPORTE GENERAL BIBLIOTECA </title>
</head>

<body>
    <div class="container">
		<div class="titulo">
			<h3>Reporte Bibliotecario Estudiantil</h3>
		</div>
		
		 <h5>Informe de uso de Libros en Biblioteca</h5>
		  <table class="table table-bordered formatoTabla">
			  <thead>
				  <tr>
                        <td>N°</td>
                        <td class="formato">Nombre del Estudiante</td>
                        <td class="formato">Número de Matricula</td>
                        <td class="formato">Nivel - Semestre</td>
                        <td class="formato">Fecha de Ingres a la Biblioteca</td>
					    <td class="formato">Hora de Entrada y Salida de la Biblioteca</td>
					    <td class="formato">Tiempo</td>
                        <td class="formato">Libro</td>
				  </tr>
				 
			  </thead>
			  <tbody>
                  
				  @foreach ($datos as $datos)
				  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$datos->nombres}} {{$datos->apellidos}}</td>  
                    <td>{{$datos->numero_matriculacion}}</td>
                    <td>{{$datos->grado}}</td>
					<td class="formato">{{$datos->last_entry}}</td>
                    <td >{{$datos->last_entry}}</td>
                    <td>{{$datos->minutos}}</td>
                    <td>{{$datos->slug}}</td>				
				  </tr>	  
				  
				  @endforeach
				  
			  </tbody>
		  </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>