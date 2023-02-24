@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas Curso
				<small>Editar</small>
			</h2>
		</div>
	</div>
	<div class="row wrapper white-bg">
		<div class="col-xs-12 profe-cuadricula lista-general p-0">
			<h3 class="m-0">
				<p class="m-05">Dirigente:
					<span class="not"></span>
				</p>
				<p class="m-05">Curso:
					<span class="not"></span>
				</p>
				<p class="m-05">Materia:
					<span class="not"></span>
				</p>
			</h3>
		</div>
	</div>
	<div class="row mt-1 mb350">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="crearDestrezas__selects-grid">
					<input type="date" class="form-control">
					<select name="" id="" class="form-control">
						<option value="">Materia...</option>
					</select>
					<select name="" id="" class="form-control">
						<option value="">???</option>
					</select>
				</div>
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td height="54" class="text-center no-border">#</td>
									<td height="54" class="no-border fz19">Estudiantes</td>
									<td class="no-border white-bg"></td>
									<td class="no-border fz19 text-center">I</td>
									<td class="no-border fz19 text-center">EP</td>
									<td class="no-border fz19 text-center">A</td>
									<td class="no-border fz19 text-center">N/E</td>
								</tr>
								<tr>
									<td class="text-center">1</td>
									<td class="">Miguel Vinicio Bonifaz Calderon</td>
									<td class="no-border"></td>
									<td>
										<input type="number" class="form-control w50px"> </td>
									<td>
										<input type="number" class="form-control w50px"> </td>
									<td>
										<input type="number" class="form-control w50px"> </td>
									<td>
										<input type="number" class="form-control w50px"> </td>
								</tr>
							</table>
						</div>
						<div>
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
								</tr>
								<tr>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection