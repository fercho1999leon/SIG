<div class="row noBefore wrapper white-bg a-informacionInstitucion">
    <div class="text-center">
        <img class="a-logoInstitucion__perfil" src="img/escudo.png">
    </div>
    <div class="a-institucion__unidadEducativa">
        @foreach($data as $institution)
        <h1 class="title-school text-center">
            <small class="text-center">UNIDAD EDUCATIVA</small>
            <br>{{$institution->nombre}}
        </h1>
        @endforeach
        <p class="text-center">{{$institution->ciudad}}-{{$institution->direccion}}</p>
    </div>
</div>
@foreach($data as $institution)
<div class="row wrapper wrapper-content pb250">
    @if($institution->lema !=null)
    <div class="alert alert-info alert-dismissible text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{$institution->lema}}
    </div>
    @endif
    <div class="col-lg-12">
        <div class="widget widget-tabs">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">INFORMACIÓN</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-2">MISIÓN-VISIÓN</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-3">HISTORIA-ANTECEDENTES</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-4">SECCIONES</a>
                    </li>
                    <!--
                    <li>
                        <a data-toggle="tab" href="#tab-5">DIRECTIVA</a>
                    </li>
                    -->
                    <li>
                        <a data-toggle="tab" href="#tab-6">WEB OFICIAL</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-7">REDES SOCIALES</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <ul class="list-unstyled">
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Ciudad:</label>
                                    </div>
                                    <div class="col-lg-10" id="city">
                                        {{$institution->ciudad}}
                                    </div>
                                </li>
                            </div>
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Direccion:</label>
                                    </div>
                                    <div class="col-lg-10" id='dir'>
                                        {{$institution->direccion}}
                                    </div>
                                </li>
                            </div>
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Correo:</label>
                                    </div>
                                    <div class="col-lg-10" id='telf'>
                                        {{$institution->correo}}
                                    </div>
                                </li>
                            </div>
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Telefono:</label>
                                    </div>
                                    <div class="col-lg-10" id='telf'>
                                        {{$institution->telefonos}}
                                    </div>
                                </li>
                            </div>
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Jornada:</label>
                                    </div>
                                    <div class="col-lg-10" id='tipo'>
                                        {{$institution->jornada}}
                                    </div>
                                </li>
                            </div>
                            <div class="row">
                                <li class="option-tabs">
                                    <div class="col-lg-2">
                                        <label>Horario de atencion:</label>
                                    </div>
                                    <div class="col-lg-10" id='tipo'>
                                        {{$institution->horariosDeAtencion}}
                                    </div>
                                </li>
                            </div>

                        </ul>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="row">
                            @if($institution->mision != null)
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm " id='mision'>
                                    <strong>Misión: </strong>{{$institution->mision}}</p>
                            </div>
                            @endif @if($institution->vision != null)
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm " id='mision'>
                                    <strong>Visión: </strong>{{$institution->vision}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="row">
                            @if($institution->historia != null)
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm " id='mision'>
                                    <strong>Historia: </strong>{{$institution->historia}}</p>
                            </div>
                            @endif @if($institution->antecedentes != null)
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm " id='mision'>
                                    <strong>Antecedentes: </strong>{{$institution->antecedentes}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 d-f jc-c fd-c ">
                                @if($institution->ei != null)
                                <p>
                                    <strong>EI:</strong>
                                </p>
                                <p>
                                    <small class="btn btn-success">{{$institution->ei}}</small>
                                </p>
                                @endif
                            </div>
                            <div class="col-lg-12 d-f jc-c fd-c">
                                @if($institution->egb != null)
                                <p>
                                    <strong>EGB:</strong>
                                </p>
                                <p>
                                    <small class="btn btn-success">{{$institution->egb}}</small>
                                </p>
                                @endif
                            </div>
                            <div class="col-lg-12 d-f jc-c fd-c">
                                @if($institution->bgu != null)
                                <p>
                                    <strong>BGU:</strong>
                                    </small>
                                </p>
                                <p>
                                    <small class="btn btn-success">{{$institution->bgu}}</small>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--
                    <div id="tab-5" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 d-f jc-c fd-c ">
                                <p>
                                    <strong>Rectora:</strong>
                                </p>
                                <p>
                                    <span class="label-success"> Carmen Ojeda León </span>
                                    <br>
                                    <strong>Correo: </strong>misscarmen_3@gmail.com
                                    <br>
                                    <strong>Teléfonos: </strong>099 399 8977
                                </p>
                                <p>
                                    <strong>Directora:</strong>
                                </p>
                                <p>
                                    <span class="label-success"> Carmen Ojeda León </span>
                                    <br>
                                    <strong>Correo: </strong>misscarmen_3@gmail.com
                                    <br>
                                    <strong>Teléfonos: </strong>099 399 8977
                                </p>
                            </div>
                        </div>
                    </div>
                    -->
                    <div id="tab-6" class="tab-pane">
                        <div class="row">
                            @if($institution->sitioWeb != null)
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm " id='mision'>{{$institution->sitioWeb}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div id="tab-7" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 d-f jc-c fd-c ai-c">
                                <p class="p-sm">
                                    @if($institution->facebook != null)
                                    <a href="{{$institution->facebook}">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    @endif @if($institution->twitter != null)
                                    <a href="{{$institution->twitter}">
                                        <i class="fa fa-twitter-square"></i>
                                    </a>
                                    @endif @if($institution->youtube != null)
                                    <a href="{{$institution->youtube}">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                    @endif @if($institution->google != null)
                                    <a href="{{$institution->google}">
                                        <i class="fa fa-google-plus-square"></i>
                                    </a>
                                    @endif @if($institution->instagram != null)
                                    <a href="{{$institution->instagram ">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach