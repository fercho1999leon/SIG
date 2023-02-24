@php
    $rol = Sentinel::getUser()->roles()->first()->name;
    $user_data = session('user_data');
    $estudiante = session('estudiante'); 
	$tMessages = session('tMessages');
	use App\Student2;
	use App\ConfiguracionSistema;
	use Carbon\Carbon;
	use App\Institution;
	use App\RequestUser;
	$requestUser = RequestUser::first();
    $institution = Institution::first();
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/tramite.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>SOLICITUD </title>
</head>

<body>
    <div class="container">
    <div class="row ">
        <div class="col-4 marco">
        @include('partials.encabezados.solicitudes-encabezado')
        </div>
        <div class="col-12">
			<h1 class="centrar_tramite">{{$solicitud->title_transact}}</h1>
		</div>
		<br><br><br>
		<div class="marcoGeneral">
        <div class="col-12">
			<p class="izquierda">{{$solicitud->title_addressee}}</p>
		</div>
		<div class="col-12">
			<p class="izquierda">{{$solicitud->name_addressee}}</p>
		</div>
		<div class="col-12">
			<p class="izquierda">{{$solicitud->department_addressee}}</p>
		</div>
		<br><br>
		<div class="col-12">
			<p class="fecha">{{$solicitud->date_creation}}</p>
		</div>
		<br><br><br>
		<div class="col-12">
			<p class="parrafo">
			Yo, <span class="datosPersonales">{{$solicitud->name_student}} </span> estudiante en el Instituto Técnico Superior 
			"Rey David" de la Carrera de <span class="datosPersonales">{{$solicitud->career_student}} </span>, solicito a usted: 
			</p>			
			<p class="parrafo">{{$solicitud->detail_transact}} .</p>
			<br>
			<p class="parrafo">
			Por la favorable acogida que le dé al presente anticipo mis sinceros agradecimientos y me suscribo de usted. 
			</p>			
		</div>
			<br><br><br><br><br>
        <div class="col-12 centrado">
			<h5 class="centrado">Atentamente</h5>
			<br><br><br><br><br>
			<p>_____________________________________</p>
			<h5 class="centrado">C.I. N° {{$solicitud->ci_student}}</h5>
		</div>
		<br><br><br><br><br>
		<div class="col-12 derecha">
				
			Valor: $ {{number_format($solicitud->valor, 2, ',', '.')}}
		</div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>