@extends('layouts.master')
@section('content')
	<style>
		p {
			font-weight: 400;
		}
	 .ck-editor__top {
        display: none !important;
	}
	.ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
		border:none !important;
	}
	</style>
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
					<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
						{{$docente->fecha}}
						<span>FECHA</span>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
						<div>
							{{$docente->hora_inicio}}
							<span>HORA DE INICIO</span>
						</div>
						<div>
							{{$docente->hora_fin}}
							<span>HORA FIN</span>
						</div>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
						<div>
							{{$docente->materia}}
							<span>ASIGNATURA</span>
						</div>
						<div>
							{{$docente->grado}}
							<span>GRADO</span>
						</div>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
						{{$docente->tema}}
						<span>TEMA</span>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
						{{$docente->objetivo}}
						<span>OBJETIVO</span>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
						<textarea id="editor1">
							{{$docente->observaciones}}
						</textarea>
						<span>OBSERVACIONES</span>
					</h3>
					<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
						<textarea id="editor2"> 
							{{$docente->recomendaciones}}
						</textarea>
						<span>RECOMENDACIONES</span>
					</h3>
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

		function load() {
			const ck = document.querySelector('.ck-content');
			ck.setAttribute('contenteditable', 'false');
		}
		window.onload = load;
	</script>
@endsection

