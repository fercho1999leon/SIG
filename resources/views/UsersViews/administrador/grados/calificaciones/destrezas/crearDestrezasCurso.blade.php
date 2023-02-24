@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas Curso
				<small>Crear</small>
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
		<div class="col-xs-12 ">
			<div class="crearDestrezasCurso-grid">
				<div>
					<select name="" id="" class="form-control">
						<option value="">Selecciones una destreza...</option>
					</select>
				</div>
				<div class="crearDestrezasCurso-tablas-grid white-bg pined-table-responsive">
					<div>
						<table class="s-calificaciones w100">
							<tr class="table__bgBlue">
								<td class="text-center no-border">#</td>
								<td class=" no-border">Estudiante</td>
							</tr>
							<tr>
								<td class="text-center">1</td>
								<td>Miguel Vinicio Bonifaz Calderon</td>
							</tr>
						</table>
					</div>
					<div>
						<table class="s-calificaciones">
							<tr class="table__bgBlue">
								<td class="text-center no-border bold">I</td>
								<td class="text-center no-border bold">EP</td>
								<td class="text-center no-border bold">A</td>
							</tr>
							<tr>
								<td class="text-center p-0" height="40"><input type="radio"></td>
								<td class="text-center p-0" height="40"><input type="radio"></td>
								<td class="text-center p-0" height="40"><input type="radio"></td>
							</tr>
						</table>
					</div>
					<div class="">
						<button class="btn btn-lg btn-primary">Crear</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection