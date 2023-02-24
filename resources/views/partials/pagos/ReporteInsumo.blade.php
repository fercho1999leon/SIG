<form action="{{ route('InsumoInstitucion') }}" class="pagos__rubrosPorFecha" method="POST" id="ReporteInsumo" style="display: none">
	{{ csrf_field() }}
	<div></div>
	<div>
		@include('partials.pagos.selectReportes', [
			'option' => 'ReporteInsumo',
			'optionid' => 7,
			])
	</div>	
	<div class="flex">
					<div>
						<label for="">Tipo</label>
						<select class="form-control" name="rubro_insumo" >
							@foreach ($rubros as $rubro)
								<option value="{{ $rubro->id}}">{{ $rubro->tipo_rubro }}</option>						
							@endforeach
							<option value="Otro">OTRO</option>
						</select>
					</div>
					<div>
						<label for="">Mes</label>
						<select class="form-control" name="mes_insumo" >
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
		<div>
			<div>
			<label for=""></label>
			<button type="submit" class="ml-6 mt-5 mb-0 btn btn-info">
				<i class="fa fa-file-excel-o"></i>
			</button>
		</div>
		</div>
	</div>
</form>