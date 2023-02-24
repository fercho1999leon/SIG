@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Planificaciones <small>Curso</small> </h2>
			<a class="title-page btn btn-black">Descargar</a>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">
					@include('partials.planificacion.tabla-planificacion')
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection