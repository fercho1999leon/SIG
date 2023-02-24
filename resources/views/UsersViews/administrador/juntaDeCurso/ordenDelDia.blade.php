@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Junta de curso
				<small>orden del día</small>
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
			<div class="text-center">
				<button data-toggle="modal" data-target="#agregarPunto" class="btn dirConfiguraciones__instituto--agregarInfo">AGREGAR PUNTO</button>
			</div>
			<div class="white-bg p-1 pined-table-responsive mt-1">
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td class="text-center">#</td>
						<td class="text-center">Nombre</td>
						<td class="text-center">Si</td>
						<td class="text-center">No</td>
						<td class="text-center">Observación</td>
					</tr>
					<tr>
						<td class="text-center">1</td>
						<td>Nombre------</td>
						<td class="text-center bold">X</td>
						<td class="text-center bold"></td>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, debitis cumque rerum excepturi impedit fugiat?</td>
						<td class="text-center">
							<button data-toggle="modal" data-target="#editarPunto"  class="bg-none no-border">
								<i class="icon__ver fa fa-pencil"></i>
							</button>
						</td>
						<td class="text-center">
							<button class="icon__eliminar-btn">
								<i class="fa fa-trash"></i>
							</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Agregar Punto -->
<div class="modal fade" id="agregarPunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">AGREGAR PUNTO</h4>
			</div>
			<div class="modal-body">
				<div class="grid-form">
					<p class="no-margin grid-form-p">Nombre: </p>
					<input type="text" class="form-control" id="bank" placeholder="Teresa Correa Zambrano" name="bank">
					<p class="no-margin grid-form-p">Observacion: </p>
					<input type="text" class="form-control" id="bank" placeholder="Secretaria General" name="bank">
					<p class="no-margin grid-form-p">----: </p>
					<div>
						<label for="si">Si </label>
						<input id="si" type="radio" name="ordenDelDia__radio">
						<label for="no">No </label>
						<input id="no" type="radio" name="ordenDelDia__radio">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
				<button type="button" class="btn btn-primary">AGREGAR</button>
			</div>
		</div>
	</div>
</div>
<!-- Editar Punto -->
<div class="modal fade" id="editarPunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">EDITAR PUNTO</h4>
			</div>
			<div class="modal-body">
				<div class="grid-form">
					<p class="no-margin grid-form-p">Nombre: </p>
					<input type="text" class="form-control">
					<p class="no-margin grid-form-p">Observacion: </p>
					<input type="text" class="form-control" >
					<p class="no-margin grid-form-p">----: </p>
					<div>
						<label for="si">Si </label>
						<input id="si" type="radio" name="ordenDelDia__radio">
						<label for="no">No </label>
						<input id="no" type="radio" name="ordenDelDia__radio">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
				<button type="button" class="btn btn-primary">AGREGAR</button>
			</div>
		</div>
	</div>
</div>
@endsection