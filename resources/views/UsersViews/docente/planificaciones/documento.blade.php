@extends('layouts.master')
@section('content')
<a class="button-br" href="">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Planificaciones <small>Nombre de la materia / Destrezas...</small> </h2>
			<div style="display:flex;">
				<a class="title-page btn btn-black mr-1">Descargar</a>
				<a class="title-page btn btn-black">Crear planificación</a>
			</div> 
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			<div class="col-xs-12">
				@include('partials.planificacion.tabla-planificacion')
			</div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection