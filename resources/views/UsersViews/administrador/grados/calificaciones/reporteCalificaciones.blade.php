@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg noBefore titulo-separacion">
		<h2 class="title-page">
			Reporte Calificaciones / Curso
		</h2>
	</div>
	<div class="wrapper wrapper-content">
		<div class="white-bg p-1">
			<div class="pined-table-responsive">
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td class="no-border uppercase">Estudiante</td>
						<td class="no-border uppercase">Comportamiento</td>
						<td class="no-border uppercase">Disciplina</td>
					</tr>
					<tr>
						<td>Miguel Vinicio Bonifaz Calderon</td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
						</td>
					</tr>
					<tr>
						<td>Miguel Vinicio Bonifaz Calderon</td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
						</td>
					</tr>
					<tr>
						<td>Miguel Vinicio Bonifaz Calderon</td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
						</td>
					</tr>
					<tr>
						<td>Miguel Vinicio Bonifaz Calderon</td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
						</td>
					</tr>
					<tr>
						<td>Miguel Vinicio Bonifaz Calderon</td>
						<td></td>
						<td></td>
						<td class="text-center">
							<a href="">
								<i class="fa fa-pencil icon__editar"></i>
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection