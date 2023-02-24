@php
use App\TituloGrado;
use App\TituloPosgrado;
use App\Certificacione;
use App\Seminario;
use App\ExperienciaProfesional;
use App\ExperienciaDocente;
use App\ExperienciaCapacitador;
use App\ExperienciaVinculacion;
use App\ExpVincColectiva;
use App\Evento;
use App\PublicacionLibro;
use App\Articulo;
$tituloGrado = TituloGrado::where('usuario_id', $docente->id)->first();
$tituloPosgrado = TituloPosgrado::where('usuario_id', $docente->id)->first();
$certificaciones = Certificacione::where('usuario_id', $docente->id)->get();
$seminarios = Seminario::where('usuario_id', $docente->id)->get();
$experienciasProfesionales = ExperienciaProfesional::where('usuario_id', $docente->id)->get();
$experienciasDocentes = ExperienciaDocente::where('usuario_id', $docente->id)->get();
$experienciasCapacitadoras = ExperienciaCapacitador::where('usuario_id', $docente->id)->get();
$experienciasVinculacion = ExpVincColectiva::where('usuario_id', $docente->id)->get();
$experienciasInvestigacion = ExperienciaVinculacion::where('usuario_id', $docente->id)->get();
$eventosInternacionales = Evento::where('usuario_id', $docente->id)->get();
$publicacionLibros = PublicacionLibro::where('usuario_id', $docente->id)->get();
$publicacionArticulos = Articulo::where('usuario_id', $docente->id)->get();
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ secure_asset('css/curriculum/curriculum.css') }}">
    <title>Hoja de Vida</title>
</head>

<body>
    <div class="container-lg p-3 bg-black">
        @include('partials.encabezados.reporte-institucional', ['reportName' => 'Reporte
        Docente'])
        <div class="container-lg p-3">
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                1. DATOS PERSONALES
            </h4>
            {{-- DATOS PERSONALES --}}
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr>
                            <th class="fw-normal"><strong class="fw-bolder">Apellidos:</strong>
                                {{ $docente->apellidos }}</th>
                            <th class="fw-normal"><strong class="fw-bolder">C.I.:</strong> {{ $docente->ci }}
                            </th>
                        </tr>
                        <tr>
                            <th class="fw-normal"><strong class="fw-bolder">Nombres:</strong>
                                <span>{{ $docente->nombres }}</span>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">Nacionalidad:</strong>
                                {{ $docente->nacionalidad }}
                            </th>
                        </tr>
                        <tr>
                            <th class="fw-normal"><strong class="fw-bolder">Fecha de Nacimiento:</strong>
                                {{ $docente->fNacimiento }}</th>
                            <th class="fw-normal"><strong class="fw-bolder">Sexo:</strong>
                                {{ $docente->sexo }}</th>
                        </tr>
                        <tr>
                            <th class="fw-normal"><strong class="fw-bolder">Dirección Domiciliaria:</strong>
                                {{ $docente->dDomicilio }}</th>
                            <th class="fw-normal"><strong class="fw-bolder">Teléfono:</strong>
                                {{ $docente->tDomicilio }}</th>
                        </tr>
                        <tr>
                            <th class="fw-normal"><strong class="fw-bolder">Correo Electronico:</strong> <span
                                    class="text-lowercase text-decoration-underline fw-normal">{{ $docente->correo }}</span>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">Celular:</strong>
                                {{ $docente->movil }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            {{-- FORMACIÓN ACADÉMICA --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                2. FORMACIÓN ACADÉMICA
            </h4>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2 ">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TÍTULOS DE GRADO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CÓDIGO SENESCYT</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">UNIVERSIDAD</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">PAÍS</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    @if ($tituloGrado != null)
                        <tbody class="textoDatos">
                            <tr class="text-capitalize">
                                <th class="fw-normal">1</th>
                                <th class="fw-normal">{{ $tituloGrado->nombre }}</th>
                                <th class="fw-normal">{{ $tituloGrado->codigo_senescyt }}</th>
                                <th class="fw-normal">{{ $tituloGrado->universidad }}</th>
                                <th class="fw-normal">{{ $tituloGrado->pais }}</th>
                                <th class="fw-normal">{{ $tituloGrado->ano }}</th>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2 ">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TÍTULOS DE POSTGRADO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CÓDIGO SENESCYT</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">UNIVERSIDAD</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">PAÍS</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($tituloPosgrado != null)
                            <tr class="text-capitalize">
                                <th class="fw-normal">1</th>
                                <th class="fw-normal">{{ $tituloPosgrado->nombre }}</th>
                                <th class="fw-normal">{{ $tituloPosgrado->codigo_senescyt }}</th>
                                <th class="fw-normal">{{ $tituloPosgrado->universidad }}</th>
                                <th class="fw-normal">{{ $tituloPosgrado->pais }}</th>
                                <th class="fw-normal">{{ $tituloPosgrado->ano }}</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2 ">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CERTIFICACIONES
                                    SENESCYT
                                </strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">NÚMERO DE REGISTRO SETEC</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">INSTITUCIÓN CERTIFICADORA</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">PAÍS</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($certificaciones != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($certificaciones as $certificado)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $certificado->nombre }}</th>
                                    <th class="fw-normal">{{ $certificado->registro_setec }}</th>
                                    <th class="fw-normal">{{ $certificado->institucion_certificadora }}</th>
                                    <th class="fw-normal">{{ $certificado->pais }}</th>
                                    <th class="fw-normal">{{ $certificado->ano }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- CURSOS Y SEMINARIOS ULTIMOS CINCO AÑOS --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                3. CURSOS Y SEMINARIOS ULTIMOS CINCO AÑOS
            </h4>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">NOMBRE DEL CURSO O
                                    SEMINARIO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">INSTITUCIÓN</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">PAÍS</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">AÑO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder"># DE HORAS</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($seminarios != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($seminarios as $seminario)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $seminario->nombre }}</th>
                                    <th class="fw-normal">{{ $seminario->institucion }}</th>
                                    <th class="fw-normal">{{ $seminario->pais }}</th>
                                    <th class="fw-normal">{{ $seminario->ano }}</th>
                                    <th class="fw-normal">{{ $seminario->numero_horas }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- EXPERIENCIA --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                4. EXPERIENCIA
            </h4>
            <p class="text-left text-uppercase textoSubtitle">
                4.1 PROFESIONAL
            </p>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">EMPRESA-INSTITUCIÓN</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">CARGO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">DE MES-AÑO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">A MES-AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($experienciasProfesionales != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($experienciasProfesionales as $experiencia)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $experiencia->empresa_institucion }}</th>
                                    <th class="fw-normal">{{ $experiencia->cargo }}</th>
                                    <th class="fw-normal">{{ $experiencia->desde }}</th>
                                    <th class="fw-normal">{{ $experiencia->hasta }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <p class="text-left text-uppercase textoSubtitle">
                4.2 DOCENTE
            </p>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CURSOS - MATERIAS -
                                    MÓDULO</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">INSTITUCIÓN</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">DE MES-AÑO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">A MES-AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($experienciasDocentes != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($experienciasDocentes as $experiencia)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $experiencia->curso_materia_modulo }}</th>
                                    <th class="fw-normal">{{ $experiencia->institucion }}</th>
                                    <th class="fw-normal">{{ $experiencia->desde }}</th>
                                    <th class="fw-normal">{{ $experiencia->hasta }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <p class="text-left text-uppercase textoSubtitle">
                4.3 CAPACITADOR
            </p>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CURSO - SEMINARIO
                                    (ÁREAS)</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">ENTIDADES</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">DE MES-AÑO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">A MES-AÑO</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($experienciasCapacitadoras != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($experienciasCapacitadoras as $experiencia)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $experiencia->curso_seminario }}</th>
                                    <th class="fw-normal">{{ $experiencia->entidades }}</th>
                                    <th class="fw-normal">{{ $experiencia->desde }}</th>
                                    <th class="fw-normal">{{ $experiencia->hasta }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <p class="text-left text-uppercase textoSubtitle">
                4.4 VINCULACIÓN CON LA COLECTIVIDAD
            </p>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TIPO DE EXPERIENCIA</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">PROGRAMA/PROYECTO</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">DURACIÓN</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($experienciasVinculacion != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($experienciasVinculacion as $experiencia)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $experiencia->tipo_experiencia }}</th>
                                    <th class="fw-normal">{{ $experiencia->programa_proyecto }}</th>
                                    <th class="fw-normal">{{ $experiencia->duracion }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <p class="text-left text-uppercase textoSubtitle">
                4.5 INVESTIGACIÓN
            </p>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TIPO DE EXPERIENCIA</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">PROGRAMA</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">DURACIÓN</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($experienciasInvestigacion != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($experienciasInvestigacion as $experiencia)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $experiencia->tipo_experiencia }}</th>
                                    <th class="fw-normal">{{ $experiencia->programa }}</th>
                                    <th class="fw-normal">{{ $experiencia->duracion }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- EVENTOS INTERNACIONALES – PONENCIAS EN LOS ÚLTIMOS TRES AÑOS --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                5. EVENTOS INTERNACIONALES – PONENCIAS EN LOS ÚLTIMOS TRES AÑOS
            </h4>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">NOMBRE DEL EVENTO</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">PAÍS Y
                                    CIUDAD
                                </strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">FECHA DE PUBLICACION</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">MEMORIA DEL EVENTO
                                    (URL)</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($eventosInternacionales != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($eventosInternacionales as $evento)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $evento->nombre }}</th>
                                    <th class="fw-normal">{{ $evento->lugar }}</th>
                                    <th class="fw-normal">{{ $evento->fecha_publicacion }}</th>
                                    <th class="fw-normal">{{ $evento->url }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- PUBLICACIONES DE ARTÍCULOS --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                6. PUBLICACIONES DE ARTÍCULOS
            </h4>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TÍTULO</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">NOMBRE DE REVISTA</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CODIGO
                                    ISSN
                                </strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">VOL. No. / FECHA
                                    PUBLICACIÓN</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($publicacionArticulos != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($publicacionArticulos as $articulo)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $articulo->titulo }}</th>
                                    <th class="fw-normal">{{ $articulo->nombre_revista }}</th>
                                    <th class="fw-normal">{{ $articulo->codigo_issn }}</th>
                                    <th class="fw-normal">{{ $articulo->volumen }}
                                        {{ $articulo->fecha_publicacion }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- PUBLICACIÓN DE LIBROS --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                7. PUBLICACIÓN DE LIBROS
            </h4>
            <div class="row m-3">
                <table class="table table-bordered border-dark border-2">
                    <thead class="text-capitalize text-start textoDatos">
                        <tr class="bg-dark text-white text-center">
                            <th class="fw-normal"><strong class="fw-bolder"></strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">TÍTULO</strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">NOMBRE DE REVISTA</strong></th>
                            <th class="fw-normal"><strong class="fw-bolder">CODIGO
                                    ISSN
                                </strong>
                            </th>
                            <th class="fw-normal"><strong class="fw-bolder">VOL. No. / FECHA
                                    PUBLICACIÓN</strong></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="textoDatos">
                        @if ($publicacionLibros != null)
                            @php
                                $contador = 1;
                            @endphp
                            @foreach ($publicacionLibros as $libro)
                                <tr class="text-capitalize">
                                    <th class="fw-normal">{{ $contador++ }}</th>
                                    <th class="fw-normal">{{ $libro->titulo }}</th>
                                    <th class="fw-normal">{{ $libro->filiacion }}</th>
                                    <th class="fw-normal">{{ $libro->codigo_issn }}</th>
                                    <th class="fw-normal">{{ $libro->volumen }}
                                        {{ $libro->fecha_publicacion }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- DECLARACIÓN --}}
            <h4 class="h4 text-left text-uppercase textoSubtitle">
                7. DECLARACIÓN
            </h4>
            <div class="row m-3 textoDatos">
                <p>Declaro y me responsabilizo que toda la información contenida en este formulario es verídica. En caso
                    de que se compruebe la falsedad de la información autorizo a la Institución y/o Secretaría
                    Administrativa y de Personal tomar las acciones legales que corresponda.</p>
                <p>Daule, {{ $fechaActual }}</p>
            </div>
            <div class="row m-5 textoDatos text-center">
                <p class="mb-0">........................................................</p>
                <p class="text-capitalize">{{ $docente->cargo }} {{ $docente->nombres }}
                    {{ $docente->apellidos }}
                </p>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
