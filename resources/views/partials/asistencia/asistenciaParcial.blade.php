@php
$permiso = App\Permiso::desbloqueo('asistencia');
@endphp
<div class="row mt-1 mb350">
	<div class="col-lg-12">
		<div class="white-bg pined-table-responsive">
			<div class="asistencia__gridTables">
				<div class="lg:pr-10 w-full">
					<table class="s-calificaciones mb-8 w-full">
						<tr class="table__bgBlue">
							<td width="5" class="text-center no-border">#</td>
							<td class=" no-border">Estudiante</td>
							<td class="text-center no-border bold">A</td>
							<td class="text-center no-border bold">FJ</td>
							<td class="text-center no-border bold">FI</td>
							<td class="no-border" data-toggle="modal" data-target="#myModal" style="display:none">
								<a class="pointer">
									<img src=" {{secure_asset('img/circle-more.svg')}} " width="20" alt="">
								</a>
							</td>
							<td colspan="2" class="no-border"></td>
						</tr>
						@foreach($students as $student)
								<td class="text-center">{{ $count }}</td>
								<td style="text-transform: uppercase;">{{ $student->apellidos }} {{ $student->nombres }}</td>
								<td class="text-center p-0" height="40">
									{{($student->asistenciaParcial($parcial)==null ? 0 : $student->asistenciaParcial($parcial)->atrasos)}}
								</td>
								<td class="text-center p-0" height="40">
									{{($student->asistenciaParcial($parcial)==null ? 0 : $student->asistenciaParcial($parcial)->faltas_justificadas)}}
								</td>
								<td class="text-center p-0" height="40">
									{{$student->asistenciaParcial($parcial)==null ? 0 : $student->asistenciaParcial($parcial)->faltas_injustificadas}}
								</td>
								<td width="5" class="text-center">
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<a class="ReporteAsistencia"
										@if (session('user_data')->cargo === 'Administrador')
											href="{{ route('asistenciaReportStudent', [$student->id, $parcial])}}"
										@else
											href="{{ route('asistenciaTutoriaEstudiante', [$student->id, $parcial])}}"
										@endif
									>
										<i class="fa fa-pencil icon__ver"></i>
									</a>
									@endif
								</td>
							</tr>
							@php
								$count++
							@endphp
						@endforeach
					</table>
				</div>
				<table class="s-calificaciones ">
					<tr class="table__bgBlue">
						<td>
							Curso
						</td>
						<td class="text-center">N. de asistencia</td>
						<td class="no-border"></td>
					</tr>
					<tr>
						<td>
							{{$course->grado}} {{$course->especialzacion}} {{$course->paralelo}}
						</td>
						<td width="1" class="text-center">
							{{$asistenciaDelCurso->asistencia}}
						</td>
						<td width="1">
							@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
							<a href=""  data-toggle="modal" data-target="#asistenciaCurso">
								<i class="fa fa-pencil icon__ver"></i>
							</a>
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>