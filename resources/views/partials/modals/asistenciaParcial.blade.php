<div class="modal fade" id="asistenciaCurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Asistencia del curso {{App\Course::nombreCurso($course)}}</h4>
			</div>
			<form action="{{route('asistencia.cursoPorParcial', [$course->id, $parcial])}}" method="POST">
				{{ csrf_field() }}
				<div class="modal-body">
					<input type="text" name="asistencia" class="form-control" value="{{$asistenciaDelCurso->asistencia}}">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>