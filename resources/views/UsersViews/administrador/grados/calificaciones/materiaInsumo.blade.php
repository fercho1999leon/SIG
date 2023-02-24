@extends('layouts.master2')
@section('assets')
@php
if($permiso ==null || ($permiso != null && $permiso->editar == 1)){
    $readonly ="";
}else $readonly ="readonly='readonly'";
@endphp
<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection @section('content')
<style>
 .kv-file-upload{
    color:#fff !important;
    visibility: hidden !important;
}
.icon__enviar-mensaje {
    font-size: 18px;
    color: #1c84c6;
    border: none;
}
</style>
<div class="lblCargando-container">
    <h3 class="lblCargando" id="lblCargando" style="display: none;"></h3>
</div>
<a class="button-br" href="{{ route('InsumosAdmin',['id' => $Matter->id, 'parcial' => $parcial]) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="data3"> </div>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
	<div class="row wrapper white-bg mb-1">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">
				<i class="fa fa-edit icon__title text-color3"></i>
				Calificaciones
			</h2>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href="{{ route('grade_score_course',['id' => $course->id, 'parcial' => $parcial ]) }}"> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a href="{{ route('InsumosAdmin',['id' => $Matter->id, 'parcial' => $parcial]) }}"> {{$matter->nombre}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer" href="">{{$Supply->nombre}}</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row wrapper white-bg mb-05">
		<div class="col-xs-12 titulo-separacion">
			<h3 class="title-page">
				<p class="mb-05">Dirigente:
					<!--  Muestra nombres y appelidos del tutor-->
					@if($teacher !=null)
						<span class="not">
							{{ $teacher->nombres }} {{ $teacher->apellidos }}
						</span>
					@endif
				</p>
				@if ($teacher2 != null)
					<p class="mb-0">Docente:
						<span class="not"> {{$teacher2->apellidos}} {{$teacher2->nombres}} </span>
					</p>
				@endif
			</h3>
            @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
                @if($refuerzo == null)
                    <a onclick="activarRefuerzo({{$Supply->id}}, '{{$parcial}}');" class="d-verInsumo-crear text-center"  style="align-self:center">Activar Refuerzo academico</a>
                @else
                    @if($user_data->cargo=='Administrador')
                        <a onclick="desactivarRefuerzo({{$Supply->id}}, '{{$parcial}}')" class="d-verInsumo-crear text-center" style="align-self:center">Desactivar Refuerzo academico</a>
                    @endif
                @endif
            @endif
		</div>
	</div>
    <input name="idMateria" id="idMateria" type="hidden" value="{{$idMateria}}">
    <input id="parcialCOD" type="hidden" value="{{$parcial}}">
    <input name="idInsumo" id="idInsumo" type="hidden" value="{{$idInsumo}}">
    <div class="row" style="margin-top: 5px; background: #FFFFFF">
        <div class="d-calificaciones__verInsumo">
            <button class="d-verInsumo-crear" data-toggle="modal" data-target="#aT" href="#">CREAR</button>
            <button class="d-verInsumo-crear" data-toggle="modal" data-target="#importar" href="#">IMPORTAR</button>
            <div class="verInsumo__lista-actividades">
                <!-- foreach de las actividades correspondientes al insumo -->
                @foreach($Activities as $activity)
                    <div id="{{$activity->id}}" class="insumo" style="background: #eee;color: #37505C;border: none;border-radius: 4px;">
                        {{substr($activity->nombre,0,40)}}
                        @php
                        $rutaDescarga ='/curso_'.$course->id.'/'.substr($Matter->nombre, 0 ,25).'/parcial_'.$activity->parcial.'/Insumo_'.$activity->idInsumo.'/'.substr($activity->nombre, 0 ,25).'*';
                        @endphp
                        {{-- @if($activity->recibirTareas==1) --}}
                            <a class="verInsumo__lista-button" name="{{route('getActividadAdmin', ['activity' => $activity->id, 'course' => $course->id, 'idMateria' => $idMateria, 'accion' => 2])}}">
                                <i class="fa fa-eye icon__ver" title="Ver actividad"></i>
                            </a>
                        {{-- @endif --}}
                        <a class="verInsumo__lista-button" name="{{route('getActividadAdmin', ['activity' => $activity->id, 'course' => $course->id, 'idMateria' => $idMateria, 'accion' => 1])}}">
                            <i class="fa fa-edit icon__editar" title="Calificar"></i>
                        </a>
                        {{--se agrego para descargar en formato zip los adjuntos de las actividades creadas--}}
                        @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
                        <form action="{{route('descargarAdjuntos')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="rutaDescarga" type="hidden" value="{{$rutaDescarga}}">
                                <input name="nombreDescarga" type="hidden" value="{{$activity->nombre}}">
                                <button type="submit" class="icon__enviar-mensaje"><i class="fa fa-download" title="Descargar deberes adjuntos"></i></button>
                        </form>
                        @endif
                        @if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
                            <div action="{{route('deleteActivityAdmin')}}" method="POST" class="icon__eliminar-form form-delete" onclick="eliminarActividad({{$activity->id}});">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input name="idActivity" type="hidden" value="{{$activity->id}}">
                                <button type="submit" class="icon__eliminar-btn"><i class="fa fa-trash" title="Eliminar"  style="border: none !important"></i></button>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- endforeach -->
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 5px; background: #FFFFFF">
        <div class="table-responsive">
            <div class="col-xs-12">
                <div class="d-insumo__container">
                    <div class="d-parciales__notas--estudiantes d-resaltado__alumnos">
                        <p class="d-parciales__notas--estudiantes--titulo">Estudiantes</p>
                        <!-- foreach del listado de estudiantes que pertenecen a ese curso -->
                        @foreach($Students as $student)
                            <p class="d-parciales__notas--numero">{{$loop->iteration}} </p>
                            <p class="d-parciales__notas--nombre" style="text-transform: uppercase;">
                                {{$student->apellidos}}, {{$student->nombres}}
                                
                            </p>
                        @endforeach
                        <!-- endforeach -->
                    </div>
                    <div class="d-insumo__actividades">
                        <!-- foreach de la actividad que hace referencia al insumo dentro del primer parcial (p1q1) -->
                        @foreach($Activities as $key => $activity)
                        <div class="d-calificaciones__quimistre d-resaltado__nota d-resaltado__nota">
                            <p class="d-calificaciones--item gridRow1-3">
                                {{$activity->nombre}}
                            </p>
                            <!-- Es un input -->
                            @foreach($Students as $student)
                                <input type="text" {{$readonly}}
                                @if($activity->calificado)
                                    id="supply{{($key + 1).$loop->iteration}}"
                                    student_id="{{ $student->id}}"
                                    supply_id="{{$Supply->id}}"
                                    name="{{route('calificacionesUpdateAdmin',['activity'    =>  $activity->id,'student' =>  $student->idStudent])}}"
                                @else
                                    disabled
                                @endif
                                class="d-calificaciones--item actualizarNota"
                                @if($calificaciones->where('idEstudiante', $student->idStudent)->where('idActividad', $activity->id)->first() != null)
                                    value="{{$calificaciones->where('idEstudiante', $student->idStudent)->where('idActividad', $activity->id)->first()->nota }}"
                                @else
                                    value="0"
                                @endif
                                >
                            @endforeach
                        </div>
                        @endforeach
                    </div>

                    <div class="d-insumo__nota-final">
                        <div class="d-calificaciones__quimistre d-resaltado__nota">
                            <p class="d-calificaciones--item gridRow1-3">
                                Suma
                            </p>
                            @foreach($Students as $student)
                            <p class="d-calificaciones--item tt_valor" id="tt{{$loop->iteration}}" estudiante_id={{ $student->id }}>
                                0.00
                            </p>
                            @endforeach
                        </div>
                        <div class="d-calificaciones__quimistre d-resaltado__nota">
                            <p class="d-calificaciones--item gridRow1-3 notaBuena">
                                PRO
                            </p>
                            @foreach($Students as $student)
                            <p class="d-calificaciones--item prEstudiante">
                                0.00
                            </p>
                            @endforeach
                        </div>
                        @if($refuerzo != null)
                        <div class="d-calificaciones__quimistre d-resaltado__nota">
                            <p class="d-calificaciones--item gridRow1-3 notaBuena">
                                R.A
                            </p>
                            @foreach($Students as $student)
                            <input type="text"
                                id="refuerzo{{$student->id}}"
                                student_id="{{ $student->id}}"
                                supply_id="{{$Supply->id}}"
                                name="{{route('calificacionesUpdateAdmin',['refuerzo'    =>  $refuerzo->id,'student' =>  $student->idStudent])}}"
                                class="w100 d-calificaciones--item actualizarNota refuerzo"
                                @if($calificaciones->where('idEstudiante', $student->idStudent)->where('idActividad', $refuerzo->id)->first() != null)
                                    value="{{$calificaciones->where('idEstudiante', $student->idStudent)->where('idActividad', $refuerzo->id)->first()->nota }}"
                                @else
                                    value="0"
                                @endif
                                disabled
                            >
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mt-2">
        <a class="btn btn-primary btn-lg" href="{{ route('InsumosAdmin',['id' => $Matter->id, 'parcial' => $parcial]) }}">
            Guardar
        </a>
    </div>
</div>
</div>
<div class="modal fade" id="importar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Subir Calificaciones desde excel plataforma EVA</h4>
            </div>
        <form method="post" action="{{route('importarActividades')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="idMateria2"  type="hidden" value="{{$idMateria}}">
        <input name="parcialCOD2" type="hidden" value="{{$parcial}}">
        <input name="idInsumo2"  type="hidden" value="{{$idInsumo}}">
        <input id="excel" name="excel" type="file" class="file">
    </form>
    </div>
</div>
</div>
<!-- Crear Actividad -->
<div class="modal fade" id="aT" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear una nueva Actividad</h4>
            </div>
            <div class="modal-body">
                <div class="widget widget-tabs">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-1">GENERAL</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2">DESCRIPCION</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3">ADJUNTOS</a>
                            </li>
                        </ul>
                        <form id="FormAddActivity" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <table class="table table-bordered" width="75%">
                                        <tbody>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span>Nombre</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span>Fecha de Inicio</span>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" step="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span>Fecha de Entrega</span>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega" step="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span>Es calificado?</span>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="calificado" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span>Permitir tarea?</span>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="recibirTareas" value="1">
                                                </td>
											</tr>
											<input type="hidden" name="idCurso" value="{{$course->id}}">
											@php
												$user_profile = App\User::find(Sentinel::getUser()->id);
											@endphp
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <textarea  class="form-control mb-1" rows="5" name="descripcion" id="descripcion" placeholder="Descripcion"></textarea>
                                </div>
                                Adjuntar archivo
                                    <div id="tab-3" class="tab-pane">
									<input id="adjunto" name="adjuntos" type="file" class="file">
                                    </div>
                                <div id="kartik-file-errors"></div>
                            </div>
                            <input class="btn btn-primary" type="reset" name="reset" id="reset">
                        </form>
                    </div>
				</div>
				<div id="data"></div>
                <input type="hidden" id="totalEstudiantes" value="{{ count($Students) }}">
               <input type="hidden" id="totalTareas" value="{{ count($Activities->where('calificado','=', true)) }}">
               {{--Se agrega esta variable para correr el promedio de forma correcta--}}
               <input type="hidden" id="totalTareasSF" value="{{ count($Activities) }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="AddActividad">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Visualizaci�n de actividad -->
<div class="modal fade" id="t1" role="dialog">

</div>

@endsection
@section('scripts')

<script src="{{secure_asset('bootstrap-fileinput/js/plugins/piexif.min.js')}}" type="text/javascript"></script>
<script src="{{secure_asset('bootstrap-fileinput/js/plugins/sortable.min.js')}}" type="text/javascript"></script>
<script src="{{secure_asset('bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{secure_asset('bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{secure_asset('bootstrap-fileinput/js/locales/es.js')}}"></script>
<script>
	var url = window.location.origin
	function eliminarActividad(idActividad) {
		Swal.fire({
			title: '�Esta seguro que desea eliminar esta actividad?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO',
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: `${url}/deleteActivityAdmin`,
						data: {
							'_token': $('input[name=_token]').val(),
							'_method': 'DELETE',
							'idActivity':idActividad
						},
						success: function (response) {
							location.reload();
						}, error: function(response) {
							alert('Algo salio mal.')
						}
					});

			}
		})
	}
	function activarRefuerzo(idRefuerzo, parcial) {
		Swal.fire({
			title: '�Seguro desea activar Refuerzo Academico?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "GET",
						url: `${url}/grados/materiaInsumo/Actividades/refuerzo/${idRefuerzo}/${parcial}`,
						success: function (response) {
							location.reload();
						}, error: function(response) {
							alert('Algo salio mal.')
						}
					});

			}
		})
	}

	function desactivarRefuerzo(idRefuerzo, parcial) {
		Swal.fire({
			title: '�Seguro desea desactivar Refuerzo Academico? Se perderan todos los cambios ingresados.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "GET",
						url: `${url}/grados/materiaInsumo/Actividades/refuerzo/desactivar/${idRefuerzo}/${parcial}`,
						success: function (response) {
							location.reload();
						}, error: function(response) {
							alert('Algo salio mal.')
						}
					});

			}
		})
	}
calcular();
cargarPromedios();

$('.actualizarNota').change(function (e) {

        var masde10 = /^[1-9]+[1-9]+$/;
        var letras = /^[a-zA-Z]+$/;
		var notaMinima = parseFloat('{{$nota_minima->valor}}')
        if( $(this).val().match(masde10) || $(this).val().match(letras) || parseFloat($(this).val()) > 10 || parseFloat($(this).val()) < notaMinima){
            $(this).val("0");
            return;
        }else{
            var ruta = $(this).attr('name');
            var nota = $(this).val()
            var student = $(this).attr('student_id');
            var supply = $(this).attr('supply_id');
            $.ajax({
                url: ruta,
                type: "POST",
                data: { nota: nota,
                        student: student,
                        supply: supply
                },
                success: function (result, status, xhr) {
                    $('#lblCargando').text('Finalizado').fadeOut(1000);
                },
                beforeSend: function () {
                    $('#lblCargando').removeClass( "lblCargando-error" );
                    $('#lblCargando').addClass( "lblCargando" );
                    $('#lblCargando').text('Subiendo notas...').show();
                },
                error: function (xhr, status, error) {
                    var response = JSON.parse(xhr.responseText)
                    $.each(response, function (index, value) {
                        $('#lblCargando').text('Ingrese por favor un numero').show();
                        $('#lblCargando').addClass( "lblCargando-error" );
                    });
                }
            });
            if(!$(this).hasClass('refuerzo'))
			{
				calcular();
				cargarPromedios();
			}
        }
    });


    function calcular() {
        let totalEstudiantes = parseInt($('#totalEstudiantes').val());
        let totalTareas = parseInt($('#totalTareasSF').val());
        for (i = 1; i <= totalEstudiantes; i++) {
            let total_tt = 0;
            for (j = 1; j <= totalTareas; j++) {
                let n = $('#supply' + j + i).val();
                if (n === undefined || n === '') {
                    total_tt = parseFloat(total_tt);
                    //console.log(total_tt);
                } else {
                    var tot = parseFloat(total_tt) + parseFloat(n);
                    total_tt = tot.toFixed(2);
                    //console.log(total_tt);
                }

            }
            $('#tt' + i).text(total_tt);
        }
    }
    function calc(valor) {
        var num = valor
        var with2Decimals = 0;
        if(!isNaN(num))
            with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]
       return with2Decimals;
    }
    function cargarPromedios() {
        var objPromedio = [];
        $('.tt_valor').each(function (index, value) {
            let tareas = parseFloat($('#totalTareas').val());
            let pr;
            pr = parseFloat($(value).text());
            objPromedio.push(
                {
                    "promedio": calc( (pr / tareas) ),
                    "id": $(value).attr('estudiante_id')
                }
            );
        });
        $('.prEstudiante').each(function (index, value) {
            let tareas = parseFloat($('#totalTareas').val());
            if ( !isNaN(objPromedio[index].promedio) ){
                if(objPromedio[index].promedio<7)
                {
                    $('.refuerzo').eq(index).prop('disabled', false);
                }
                else
                {
                    $('.refuerzo').eq(index).prop('disabled', true);
                }
                $(this).text( calc(objPromedio[index].promedio));
            }else{
                $(this).text("0");
            }
        });
    }

    function eventFire(el, etype) {
        if (el.fireEvent) {
            el.fireEvent('on' + etype);
        } else {
            var evObj = document.createEvent('Events');
            evObj.initEvent(etype, true, false);
            el.dispatchEvent(evObj);
        }
    }
    var x = {}
    $("#file").fileinput({
        language: "es",
        uploadUrl: "{{route('tempAdjuntos')}}",
        showRemove: false,
        showRemoveCaption: false,
        showUpload: false,
        maxFileCount: 3,
        allowedFileExtensions: ["docx", "pptx", "pdf", "xls", "xlsx", "zip"],
        uploadAsync: false,
        previewFileIcon: '<i class="fa fa-file"></i>',
        allowedPreviewTypes: null, // disable preview of standard types
        allowedPreviewMimeTypes: ['image/jpeg', 'text/javascript'], // allow content to be shown only for certain mime types
        previewFileIconSettings: {
            'docx': '<i class="fa fa-file-word-o text-primary"></i>',
            'xls': '<i class="fa fa-file-excel-o text-success"></i>',
            'xlsx': '<i class="fa fa-file-excel-o text-success"></i>',
            'pptx': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
            'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
            'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
        },
        fileActionSettings: {
            showRemove: false,
            showUpload: false,
            showZoom: false,
            showDrag: false,
        },
    }).on('fileuploaded', function (event, data, id, index) {
        var p = { name: data.file[index].name, path: data.response.path }
        x['Adjunto_' + index] = p
        var r = JSON.stringify(x)
        alert(r)
        $('#adjuntos').val(r)
    });


    $('#AddActividad').click(function (e) {
        $("#AddActividad").attr("disabled", true);
        $('#FormUpdateActivity').submit(function (r) { r.preventDefault() });
        message()
    });
    function message() {
       
        var form = document.forms.namedItem("FormAddActivity");
        var oOutput = document.getElementById("data"),        
            oData = new FormData(document.forms.namedItem("FormAddActivity"));
        var id = $('#idInsumo').val();
        //console.log('ent',$('#nombre').val() );
        var oReq = new XMLHttpRequest();
        oReq.open("POST", "{{ route('ActividadAdmin')}}/{{$Matter->id}}/"
            + id + "/" + $('#parcialCOD').val(), true);

        //oReq.open("POST", "{{ route('ActividadAdmin')}}/{{$Matter->id}}/311/{{$parcial}}");
        oReq.onload = function (oEvent) {
            if (oReq.status == 200) {
                oOutput.innerHTML = this.responseText;
                eventFire(document.getElementById('reset'), 'click');
                $('#aT').modal('hide');
                location.reload();

            } else {
                var obj = JSON.parse(this.responseText);
                //console.log('entra',obj);
                oOutput.innerHTML = obj.message;
                $('#aT').modal('show');
                $("#AddActividad").attr("disabled", false);
            }
        };
        oReq.send(oData);

    }


    $('.verInsumo__lista-button').click(function (e) {
        e.preventDefault()
        var ruta = $(this).attr('name');
        $.ajax({
            url: ruta,
            type: "GET",
            success: function (result, status, xhr) {
                $('#t1').html(result)
                $('#t1').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
    });
</script>
@endsection