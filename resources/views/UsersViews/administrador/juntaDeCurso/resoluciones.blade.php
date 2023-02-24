@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Junta de curso
				<small>resoluciones</small>
			</h2>
			<div class="select__header">
				<select name="" id="" class="form-control">
					<option value="">Q1 - Parcial 1</option>
					<option value="">Q1 - Parcial 2</option>
					<option value="">Q1 - Parcial 3</option>
					<option value="">Q2 - Parcial 1</option>
					<option value="">Q2 - Parcial 2</option>
					<option value="">Q2 - Parcial 3</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-1">
			<div class="white-bg p-1 pined-table-responsive mt-1">
				<table class="s-calificaciones">
					<tr class="table__bgBlue">
						<td class="text-center">Parcial</td>
						<td class="text-center">Quimestre</td>
						<td class="">Observación</td>
					</tr>
					<tr>
						<td class="text-center">--</td>
						<td class="text-center">--</td>
						<td class="">--</td>
						<td class="text-center">
							<button data-toggle="modal" data-target="#editarResoluciones" class="bg-none no-border">
								<i class="icon__ver fa fa-pencil"></i>
							</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Editar Punto -->
<div class="modal fade" id="editarResoluciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">---</h4>
			</div>
			<div class="modal-body">
				<div class="grid-form">
					<p class="no-margin grid-form-p">Parcial: </p>
					<select name="" id="" class="form-control">
						<option value="">--</option>
					</select>
					<p class="no-margin grid-form-p">Observacion: </p>
					<select name="" id="" class="form-control">
						<option value="">---</option>
					</select>
					<p class="no-margin grid-form-p">Observación </p>
					<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
				<button type="button" class="btn btn-primary">ACTUALIZAR</button>
			</div>
		</div>
	</div>
</div>
@endsection