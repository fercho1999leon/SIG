@extends('layouts.master') 
@section('content')
	{{--<a class="button-br" href=" {{url('/reportePorEstudiantes/p1q1') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>--}}
	<div id="page-wrapper" class="gray-bg dashbard-1">
		@include('barra.administrador')
		<div class="row wrapper white-bg titulo-separacion noBefore">
			<div class="col-xs-12 titulo-separacion">
				<h2 class="title-page">Reporte Por Estudiantes <small>Certificados</small></h2>
				<button class="btn bg_color3 uppercase bold" id="addFecha" style="display:none;">Agregue una fecha</button>
				<input type="date" class="form-control select__header" id="inpFecha" style="display: none">
			</div>
		</div>
		<div class="row mt-1 mb350">
			<div class="p-1 white-bg">
				<table class="s-calificaciones table__reporte__estPorCurso w100">
					<tr class="table__bgBlue">
						<td class="no-border uppercase text-center">{{ $course->grado }} {{ $course->paralelo }}</td>
						{{--<td class="no-border text-center">Asistencia</td>--}}
						<!--<td class="no-border text-center">Comportamiento</td>-->
						<td class="no-border text-center">Matricula</td>
					</tr>
					@foreach($students as $student)
						<tr>
							<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
							{{--<td class="text-center">
								<a href="{{ route('certificadoAsistencia', ['idAlumno' => $student->idStudent]) }}" class="rep reportePorEstudiante__download-icon" download><i class="fa fa-download"></i></a>
							</td>--}}
							<!--
								<td class="text-center">
									<div class="dropdown">
										<button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<a 
												class="rep reportePorEstudiante__download-icon" 
												download><i class="fa fa-download"></i>
											</a>
										</button>
										<div class="dropdown-menu p-4" aria-labelledby="dropdownMenuButton" >
											<div class="calificaciones__dropDown-grid">
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p1q1']) }}" class="calificaciones__dropDown__item-link border-bottom" target="_blank" class="dropdown-item">
													1er Parcial del 1er Quimestre
												</a>
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p2q1']) }}" class="calificaciones__dropDown__item-link border-bottom" target="_blank" class="dropdown-item">
													2do Parcial del 1er Quimestre
												</a>
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p3q1']) }}" class="calificaciones__dropDown__item-link border-bottom" target="_blank" class="dropdown-item">
													3er Parcial del 1er Quimestre
												</a>
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p1q2']) }}" class="calificaciones__dropDown__item-link border-bottom" target="_blank" class="dropdown-item">
													1er Parcial del 2do Quimestre
												</a>
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p2q2']) }}" class="calificaciones__dropDown__item-link border-bottom" target="_blank" class="dropdown-item">
													2do Parcial del 2do Quimestre
												</a>
												<a href="{{route('certificadoComportamiento', ['idAlumno' => $student->idStudent, 'parcial' => 'p3q2']) }}" class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item">
													3er Parcial del 2do Quimestre
												</a>
											</div>
										</div>
									</div>
								</td>
							-->
							<td class="text-center">
								<a href="{{ route('cerMatricula', ['idAlumno' => $student->idStudent]) }}" class="rep reportePorEstudiante__download-icon"><i class="fa fa-download"></i></a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	@endsection
@section('scripts')
<script>
	$('#inpFecha').change(function() {
		$('.rep').attr('fecha', $(this).val());
		$('.rep').click(function (e) {
			e.preventDefault();    
			window.location.href = $(this).attr('href') + "/" +  $(this).attr('fecha');
		});
	})
</script>
@endsection