@if ($modalCurso == 'editarCurso')
	<div class="modal fade" id="{{$modalCurso}}{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
@else
	<div class="modal fade" id="{{$modalCurso}}{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
@endif
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header titulo-separacion">
				@if ($modalCurso == 'editarCurso')
					
					<h3 class="modal-title" id="exampleModalLabel">{{App\Course::nombreCurso($course)}}</h3>
				@else
					<h3 class="modal-title" id="exampleModalLabel">{{$grado}}</h3>
				@endif
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@if ($actionRoute == 'cursosEdicionResources.update')
				<form action="{{route($actionRoute, $course)}}" method="POST">
				{{method_field('PUT')}}
			@else
				<form action="{{route($actionRoute)}}" method="POST">
			@endif
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="wrapper wrapper-content">
						<table class="table table-bordered" width="75%">
							<tbody>
								<tr>
									<td width="25%" class="text-right" style="background: #EDF3F4">
										<span> Paralelo </span>
									</td>
									<td>
										@if ($modalCurso == 'editarCurso')
											<input class="form-control" name="paralelo" type="text" value="{{old('paralelo', $course->paralelo)}}">
										@else
											<select name="paralelo" class="form-control input-sm">
												@foreach ($paralelos as $paralelo)
													<option value="{{$paralelo}}" {{old('paralelo') == $paralelo ? 'selected' : ''}}>{{$paralelo}}</option>
												@endforeach
											</select>
										@endif
										
										@if ($modalCurso == 'editarCurso')
											<input type="hidden" name="grado" value="{{$course->grado}}">
										@else
											<input type="hidden" name="grado" value="{{$grado}}">
										@endif
										@if ($modalCurso == 'editarCurso')
											<input type="hidden" name="seccion" value="{{$course->seccion}}">
										@else
											@if ($seccion == 'EI')
												<input type="hidden" name="seccion" value="{{$seccion}}">
											@elseif($seccion == 'EGB')
												<input type="hidden" name="seccion" value="{{$seccion}}">
											@else
												<input type="hidden" name="seccion" value="{{$seccion}}">
											@endif
										@endif
										<p class="errorTitle text-center alert alert-danger hidden"></p>
									</td>
								</tr>
								<tr>
									<td width="25%" class="text-right" style="background: #EDF3F4">
										<span> Cupos </span>
									</td>
									<td>
										@if ($modalCurso == 'editarCurso')
											<input type="number" class="form-control input-sm" min="1" name="cupos" value="{{old('cupos', $course->cupos)}}" required>
										@else
											<input type="number" class="form-control input-sm" min="1" name="cupos" value="{{old('cupos')}}" required>
										@endif
									</td>
								</tr>
								<tr>
									<td width="25%" class="text-right" style="background: #EDF3F4">
										<span> Dirigente </span>
									</td>
									<td>
										<div class="ui-widget">
											<select class="form-control input-sm" name="tutor">
												<option value="">Ninguno</option>
												@if ($modalCurso == 'editarCurso')
													@foreach ($docentes as $docente)
														<option value="{{$docente->id}}" {{old('tutor', $course->idProfesor == $docente->id ? 'selected' : '')}}  >{{ $docente->apellidos}} {{ $docente->nombres}}</option>
													@endforeach
												@else
													@foreach ($docentes as $docente)
														<option value="{{$docente->id}}" {{old('tutor') == $docente->id ? 'selected' : ''}} >{{ $docente->apellidos}} {{ $docente->nombres}}</option>
													@endforeach
												@endif
											</select>
										</div>
									</td>
								</tr>
								@if ($seccion == 'BGU')
									<tr>
										<td width="25%" class="text-right" style="background: #EDF3F4">
											<span> Especialización </span>
										</td>
										<td>
											<div class="ui-widget">
												@if ($modalCurso == 'editarCurso')
													<input type="text" name="especializacion" class="form-control" value="{{old('especializacion',$course->especializacion)}}" >
												@else
													<input type="text" name="especializacion" class="form-control" value="{{old('especializacion')}}" >
												@endif
											</div>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">GUARDAR</button>
				</div>
			</form>
		</div>
	</div>
</div>