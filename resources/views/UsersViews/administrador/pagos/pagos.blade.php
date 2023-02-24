@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('barra.administrador')
        <div class="row wrapper white-bg titulo-separacion noBefore">
            <h2 class="title-page">Pagos</h2>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                    <div class="card-asistencia cardCourses">
                        <div class="typeOfCourse">
                           
                            <div class="card-asistencia">
                                @foreach
                                @foreach($courses as $course)
                                <div class="lista_alumnos">
                                    <article class="alumnos">
                                        <a href="{{ route('pagosCurso', $course->id) }}" class="rector_pagos8A">
                                            <h2>
                                                <img src="img/CURSO.png" alt="" class="cursoImg">
                                                {{ $course->grado }} {{ $course->paralelo }}
                                            </h2>
                                        </a>
                                        <hr>
                                        <!--
                                        <div class="rectorPagos__valorPendiente">
                                            <a href="colecturia_pagos8A1.php" class="rectorPagos__items">
                                                <span class="valorResuelto">CANCELADO</span>
                                                <button class="btn rectorPagos__cantidadAlumnos">
                                                    <img class="rectorPagos--user" src="img/user.svg" alt="">100
                                                    <button class="btn rectorPagos--verCancelado ">ver</button>
                                                </button>
                                            </a>
                                            <a href="colecturia_pagos8A2.php" class="rectorPagos__items">
                                                <span class="valorPendiente">POR CONFIRMAR</span>
                                                <button class="btn rectorPagos__cantidadAlumnos">
                                                    <img class="rectorPagos--user" src="img/user.svg" alt="">3
                                                    <button class="btn rectorPagos--verConfirmar ">ver</button>
                                                </button>
                                            </a>
                                            <a href="colecturia_pagos8A3.php" class="rectorPagos__items">
                                                <span class="valorError">PENDIENTE: </span>
                                                <button class="btn rectorPagos__cantidadAlumnos">
                                                    <img class="rectorPagos--user" src="img/user.svg" alt="">2
                                                    <button class="btn rectorPagos--verPendiente ">ver</button>
                                                </button>
                                            </a>
                                        </div>
                                        -->
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection