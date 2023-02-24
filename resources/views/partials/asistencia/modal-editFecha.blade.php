<div class="modal fade" id="editFecha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Fecha</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-3"></div>
						<div class="col-xs-6">
							<table class="mb-1 s-calificaciones w100">
								<tr>
									<td class="uppercase bold" width="100%">
										<label for="editFecha">Justificada</label>
									</td>
									<td>
										<input onclick="functionFalta()" id="edit-justificada" type="radio" name="1" checked>
									</td>
								</tr>
								<tr>
									<td class="uppercase bold">
										<label for="editFecha1">Injustificada</label>
									</td>
									<td>
										<input onclick="functionFalta()" id="edit-injustificada" type="radio" name="1">
									</td>
								</tr>
							</table>
						</div>
						<div class="col-xs-3"></div>
					</div>
					<div id="editFecha-textarea">
						<label for="">Motivo</label>
						<textarea class="form-control" name="" cols="30" rows="4"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Actualizar</button>
				</div>
			</div>
		</div>
	</div>