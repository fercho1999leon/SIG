@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Junta de curso
				<small>promedio asignaturas</small>
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
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td class="text-center">Aisgnatura</td>
						<td class="text-center">Docente</td>
						<td class="text-center">Nota parcial</td>
					</tr>
					<tr>
						<td class="text-center">0.00</td>
						<td class="text-center">0.00</td>
						<td class="text-center">0.00</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection