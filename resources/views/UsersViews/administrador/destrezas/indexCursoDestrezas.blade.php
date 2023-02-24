@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href=" {{route('destrezasAdmin') }} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">
				Destrezas
			</h2>
			{{--<a href="{{ route('crearDestrezaAdmin') }}" class="destreza__destreza-crear title-page">
				<i class="fa fa-plus-square"></i>
				Crear Destreza
			</a>--}}{{--Se comento debido a que se esta usando el crear destreza desde el docente--}}
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a class="no-pointer"> {{$course->grado}} {{$course->especialzacion}} {{$course->paralelo}} </a>
				</div>
			</div>
		</div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="a-matricula__estudiantes">
                @foreach($Matters as $matter)
                <div class="text-center d-asistencia__card"> 
                    <!-- El enlace es a la materia -->
                    {{--<a href="{{route('showDestrezasMateriaAdmin',['idMateria' =>  $matter->id, 'parcial' => 'P1Q1'])}}">--}}
                        <a href="{{route('showDestrezasMateria',['idMateria' =>  $matter->id, 'parcial' => 'P1Q1'])}}">
                        <h3 class="m-0">CURSO: 
							@php
								$course = App\Course::find($matter->idCurso);
							@endphp
							{{App\Course::nombreCurso($course)}}
						</h3>
                        <hr class="d-asistencia__card-hr">
                        <div class="docAsistencia">
                            <figure class="recAsistencia--img">
                                <img src="{{secure_asset('img/calificaciones/calificaciones_gris.svg')}}" alt="">
                            </figure>
                            <h3 class="text-center m-0">{{$matter->nombre}}
                            </h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
