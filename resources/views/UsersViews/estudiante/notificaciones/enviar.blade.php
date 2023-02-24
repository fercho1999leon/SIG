<style>
    .ck-file-dialog-button {
        display: none !important;
    }
</style>
@extends('layouts.master')
@section('content')
@php
use App\ConfiguracionSistema; 
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <button disabled class="btn btn-block btn-primary compose-mail pinedTooltip" href="">
                            <i class="fa fa-envelope-o"></i>
                            <span class="pinedTooltipH">Nuevo Correo</span>
                        </button>
                        <div class="space-25"></div>
                        <h5>CATEGORÍAS</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li>
                                <a href="{{ route('notificacionesEstudiante') }}">
                                    <i class="fa fa-inbox "></i> Bandeja de Entrada
                                    <span class="label label-warning pull-right">{{ $countMessages }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('notificacionesEstudianteEnviados') }}">
                                    <i class="fa fa-envelope-o"></i> Enviados
                                    <span class="label label-primary pull-right">{{ $countSend }}</span>
                                </a>
                            </li>
                        </ul>
                        @include('partials.notificaciones._categorias')
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 animated fadeInRight">
            <form method="post" action="{{ route('enviarMensaje') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idCurso" id="idCurso" value="{{$curso->id}}">
                <div class="nuevoMensaje">
                    <div class="nuevoMensaje__container">
                        <label for="">Para:</label>
                        <div class="nuevoMensaje__container-p">
                            <select name="selectPersonal" id="selectPersonal" class="form-control">
                                <option value="seleccionar">Seleccionar</option>
                                @php
                                $enviarAdmin = ConfiguracionSistema::sendToAdmin();
                                @endphp
                                @if($enviarAdmin->valor=='1')
                                <option value="administracion">Administración</option>
                                @endif
                                <option value="docentes">Docentes</option>
                            </select>
                            <div class="checkTodos" style="display: none">
                                <label for="checkTodos">Todos</label>
                                <input id="checkTodos" type="checkbox">
                            </div>
                            <div id="cursosCheck" class="checkRepresentantes" style="display:none">
                                @foreach($courses as $course)
                                  <label for="{{$course->id}}">{{$course->grado}} {{$course->paralelo}}</label>
                                  <input id="{{$course->id}}" type="checkbox">
                                @endforeach
                            </div>
                            <select id="personalData" name="user[]" class="form-control" multiple required>
                            </select>
                        </div>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Razon</label>
                        <input name="razon" type="text" class="form-control" required>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Descripcion</label>
                        <textarea name="descripcion" id="editor" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Adjuntar archivos</label>                        
                        <input id="adjunto" name="adjunto" type="file" class="file">
                    </div>
                    <div class="text-right">
                        <input type="reset" value="Cancelar" class="btn btn-danger"></input>
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{secure_asset('js/jquery-3.3.js')}}"></script>
<script src="{{secure_asset('bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src=" {{secure_asset('ckeditor/ckeditor.js')}} "></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>

(function () {
	$("#adjunto").fileinput();
    // Este es el checkbox donde se marcan todos los listados generados en el select,sea representante o docentes, etc
    const checkRepresentanteDiv = document.querySelector('.checkRepresentantes')
    // checkbox Representantee
    const checkTodos = document.getElementById('checkTodos');
    checkTodos.addEventListener('click', function() {
        let checkRep = document.getElementById('checkTodos');
        if(checkRep.checked) {
            var c = document.getElementById('cursosCheck').getElementsByTagName('input');
            var representantesTodos = document.querySelectorAll('#personalData option');
            for (let i = 0; i < representantesTodos.length; i++) {
                representantesTodos[i].setAttribute('selected', '');
                representantesTodos[i].selected = true;
            }
        } else {
            var representantesTodos = document.querySelectorAll('#personalData option');
            for (let i = 0; i < representantesTodos.length; i++) {
                representantesTodos[i].removeAttribute('selected');
                representantesTodos[i].selected = false;
            }
        }
    })

    // segun el personal seleccionado, se abrira con select
    const selectPersonal = document.getElementById('selectPersonal');
    const personal_i = document.getElementById('personal-institucion'),
        personal_a = document.getElementById('personal-administracion'),
        personal_d = document.getElementById('personal-docente'),
        personal_r = document.getElementById('personal-representante');

    selectPersonal.addEventListener('change', () => { 
        $('#personalData').empty();
        if(selectPersonal.value === 'seleccionar') {
            checkRepresentanteDiv.style.display = 'none';
            document.querySelector('.checkTodos').style.display = 'none';
        }
        if (selectPersonal.value === 'administracion') {
                // check
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'none';     
                $.get('../../FichasPersonales/api/administrativos', function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.nombres + " " + data.apellidos));
                    })
                })
            }
            /*
            if (selectPersonal.value === 'docentes') {
            document.querySelector('.checkTodos').style.display = 'block';
            checkTodos.checked = false;
            checkRepresentanteDiv.style.display = 'none';
            $.get('../../FichasPersonales/api/docentes', function (value, status) {
                $.each(value.courses, function (key, data) {
                    value.data.forEach(function (el) {
                        if (data.idProfesor == el.id)
                            el.nombres = el.nombres + " - " + data.grado + " " + data.paralelo;
                    })
                    value.data.sort(function (a, b) {
                        var nameA = a.apellidos, nameB = b.apellidos
                        if (nameA < nameB) //sort string ascending
                            return -1
                        if (nameA > nameB)
                            return 1
                        return 0 //default return value (no sorting)
                    })
                })
                $.each(value.data, function (key, docente) {
                    $('#personalData')
                        .append(
                            $("<option></option>")
                                .attr("value", docente.id)
                                .text(docente.apellidos + " " + docente.nombres)
                        );
                })
            })
        }*/

        if (selectPersonal.value === 'docentes') {

           // alert(document.getElementById('idCurso').value);
            document.querySelector('.checkTodos').style.display = 'block';
            checkTodos.checked = false;
            checkRepresentanteDiv.style.display = 'none';
            $.get('../../FichasPersonales/api/docentesMateria/?idCurso='+document.getElementById('idCurso').value, function (value, status) {
                $.each(value.courses, function (key, data) {                     
                    value.data.forEach(function (el) {
                      
                        if (data.idProfesor == el.id && value.courses[key].id == document.getElementById('idCurso').value)
                            el.nombres = el.nombres + " - " + data.grado + " " + data.paralelo;
                    })
                    value.data.sort(function (a, b) {
                        var nameA = a.apellidos, nameB = b.apellidos
                        if (nameA < nameB) //sort string ascending
                            return -1
                        if (nameA > nameB)
                            return 1
                        return 0 //default return value (no sorting)
                    })
                
                })
                $.each(value.data, function (key, docente) {
                    if (true) {}
                    $('#personalData')
                        .append(
                            $("<option></option>")
                                .attr("value", docente.id)
                                .text(docente.apellidos + " " + docente.nombres+" "+docente.materia)
                        );
                })
            })
        }
    })

    //Input de los checkbox de los cursos
    var c = document.getElementById('cursosCheck').getElementsByTagName('input');

    //Recorrido de cada checkbox
    for (index = 0; index < c.length; ++index) {

        //Se agrega eventlisteners para cada checkbox
        c[index].addEventListener('click', function() {

            //Se optienen los estudiantes cargados en el selecet #personalData
            var estudiantesTodos = document.querySelectorAll('#personalData option');
            
            //Validacion si esta seleccionado el checkbox
            if((this).checked) {

                //Recorrido de los estudiantes
                for (let i = 0; i < estudiantesTodos.length; i++) {

                    //Validacion si el id de curso coincide con el id del curso del estudiante
                    if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                        //Se agrega atributo selected
                        estudiantesTodos[i].setAttribute('selected', '');
                        estudiantesTodos[i].selected = true;
                    }  else {
                        //Validacion si el id de curso coincide con el id del curso del estudiante
                        if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                            //Se agrega atributo selected
                            estudiantesTodos[i].setAttribute('selected', '');
                            estudiantesTodos[i].selected = true;
                        }
                    }
                }
            }
            //Si se quita la seleccion del checkbox
            else{
                //Recorrido de los estudiantes
                for (let i = 0; i < estudiantesTodos.length; i++) {
                    //Validacion si el id de curso coincide con el id del curso del estudiante
                    if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                        //Se elimina la propiedad selected
                        estudiantesTodos[i].selected = false;
                        estudiantesTodos[i].removeAttribute( "selected" );
                    }  else {
                        //Validacion si el id de curso coincide con el id del curso del estudiante
                        if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                            //Se elimina la propiedad selected
                            estudiantesTodos[i].selected = false;
                            estudiantesTodos[i].removeAttribute( "selected" );
                        }
                    }
                }

            }
        });
    }


})()
</script>
@endsection
