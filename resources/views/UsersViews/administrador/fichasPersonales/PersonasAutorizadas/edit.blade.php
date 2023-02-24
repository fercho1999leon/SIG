@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('personas-autorizadas.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Personas Autorizadas</h2>
		    </div>
		</div>
		<div class="wrapper bg-white pt-6 rounded-lg mt-2" id="personas_autorizadas">
			<form action="{{route('personas-autorizadas.update', $user)}}" method="post">
				{{ csrf_field() }}
				{{method_field('PUT')}}
				@include('partials.personasAutorizadas.formulario')
				<div class="text-right">
					<input type="submit" class="mb-1 btn btn-primary btn-lg" value="ACTUALIZAR">
				</div>
			</form>
        </div>
	</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function() {
		$('.estudiantes').select2();
	});
</script>
@endsection
