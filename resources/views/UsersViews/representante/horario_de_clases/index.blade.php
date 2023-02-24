@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<a class="button-br" href="{{route('hijo',['hijo' =>  $hijo->idStudent])}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper border-bottom white-bg"  style="background: #ebebed">
            <div class="row wrapper border-bottom white-bg">
                <div class="repProfileHijo--cont">
                    <figure class="repProfileHijo__resumen--img">
                        <img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                    </figure>
                    <div class="repProfileHijo__resumen--info">
                        <h3 class="repProfileHijo__resumen--name">{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
                        <hr>
                        <div class="repProfileHijo__resumen--curso">
                            <h4><strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}</h4>
                            <h4><strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
                        </div>
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
					</div>
                </div>
			</div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="horario-clases">
                                <div class="table-responsive">
                                    <table class="table ss1">
                                        <thead class="scheduler ss1">
                                            <tr>
                                                <th class="text-center scheduler">
                                                    <!-- Hora -->
                                                </th>
                                                <th class="text-center scheduler fz2">Lunes</th>
                                                <th class="text-center scheduler fz2">Martes</th>
                                                <th class="text-center scheduler fz2">Miercoles</th>
                                                <th class="text-center scheduler fz2">Jueves</th>
                                                <th class="text-center scheduler fz2">Viernes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($schedules as $hour)
												<tr class="uppercase">
													<td class="scheduler horas">
														<span class="c-hour">
															{{ substr($hour->horaInicio,0,5)}}
															<br>{{ substr($hour->horaFin,0,5)}}
														</span>
													</td>
													<td class="subject">
														@foreach ($matters->where('id', $hour->dia1) as $matter)
                                                            {{ $matter->nombre_abreviado ?? $matter->nombre}}
                                                            @if ($matter->user != null)
                                                                @if ($matter->user->profile != null)
                                                                    <h5 class="mb-0">{{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}</h5>
                                                                @endif
                                                            @endif
														@endforeach
													</td>
													<td class="subject">
														@foreach ($matters->where('id', $hour->dia2) as $matter)
															{{ $matter->nombre_abreviado ?? $matter->nombre}}
                                                            @if ($matter->user != null)
                                                                @if ($matter->user->profile != null)
                                                                    <h5 class="mb-0">{{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}</h5>
                                                                @endif
                                                            @endif
                                                        @endforeach
													</td>
													<td class="subject">
														@foreach ($matters->where('id', $hour->dia3) as $matter)
															{{ $matter->nombre_abreviado ?? $matter->nombre}}
                                                            @if ($matter->user != null)
                                                                @if ($matter->user->profile != null)
                                                                    <h5 class="mb-0">{{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}</h5>
                                                                @endif
                                                            @endif
                                                        @endforeach
													</td>
													<td class="subject">
														@foreach ($matters->where('id', $hour->dia4) as $matter)
															{{ $matter->nombre_abreviado ?? $matter->nombre}}
                                                            @if ($matter->user != null)
                                                                @if ($matter->user->profile != null)
                                                                    <h5 class="mb-0">{{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}</h5>
                                                                @endif
                                                            @endif
                                                        @endforeach
													</td>
													<td class="subject">
														@foreach ($matters->where('id', $hour->dia5) as $matter)
															{{ $matter->nombre_abreviado ?? $matter->nombre}}
                                                            @if ($matter->user != null)
                                                                @if ($matter->user->profile != null)
                                                                    <h5 class="mb-0">{{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}</h5>
                                                                @endif
                                                            @endif
                                                        @endforeach
													</td>
												</tr>
											@empty
												<tr height="100">
													<td colspan="6" class="text-center">
														<h3>No se ha establecido aún el horario de este tipo</h3>
													</td>
												</tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Director Horario -->
    <div class="modal fade bs-example-modal-sm" id="modalDirectorHorario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" style="max-width: 450px; margin: 0 auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="prof-materia"></h2>
                </div>
                <div class="modal-body">
                    <div class="d-f fw-w jc-c">
                        <h3 class="perfil-m" id="prof-name"></h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
	const selectParcial = document.getElementById('selectParcial');
	const url = '{{route('hijo_horarioJs')}}';
	const hijo = '{{$hijo->idStudent}}'
	if (selectParcial) {
		selectParcial.addEventListener('change', function() {
			const parcial = selectParcial.value
			const newurl = `${url}/${hijo}/${parcial}`
			console.log(newurl)
			location.href = newurl;
		})
	} else {
		console.log('Error al obtener el select');
	}
</script>
@endsection
