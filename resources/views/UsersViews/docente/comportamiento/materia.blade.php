@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('comportamiento_docente-estudiante', ['idCurso' => $course->id, 'idMateria' => $materia->id, 'parcial' => $parcial])}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Comportamiento <small> {{$materia->nombre}} </small></h2>
			<select class="select__header form-control" id="selectParcial">
				<optgroup label="Quimestre 1">
					<option value="p1q1"{{$parcial == 'p1q1' ? 'selected' : '' }}>Q1 - Parcial 1</option>
					<option value="p2q1"{{$parcial == 'p2q1' ? 'selected' : '' }}>Q1 - Parcial 2</option>
					<option value="p3q1"{{$parcial == 'p3q1' ? 'selected' : '' }}>Q1 - Parcial 3</option>
				</optgroup>
				<optgroup label="Quimestre 2">
					<option value="p1q2"{{$parcial == 'p1q2' ? 'selected' : '' }}>Q2 - Parcial 1</option>
					<option value="p2q2"{{$parcial == 'p2q2' ? 'selected' : '' }}>Q2 - Parcial 2</option>
					<option value="p3q2"{{$parcial == 'p3q2' ? 'selected' : '' }}>Q2 - Parcial 3</option>
				</optgroup>
			</select>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-10">
				<div class="comportamiento__estudiante"></div>
				<div class="col-xs-12">
					@if ($comportamientoEstudiante == null)
						<form method="POST" action="{{route('comportamiento_docente-materia-store', ['idCurso' => $course->id, 'idMateria' => $materia->id, 'parcial' => $parcial, 'idStudent' => $student->id])}}">
							@include('partials.comportamiento.comportamiento')
						</form>
					@else
						<form method="POST" action="  ">
							{{ method_field('PUT') }}
							@include('partials.comportamiento.comportamiento')
						</form>
					@endif
				</div>
			</div>
			<div class="col-xs-1">
			</div>
		</div>
	</div>
</div>
@endsection
<script>
	function load() {
		const url = "{{route('comportamiento_docente-materia-js')}}"
		console.log(url)
		const idCurso = '{{$student->idCurso}}'
		const idStudent = '{{$student->id}}'
		const idMateria = '{{$materia->id}}'
		const selectParciales = document.getElementById('selectParcial')
		if(selectParciales) {
			selectParciales.addEventListener('change', function() {
				const parcial = selectParciales.value
				let newurl = `${url}/${idCurso}/${idMateria}/${parcial}/${idStudent}`
				location.href = newurl;
			})
		} else {
			console.log('no se pudo obtener el id del select')
		}
	}
	window.onload = load;
</script>