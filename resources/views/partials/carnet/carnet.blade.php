<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Carnet</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body>
	<div class="carnet-grid">
		@foreach ($students as $student)
			<div class="table-carnet-container">
				<table class="table-carnet">
					<tr>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td rowspan="2" class="carnet-vat">
							@if ($student->profile->url_imagen != null)
								<div style='background: url("{{secure_asset('storage/'.$student->profile->url_imagen)}}") no-repeat center center; width:80px;height:80px;border-radius:50%;background-size:cover;'>
								</div>
							@else
								<img width="80" 
									class="img-carnet" 
									src="{{secure_asset('img/icono_persona.png')}}" 
									alt="">
							@endif
						</td>
						<td class="carnet-vat">
							<h3 class="carnet__nombre">
								{{$student->nombres}} {{$student->apellidos}} 
							</h3>
							<div class="carnet__informacion-datos">
								<p class="carnet__nombre--item">
									<span>Curso:</span>
									{{$course->grado}}
								</p>
								<p class="carnet__nombre--item">
									<span>Paralelo:</span>
									{{$course->paralelo}}
								</p>
								@if ($course->especializacion != null)
									<p class="carnet__nombre--item">
										<span>Especialización:</span>
										{{$course->especializacion}}
									</p>									
								@endif
								<p class="carnet__nombre--item">
									<span>Año Lectivo:</span>
									{{$institution->periodoActual->nombre}}
								</p>
							</div>
						</td>
						<td rowspan="2" class="carnet-logo">
							<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="25" alt="" >
						</td>
					</tr>
					<tr>
						<td class="carnet-vat">
							
						</td>
					</tr>
					<tr>
						<td>
							@if ($student->tipoSangre != null)
								<div class="carnet__as-end">
									<p class="carnet__tipoDeSangre">
										<span> {{$student->tipoSangre}} </span>
										TIPO DE SANGRE
									</p>
								</div>
							@endif
						</td>
						<td colspan="2">
							<div class="carnet__as-end">
								<div class="carnet__web">
									@if($institution->sitioWeb != null)
										<div class="carnet__web-btn">
											{{$institution->sitioWeb}}
										</div>
									@endif
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>			
		@endforeach
	</div>
	<div class="carnet-grid">
		@foreach ($students as $student)
			<div class="table-carnet-container">
				<table class="table-carnet">
					<tr>
						<td colspan="2">
							<p class="carnet-item-post-p">
								Esta credencial es propiedad de {{$institution->nombre}} su uso es personal e instraferible. <br><br>En caso de perdida notificar a la institución.
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<div class="carnet__informacion-datos">
								<p class="carnet__nombre--item" style="display:grid;">
									<span>Institución:</span>
									{{$institution->nombre}}
								</p>
								<p class="carnet__nombre--item" style="display:grid;">
									<span>Telefonos:</span>
									{{$institution->telefonos}}
								</p>
								<p class="carnet__nombre--item" style="display:grid;">
									<span>Ciudad:</span>
									{{$institution->ciudad}} - Ecuador
								</p>
							</div>
						</td>
						<td>
							<div>
								<img src=" {{secure_asset('img/logo/logo_pinedVertical.png')}} " width="60" alt="">
							</div>
						</td>
					</tr>
				</table>
			</div>			
		@endforeach
	</div>
</body>

</html>