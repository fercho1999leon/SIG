@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{ route('institucionMaterias') }}">
	<button>
		<img src="../img/return.png" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Institución
				<small> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </small>
			</h2>
		</div>
	</div>
	<div class="row mb350">
		<div class="modal-body ">
			<div class="row">
				<div class="col-xs-12">
					<div class="white-bg">
						<div class="pined-table-responsive">
							<table class="s-calificaciones w100">
								<tr class="table__bgBlue">
									<td class="text-center">AREA</td>
									<td class="text-center">ASIGNATURA</td>
									<td class="text-center">DOCENTE</td>
								</tr>
								@foreach ($materiasFijas as $materia)
									<tr>
										<td> {{$materia->area}} </td>
										<td>{{$materia->nombre}}</td>

										@foreach ($teachers->where('userid', $materia->idDocente) as $teacher)
											<td>
												{{$teacher->apellidos}} {{$teacher->nombres}} 
											</td>
										@endforeach
									</tr>
								@endforeach
								<tr>
									<td class="no-border" colspan="3">
										<span style="visibility: hidden">.</span>
									</td>
								</tr>
								@foreach ($materiasOptativas as $materia)
									<tr>
										<td> {{$materia->area}} </td>
										<td>{{$materia->nombre}}</td>
										@foreach ($teachers->where('userid', $materia->idDocente) as $teacher)
											<td>
												{{$teacher->apellidos}} {{$teacher->nombres}} 
											</td>
										@endforeach
									</tr>
								@endforeach
								<tr>
										<td class="no-border" colspan="3">
										<span style="visibility: hidden">.</span>
									</td>
								</tr>
								@foreach ($materiasInternas as $materia)
									<tr>
										<td> {{$materia->area}} </td>
										<td>{{$materia->nombre}}</td>
										@foreach ($teachers->where('userid', $materia->idDocente) as $teacher)
											<td>
												{{$teacher->apellidos}} {{$teacher->nombres}} 
											</td>
										@endforeach
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

@endsection