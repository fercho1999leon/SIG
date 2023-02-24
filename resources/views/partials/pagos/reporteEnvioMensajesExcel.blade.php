<form action="{{ route('exel_envio_mensajes') }}" class="pagos__rubrosPorFecha" method="POST" id="reporteEnvioMensajesExcel" style="display: none">
	{{ csrf_field() }}
	<div></div>
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'reporteEnvioMensajesExcel',
			'optionid' => 6,
			])
	</div>
	<div>
		<label for="">Fecha desde:</label>
		<input type="date" name="desde" class="form-control" required>
	</div>
	<div class="flex">
		<div>
			<label for="">Fecha hasta:</label>
			<input type="date" name="hasta" class="form-control" required>
		</div>
		<div>
			<label for=""></label>
			<button type="submit" class="ml-6 mt-0 mb-0 btn btn-info">
				<i class="fa fa-file-excel-o"></i>
			</button>
		</div>
	</div>
</form>