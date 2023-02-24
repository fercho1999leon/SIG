@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('configuraciones')}}">
	<button>
		<img src="../img/return.png" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Configuraciones
				<small>Asistencia</small>
			</h2>
		</div>
	</div>
	<div class="row wrapper white-bg directorPerfil-info"></div>
	<form method="post" action="">
		<div class="row mt-1">
			<div class="col-xs-6">
				<div class="panel panel-default p-1">
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Educación Inicial</button>
						</a>
						<div class="configuracionesParcial-fechas-grid configuracionesPorSeccion-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control"> 
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Días Laborables
								</p>
								<input type="number" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="panel panel-default p-1">
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Primaria</button>
						</a>
						<div class="configuracionesParcial-fechas-grid configuracionesPorSeccion-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control"> 
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Días Laborables
								</p>
								<input type="number" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="panel panel-default p-1">
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Secundaria</button>
						</a>
						<div class="configuracionesParcial-fechas-grid configuracionesPorSeccion-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control"> 
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Días Laborables
								</p>
								<input type="number" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="panel panel-default p-1">
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Bachillerato</button>
						</a>
						<div class="configuracionesParcial-fechas-grid configuracionesPorSeccion-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control"> 
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Días Laborables
								</p>
								<input type="number" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 text-center">
				<button type="submit" class="btn btn-primary btn-lg mb-2">ACTUALIZAR</button>
			</div> 
		</div>
	</form>
</div>
@endsection