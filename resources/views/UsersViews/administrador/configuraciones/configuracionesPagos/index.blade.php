@php
    $permiso = App\Permiso::desbloqueo('configuracionesPagos');
@endphp
@extends('layouts.master') 
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
<a class="button-br" href="{{route('configuraciones')}}">
	<button>
		<img src="../img/return.png" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Configuraciones
				<small>Pagos</small>
			</h2>
			<a href="{{route('becas') }}" class="destreza__destreza-crear title-page table__bgBlue">Becas o Descuentos</a>
		</div>				
		
	</div>
	<div class="row wrapper white-bg directorPerfil-info"></div>
		<div class="row mt-1">
			<div class="col-xs-12">
				<div class="panel panel-default p-1">
					<div>
						@if(!$carrers->isEmpty())
							@foreach($carrers as $carrer)
								<div class="col-xs-12 p-1 bg-black">
									<h1 class="text-uppercase text-white" style="text-align: center">{{$carrer->nombre}}</h1>
								</div>
								@foreach($courses as $course)
									@if($course->id_career == $carrer->id)
										@include('UsersViews.administrador.configuraciones.configuracionesPagos._cursoIndividual')
									@endif
								@endforeach
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
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
@section('scripts')
<script>
	var url = window.location.origin
	function eliminarRubro(idPago) {
		Swal.fire({
			title: '¿Seguro desea eliminar este rubro?',
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
						url: "{{route('configuraciones_EliminarPago',[''])}}"+'/'+idPago,
						data: {
							'_token': $('input[name=_token]').val(),
							'_method': 'DELETE'
						},
						success: function (response) {
							$('#'+idPago).css('display', 'none')
							Swal.fire(
								'El rubro a sido eliminado!',
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