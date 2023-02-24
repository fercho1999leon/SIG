@extends('layouts.master') 
<a class="button-br" href="{{ route('institucionParalelo') }}">
	<button>
		<img src="../img/return.png" alt="" width="17">Regresar
	</button>
</a>
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="wrapper wrapper-content">
		<div class="ibox  collapsed">
			<div class="text-center">
				<a class="collapse-link text-center btn btn-lg bg_color3 w250">INFORMACIÓN</a>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<table class="s-calificaciones margin-auto">
							<tr>
								<td class="text-right bg_color7 no-border"><strong>Curso</strong></td>
								<td class="text-left">
									@if($course->grado != null)
										{{ $course->grado }}
									@endif
									@if($course->paralelo != null)
										{{ $course->paralelo }}
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-right bg_color7 no-border"><strong>Tutor/ Dirigente</strong></td>
								<td class="text-left">
									<!--  Muestra nombres y apellidos del tutor-->
									@foreach($teachers as $teacher)
										@if($teacher->id==$course->idProfesor)
											{{ $teacher->nombres }} {{ $teacher->apellidos }}
										@endif
									@endforeach
								</td>
							</tr>
							<tr>
								<td class="text-right bg_color7 no-border"><strong>Aula Asignada</strong></td>
								<td class="text-left">
									@if($course->idAula !=null)
										{{ $course->idAula }}
									@endif
								</td>
							</tr>
							
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="ibox  collapsed mt-1">
			<div class="text-center">
				<a class="collapse-link text-center btn btn-lg bg_color3 w250">LISTA DE ESTUDIANTES</a>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="widget widget-tabs">
							<div class="tabs-container">
								
								<div class="tab-content">
									<div id="tab-1" class="tab-pane active">
										<table class="s-calificaciones s-calificaciones--trGris margin-auto" width="75%">
											<tr class="table__bgBlue">
												<td width="10" class="text-center no-border">#</td>
												<td class="no-border">ESTUDIANTE</td>
											</tr>
											@foreach($students as $student)
											<tr>
												<td class="text-center">{{ $count++ }}</td>
												<td>{{ $student->nombres }} {{ $student->apellidos }}</td>
											</tr>
											@endforeach
										</table>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection