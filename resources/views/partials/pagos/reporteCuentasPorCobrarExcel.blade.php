<form action="{{ route('cuentas_por_cobrar_excel') }}" class="pagos__rubrosPorFecha" method="POST" id="reporteCuentasPorCobrarExcel" style="display: none">
	{{ csrf_field() }}
	<div></div>
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'cuentasPorCobrarExcel',
			'optionid' => 2,
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
			<button type="submit" class="ml-6 mt-0 mb-0 btn btn-black">
				<i class="fa fa-download"></i>
			</button>
		</div>
	</div>
</form>