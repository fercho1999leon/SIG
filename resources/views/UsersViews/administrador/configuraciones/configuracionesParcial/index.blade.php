@php
    $permiso = App\Permiso::desbloqueo('configuracionesParcial');
@endphp
@extends('layouts.master') @section('content')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
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
				<small>Parcial</small>
			</h2>
		</div>
	</div>
	<div class="row wrapper white-bg directorPerfil-info"></div>
	<form method="post" action="{{ route('configuracionesParcialActualizar', $configuracion->id) }}">
		<input name="_method" type="hidden" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row mt-1">
			<div class="col-xs-12">
				<div class="panel panel-default p-1">
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre1 - Parcial 1</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p1q1FI" value="{{ $configuracion->p1q1FI }}"> 
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p1q1FF" value="{{ $configuracion->p1q1FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre1 - Parcial 2</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p2q1FI" value="{{ $configuracion->p2q1FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p2q1FF" value="{{ $configuracion->p2q1FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre1 - Parcial 3</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p3q1FI" value="{{ $configuracion->p3q1FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p3q1FF" value="{{ $configuracion->p3q1FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre1 - Examen</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="exq1FI" value="{{ $configuracion->exq1FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="exq1FF" value="{{ $configuracion->exq1FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre2 - Parcial 1</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p1q2FI" value="{{ $configuracion->p1q2FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p1q2FF" value="{{ $configuracion->p1q2FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre2 - Parcial 2</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p2q2FI" value="{{ $configuracion->p2q2FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p2q2FF" value="{{ $configuracion->p2q2FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre2 - Parcial 3</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="p3q2FI" value="{{ $configuracion->p3q2FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="p3q2FF" value="{{ $configuracion->p3q2FF }}">
							</div>
						</div>
					</div>
					<div class="configuracionesParcial__quimestre-grid">
						<a href="">
							<button class="btn dirConfiguraciones__instituto--agregarInfo">Quimestre2 - Examen</button>
						</a>
						<div class="configuracionesParcial-fechas-grid">
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de inicio
								</p>
								<input type="date" class="form-control" name="exq2FI" value="{{ $configuracion->exq2FI }}">
							</div>
							<div class="configuracionesParcial-fechas-item">
								<p class="no-margin">
									Fecha de finalización
								</p>
								<input type="date" class="form-control" name="exq2FF" value="{{ $configuracion->exq2FF }}">
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
@else
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">NO TIENE PERMISOS NECESARIOS.</h2>
            </div>
        </div>
    </div>
@endif