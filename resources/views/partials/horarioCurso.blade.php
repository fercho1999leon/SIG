<!-- Horario de Clase -->
<div class="repProfileHijo__resumen--info">
<select class="selectpicker form-control select__header" style="margin: 20px" id="selParciales">
	@foreach($unidad as $und)
	<optgroup label="{{$und->nombre}}">
		@php
		$parcialP = App\ParcialPeriodico::parcialP($und->id);
		@endphp
		@foreach($parcialP as $par )
		<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}}>{{$par->nombre}}</option>
		@endforeach
		<option value="{{$und->identificador."Q"}}" {{$und->identificador."Q" == $parcial ? 'selected' : ''}}>{{$und->nombre}}</option>
	</optgroup>
	@endforeach
</select>
</div>
<div id="H-C" class="wrapper wrapper-content" style="background: #F3F3F4">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="horario-clases">
					<div class="table-responsive">
						<table class="table ss1">
							<thead class="scheduler ss1">
								<tr>
									<th class="text-center scheduler">
										<!-- Hora -->
									</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Lunes</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Martes</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Miercoles</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Jueves</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Viernes</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Sábado</th>
									<th class="text-center scheduler" style="font-size: 1.6em;">Domingo</th>
								</tr>
							</thead>
							<tbody id="horario">
								@foreach($schedules as $schedule)
								<tr>
									<td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
										<span class="c-hour">{{ $schedule->horaInicio}}<br>
											{{ $schedule->horaFin}}
										</span>
									</td>
									@forelse ($matters->where('id', $schedule->dia1) as $matter)
									<td class="subject" style="vertical-align: middle;background: #C0392B;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia2) as $matter)
									<td class="subject" style="vertical-align: middle;background: #9B59B6;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia3) as $matter)
									<td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia4) as $matter)
									<td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia5) as $matter)
									<td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia6) as $matter)
									<td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
									@forelse ($matters->where('id', $schedule->dia7) as $matter)
									<td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">
										{{ $matter->nombre}}
									</td>
									@empty
									<td></td>
									@endforelse
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('#selParciales').change( function() {
	var id = $('#selParciales').val();
	window.location.href = "{{ route('horarioEscolarEstudiante',['']) }}/"+$('#selParciales').val();
});
</script>