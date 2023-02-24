@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas
				<small>Crear</small>
			</h2>
		</div>
	</div>
	<div class="row mt-1 mb350">
	   <div class="col-xs-12 ">
		   <div class="agendaEscolar__crearTarea-grid crearDestreza-container">
			   <div class="agendaEscolar__crearTarea-materia-parcial">
				   <select name="" id="" class="form-control">
						  <option value="">Seleccione un curso...</option>
						  <option value="">Octavo A</option>
					  </select>
					  <select name="" id="" class="form-control">
						  <option value="">Seleccione una materia...</option>
					  </select>
			   </div>
	   			<input type="text" class="form-control" placeholder="Nombre de la destreza...">
	   			<textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Descripción de la destreza"></textarea>
				   <div class="text-center">
					   <button class="btn btn-lg btn-primary">Crear</button>
				   </div>
		   </div>
	   </div>
	</div>
</div>
@endsection