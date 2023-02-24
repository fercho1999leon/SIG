@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('showDestrezasMateriaAdmin', [$Matter->id, $parcial])}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas
			</h2>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href="{{route('destrezasAdminCurso', $Matter->idCurso)}}"> {{$course->grado}}
						{{$course->especializacion}} {{$course->paralelo}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a href="{{route('showDestrezasMateriaAdmin',[$Matter->id, $parcial])}}"> {{$Matter->nombre}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer" data-toggle="tooltip" title="{{$destreza->nombre}}">
						@foreach($clasedestrezas->where('idDestrezas', $destreza->id) as $clasedestreza)
						{{str_limit($destreza->nombre,50)}} {{$clasedestreza->parcial}}
						@endforeach
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-1 mb-1">
		<div class="col-xs-12 mt-1">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<table id="tableGrades" class="s-calificaciones">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border fz19">Estudiante</td>
									@foreach($clasedestrezas as $clasedestreza)
									@if($destreza->id == $clasedestreza->idDestrezas)
									<td class="no-border fz19">{{str_limit($destreza->nombre,50)}} {{$clasedestreza->parcial}}
									</td>
									@endif
									@endforeach
								</tr>
								@foreach($Students as $index => $student)
								<tr>
									<td class="text-center">{{($index+1)}}</td>
									<td class="">{{$student->apellidos}}, {{$student->nombres}}</td>

									@foreach($clasedestrezas as $clasedestreza)
									@if($destreza->id == $clasedestreza->idDestrezas)

									<td>
										<!-- <input type="text" id="std{{($index + 1).$loop->iteration}}" class="" value="" name=""> -->
										<select
											id="calificacionesSelect-{{$destreza->id}}-{{$clasedestreza->id}}-{{$student->id}}"
											name="calificacionesSelect-{{$destreza->id}}-{{$clasedestreza->id}}-{{$student->id}}"
											onchange="changedGrade(this.id)" class="">
											<option value="0">Seleccionar Nota</option>
											<option value="I">Inicio</option>
											<option value="EP">En proceso</option>
											<option value="A">Adquirida</option>
											<option value="NE">No Evaluada</option>

										</select>
									</td>
									@endif
									@endforeach
								</tr>
								@endforeach
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	function changedGrade(id){
		var json = {};
		var splitID = id.split('-');
		var elms = document.getElementById("tableGrades").getElementsByTagName("select");
		for (var i = 0; i < elms.length; i++) {
			if(elms[i].id.indexOf("calificacionesSelect-"+splitID[1]+"-"+splitID[2]) !== -1){
				var splitID2 = elms[i].id.split('-');
				json[splitID2[3]] = elms[i].value;
			}
		}

		$.ajax({
			 url: "{{route('updateClaseDestrezaAdmin')}}" ,
			 type:"POST",
			 data:{
				 '_token': $('input[name=_token]').val(),
				 "notas": JSON.stringify(json) ,
				 "id": splitID[2]},
			 success: function(result, status, xhr){

			 },
			 error: function (xhr,status,error){
					 alert("Error!!");

			 },

	 });
	}

	var clases = {!!$jsonClases!!};
	var elms = document.getElementById("tableGrades").getElementsByTagName("select");

		jQuery.each(clases, function(k, val) {
			var cali = JSON.parse(val['calificacion']);

				jQuery.each(cali, function(j, value) {

						for (var i = 0; i < elms.length; i++) {
							var splitID2 = elms[i].id.split('-');
							if(splitID2[1]==val['idDestrezas']	&&	splitID2[2]==val['id']){
								if(j==splitID2[3]){
									$("#"+elms[i].id).find('option[value="'+value+'"]').attr("selected",true);
								}
							}
						}


				});

		});





</script>

@endsection