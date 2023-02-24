@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('docentes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        @php
       		$tipo_usuario = 'Docente';
       	@endphp
        @include('partials.fichas.fichasAdministrativoCrear', [
			'perfil' => 'Docente'
		])
    </div>
@endsection

<script >

var input = document.getElementById('porcentaje_discapacidad');
var input2 = document.getElementById('numCarnetDiscapacidad');
var input3 = document.getElementById('tipoDiscapacidad');
var input4 = document.getElementById('tipoEnfermedadCatastrofica');
var input5 = document.getElementById('fechaInicioPeriodoSabatico');
var input6 = document.getElementById('institucionDondeCursaEstudios');
var input7 = document.getElementById('paisEstudiosId');
var input8 = document.getElementById('tituloAObtener');
var input9 = document.getElementById('poseeBecaId');
var input10 = document.getElementById('tipoBecaId');
var input11 = document.getElementById('montoBeca');
var input12 = document.getElementById('financiamientoBecaId');

//if($tipo_usuario == 'Administrador'  || $tipo_usuario = 'Docente')
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
//}

function carg2(elemento) {
  d = estaEnPeriodoSabatico.value;

  if(d == "1"){
    fechaInicioPeriodoSabatico.disabled = false;
  }else{
    fechaInicioPeriodoSabatico.disabled = true;
  }
}
function carg3(elemento) {
  d = estaCursandoEstudiosId.value;

  if(d != "8"){
    institucionDondeCursaEstudios.disabled = false;
	paisEstudiosId.disabled = false;
	tituloAObtener.disabled = false;
	poseeBecaId.disabled = false;
	tipoBecaId.disabled = false;
	montoBeca.disabled = false;
	financiamientoBecaId.disabled = false;

  }else{
    institucionDondeCursaEstudios.disabled = true;
	paisEstudiosId.disabled = true;
	tituloAObtener.disabled = true;
	poseeBecaId.disabled = true;
	tipoBecaId.disabled = true;
	montoBeca.disabled = true;
	financiamientoBecaId.disabled = true;
  }
}


</script>
