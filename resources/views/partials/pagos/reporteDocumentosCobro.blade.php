<form class="pagos__rubrosPorFecha" action="{{route('reporteDocumentosDeCobro')}}" method="GET" id="reporteDocumentoCobro" style="display:none">
	<div></div>
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'documentosCobro',
			'optionid' => 3,
			])
	</div>
	<div>
		<label for="">Fecha desde:</label>
		<input class="form-control" name="fechaInicio" type="date" required>
	</div>
	<div class="flex">
		<div>
			<label for="">Fecha hasta:</label>
			<input type="date" name="fechaFin" class="form-control" required>
		</div>
		<div>
			<label for=""></label>
			<button type="submit" class="ml-6 mt-0 mb-0 btn btn-black">
				<i class="fa fa-download"></i>
			</button>
		</div>
	</div>
</form>