@extends('layouts.master')
@section('content')
@php
use App\Course;
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Comportamiento</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="p-1">
				@foreach ($materias as $key => $item)
					<h3 class="a-btn__cursos">{{$key}}</h3>
					<div class="transporte-grid">
						@foreach ($item as $materia)
							<a href="{{route('DocenteComportamientoCurso', ['idCurso' => $materia->idCurso, 'idMateria' => $materia->id, 'parcial' => 'p1q1'])}}">
								<div class="transporte-item">
									<h3 class="text-center uppercase"> {{$materia->nombre}} </h3>
									<p class="text-center">
										<?php $course = Course::getCoursesByCourse($materia->idCurso);
										?> {{$course->especializacion }} {{$course->paralelo}}
									</p>
								</div>
							</a>
						@endforeach
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection