<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informacion de Inscripcion</title>
</head>
<body>
    <p>Inscripcion del estudiante: </p>
    <ul>
        <li>Nombres: {{ $estudianteXaño->student()->first()->nombres }} {{ $estudianteXaño->student()->first()->apellidos }}</li>
        <li>Cedula: {{ $estudianteXaño->student()->first()->ci }}</li>
        <li>Curso al que aspira: {{ $estudianteXaño->course()->first()->grado }}</li>
        <li>Nacionalidad: {{ $estudianteXaño->student()->first()->nacionalidad }}</li>
    </ul>
    @if ($representante != null)
        <p>Datos del Representante:</p>
        <ul>
            <li>Nombres: {{ $representante->nombres }} {{ $representante->apellidos }}</li>
            <li>Cedula: {{ $representante->ci }}</li>
            <li>Telefono: {{ $representante->movil }}</li>
        </ul>
    @endif
</body>
</html>