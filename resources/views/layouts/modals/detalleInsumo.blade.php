<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">{{$materia}}</h4>
		</div>
		<div class="modal-body">
			<table class="s-calificaciones mx-auto" style="white-space: normal">
				<tr class="table__bgBlue">
					<td class="text-center" width="5">#</td>
					<td class="text-center">Nombre Actividad</td>
					<td>Nota</td>
					<td>Observación</td>
				</tr>
				@php $cont = 0;$total = 0; $nAct = 0; $refuerzo = 0;@endphp
				@foreach($activities as $activity)
					<tr>
						@php
							$notasact = $notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->idStudent)->first();
							$nAct++;
							$nota = 0;
							$refuerzo = 0;
							if($notasact != null){
								$nota = $notasact->nota;
							}else {
								$nota = 0;
							}
							if($activity->refuerzo == 1 && $calificaciones->insumos->refuerzo == 0){
								$refuerzo = 1;
								$nAct--;
							}
						@endphp
						@if ($refuerzo == 0)
							<td class="text-center">{{ $nAct }}</td>
							<td>{{ $activity->nombre }}</td>
							<td class="text-center">{{ $nota }}</td>
							<td>{{ ($notasact == null ? "-" : $notasact->observacion) }}</td>
						@endif
					</tr>
				@endforeach
				<tr>
					<td>Promedio Total</td>
					<td colspan="2" ></td>
					<td class="text-center">{{ bcdiv($calificaciones->insumos->nota, '1', 2) }}</td>
				</tr>
			</table>
		</div>
	</div>
</div>
	