<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado de promoción</title>
    <link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
    .certificado__hr1 {
        border: 1px solid rgb(255, 230, 0);
        width: 700px;
        margin-bottom: 3.75pt;
        & + p {
            font-size: 7.5pt;
        }
    }
</style>
<body>
	<main>
	@foreach($students as $student)
		@include('partials.encabezados.certificado-promocion-ei', [
			'reportName' => 'promoción'
		])

        <div class="row">
            <div class="text-center">
                <p class="text-center" style="line-height: 1.5">
                    <span style="font-size: 25px;" class="bold uppercase">
                        {{ $student->apellidos }} {{ $student->nombres }}
                    </span>
                </p>
                <hr class="certificado__hr1">
            </div>
        </div>

        <br><br>

        <p class="text-center" style="font-size: 17px; line-height: 1.5">
            Por haber finalizado el 
            <span class="bold uppercase text-align:center">
                @if ($course->grado == "Inicial 2") SUBNIVEL II DE EDUCACIÓN INICIAL
                @else SUBNIVEL I DE EDUCACIÓN INICIAL
                @endif
            </span>.
        </p>

        <P class="text-center" style="font-size: 17px; line-height: 1.5">
            Periodo lectivo {{ $periodo->nombre }}
        </P>

		<table class="table">
            
			
        <br> <br> <br> <br> <br>
        
        <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    <span class="bold uppercase text-align:center">{{ $institution->representante1 }} </span><br>
                    {{ $institution->cargo1 }} de la {{$inst[0]}} <br>
                    {{$inst[1]}} {{$inst[2]}}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    <span class="bold uppercase text-align:center">{{ $docente->nombres }} {{ $docente->apellidos }}</span><br>
                    Docente del Nivel Inicial <br>
                    @if ($course->grado == "Inicial 2") Subnivel II
                    @else Subnivel I
                    @endif
                </p>
            </div>
        </div><br><br><br><br>

        {{-- pie de pagina --}}
        <table class="table m-0">
            <tr>
                <th style="vertical-align:top;" class="no-border" width="50%">
                    <div class="header__logo" style="float: left">
                        <img src="{{ secure_asset('img/pie3.jpeg') }}"  width="350" alt="">
                    </div>
                </th>
                <th style="vertical-align:top;" class="no-border" width="50%">
                    <div class="header__logo" style="float:right">
                        <img width="250" src=" {{secure_asset('img/pie2.jpg')}} " alt="">
                    </div>
                </th>
            </tr>
        </table>
        {{-- fin de pie de pagina --}}
        <div style="page-break-after:always;"></div>
	@endforeach
	</main>
</body>
</html>