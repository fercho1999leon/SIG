<table class="table" style="line-height:7px;">
	@if ($inicial == true)
	<tr>
		<td colspan="2" class="text-center uppercase bold">equivalencias cualitativas del aprendizaje</td>
		<td class="no-border" ></td>
		<td colspan="3" class="text-center uppercase bold">equivalencias cualitativas del comportamiento</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td colspan="3" class="text-center uppercase bold">Asignaturas Cualitativas</td>
		@endif
	</tr>
	<tr>
		<td width="2" class="uppercase text-center bold">a</td>
		<td class="uppercase">Adquirida</td>
		<td class="no-border"></td>
		<td width="2" class="uppercase text-center bold">a</td>
		<td class="uppercase">muy sastifactorio</td>
		<td style="font-size: 8px !important;">Lidera el cumplimiento de los compromisos establecidos para la sana convivencia.</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">EX</td>
			<td class="uppercase">Excelente</td>
			<td style="font-size: 8px !important;">Demuestra destacado desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un excelente aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td width="2" class="uppercase text-center bold">ep</td>
		<td class="uppercase">En proceso</td>
		<td class="no-border"></td>
		<td width="2" class="uppercase text-center bold">b</td>
		<td class="uppercase">sastifactorio</td>
		<td style="font-size: 8px !important;">Cumple con los compromisos establecidos para la sana convivencia social</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">mb</td>
			<td class="uppercase">muy bueno</td>
			<td style="font-size: 8px !important;">Demuestra muy buen desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td width="2" class="uppercase text-center bold">i</td>
		<td class="uppercase">Iniciado</td>
		<td class="no-border"></td>
		<td width="2" class="uppercase text-center bold">c</td>
		<td class="uppercase">poco satisfactorio</td>
		<td style="font-size: 8px !important;">Falla ocasionalmente en el cumplimiento de los compromisos establecidos.</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">b</td>
			<td class="uppercase">bueno</td>
			<td style="font-size: 8px !important;">Demuestra buen desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td width="2" class="uppercase text-center bold">n/e</td>
		<td class="uppercase">No Evaluada</td>
		<td class="no-border"></td>
		<td width="2" class="uppercase text-center bold">d</td>
		<td class="uppercase">mejorable</td>
		<td style="font-size: 8px !important;">Falla reiteradamente en el cumplimiento de los compromisos establecidos.</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">r</td>
			<td class="uppercase">regular</td>
			<td style="font-size: 8px !important;">Demuestra regular desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td width="2" class="uppercase text-center bold">e</td>
		<td class="uppercase">insatisfactorio</td>
		<td style="font-size: 8px !important;">No cumple con los compromisos establecidos para la sana convivencia social</td>
	</tr>
	@else
	<tr>
		<td colspan="3" class="text-center uppercase bold">equivalencias cualitativas del aprendizaje</td>
		<td class="no-border"></td>
		<td colspan="3" class="text-center uppercase bold">equivalencias cualitativas del comportamiento</td>
	</tr>
	<tr>
		<td>Domina los aprendizajes requeridos</td>
		<td width="40" class="uppercase text-center bold">9.00 - 10.00</td>
		<td width="40" class="uppercase text-center bold">dar</td>
		<td  class="no-border"></td>
		<td width="10" class="uppercase text-center bold">a</td>
		<td class="uppercase">muy sastifactorio</td>
		<td style="font-size: 8px !important;">Lidera el cumplimiento de los compromisos establecidos para la sana convivencia.</td>
		@if ($asignaturaCualitativa == true)
			<td width=1" class="no-border"></td>
			<td class="text-center uppercase">EX</td>
			<td class="uppercase">Excelente</td>
			<td style="font-size: 8px !important;">Demuestra destacado desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un excelente aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td>Alcanza los aprendizajes requeridos</td>
		<td class="uppercase text-center bold">7.00 - 8.99</td>
		<td class="uppercase text-center bold">aar</td>
		<td class="no-border"></td>
		<td class="uppercase text-center bold">b</td>
		<td class="uppercase">sastifactorio</td>
		<td style="font-size: 8px !important;">Cumple con los compromisos establecidos para la sana convivencia social</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">mb</td>
			<td class="uppercase">muy bueno</td>
			<td style="font-size: 8px !important;">Demuestra muy buen desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td>Esta proximo alcanzar los aprendizajes requeridos</td>
		<td class="uppercase text-center bold">4.01 - 6.99</td>
		<td class="uppercase text-center bold">paar</td>
		<td class="no-border"></td>
		<td class="uppercase text-center bold">c</td>
		<td class="uppercase">poco sastifactorio</td>
		<td style="font-size: 8px !important;">Falla ocasionalmente en el cumplimiento de los compromisos establecidos.</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">b</td>
			<td class="uppercase">bueno</td>
			<td style="font-size: 8px !important;">Demuestra buen desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td>No alcanza los aprendizajes requeridos</td>
		<td class="uppercase text-center bold">0.00 - 4.00</td>
		<td class="uppercase text-center bold">naar</td>
		<td class="no-border"></td>
		<td class="uppercase text-center bold">d</td>
		<td class="uppercase">mejorable</td>
		<td style="font-size: 8px !important;">Falla reiteradamente en el cumplimiento de los compromisos establecidos.</td>
		@if ($asignaturaCualitativa == true)
			<td class="no-border"></td>
			<td class="text-center uppercase">r</td>
			<td class="uppercase">regular</td>
			<td style="font-size: 8px !important;">Demuestra regular desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un aporte a su formación integral</td>
		@endif
	</tr>
	<tr>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td class="uppercase text-center bold">E</td>
		<td class="uppercase">insastifactorio</td>
		<td style="font-size: 8px !important;">No cumple con los compromisos establecidos para la sana convivencia social</td>
	</tr>
	@endif
</table>