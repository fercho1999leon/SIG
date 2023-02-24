@extends('layouts.master') 
@section('content')
<a class="button-br" href=" {{route('transporte')}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Transporte <small>Unidad</small></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-1">
			<div class="pined-table-responsive">
				<div class="transporte-container">
					<div class="transporte__unidad mb-1">
						<table class="w100 s-calificaciones badge-white">
							<thead class="transporte__tableHeader">
								<tr>
									<td class="no-border" colspan="2">
										<h3 class="m-0 text-center">Unidad {{$transporte->unidad}}</h3>
									</td>
								</tr>
							</thead>
							<tr>
								<td class="no-border transporte__unidad__datos">{{$transporte->chofer}} <span>Chofer</span></td>
								<td class="no-border transporte__unidad__datos">{{$transporte->placa}}<span>Placa</span></td>
							</tr>
							<tr>
								<td class="no-border transporte__unidad__datos">{{$transporte->ruta}} <span>Ruta</span></td>
								<td class="no-border transporte__unidad__datos">{{$transporte->rutaDetalle}} <span>Detalles de la ruta</span></td>
							</tr>
							<tr>
								<td class="no-border transporte__unidad__datos">{{$transporte->celular}} <span>Celular</span></td>
								<td class="no-border transporte__unidad__datos" style="text-transform: initial">
									@if ($transporte->correo == !null)
										{{$transporte->correo}} 
									@else
										<small>No tiene un correo asignado.</small>
									@endif
									<span>Correo</span>
								</td>
							</tr>
						</table>
					</div>
					@foreach ($courses as $course)
						@if (count($estudiantes->where('idCurso', $course->id)) > 0)
							<h3 class="a-btn__cursos uppercase"> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </h3>
							<table class="w100 s-calificaciones badge-white">
								<tr class="table__bgBlue">
									<td colspan="2" class="text-center uppercase">Estudiantes</td>
								</tr>
								@foreach ($estudiantes->where('idCurso', $course->id) as $estudiante)
									<tr>
										<td>{{$estudiante->apellidos}} {{$estudiante->nombres}}</td>
									</tr>
								@endforeach
							</table>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection