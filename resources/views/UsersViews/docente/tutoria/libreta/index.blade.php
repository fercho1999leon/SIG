@extends('layouts.master')
@section('content')
<div id="wrapper">
	@include('layouts.nav_bar_top')
	<div id="page-wrapper" class="gray-bg dashbard-1" style="background: #EBEBED">
		<div class="row wrapper white-bg ">
			<div class="col-xs-12 titulo-separacion noBefore">
				<h2 class="title-page">Boletin:<!-- libreta-->
					<small class="text-color7 bold">
						{{ $tutoria->grado }} {{$tutoria->especializacion}} {{ $tutoria->paralelo }}
					</small>
				</h2>
				<h2 class="title-page">REPORTES POR CURSO
				<div>
					@if( $tutoria->seccion=='EI' || $course->grado=='Primero')
						<a target="_blank" href="{{ route('destrezaCurso', ['curso' => $tutoria->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
							   Boletin Curso<!-- libreta de curso-->
						</a>
						<a target="_blank" href="{{ route('informeQuimestralDestrezas', ['curso' => $tutoria->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
							Informe Cualitativo Detallado
						</a>
					@else
						<a target="_blank" href="{{ route('reporteEstudiantes', ['idCurso' => $course->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
							Boletin Parcial <!-- libreta de curso-->
						</a>
						<a target="_blank" href="{{ route('libretaQuimestre', ['idCurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}" class="btn btn-primary calificaciones__materia-actualizar">
							Boletin <!--libreta Quimestral-->
						</a>
						<a target="_blank" href="{{ route('cuadroGeneralCursoQuimestre', ['idCurso' => $course->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
							Cuadro de Calificaciones
						</a>
					@endif
				</div>
			</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content dir-calificaciones" id="alumnos">
			<div class="row">
				<div class="col-xs-12 col-md-6 mb-1">
					<select class="selectpicker form-control" id="mySelect">
						@foreach($unidad as $und)
							<optgroup label="{{$und->nombre}}">
								@php
								$parcialP = $parciales->where('idUnidad', $und->id);
								@endphp
								@foreach($parcialP as $par )
									<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
								@endforeach
							</optgroup>
						@endforeach
					</select>
				</div>
				<div>
					<a target="_blank" href="{{ route('actaCalificacionesGeneral', ['curso' => $course->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
						Reporte General
					</a>
					<a target="_blank" href="{{ route('cuadroCalificacionesCurso', ['curso' => $course->id, 'parcial' => $parcial]) }}" class="btn btn-primary calificaciones__materia-actualizar">
						Cuadro de Calificaciones
					</a>
				</div>
			</div>
			<div class="row mb350" >
				<div class="col-lg-12">
					<div class="pined-table-responsive white-bg p-1">
						<table class="s-calificaciones" width="50%">
							<tr class="table__bgBlue">
								<td class="text-center" width="20"> #</td>
								<td>E S T U D I A N T E</td>
								<td>Boletin Parcial<!--Libreta Parcial--></td>
								<td>Boletin<!--Libreta Quimestral--></td>
                                <td>Boletin<!--Libreta Anual--></td>
							</tr>
							@foreach($students as $student)
							<tr>
								<td class="text-center">
									<span> {{$count++}} </span>
								</td>
								<td>
									@if($student->apellidos!=null)
										{{ $student->apellidos }},
									@endif
									@if($student->nombres!=null)
										{{ $student->nombres }}
									@endif
								</td>
								<td class="text-center">
									@if($course->seccion=='EI' || $course->grado=='Primero')
										<a target="_blank" href="{{ route('destrezaEstudiante', ['idEstudiante' => $student->idStudent, 'idCurso' => $tutoria->id, 'parcial' => $parcial])}}" class="btn btn-primary">
											Libreta Destrezas
										</a>
									@else
										<a target="_blank" href="{{ route('reporteEstudiante', ['idEstudiante' => $student->idStudent, 'idCurso' => $course->id, 'parcial' => $parcial])}}" class="btn btn-primary">
											 Boletin Parcial<!--Libreta Parcial-->
										</a>
									@endif
								</td>
								<td class="text-center">
									@if($course->seccion=='EI' || $course->grado=='Primero')
									@if (App\Institution::find(1)->ruc = '0992636009001')
										<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumnoDetallada', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2), 'idAlumno' => $student->idStudent ])}}" class="btn btn-primary">
											Libreta Destreza Quimestral
										</a>
									@else
										<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumno', ['curso' => $course->id, 'parcial' => $parcial,'idEstudiante' => $student->idStudent ]) }}" class="btn btn-primary">
											Libreta Destreza Quimestral
										</a>
									@endif
									@else
										<a target="_blank" href="{{ route('libretaQuimestreEstudiante', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2), 'idAlumno' => $student->idStudent ])}}" class="btn btn-primary">
											Boletin<!--Libreta Quimestral-->
										</a>
									@endif
								</td>
                                <td class="text-center">
                                    @if($course->seccion=='EI' || $course->grado=='Primero')
									<a target="_blank" href="{{ route('informeAnualDestrezasEstudiantes', ['idCrurso' => $course->id,'idAlumno' => $student->idStudent ])}}" class="btn btn-primary">
										Libreta Anual
									</a>
                                    @else
                                        <a target="_blank" href="{{ route('libretaAnualEstudiante', ['idEstudiante' => $student->id]) }}" class="btn btn-primary">
                                           Boletin Semestral<!-- Libreta Anual-->
                                        </a>
                                    @endif
                                </td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	$('#mySelect').change(function () {
		var id = "{{ $tutoria->id}}";
		window.location.href = "{{ route('tutoria_Libreta_ruta') }}/" + id + "/" +  $('#mySelect').val();
	});
</script>
@endsection

