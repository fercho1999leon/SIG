@extends('layouts.master')
@section('content')
@php
use App\Course;
@endphp
<a class="button-br" href="{{route('cursosDocente')}}">
    <button>
        <img src="../../../img/return.png" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 seleccion-curso">
            <h2 class="title-page">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" id="alumnos">
        <div class="a-matricula__estudiantes">
            @foreach($students as $student)
                <div class="d-cursos-item">
                    <img alt="Icono Estudiante" src="../../../img/icono persona.png" width="25">
                    <h4 style="text-transform: uppercase;">
                        {{ $student->nombres }} {{ $student->apellidos }}
                    </h4>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection