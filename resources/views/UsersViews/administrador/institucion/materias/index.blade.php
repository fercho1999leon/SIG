@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Institución
				<small> Materias-Asignaturas</small>
			</h2>
		</div>
	</div>
	<div class="row mb350">
		<div class="col-lg-12">
			@if($regimen=='Regular')
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Inicial </span>
				</h3>
				<div class="card-asistencia">
					@foreach($courses->where('seccion', 'EI') as $course)
						<div class="lista_alumnos">
							<article class="dirInformacion__cursos--item">
								<div class="dirInformacion__cursos--info">
									<h3>
										<a href="{{ route('institucionVerMaterias', $course->id)}}">
											{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
										</a>
									</h3>
								</div>
							</article>
						</div>
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Primero </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Primero')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Segundo </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Segundo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Tercero </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Tercero')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Cuarto </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Cuarto')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Quinto </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Quinto')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Sexto </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Sexto')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Septimo </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Septimo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Octavo </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Octavo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Noveno </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Noveno')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Decimo </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'EGB') as $course)
						@if ($course->grado == 'Decimo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Primero de Bachillerato </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'BGU') as $course)
						@if ($course->grado == 'Primero de Bachillerato')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Segundo de Bachillerato </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'BGU') as $course)
						@if ($course->grado == 'Segundo de Bachillerato')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Tercero de Bachillerato </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses->where('seccion', 'BGU') as $course)
						@if ($course->grado == 'Tercero de Bachillerato')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
			@else
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Secundaria </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses as $course)
						@if($course->grado=='Octavo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												Secundaria {{$course->paralelo}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Bachillerato </span>
				</h3>
				<div class="card-asistencia">
					@foreach ($courses as $course)
						@if($course->seccion=='BGU')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('institucionVerMaterias', $course->id)}}">
												{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>

@endsection