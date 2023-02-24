@php
    $permiso = App\Permiso::desbloqueo('horariosEdicion');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
<a class="button-br" href="{{ route('configuraciones') }}">
    <button>
        <img src="img/return.png" alt="" width="17">Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg">
        <div class="col-lg-12">
            <h2 class="title-page">Configuraciones
                <small>Horarios</small>
            </h2>
        </div>
    </div>
    <!-- EI -->
	<div class="row text-center">
		<div class="col-lg-12 barra-inicial">
			<h3 class="m-0 p-1 color-white"> Carrera
			</h3>
		</div>
	</div>
	@include('partials.configuraciones.configuracionHorario', [
		'course' => $coursesEI
	])

    
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