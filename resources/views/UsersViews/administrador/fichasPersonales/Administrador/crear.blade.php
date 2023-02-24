@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('administrativos') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
       	@php
       		$tipo_usuario = 'Administrador';
       	@endphp
        @include('partials.fichas.fichasAdministrativoCrear', [
			'perfil' => 'Administrador'
		])
    </div>
@endsection

<script>
	var input = document.getElementById('porcentaje_discapacidad');
    var input2 = document.getElementById('numCarnetDiscapacidad');
    var input3 = document.getElementById('tipoDiscapacidad');
    var input4 = document.getElementById('tipoEnfermedadCatastrofica');

	function carg(elemento) {
  d = discapacidad.value;

  if(d == "1"){
	$("#numCarnetDiscapacidad").prop('disabled', false);
	$("#porcentaje_discapacidad").prop('disabled', false);
	$("#tipoDiscapacidad").prop('disabled', false);
	$("#tipoEnfermedadCatastrofica").prop('disabled', false);
  }else{	  
	$("#numCarnetDiscapacidad").prop('disabled', true);
	$("#porcentaje_discapacidad").prop('disabled', true);
	$("#tipoDiscapacidad").prop('disabled', true);
	$("#tipoEnfermedadCatastrofica").prop('disabled', true);
  }
}
</script>

