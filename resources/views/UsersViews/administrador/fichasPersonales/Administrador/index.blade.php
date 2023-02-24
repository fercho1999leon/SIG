@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('administrativos');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        @php
        	$tipo_usuario = 'Administrador';
        @endphp
        @include('partials.fichas.fichasAdministrativo', [
			'perfil' => 'admin'
		])
	</div>
	{{-- modal para  --}}
	<div class="modal fade" id="detalleAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$('.form-elimidar').click(function(e){
    	e.preventDefault()
	});

	$('.icon__ver').click(function() {
		$.ajax({
			type: "GET",
			url: $(this).data('route'),
			success: function (response) {
				$('#detalleAdmin').html(response)
				$('#detalleAdmin').modal('show')
			}, error: function() {
				console.log('sucedio un error')
			}
		});
	})
</script>
@endsection

