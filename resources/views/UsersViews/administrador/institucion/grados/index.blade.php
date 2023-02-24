@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Institución
				<small> Grados</small>
			</h2>
		</div>
	</div>
	<div class="row text-center mb-05">
		<div class="col-lg-12 barra-inicial">
			<h3 class="m-0 p-1 color-white"> Educación inicial
			</h3>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row" id="courses-list">
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Inicial 1</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Inicial 1")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Inicial 2</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Inicial 2")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="row text-center">
		<div class="col-lg-12 barra-inicial">
			<h3 class="m-0 p-1 color-white"> Educación General Básica
			</h3>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row" id="courses-list">

			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Primero</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Primero")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>

			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Segundo</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Segundo")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>

			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Tercero</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Tercero")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>

			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Cuarto</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Cuarto")
						<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>

			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Quinto</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Quinto")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Sexto</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Sexto")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Septimo</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Septimo")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Octavo</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Octavo")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Noveno</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Noveno")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Decimo</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Decimo")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-lg-12 barra-inicial">
			<h3 class="m-0 p-1 color-white"> Bachillerato General Unificado
			</h3>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row" id="courses-list">
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Primero de Bachillerato</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Primero de Bachillerato")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Segundo de Bachillerato</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Segundo de Bachillerato")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
			<div class="typeOfCourse">
				<h5 class="typeOfCourse--title">Tercero de Bachillerato</h5>
				<div class="gradosCalificaciones-grid">
					@foreach($courses as $course)
                		@if($course->grado == "Tercero de Bachillerato")
							<article class="gradosCalificaciones-item">
								<div class="gradosCalificaciones-curso">
									<h3 class="no-margin uppercase">
										<i class="fa fa-bookmark text-colorpined1 mr-05"></i>{{$course->grado}} {{$course->paralelo}}
									</h3>
								</div>
								<div>
									<a href="{{ route('institucionVerParalelos', $course->id)}}">
										<img src="{{secure_asset('img/informacion-boton.svg')}}" width="20" alt="">
									</a>
								</div>
							</article>
                		@endif
            		@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection