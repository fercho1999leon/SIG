@extends('layouts.master')
@section('content')
@php
use App\Course;
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">DESTREZAS</h2>
            <a href="{{ route('crearDestreza') }}" class="destreza__destreza-crear title-page">
                <i class="fa fa-plus-square"></i>
                Crear Destreza
            </a>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			@foreach($materias as $key => $item)
				<h3 class="a-btn__cursos"> {{$key}} </h3>
				<div class="a-matricula__estudiantes">
					@foreach ($item as $materia)
						{{--
						<div class="text-center d-asistencia__card">
							<!-- El enlace es a la materia -->
							<a href="{{route('showDestrezasMateria',['idMateria'    =>  $materia->id])}}">
								<div class="docAsistencia">
									<figure class="recAsistencia--img">
										<img src="{{secure_asset('img/calificaciones/calificaciones_gris.svg')}}" alt="">
									</figure>
									<h3 class="text-center m-0">{{$materia->nombre}}</h3>
								</div>
							</a>
						</div>
						--}}

						<div class="d-cursos-item">
		                    <h3 class="text-center d-cursos__nombreMateria">
		                        <img class="mr-05" src="{{secure_asset('img/curso.svg')}}" width="16">
		                        <a href="{{route('showDestrezasMateria',['idMateria' =>  $materia->id, 'parcial' => 'P1Q1'])}}">
		                            {{$materia->nombre}}
								</a>
		                    </h3>
							<p>
								<?php $course = Course::getCoursesByCourse($materia->idCurso);
								?> {{$course->especializacion }} {{$course->paralelo}}
							</p>
                		</div>
					@endforeach
				</div>
			@endforeach
        </div>
    </div>
</div>
@endsection
