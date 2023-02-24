<label for="">Seleccione una opción...</label>
<div class="flex">
	<select class="form-control selectReportes" data-optionid="{{$optionid}}">
		<option value="reporteDiario" {{$option === 'reporteDiario' ? 'selected' : ''}}>Reporte Diario</option>
		<option value="cuentasPorCobrar" {{$option === 'cuentasPorCobrar' ? 'selected' : ''}}>Reporte cuentas por cobrar</option>
        <option value="cuentasPorCobrarExcel" {{$option === 'cuentasPorCobrarExcel' ? 'selected' : ''}}>Reporte cuentas por cobrar Excel</option>
		<option value="documentosCobro" {{$option === 'documentosCobro' ? 'selected' : ''}}>Reporte documentos de cobro</option>
		<option value="descuentos100" {{$option === 'descuentos100' ? 'selected' : ''}}>Estudiantes con becas del 100%</option>
		<option value="reporteDiarioGeneral" {{$option === 'reporteDiarioGeneral' ? 'selected' : ''}}>Reporte Diario General</option>
		<option value="reporteEnvioMensajesExcel" {{$option === 'reporteEnvioMensajesExcel' ? 'selected' : ''}}>Reporte Envio Mensajes Excel</option>
        <option value="ReporteInsumo" {{$option === 'ReporteInsumo' ? 'selected' : ''}}>Deudas por Mes Excel</option>
        <option value="facturasCobradasExcel" {{$option === 'facturasCobradasExcel' ? 'selected' : ''}}>Facturas Cobradas Excel</option>
	</select>
</div>