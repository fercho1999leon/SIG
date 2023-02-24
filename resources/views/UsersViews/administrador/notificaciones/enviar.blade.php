<style>
    .ck-file-dialog-button {
        display: none !important;
    }
</style>
@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row">
        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <button disabled class="btn btn-block btn-primary compose-mail pinedTooltip" href="">
                            
                            <span class="pinedTooltipH">Nuevo Correo</span>
                        </button>
                        <div class="space-25"></div>
                        <h5>CATEGORÍAS</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li>
                                <a href="{{ route('notificacionesRecibidos') }}">
                                    <i class="fa fa-inbox "></i> Bandeja de Entrada
                                    <span class="label label-warning pull-right">{{ $countMessages }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('notificacionesEnviados') }}">
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
                <div class="nuevoMensaje">
                    <div class="nuevoMensaje__container">
                        <label for="">Para:</label>                 
                        
                        <div class="nuevoMensaje__container-p">
                            <select name="selectPersonal" id="selectPersonal" class="form-control">
                                <option value="seleccionar">Seleccionar</option>
                                <option value="administracion">Administración</option>
                                <option value="secretaria">Secretaría</option>
                                <option value="docentes">Docentes</option>
                                @if($user_profile->cargo=='Docente')
                                <option value="representantes2">.R.</option>
                                <option value="estudiantes2">Estudiantes</option>
                                @else
                                <option value="representantes">.R.</option>
                                <option value="estudiantes">Estudiantes</option>
                                @endif
                            </select>
                            <select id="CursoData" name="Curso[]"  multiple  style="display: none;">
                            </select>
                            <div class="checkTodos" style="display: none">
                                <label for="checkTodos">Todos</label>
                                <input id="checkTodos" type="checkbox">
                            </div>
                            <div id="cursosCheck" class="checkRepresentantes" style="display:none">
                                <div class="checkRepresentantes-grid">
                                    <div class="checkRepresentantes__grados">
                                        <div class="checkRepresentantes__checkbox">
                                            <div>
                                                <input id="EI" class="no-margin" type="checkbox">
                                                <label for="EI">EI</label>
                                            </div>
                                        </div>
                                        <div class="EI gradosCheck" >
                                            @foreach($courses as $course)
                                                @if($course->seccion === 'EI')
													<input id="{{$course->id}}" class="no-margin" type="checkbox"> 
													<label for="{{$course->id}}" class="no-margin">{{$course->grado}} {{$course->paralelo}}</label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="checkRepresentantes__grados">
                                        <div class="checkRepresentantes__checkbox">
                                            <div>
                                                <input id="EGB" class="no-margin" type="checkbox">
                                                <label for="EGB">EGB</label>
                                            </div>
                                        </div>
                                        <div class="EGB gradosCheck" >
                                            @foreach($courses as $course)
                                                @if($course->seccion === 'EGB')
                                                <input id="{{$course->id}}" class="no-margin" type="checkbox"> 
                                                <label for="{{$course->id}}" class="no-margin">{{$course->grado}} {{$course->paralelo}}</label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="checkRepresentantes__grados">
                                        <div class="checkRepresentantes__checkbox">
                                            <div>
                                                <input id="BGU" class="no-margin" type="checkbox">
                                                <label for="BGU">BGU</label>
                                            </div>
                                        </div>
                                        <div class="BGU gradosCheck" >
                                            @foreach($courses as $course)
                                                @if($course->seccion === 'BGU')
                                                <input id="{{$course->id}}" class="no-margin" type="checkbox"> 
                                                <label for="{{$course->id}}" class="no-margin">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <select id="personalData" name="user[]" class="form-control" multiple required>
                            </select>
                        </div>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Copia:</label>
                        <input class="form-control" type="text" name="" id="NuevoEmail"  placeholder="Agregue más destinatarios">
                        <div id="listaCorreos"></div>
                        <div class="nuevoMensaje__enviados-mail" id="EmailCopia" >
                            <div class="nuevoMensaje__enviados-mask" style="display: none"></div>                
                        </div>
                        <input type="hidden" name="CopiaCorreos" id="CopiaCorreos" value="0">
                        <div id="listaCorreosCopia"></div>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Razon</label>
                        <input name="razon" type="text" class="form-control" required>
                    </div>
                    <div class="nuevoMensaje__container">
                        <label for="">Descripcion</label>
                        <textarea name="descripcion" id="editor" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    @if ($user_profile->cargo != 'Representante' || ($user_profile->cargo == 'Representante' && $adjunto->valor==1))
                        <div class="nuevoMensaje__container">
                            <label for="">Adjuntar archivos <span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span></label>
                            <input id="adjunto" name="adjunto" type="file" class="file">
                        </div>
                    @endif
                    <div class="text-right">
                        <input type="reset" value="Cancelar" class="btn btn-danger">
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
  $("#adjunto").fileinput();
    (function () {

        // Este es el checkbox donde se marcan todos los listados generados en el select,sea representante o docentes, etc
        const checkRepresentanteDiv = document.querySelector('.checkRepresentantes')
        const cInput = document.querySelectorAll('input[type="checkbox"]')
        // checkbox Representantee
        const checkTodos = document.getElementById('checkTodos');
        checkTodos.addEventListener('click', function () {
            let checkRep = document.getElementById('checkTodos');
            if (checkRep.checked) {
                var c = document.getElementById('cursosCheck').getElementsByTagName('input');
                var representantesTodos = document.querySelectorAll('#personalData option');
                for (let i = 0; i < representantesTodos.length; i++) {
                    representantesTodos[i].setAttribute('selected', '');
                    representantesTodos[i].selected = true;
                }
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].setAttribute('checked', '')
                    cInput[i].checked = true;
                }
            } else {
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].removeAttribute('checked')
                    cInput[i].checked = false;
                }
                var representantesTodos = document.querySelectorAll('#personalData option');
                for (let i = 0; i < representantesTodos.length; i++) {
                    representantesTodos[i].removeAttribute('selected');
                    representantesTodos[i].selected = false;
                }
            }
        })
    $('#NuevoEmail').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
        var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteEmail') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listaCorreos').show();           

                    $('#listaCorreos').html(data);
          }
         });
        } 
    });

        // segun el personal seleccionado, se abrira con select
        const selectPersonal = document.getElementById('selectPersonal');
        const personal_i = document.getElementById('personal-institucion'),
            personal_a = document.getElementById('personal-administracion'),
            personal_d = document.getElementById('personal-docente'),
            personal_r = document.getElementById('personal-representante');

        selectPersonal.addEventListener('change', () => {
            $('#personalData').empty();
            if (selectPersonal.value === 'seleccionar') {
                checkRepresentanteDiv.style.display = 'none';
                document.querySelector('.checkTodos').style.display = 'none';
            }
            if (selectPersonal.value === 'administracion') {
                // check
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'none';
                 $('#CursoData').hide()              
                $.get('FichasPersonales/api/administrativos', function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.nombres + " " + data.apellidos));
                    })
                })
            }
            if (selectPersonal.value === 'secretaria') {
                // check
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'none';
                 $('#CursoData').hide()
                $.get('FichasPersonales/api/secretaria', function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.nombres + " " + data.apellidos));
                    })
                })
            }
            if (selectPersonal.value === 'estudiantes2') {
                $('#CursoData').empty()
                // check
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'none';
                $.get('FichasPersonales/api/cursosDocente', function (value, status) {
                    $.each(value, function (key, data) {  
                    $('#CursoData').show();                    
                            $('#CursoData')
                            .append($("<option onclick='seleccionar_estudiante("+data.id+");'></option>")
                               .attr("value", data.id)
                                .text(data.grado + " " + data.paralelo));
                       
                    })
                })
            }
            if (selectPersonal.value === 'representantes2') {
                $('#CursoData').empty()
                // check
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'none';
                $.get('FichasPersonales/api/cursosDocente', function (value, status) {
                    $.each(value, function (key, data) {  
                    $('#CursoData').show();                    
                            $('#CursoData')
                            .append($("<option onclick='seleccionar_repre("+data.id+");'></option>")
                               .attr("value", data.id)
                                .text(data.grado + " " + data.paralelo));
                       
                    })
                })
            }
            if (selectPersonal.value === 'docentes') {
                document.querySelector('.checkTodos').style.display = 'block';
                checkRepresentanteDiv.style.display = 'none';
                 $('#CursoData').hide()
                checkTodos.checked = false;
                $.get('FichasPersonales/api/docentes', function (value, status) {
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
            }

            //Si selecciona representante
            if (selectPersonal.value === 'representantes') {
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'block';
                 $('#CursoData').hide()
                $.get('FichasPersonales/api/estudiantesConRepresentante', function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)//Id del reprentante con nombres y apellidos de estudiantes
								.text(data.nombres + " " + data.apellidos + " - " + data.grado + " " + data.paralelo));
                    })
					var representantesTodos = document.querySelectorAll('#personalData option');
                    for (let i = 0; i < representantesTodos.length; i++) {
                        representantesTodos[i].setAttribute('id', value[i].idCurso);
                    }
                });
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].removeAttribute('checked')
                    cInput[i].checked = false;
                }
			}
			
            //Si selecciona estudiantes
            if (selectPersonal.value === 'estudiantes') {
                document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                checkRepresentanteDiv.style.display = 'block';
                 $('#CursoData').hide()
                $.get('FichasPersonales/api/estudiantes', function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)//Id del reprentante con nombres y apellidos de estudiantes
								.text(data.nombres + " " + data.apellidos + " - " + data.grado + " " + data.paralelo));
                    })
					var representantesTodos = document.querySelectorAll('#personalData option');
                    for (let i = 0; i < representantesTodos.length; i++) {
                        representantesTodos[i].setAttribute('id', value[i].idCurso);
                    }
                });
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].removeAttribute('checked')
                    cInput[i].checked = false;
                }
            }
        })
        //Input de los checkbox de los cursos
        var c = document.getElementById('cursosCheck').getElementsByTagName('input');
        //Recorrido de cada checkbox
        for (index = 0; index < c.length; ++index) {

            //Se agrega eventlisteners para cada checkbox
            c[index].addEventListener('click', function () {

                //Se optienen los estudiantes cargados en el selecet #personalData
                var estudiantesTodos = document.querySelectorAll('#personalData option');

                //Validacion si esta seleccionado el checkbox
                if ((this).checked) {
                    //Recorrido de los estudiantes
                    for (let i = 0; i < estudiantesTodos.length; i++) {
                        //Validacion si el id de curso coincide con el id del curso del estudiante
                        if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                            //Se agrega atributo selected
                            estudiantesTodos[i].setAttribute('selected', '');
                            estudiantesTodos[i].selected = true;
                        } else {
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
                else {
                    //Recorrido de los estudiantes
                    for (let i = 0; i < estudiantesTodos.length; i++) {
                        //Validacion si el id de curso coincide con el id del curso del estudiante
                        if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                            //Se elimina la propiedad selected
                            estudiantesTodos[i].selected = false;
                            estudiantesTodos[i].removeAttribute("selected");
                        } else {
                            //Validacion si el id de curso coincide con el id del curso del estudiante
                            if (estudiantesTodos[i].getAttribute('id') === (this).id) {
                                //Se elimina la propiedad selected
                                estudiantesTodos[i].selected = false;
                                estudiantesTodos[i].removeAttribute("selected");
                            }
                        }
                    }

                }
            });
        }
    })()
    function seleccionar_estudiante($idCurso){
      
        $('#personalData').empty()
        const checkRepresentanteDiv = document.querySelector('.checkRepresentantes')
        const cInput = document.querySelectorAll('input[type="checkbox"]')
        // checkbox Representantee
            document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                //checkRepresentanteDiv.style.display = 'block';
                $.get('FichasPersonales/api/estudiantesMateria?idCurso='+$idCurso, function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)//Id del reprentante con nombres y apellidos de estudiantes
                                .text(data.nombres + " " + data.apellidos + " - " + data.grado + " " + data.paralelo));
                    })
                    var representantesTodos = document.querySelectorAll('#personalData option');
                    for (let i = 0; i < representantesTodos.length; i++) {
                        representantesTodos[i].setAttribute('id', value[i].idCurso);
                    }
                });
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].removeAttribute('checked')
                    cInput[i].checked = false;
                }
            
    }
    function seleccionar_repre($idCurso){
      
        $('#personalData').empty()
        const checkRepresentanteDiv = document.querySelector('.checkRepresentantes')
        const cInput = document.querySelectorAll('input[type="checkbox"]')
        // checkbox Representantee
            document.querySelector('.checkTodos').style.display = 'block';
                checkTodos.checked = false;
                //checkRepresentanteDiv.style.display = 'block';
                $.get('FichasPersonales/api/representantesMateria?idCurso='+$idCurso, function (value, status) {
                    $.each(value, function (key, data) {
                        $('#personalData')
                            .append($("<option></option>")
                                .attr("value", data.id)//Id del reprentante con nombres y apellidos de estudiantes
                                .text(data.nombres + " " + data.apellidos + " - " + data.grado + " " + data.paralelo));
                    })
                    var representantesTodos = document.querySelectorAll('#personalData option');
                    for (let i = 0; i < representantesTodos.length; i++) {
                        representantesTodos[i].setAttribute('id', value[i].idCurso);
                    }
                });
                for (let i = 0; i < cInput.length; i++) {
                    cInput[i].removeAttribute('checked')
                    cInput[i].checked = false;
                }
            
    }
    function agregarEmail($id,$correo,$nombres,$apellidos){
        var array_copia = []; 
        $('#listaCorreos').hide();
        $('#NuevoEmail').val(''); 
        var str =$('#CopiaCorreos').val();
        var array = str.split(',');
            if(!array.includes($id)){        
                array_copia.push($('#CopiaCorreos').val());
                var titulo =$nombres.concat(' ',$apellidos);
                $('#EmailCopia').append("<h4 title='"+titulo+"' id='email_"+$id+"'>"+$correo+" | <i class='fa fa-times' onClick='quitarCorreo("+$id+")'></i></h4>");
                    array_copia.push($id);
                $('#CopiaCorreos').val(array_copia);
            }else {
            alert('Contacto duplicado');}
    }
    function quitarCorreo($id){ 
    $('#email_'+$id).remove();
        var str =$('#CopiaCorreos').val();
        var array = str.split(',');
        var index = array.indexOf(''+$id);
            if (index > -1) {
            array.splice(index, 1);
            }
        $('#CopiaCorreos').val(array);

    }
</script> 
@endsection