@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('aulicas.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg " >
            <div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Observaciones Aulicas<small> / {{$docente->apellidos}} {{$docente->nombres}}</small></h2>
            </div>
		</div>
        <div class="row mt-1 mb350">
			<div class="col-xs-12">
				<div class="panel max-w-2xl mx-auto p-6">
					<form class="form__osbervacionesAulicas" action="{{route('observacionesAulicas.store', $docente)}}" method="POST">
						{{ csrf_field() }}
						@include('UsersViews.administrador.observacionesAulicas._formulario')
					</form>
				</div>
			</div>
        </div>
	</div>
	<script src=" {{secure_asset('ckeditor/ckeditor.js')}} "></script>
	<script>
		ClassicEditor
			.create(document.querySelector('#editor1'))
			.catch(error => {
				console.error(error);
			});
		ClassicEditor
			.create(document.querySelector('#editor2'))
			.catch(error => {
				console.error(error);
			});
	</script>
@endsection
@section('scripts')
	<script>
		const selectAsignatura = $('#asignaturas');
		const inputGrado = $('.grado')
		const checkboxGuardar = $('#guardar')
		const btnSubmit = $('#submit')
		selectAsignatura.change(function() {
			let grado = $('#asignaturas option:selected').data('grado')
			for (let i = 0; i < inputGrado.length; i++) {
				const element = inputGrado[i];
				element.setAttribute('value', grado)
			}
		})
		
		checkboxGuardar.click(function() {
			if ($(this).is(":checked")) {
				btnSubmit.text('FINALIZAR')
			} else {
				btnSubmit.text('GUARDAR')
			}
		})
	</script>
@endsection

