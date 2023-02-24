@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Encuesta</h2>
		</div>
	</div>
	<div class="max-w-2xl mx-auto">
		<div class="flex flex-col justify-between mt-4 lg:flex-row">
			<div></div>
			<div> 
				<select class="form-control lg:w-64">
					<option value="">Todas</option>
					<option value="">Pendientes</option>
					<option value="">Realizadas</option>
				</select>
			</div>
		</div>
		<div class="table-responsive mt-4">
			<table class="s-calificaciones bg-white w-full">
				<tr class="table__bgBlue">
					<td class="text-center">#</td>
					<td class="">nombre de la encuesta</td>
					<td class="text-center">rol</td>
					<td class="text-center">00/00/0000</td>
					<td class="text-center">state</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
			</table>
		</div>
	</div>
@endsection