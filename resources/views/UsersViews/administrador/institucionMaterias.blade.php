@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Grados
				<small> Materias-Asignaturas</small>
			</h2>
		</div>
	</div>
	<div class="row mb350">
		<div class="col-lg-12">
			<div class="widget widget-tabs bg-none">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-2">Grados</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="tab-2" class="tab-pane  active">
							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Inicial 1 </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Inicial 1")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Inicial 2 </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Inicial 2")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Primero </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Primero")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Segundo </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Segundo")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Tercero </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Tercero")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Cuarto </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Cuarto")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Quinto </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Quinto")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Sexto </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Sexto")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Septimo </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Septimo")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Octavo </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Octavo")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Noveno </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Noveno")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Decimo </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Decimo")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Primero de Bachillerato </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Primero de Bachillerato")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>

							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Segundo de Bachillerato </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Primero de Bachillerato")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>
							
							<h3 class="a-btn__cursos">
								<span class="etiquetaLetra"> Tercero de Bachillerato </span>
							</h3>
							<div class="card-asistencia">
            					@foreach($courses as $course)
		                		@if($course->grado == "Tercero de Bachillerato")
            					<div class="panel-group">
            						<div class="panel panel-default">
               	 						<div class="dirInformacion__cursos--item">
                    						<h3 class="panel-title">
                        						<a data-toggle="collapse"> {{$course->grado}} {{$course->paralelo}} </a>
                    						</h3>
                						</div>
                    					<ul class="list-group">
                       						@foreach($matters as $matter)
												@if($matter->idCurso === $course->id)
													@if($matter->idDocente!=null)
														<p>{{$matter->nombre}} - {{$teachers[$matter->idDocente -1]->nombres}} {{$teachers[$matter->idDocente -1]->apellidos}}</p>
													@else
														<p>{{$matter->nombre}}</p>
													@endif
												@endif
											@endforeach
                    					</ul>
            						</div>
        						</div>
        						@endif
            					@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection