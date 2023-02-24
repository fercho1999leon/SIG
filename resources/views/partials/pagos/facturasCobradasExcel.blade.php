<form action="{{ route('FacturasCobradas') }}" class="pagos__rubrosPorFecha" method="POST" id="facturasCobradasExcel" style="display: none">
	{{ csrf_field() }}
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'facturasCobradasExcel',
			'optionid' => 8,
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
	<div>
	</div>
</form>