<div class="pagos__rubrosPorFecha" method="GET" id="reporteEstudiantesBecados" style="display:none">
	<div></div>
	<div>
	</div>
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'descuentos100',
			'optionid' => 4,
			])
	</div>
	<div>
		<label for=""></label>
		<button class="m-0 btn btn-black" data-toggle="modal" data-target="#estudiantesConBeca_Descuento">Becas/Descuentos del 100%</button>
	</div>
</div>