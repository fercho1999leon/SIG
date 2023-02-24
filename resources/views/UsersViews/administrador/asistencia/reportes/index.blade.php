@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$unidad = App\UnidadPeriodica::unidadP();
$permiso = Permiso::desbloqueo('asistencia');
@endphp
<a class="button-br" href=" {{route('asistencia')}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">
				Reporte de Asistencia
			</h2>
			<div class="flex">
				<select class=" form-control select__header" id="selectParcial">
					@foreach($unidad as $und)
						<optgroup label="{{$und->nombre}}">
							@php
							$parcialP = App\ParcialPeriodico::parcialP($und->id);
							@endphp
							@foreach($parcialP as $par )
								@if(($par->identificador == 'q1') || ($par->identificador == 'q2'))
								@else
									<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
								@endif
							@endforeach
						</optgroup>
					@endforeach
				</select>
				<div class="dropdown">
					@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
					<button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
					</button>
					@endif
					<div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" style="left: -131px; width: 151px;">
						<div class="calificaciones__dropDown-grid">
							<a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{route('reporteAsistenciaCurso', [$course, $parcial])}}">
								Parcial
							</a>
							<a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{route('reporteAsistenciaCursoQuimestral', [$course, $parcial])}}">
								Quimestral
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="border">
					<a class="no-pointer">
						{{$course->grado}} {{$course->especialzacion}} {{$course->paralelo}}
					</a>
				</div>
			</div>
		</div>
	</div>
	@include('partials.asistencia.asistenciaParcial')
</div>
{{-- modal agregar agregar asistencia curso--}}
@include('partials.modals.asistenciaParcial')
@endsection
@section('scripts')
	<script>
		const selectParcial = document.getElementById('selectParcial');
		const url = window.location.origin
		const idCurso = '{{$course->id}}';
		if (selectParcial) {
			selectParcial.addEventListener('change', function() {
				const parcial = selectParcial.value
				const newurl = `${url}/asistencia/Reporte Curso/${idCurso}/${parcial}`
				location.href = newurl;
			})
		} else {
			console.log('Error al obtener el select');
		}


	</script>
@endsection