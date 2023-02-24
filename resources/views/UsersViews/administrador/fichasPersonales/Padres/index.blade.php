@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('padres');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Fichas Personales  Padre / Madre</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
			@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
	        <div class="agregarSeccionCont">
				<a href="{{ route('padresCrear') }}">
					<button class="btn dirConfiguraciones__instituto--agregarInfo">Agregar nuevo Padre/Madre</button>
				</a>
			</div>
			@endif
			<hr class="dirConfiguraciones__instituto--hr">
        	@include('partials.fichas.fichasPadres')
        </div>
	</div>
	{{-- modal para ver la información del padre --}}
	<div class="modal fade" id="detallePadre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
@endsection
@section('scripts')
<script>
	$('.icon__ver').click(function() {
		$.ajax({
			type: "GET",
			url: $(this).data('route'),
			success: function (response) {
				$('#detallePadre').html(response)
				$('#detallePadre').modal('show')
			}, error: function() {
				console.log('Sucedio error al traer la información del padre')
			}
		});
	})

</script>
@endsection
