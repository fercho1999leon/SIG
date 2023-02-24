@extends('layouts.master2') 
@section('content')
<a class="button-br" href="{{ route('agenda_Docente', 'fecha='.request('fecha')) }}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 seleccion-curso">
			<h2 class="title-page">AGENDA<small>Crear</small></h2>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="pined-table-responsive">
							<form method="post" action="{{ route('agenda_Docente_storeHora', $matter->id) }}" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
								@include('partials.crearClaseD')
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function load() {
		const yolin = document.querySelector('.file-drop-zone-title');
		yolin.innerHTML = 'Arrastre sus archivos aquí';
	}
	window.onload = load;
</script>

@endsection 
@section('scripts')
@endsection