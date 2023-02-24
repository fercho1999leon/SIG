@extends('layouts.master') 
@section('content')
@php
	use App\Student2;
	use App\Student2Profile;
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Transporte</h2>
			<a href=" {{route('transporte-crearRuta')}} " class="title-page btn btn-black">
				Crear Unidad
            </a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-1">
			<div class="p-1">
				<p class="bold text-4xl">TRANSPORTES INSTITUCIONALES</p>
				<div class="transporte-grid">
					@forelse ($unidades as $unidad)
						@php
							$estudiantesHombres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')->where('students2.sexo','Masculino')->where('students2_profile_per_year.transporte_id', $unidad->id)->get();
							
							$estudiantesMujeres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')->where('students2.sexo','Femenino')->where('students2_profile_per_year.transporte_id', $unidad->id)->get();
						@endphp
						<div class="transporte-item" id="{{$unidad->id}}">
							<div class="transporte-content">
								<div class="transporte__titutloUnidad">
									<h3 class="transporte__unidad__datos">{{$unidad->unidad}}<span>Unidad</span></h3>
									<a href=" {{route('transporte-reporte', $unidad->id)}} " class="transporte__downloadReport">
										<img src="{{secure_asset('img/file-download.svg')}}"width="15" alt="">
									</a>
								</div>
								<h3 class="transporte__unidad__datos">{{$unidad->ruta}}<span>Ruta</span> </h3>
								<h3 class="transporte__unidad__datos">{{$unidad->chofer}}<span>Chofer</span> </h3>
							</div>
							<div class="transporte__footer">
								<div class="transporte__estudiantes">
									<span>
										<img src=" {{secure_asset('img/hombreS.svg')}} " width="20" alt=""> 
										{{count($estudiantesHombres)}}
									</span>
									<span>
										<img src=" {{secure_asset('img/mujerS.svg')}} " width="20" alt="">
										{{count($estudiantesMujeres)}}
									</span>
								</div>
								<div class="transporte__acciones">
									<a href="{{route('transporte-ver', $unidad->id)}}">
										<i class="fa fa-eye icon__ver"></i>
									</a>
									<a href="{{route('transporte-editar', $unidad->id)}}">
										<i class="fa fa-pencil a-fa-pencil__matricula"></i>
									</a>
									<div onclick="eliminarTransporte({{$unidad->id}})">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="icon__eliminar-btn">
											<i class="fa fa-trash icon__eliminar"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					@empty
						<p>No existen unidades</p>
					@endforelse
				</div>
				<div class="mt-10">
					<p class="bold text-4xl">TRANSPORTES PRIVADOS</p>
					<div class="transporte-grid">
						@forelse ($unidadesPrivadas as $unidad)
							<div class="transporte-item" id="{{$unidad->id}}">
								<div class="transporte-content">
									<h3 class="transporte__unidad__datos">{{$unidad->placa}}<span>Placa</span> </h3>
									<h3 class="transporte__unidad__datos">{{$unidad->chofer}}<span>Chofer</span> </h3>
									<h3 class="transporte__unidad__datos">{{$unidad->celular}}<span>Celular</span> </h3>
									<h3 class="transporte__unidad__datos">{{$unidad->correo}}<span>Correo</span> </h3>
								</div>
								<div class="transporte__footer">
									<div class="transporte__estudiantes">
										
									</div>
									<div class="transporte__acciones">
										<a href="{{route('transporte-editar', $unidad->id)}}">
											<i class="fa fa-pencil a-fa-pencil__matricula"></i>
										</a>
										<div onclick="eliminarTransporte({{$unidad->id}})">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="icon__eliminar-btn">
												<i class="fa fa-trash icon__eliminar"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						@empty
							<p>No existen unidades privadas</p>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script>
		var url = window.location.origin
		function eliminarTransporte(idTransporte) {
			Swal.fire({
				title: '¿Seguro desea eliminar esta unidad?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "POST",
							url: `${url}/transporte/delete/${idTransporte}`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idTransporte).css('display', 'none')
								Swal.fire(
									'Unidad Eliminada!',
									'',
									'success'
								)
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});
						
				}
			})
		}
	</script>
@endsection