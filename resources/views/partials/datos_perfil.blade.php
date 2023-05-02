@php
$rol = Sentinel::getUser()
    ->roles()
    ->first()->name;
$user_data = session('user_data');
use App\Administrative;
@endphp
<div class="row wrapper white-bg perfil-general relative">
    <div class="foto-perfil">
        @if ($permiso == null || ($permiso != null && $permiso->editar == 1))
            <!--agrego la validación del permiso-->
            {{ Form::open(['url' => '/Avatar', 'method' => 'post', 'files' => 'true']) }}
            <label for="my-file" class="label-my-file">
                {{ Form::file('image', ['name' => 'image','accept' => 'image/x-png,image/gif,image/jpeg','class' => 'my-file']) }}
                Cambiar foto de perfil
            </label>
            {{ Form::text('url_image', $user_data->url_imagen,['hidden'])}}
            {{ Form::submit('Subir') }}
            {{ Form::close() }}
        @endif
    </div>
    @if ($errors->any())
        <ul>
            <div class="row">
                <div class="col-md-4"> <!-- Definir una columna de tamaño 4 -->
                    <div class="row"> <!-- Crear una nueva fila -->
                        @foreach ($errors->all() as $error)
                            <div class="col-md-12 alert alert-dismissible alert-danger" style="margin-top: 5px;" role="alert">{{$error}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </ul>
    @endif
    <script>
        const submitBtn = document.querySelector('input[value="Subir"]');
        submitBtn.style.display = 'none';
        const myLabel = document.querySelector('.my-file');
        myLabel.addEventListener('click', function() {
            submitBtn.style.display = 'inline-block';
        })
    </script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#mostrarmodal").modal("show");
        });
    </script>
    <div class="profile-image">
        <img src="{{ $user_data->url_imagen == null ? secure_asset('img/icono_persona.png') : secure_asset('storage/'.$user_data->url_imagen) }}"
            class="img-circle circle-border m-b-md" alt="profile">
    </div>
    <div class="profile-info">
        <h2 class="no-margins uppercase">{{ strtoupper($user_data->nombres . ' ' . $user_data->apellidos) }}</h2>
        <h3><strong>PERFIL</strong></h3>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="widget widget-tabs">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-1">GENERAL</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-2">DOMICILIO</a>
                        </li>
                       {{-- @if ($rol == 'Docente')
                            <li>
                                <a data-toggle="tab" href="#tab-3">TÍTULOS</a>
                            </li>
                        @else
                            <li>
                                <a data-toggle="tab" href="#tab-4">MÉDICA</a>
                            </li>
                        @endif --}}
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <ul class="list-unstyled m-t">
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Nombres:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->nombres }}
                                        </div>
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Apellidos:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->apellidos }}
                                        </div>
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>C.I:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->ci }}
                                        </div>
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Correo:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->correo }}
                                        </div>
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->movil }}
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <ul class="list-unstyled m-t">
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Dirección:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->dDomicilio }}
                                        </div>
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $user_data->tDomicilio }}
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        @if ($rol == 'Representante')
                            <div id="tab-3" class="tab-pane">
                                <ul class="list-unstyled m-t">
                                    <div class="row">
                                        <li class="option-tabs">
                                            <div class="col-lg-2">
                                                <label>Dirección:</label>
                                            </div>
                                            <div class="col-lg-10">
                                                {{ $user_data->direccion }}
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li class="option-tabs">
                                            <div class="col-lg-2">
                                                <label>Teléfono:</label>
                                            </div>
                                            <div class="col-lg-10">
                                                {{ $user_data->telefono }}
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                            <div id="tab-4" class="tab-pane">
                                <ul class="list-unstyled m-t">
                                    <div class="row">
                                        <li class="option-tabs">
                                            <div class="col-lg-4">
                                                <label>Teléfono de emergencia:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{ $user_data->numero_emergencia }}
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        @else
                            <div id="tab-4" class="tab-pane">
                                <ul class="list-unstyled m-t">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Teléfono de emergencia:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{ $user_data->numero_emergencia }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Enfermedad que padece:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{ $user_data->enfermedad }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Observación:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{ $user_data->observacion }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Grupo sanguíneo:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{ $user_data->grupo_sanguineo }}
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    @if ($permiso == null || ($permiso != null && $permiso->editar == 1))
                        <!--agrego la validación del permiso-->
                        @if ($editarDatosEstudiante->valor == 1 || $rol != 'Estudiante')
                            <a href="{{ route('editPerfil') }}" class='pinedTooltip mr-05'>
                                <i class="fa fa-pencil a-fa-pencil__matricula a-fa-pencil__matricula"></i>
                                <span class="pinedTooltipH">EDITAR PERFIL</span>
                            </a>
                            {{--@if ($rol == 'Docente')
                            @php
                                $docenteActual = Administrative::find($user_data->id);
                            @endphp
                                <a href="{{ route('curriculumDocente', Sentinel::getUser()->id) }}" class="pinedTooltip mr-05" target="_blank">
                                    <img src="{{ secure_asset('img/file-download.svg') }}" width="17" alt="">
                                    <span class="pinedTooltipH">Hoja de Vida Docente</span>
                                </a>
                            @endif--}}
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>


@if ($rol == 'Administrador')
@endif
@if ($rol == 'Docente')
    <!--
    <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Bienvenido Docente</h3>
                </div>
                <div class="modal-body">


                    Le pedimos que edite su perfil, ingrese su horario de clase y verifique la información que tiene disponible.<br>
                    En el caso de necesitarse correciones lo realizaremos en el transcurso de la semana.<br>

                    Gracias por su atención.
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    -->
@endif
@if ($rol == 'Representante')
    <!--
    <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>Estimado Representante</h3>
                </div>
                <div class="modal-body">

                    Le pedimos que edite su perfil.
                    Verifique si el/los estudiantes que se muestran, en efecto usted es el representante.

                    <br><br>
                    Estamos realizando las configuraciones pertinentes con la institución y en pocos dias tendrá disponible toda la información que necesita para el uso de la plataforma con normalidad.
                    <br><br>
                    Agradecemos su tiempo y comprensión.
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
    -->
@endif
