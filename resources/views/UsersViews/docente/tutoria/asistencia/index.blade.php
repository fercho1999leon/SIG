@extends('layouts.master') @section('content')
@php
	$unidad = App\UnidadPeriodica::unidadP();
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Asistencia</h2>
			<select class=" form-control select__header" id="mySelect">
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
		</div>
	</div>
	@include('partials.asistencia.asistenciaParcial')
</div>
{{-- modal agregar agregar asistencia curso--}}
@include('partials.modals.asistenciaParcial')
@endsection
@section('scripts')
<script>
	const selectParcial = document.getElementById('mySelect');
	const url = window.location.origin
	const idCurso = '{{$course->id}}';
	if (selectParcial) {
		selectParcial.addEventListener('change', function() {
			const parcial = selectParcial.value
			const newurl = `${url}/Tutoria/Asistencia/${idCurso}/${parcial}`
			location.href = newurl;
		})
	} else {
		console.log('Error al obtener el select');
	}
</script>

@endsection