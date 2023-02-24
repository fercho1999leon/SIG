
<div class="row wrapper white-bg directorPerfil-info">                        
    <div class="profile-image">
        <img src="{{secure_asset("storage/$user_data->url_imagen") }}" class="img-circle circle-border m-b-md" alt="profile">
    </div>
    <div class="profile-info">
        <h2 class="no-margins">CARMEN OJEDA LEON</h2>  
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
                        <li>
                            <a data-toggle="tab" href="#tab-3">MÉDICA</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <ul class="list-unstyled">
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Nombres:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            CARMEN
                                        </div>                                            
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Apellidos:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            OJEDA LEON
                                        </div>                                            
                                    </li>   
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>C.i:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            091538132-1
                                        </div>                                                
                                    </li>
                                </div>       
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Correo:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            misscarmen_3@gmail.com
                                        </div>
                                    </li>
                                </div>                                                   
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Telefono:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            099 399 8977
                                        </div>
                                    </li>    
                                </div>                                                         
                            </ul>   
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <ul class="list-unstyled">
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Ciudad:</label>
                                        </div>         
                                        <div class="col-lg-10">
                                            DURAN
                                        </div>                                                
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">                
                                            <label>Direccion:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            CDLA. DEMOCRATICA SUR 
                                        </div>
                                    </li> 
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-2">
                                            <label>Telefono:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            099 399 8977
                                        </div>                                                
                                    </li> 
                                </div>                                      
                            </ul> 
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <ul class="list-unstyled">
                                <div class="row"> 
                                    <li class="option-tabs">
                                        <div class="col-lg-4">
                                            <label>Telefono de emergencia:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            042 55 99 88
                                        </div> 
                                    </li>                                            
                                </div>
                                <div class="row">
                                    <li class="option-tabs">    
                                        <div class="col-lg-4">
                                            <label>Sufre de enfermedad:</label>
                                        </div>                      
                                        <div class="col-lg-8">
                                            SI
                                        </div>                                                
                                    </li>
                                </div>
                                <div class="row">
                                    <li class="option-tabs">
                                        <div class="col-lg-4">
                                            <label>Alergia:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            SI - FRESAS
                                        </div>                                                  
                                    </li>
                                </div>
                            </ul> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div> 


{{ Form::open(array('url' => '/Avatar','method' =>  'post','files'=>'true')) }}
{{ Form::file('image',array('name'  =>  'image','accept' =>  'image/x-png,image/gif,image/jpeg'))}}
{{ Form::submit('Subir')}}
{{ Form::close() }}
