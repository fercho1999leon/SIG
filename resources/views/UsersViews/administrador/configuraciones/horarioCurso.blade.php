@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::where('idPeriodo',$course->idPeriodo)->get();
@endphp
	<a class="button-br" href="{{ route('horariosEdicion') }}">
		<button>
			<img src="img/return.png" alt="" width="17">Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Horario del Curso
                    <small> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </small>
				</h2>
				<select class="select__header form-control" id="selectParcial">

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
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="a-configuraciones__nuevoHorario">
                <div class="modal-body ">
                    <div class="modalEditarHorario" id="modalHorario">
                        <button class="btn mt-1 dirConfiguraciones__instituto--agregarInfo" id="btnAddHour" data-toggle="modal">Agregar Hora Clase</button>
                        <div class="pined-table-responsive">
                            <table class="configuracionesHorario__edicion  table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="150">H. Inicio </th>
                                        <th class="text-center" width="150">H. Fin</th>
                                        <th class="text-center" width="150">Lunes</th>
                                        <th class="text-center" width="150">Martes</th>
                                        <th class="text-center" width="150">Miércoles</th>
                                        <th class="text-center" width="150">Jueves</th>
                                        <th class="text-center" width="150">Viernes</th>
                                        <th class="text-center" width="150">Sábado</th>
                                        <th class="text-center" width="150">Domingo</th>
                                    </tr>
								</thead>
                                <tbody id="hourRows">
                                  @foreach($courseSchedules as $key=>$courseSchedule)
                                    <tr id="{{$courseSchedule->id}}">
                                      <input type="hidden" id="idSchedule{{($key+1)}}" value="{{$courseSchedule->id}}" >
                                        <td>
                                            <div>
                                                <input id="horaInicio{{ ($key+1)}}" type="time"  class="form-control" value="{{$courseSchedule->horaInicio}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <input id="horaFin{{ ($key+1)}}" type="time"  class="form-control" value="{{$courseSchedule->horaFin}}">
                                            </div>
                                        </td>
                                        <td>
                                            <select  id="selectLun{{ ($key+1)}}" name="" id="" class="form-control">
                                                <option value="0">Seleccionar Materia</option>
                                               
                                                @foreach($subjects as $subject)
                                                
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia1 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                    <!--<option value="{{ $subject->id }}" >{{$subject->nombre}}</option>-->

                                                    <!--<option value="{{ $subject ['id'] }}">{{ $subject ['nombre'] }}</option> -->
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="selectMar{{ ($key+1)}}"  name="" id="" class="form-control">
                                                <option value="0">Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia2 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="selectMier{{ ($key+1)}}"  name="" id="" class="form-control">
                                                <option value="0">Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia3 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="selectJue{{ ($key+1)}}" name="" id="" class="form-control">
                                                <option value="0">Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia4 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="selectVie{{ ($key+1)}}" name="" id="" class="form-control">
                                                <option value="0">Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia5 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="selectSab{{ ($key+1)}}" name="" id="" class="form-control">
                                                <option value="0" {{ ($subject->nombre == '0' ) ? ' selected' : '' }}>Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia6 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
										</td>
                                        <td>
                                            <select  id="selectDom{{ ($key+1)}}" name="" id="" class="form-control">
                                                <option value="0" {{ ($subject->nombre == '0' ) ? ' selected' : '' }}>Seleccionar Materia</option>
                                                @foreach($subjects as $subject)
													<option value="{{ $subject->id }}" {{ ($subject->id == $courseSchedule->dia7 ) ? ' selected' : '' }}>{{$subject->nombre}}</option>
                                                @endforeach
                                            </select>
										</td>
										<td>
											<div>
												{{method_field('DELETE')}}
												{{ csrf_field() }}
												<button type="submit" class="icon__eliminar-btn fz19" onclick="eliminarHora({{$courseSchedule->idCurso}}, '{{$parcial}}', {{$courseSchedule->id}})">
													<i class="fa fa-trash"></i>
												</button>
											</div>
										</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>

            <div class="text-center mt-1">
				<input id="course_id"  type="hidden" name="course_id" value="{{$idCourse}}">
                <button  type="button" class="btn btn-primary btnUpdate">ACTUALIZAR</button>
            </div>
        </div>
    </div>
    <?php
    echo "<script>\n";
    echo 'var subjects = ' . json_encode($subjects, JSON_PRETTY_PRINT) . ';';
    echo "\n</script>"; ?>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script type="text/javascript">
let parcial = '{{$parcial}}'
const selectParcial = document.getElementById('selectParcial');
const url = '{{route('creacionHorarioParcialJs')}}';
const idCurso = '{{$idCourse}}';
if (selectParcial) {
	selectParcial.addEventListener('change', function() {
		const parcial = selectParcial.value
		const newurl = `${url}/${idCurso}/${parcial}`
		location.href = newurl;
	})
} else {
	console.log('Error al obtener el select');
}

$('#btnAddHour').on('click', function() {
  var count = $('#hourRows').children('tr').length;
  var trHour = document.createElement("tr");

  var inputHidden = document.createElement("input");
  inputHidden.type='hidden';
  inputHidden.id="idSchedule"+(count+1);
  inputHidden.value="";

  trHour.append(inputHidden);

  //Hora Inicio
  var tdHI = document.createElement("td");
  var divHI = document.createElement("div");
  var inputHI = document.createElement("input");
  inputHI.type='time';
  inputHI.className = "form-control";
  inputHI.value='';
  inputHI.name="horaInicio"+(count+1);
  inputHI.id="horaInicio"+(count+1);
  divHI.append(inputHI);
  tdHI.append(divHI);
  trHour.append(tdHI);

  //Hora Fin
  var tdHF = document.createElement("td");
  var divHF = document.createElement("div");
  var inputHF = document.createElement("input");
  inputHF.type='time';
  inputHF.className = "form-control";
  inputHF.value='';
  inputHF.name="horaFin"+(count+1);
  inputHF.id="horaFin"+(count+1);
  divHF.append(inputHF);
  tdHF.append(divHF);
  trHour.append(tdHF);

  //Lunes
  var tdLUN = document.createElement("td");
  var selectLUN = document.createElement("select");
  selectLUN.className="form-control";
  selectLUN.name="selectLun"+(count+1);
  selectLUN.id="selectLun"+(count+1);
  var op=document.createElement("option");
  op.innerHTML="Seleccionar Materia";
  op.value=0;

  selectLUN.append(op);

  getSubjects(selectLUN,subjects);


  tdLUN.append(selectLUN);
  trHour.append(tdLUN);

  //Martes
  var tdMar = document.createElement("td");
  var selectMar = document.createElement("select");
  selectMar.className="form-control";
  selectMar.name="selectMar"+(count+1);
  selectMar.id="selectMar"+(count+1);
  var op2=document.createElement("option");
  op2.innerHTML="Seleccionar Materia";
  op2.value=0;

  selectMar.append(op2);

  getSubjects(selectMar,subjects);


  tdMar.append(selectMar);
  trHour.append(tdMar);

  //Miercoles
  var tdMier = document.createElement("td");
  var selectMier = document.createElement("select");
  selectMier.className="form-control";
  selectMier.name="selectMier"+(count+1);
  selectMier.id="selectMier"+(count+1);
  var op3=document.createElement("option");
  op3.innerHTML="Seleccionar Materia";
  op3.value=0;

  selectMier.append(op3);

  getSubjects(selectMier,subjects);


  tdMier.append(selectMier);
  trHour.append(tdMier);

  //Jueves
  var tdJue = document.createElement("td");
  var selectJue = document.createElement("select");
  selectJue.className="form-control";
  selectJue.name="selectJue"+(count+1);
  selectJue.id="selectJue"+(count+1);
  var op4=document.createElement("option");
  op4.innerHTML="Seleccionar Materia";
  op4.value=0;

  selectJue.append(op4);

  getSubjects(selectJue,subjects);


  tdJue.append(selectJue);
  trHour.append(tdJue);

  //Viernes
  var tdVie = document.createElement("td");
  var selectVie = document.createElement("select");
  selectVie.className="form-control";
  selectVie.name="selectVie"+(count+1);
  selectVie.id="selectVie"+(count+1);
  var op5=document.createElement("option");
  op5.innerHTML="Seleccionar Materia";
  op5.value=0;


  selectVie.append(op5);

  getSubjects(selectVie,subjects);


  tdVie.append(selectVie);
  trHour.append(tdVie);

  //Sabado
  var tdSab = document.createElement("td");
  var selectSab = document.createElement("select");
  selectSab.className="form-control";
  selectSab.name="selectSab"+(count+1);
  selectSab.id="selectSab"+(count+1);
  var op6=document.createElement("option");
  op6.innerHTML="Seleccionar Materia";
  op6.value=0;


  selectSab.append(op6);

  getSubjects(selectSab,subjects);


  tdSab.append(selectSab);
  trHour.append(tdSab);

  //Domingo
  var tdDom = document.createElement("td");
  var selectDom = document.createElement("select");
  selectDom.className="form-control";
  selectDom.name="selectDom"+(count+1);
  selectDom.id="selectDom"+(count+1);
  var op7=document.createElement("option");
  op7.innerHTML="Seleccionar Materia";
  op7.value=0;


  selectDom.append(op7);

  getSubjects(selectDom,subjects);


  tdDom.append(selectDom);
  trHour.append(tdDom);


  $('#hourRows').append(trHour);

});

function getSubjects(select,subjects) {
  for (var i = 0, len = subjects.length; i < len; i++) {
    var op2=document.createElement("option");
    op2.value=subjects[i].id;
    op2.innerHTML=subjects[i].nombre;
    select.append(op2);
  }

}

$('.text-center').on('click', '.btnUpdate', function() {
    
  var count = $('#hourRows').children('tr').length;
  var arr={};
  arr["course_id"]=$("#course_id").val();

  var flag=1;

  for (var i= 0 ; i<count;i++){
    if($("#horaInicio"+(i+1)).val()=="" || $("#horaFin"+(i+1)).val()=="")
    {
      flag=0;
      
    }
    else{
        
      arr["schedule_id"+(i+1)]=$("#idSchedule"+(i+1)).val();
      arr["horaInicio"+(i+1)]=$("#horaInicio"+(i+1)).val();
      arr["horaFin"+(i+1)]=$("#horaFin"+(i+1)).val();
      arr["selectLun"+(i+1)]=$("#selectLun"+(i+1)).val();
      arr["selectMar"+(i+1)]=$("#selectMar"+(i+1)).val();
      arr["selectMier"+(i+1)]=$("#selectMier"+(i+1)).val();
      arr["selectJue"+(i+1)]=$("#selectJue"+(i+1)).val();
      arr["selectVie"+(i+1)]=$("#selectVie"+(i+1)).val();
      arr["selectSab"+(i+1)]=$("#selectSab"+(i+1)).val();
      arr["selectDom"+(i+1)]=$("#selectDom"+(i+1)).val();
    }

  }
  if (parcial == 'clases') {
	if (flag==1) {
		var jsonString = JSON.stringify(arr);
		$.ajax({
			type: 'POST',
			url: "{{route('editHorariosStore')}}",
			data:{
			'_token': $('input[name=_token]').val(),
			count,
			jsonString
			} ,
			datatype: 'JSON',
			success: function(data) {
				if ((data.errors)) {
					alert("Error");
				}
				else{
					location.reload();
				}
			}
		});
	}
	else{
		alert("Completar los campos Horario Inicio y Horario Fin");
	}
  } else {
	if (flag==1) {
		var jsonString = JSON.stringify(arr);
		$.ajax({
			type: 'POST',
			url: "{{route('storeHorarioParcial', $parcial)}}",
			data:{
			'_token': $('input[name=_token]').val(),
			count,
			jsonString
			} ,
			datatype: 'JSON',
			success: function(data) {
				if ((data.errors)) {
					alert("Error");
				}
				else{
					location.reload();
				}
			}
		});
	}
	else{
		alert("Completar los campos Horario Inicio y Horario Fin");
	}
  }
});
</script>
@endsection
@section('scripts')
	<script>
		var enlace = window.location.origin
		function eliminarHora(idCurso, parcial, idHora) {
			console.log(idCurso, parcial, idHora)
			Swal.fire({
				title: '¿Seguro desea eliminar esta hora de clase?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "POST",
							url: `${enlace}/horariosEdicion/configuraciones-horario-parcial/${idCurso}/${parcial}/${idHora}`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idHora).css('display', 'none')
								Swal.fire(
									'Esta hora de clase ha sido eliminada!',
									'',
									'success'
								)
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});

				}
			})
		}
	</script>
@endsection
