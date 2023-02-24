<div class="panel p-1 table__planificaciones">
	<table id="tableNotificaciones" class="table table-hover table-mail whitespace-no">
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>
				Archivo
			</th>
			<th>Estado</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Nombre etc etc etc etc etc</td>
				<td>
					<div class="planificaciones__archivoDescarga-container">
						<input type="file">
						<div class="planificaciones__archivoDescarga">
							<a  href="" download>Nombre del documento.....</a>
							<i class="fa fa-arrow-down" aria-hidden="true"></i>
						</div>
					</div>
				</td>
				<td>
					APROBADO
					<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
				</td>
				<td>
					<a href="">
						<i class="fa fa-pencil a-fa-pencil__matricula"></i>
					</a>
				</td>
				<td>
					<a href="" onclick="return confirm('¿Seguro desea eliminar a este estudiante?');">
						<i class="fa fa-trash icon__eliminar"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>