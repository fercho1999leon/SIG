@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<style>
	button[tabindex="500"] {
		border: 1px solid #1ab394;
		background: #1ab394;
	}
	button[tabindex="500"]:hover {
		border: 1px solid #1ab394;
		background: #29ccab;
	}
	.kv-fileinput-caption {
		display: flex;
		align-items:center;
	}
	.fileinput-remove {
		display: none;
	}
	.file-caption-main .input-group-btn div {
		border-radius: 4px !important;
	}
	 button:nth-child(3) {
		border-radius: 4px !important;
		margin-right: 6px !important;
	}
	.kv-fileinput-caption {
		display: none !important;
	}
	.s-calificaciones-tareas {
		white-space: nowrap;
	}
</style>
<a class="button-br" href="{{route('hijo',['hijo' =>  $hijo->id])}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="row wrapper border-bottom white-bg">
            <div class="repProfileHijo--cont">
                <figure class="repProfileHijo__resumen--img">
                    <img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                </figure>
                <div class="repProfileHijo__resumen--info">
                    <h3 class="repProfileHijo__resumen--name">{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
                    <hr>
                    <div class="repProfileHijo__resumen--curso">
                        <h4><strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{$course->especializacion}} </h4>
                        <h4><strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
                    </div>
					<select class="selectpicker form-control mb-1" id="mySelect">
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
        </div>
	</div>
	<form action="{{ route('subirTareas' )}}" method="POST"  enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="idEstudiante" value="{{$hijo->idStudent}}">
		<div class="row mt-2 ">
			<div class="col-xs-12">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-1">Activos</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-2">Pasadas</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-content">
				<div id="tab-1" class="tab-pane active">
					@include('partials.tareas.tarea', [
						'idTable' => 'example',
						'activities' => $activitiesActive,
						'subirTareas' => true,
						'MostrarMensaje' => true,
						'route' => 'tareaEstudiante'
					])
				</div>
				<div id="tab-2" class="tab-pane">
					@include('partials.tareas.tarea', [
						'idTable' => 'example2',
						'activities' => $activitiesInactive,
						'subirTareas' => true,
						'MostrarMensaje' => false,
						'route' => 'tareaEstudiante'
					])
				</div>
			</div>
		</div>
	</form>
</div>
{{-- modal actividad --}}
<div class="modal fade" id="detalleActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>
@endsection

@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src=" {{secure_asset('bootstrap-fileinput/js/fileinput.js')}} "></script>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example').DataTable();

		var table = $('#example2').DataTable();
	});

	function fillModal(avg){
		$('#idCurso').val(avg)
	}

	$('#mySelect').change(function () {
		var id = "{{ $hijo->idStudent}}";
		window.location.href = "{{ route('tareasEstudianteRuta') }}/" + id + "/" +  $('#mySelect').val();
	});

	$('.dirConfiguraciones__materias--linkEdit').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarMateria').html(result)
                $('#dirModalEditarMateria').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});

	$('.detalleActividad').click(function(e){
		e.preventDefault()
		 $.ajax({
			url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#detalleActividad').html(result)
                $('#detalleActividad').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
</script>
@endsection