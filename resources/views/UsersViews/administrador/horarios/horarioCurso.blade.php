@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
$permiso =App\Permiso::desbloqueo('horario_Escolar');
@endphp
<a class="button-br" href="{{route('horario_Escolar')}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion mt-1">
            <h2 class="title-page">
                <i class="fa fa-clock-o text-color7"></i> Horario de Clases
			</h2>
			<div class="lg:flex">
				<select class="select__header form-control" id="selectParcial">
				<option value="clases" {{$parcial == 'clases' ? 'selected' : ''}} >Clases</option>
                @foreach($unidad as $und)
                <optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                        <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    @endforeach
                    </optgroup>
                @endforeach
                <optgroup label="Recuperación">
						<option value="supletorio" {{$parcial == 'supletorio' ? 'selected' : ''}} >Supletorio</option>
						<option value="remedial" {{$parcial == 'remedial' ? 'selected' : ''}} >Remedial</option>
						<option value="gracia" {{$parcial == 'gracia' ? 'selected' : ''}} >Gracia</option>
					</optgroup>
            </select>
				@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<a class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 w-48" href="{{route('descargarDeHorarioEscolarPorTipo', [$course, $parcial])}}">Descargar</a>
				@endif
			</div>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a class="no-pointer"> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </a>
					</a>
				</div>
			</div>
		</div>
    </div>
    @include('partials.horarioCurso')
</div>
@section('scripts')
<script>
	const selectParcial = document.getElementById('selectParcial');
	const url = '{{route('horario_CursoJs')}}';
	const idCurso = '{{$course->id}}';
	if (selectParcial) {
		selectParcial.addEventListener('change', function() {
			const parcial = selectParcial.value
			const newurl = `${url}/${idCurso}/${parcial}`
			console.log(newurl)
			location.href = newurl;
		})
	} else {
		console.log('Error al obtener el select');
	}
</script>
@endsection
@endsection


