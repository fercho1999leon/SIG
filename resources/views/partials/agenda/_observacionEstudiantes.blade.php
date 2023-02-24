<div class="r-calificacioneshijo-item ibox m-0 border-bottom">
		<header class="r-calificaciones-header flex justify-center align-items-center">
			<h3 class="r-calificacioneshijo-materia">
				@if ($classDay->observacionEstudiantes->isEmpty())
					No Existen estudiantes con observación
				@else
					Observación a estudiantes ({{count($classDay->observacionEstudiantes)}})
				@endif
			</h3>
			<a class="collapse-link">
				<i class="fa fa-chevron-down" style="color: #3a3a3a;font-size:20px"></i>
			</a>
		</header>
		<section class="r-calificaciones-section">
			<div class="ibox-content p-0 no-border" style="display: none;">
				@foreach ($classDay->observacionEstudiantes as $student)
					<div class="agendaEscolar__observacionEstudiante-container">
						<p>
							{{$student->student->apellidos}} {{$student->student->nombres}}
						</p>
						<p class="transporte__unidad__datos" style="text-transform: none;">
							{{$student->observacion}}
							<span>Observación</span> 
						</p>
						<p></p>
						<div class="flex align-items-center">
							<a href=""  data-toggle="modal" data-target="#crearObservacion{{$student->id}}">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
							<form action="{{route($routeDelete, $student)}}" method="POST" onclick="return confirm('¿Seguro desea eliminar esta observación?');">
								{{ csrf_field() }}
								{{method_field('DELETE')}}
								<button class="icon__eliminar-btn" type="submit">
									<i class="fa fa-trash"></i>
								</a>
							</form>
						</div>
					</div>
				@endforeach
			</div>
		</section>
	</div>