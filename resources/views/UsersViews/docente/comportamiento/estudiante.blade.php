@extends('layouts.master')
@section('content')
<a class="button-br" href=" {{route('comportamiento_docente')}} ">
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
			<div class="col-xs-12">
				<div class="table-responsive">
					<table class="s-calificaciones white-bg w100">
						<tr class="table__bgBlue">
							<td width="5" class="text-center">#</td>
							<td>Estudiantes</td>
							<td width="10" class="text-center">Nota</td>
							<td>Observación - Recomendación</td>
							<td width="5"></td>
						</tr>
						@foreach ($students as $student)
							<tr>
								<td class="text-center"> {{$count++}} </td>
								<td> {{$student->apellidos}} {{$student->nombres}} </td>
								<td class="text-center">
									@forelse ($comportamientoEstudiantes->where('idStudent', $student->id)->where('parcial', $parcial)->where('idMateria', $materia->id) as $comportamiento)
										{{$comportamiento->nota}}
									@empty
										-
									@endforelse
								</td>
								<td>
									@forelse ($comportamientoEstudiantes->where('idStudent', $student->id)->where('parcial', $parcial)->where('idMateria', $materia->id) as $comportamiento)
										{{$comportamiento->observacion}}
									@empty
										-
									@endforelse
								</td>
								<td class="text-center">
									<a href=" {{route('comportamiento_docente-materia', ['idCurso' => $student->idCurso, 'idMateria' => $materia->id, 'parcial' => $parcial, 'idStudent' => $student->id])}} ">
										<i class="fa fa-pencil a-fa-pencil__matricula"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>			
		</div>
	</div>
</div>
@endsection
<script>
	function load() {
		const url = "{{route('comportamiento_docente-estudiante-js')}}"
		console.log(url)
		const idCurso = '{{$student->idCurso}}'
		const idStudent = '{{$student->id}}'
		const idMateria = '{{$materia->id}}'
		const selectParciales = document.getElementById('selectParcial')
		if(selectParciales) {
			selectParciales.addEventListener('change', function() {
				const parcial = selectParciales.value
				let newurl = `${url}/${idCurso}/${idMateria}/${parcial}`
				location.href = newurl;
			})
		} else {
			console.log('no se pudo obtener el id del select')
		}
	}
	window.onload = load;
</script>