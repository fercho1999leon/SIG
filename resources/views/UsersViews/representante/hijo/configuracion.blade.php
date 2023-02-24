@extends('layouts.master') 
@section('content')
<a class="button-br" href=" {{route('hijo', $hijo)}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <form method="post" action="{{ route('hijo_update', $data->id) }}" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row wrapper white-bg">
            <div class="col-lg-12">
                <h2 class="title-page">Estudiante:
                    <small class="uppercase">
                        {{$hijo->nombres}}  {{$hijo->apellidos}} - {{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}
                    </small>
                </h2>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="widget widget-tabs no-margin">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-eg1">General</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-ed1">Domicilio</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-ea1">Contactos Emergencia</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-eb2">Correo de acceso</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-eg1" class="tab-pane active">
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-right tabletd_name w25 ">
                                                    <span>Cédula/Pasaporte</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->ci}}"disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name">
                                                    <span>Fecha de Nacimiento</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->fechaNacimiento}}"disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name w25 ">
                                                    <span>Nacionalidad</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->nacionalidad}}"disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name">
                                                    <span>Se encuentra condicionado</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->condicionado}}" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name">
                                                    <span>Teléfono Celular</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->celular}}"disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name">
                                                    <span>Sexo</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$hijo->sexo}}"disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right tabletd_name">
                                                    <span>Correo</span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control input-sm" value="{{$correo}}" disabled>
                                                    @if($correo==null)
                                                        Actualmente el estudiante no consta como matriculado en la institución para el presente periodo lectivo.
                                                    @endif
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="tab-ed1" class="tab-pane">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-right w25 tabletd_name">
                                                <span>Dirección del domicilio</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->direccion_domicilio}}" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right tabletd_name">
                                                <span>Teléfono del domicilio</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->telefono_movil}}" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="tab-ea1" class="tab-pane">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-right w25 tabletd_name">
                                                <span>Primer contacto emergencia</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->nombre_contacto_emergencia}}" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right tabletd_name">
                                                <span>Teléfono</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->movil_contacto_emergencia}}" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right w25 tabletd_name"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right w25 tabletd_name">
                                                <span>Segundo contacto emergencia</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->nombre_contacto_emergencia2}}" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right tabletd_name">
                                                <span>Teléfono</span>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control input-sm" value="{{$hijo->movil_contacto_emergencia2}}" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="tab-eb2" class="tab-pane">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="panel panel-default p-1">
                                        <div class="r-configuraciones-container">
                                            <h2 class="text-center text-color7 uppercase">Datos de Acceso
                                            </h2>
                                            <label for="nombre">Correo</label>
                                            <input type="email" name="email" class="form-control mb-1" value="{{$correo}}">
                                            <label for="contraseña">Password</label>
                                            <div class="mostrarContraseña">
                                                <input type="password" class="form-control " name="password" >
                                                <a>
                                                    <div class="eye-slash"></div>
                                                    <img src="{{secure_asset('img/eye.svg')}}" width="25">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center mt-1">
                    <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                </div>
            </div>
    </form>
</div>
    <script>
        const inputPass = document.querySelector('.mostrarContraseña input')
        const a = document.querySelector('.mostrarContraseña a');
        const passEye = document.querySelector('.eye-slash');

        a.addEventListener('click', function () {
            if (inputPass.type === "password") {
                inputPass.type = 'text';
                passEye.style.opacity = 1;
            } else {
                passEye.style.opacity = 0;
                inputPass.type = 'password';
            }
        })
    </script> 
@endsection