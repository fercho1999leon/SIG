<style>
    .ck-editor__top {
        display: none !important;
    }
</style>
@extends('layouts.master')
@section('content')
	@include('layouts.nav_bar_top')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row">
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail pinedTooltip" href="{{ route('notificacionesEnviar') }}">
                                
                            	<span class="pinedTooltipH">Nuevo Correo</span>
                            </a>
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
				<div class="nuevoMensaje">
					<div class="nuevoMensaje__container">
						
						<h3 class="underline">Para:</h3>
						<div class="nuevoMensaje__enviados-mail">
							<div class="nuevoMensaje__enviados-mask" style="display: none">
							</div>
							@foreach($users as $user)
							<h4>&lt;{{$user->nombres." ".$user->apellidos}}&gt;</h4>
							@endforeach
							<a class="nuevoMensaje__enviados-vermas" style="display: none;">Ver mas</a>
						</div>
					</div>
					<div class="nuevoMensaje__container">
						<h3 class="underline">Razon</h3>
						<h3 class="bold">{{ $message->razon }}</h3>
					</div>
					@if($message->adjunto != null)
					<div class="nuevoMensaje__container">
						<h3 class="underline">Adjunto</h3>
						<h3 class="bold">
							<a href="{{ route('descargaAdjuntos', ['archivo' => $message->adjunto ]) }}">
							{{ substr($message->adjunto,4,100) }}
							</a>
						</h3>
					</div>
					@endif
					<div class="nuevoMensaje__container">
						<h3 class="underline">Descripción</h3>
						<textarea id="editor" class="nuevoMensaje__content">{{ $message->descripcion }}</textarea>
					</div>
                    @if($messageLista==null)
                   
                    <div class="nuevoMensaje__container text-rigth">
                    <a href="#" onclick="verRespuesta({{$message->id}},'');">                                     
                        <span class="label label-primary pull-right"><i class="fa fa-envelope-o"></i> Responder</span>
                    </a>
                    </div>  
                    <div id="respuesta" style="display: none">
                    <form method="post" action="{{ route('enviarMensajeRespuesta') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id='idOriginal' name="idOriginal" value="">
                             <div class="nuevoMensaje__container">
                                <label for="">Razon</label>
                                <input name="razon" type="text" class="form-control" required>
                            </div>
                            <div class="nuevoMensaje__container">
                                <label for="">Descripcion</label>
                                <textarea name="descripcion" id="editor" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="nuevoMensaje__container">
                                <label for="">Adjuntar archivos <span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span></label>
                                <input id="adjunto" name="adjunto" type="file" class="file">
                            </div>
                            <div class="text-right">
                                <input type="reset" value="Cancelar" class="btn btn-danger" onclick="cerrarRespuesta()">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>                   
                    @else
                    @foreach($messageLista as $lista)
                  
                    <div class="nuevoMensaje__container">
                        <h4 class="text-right">Fecha: {{date('d-m-Y H:m:s', strtotime( $lista->created_at))  }}</h4>
                        <h4 class="text-right">{{$lista->cargo}}: {{$lista->apellidos}} {{$lista->nombres}}</h4>                      
                    </div>
                    <div class="nuevoMensaje__container">
                        <h3 class="underline">Razon</h3>
                        <h3 class="bold">{{ $lista->razon }}</h3>
                    </div>
                    @if($lista->adjunto != null)
                    <div class="nuevoMensaje__container">
                        <h3 class="underline">Adjunto</h3>
                        <h3 class="bold">
                            <a href="{{ route('descargaAdjuntos', ['archivo' => $lista->adjunto ]) }}">
                            {{ substr($lista->adjunto,4,100) }}
                            </a>
                        </h3>
                    </div>
                    @endif
                    <div class="nuevoMensaje__container">
                        <h3 class="underline">Descripción</h3>
                      <p style="border: 1px;">{{ $lista->descripcion }}</p>
                    </div>

                    @if($lista->id_from!==$user_session->id)
                    <div class="nuevoMensaje__container text-rigth">
                    <a href="#" onclick="verRespuesta({{$message->id}},{{$lista->message_id}});">                                    
                        <span class="label label-primary pull-right"><i class="fa fa-envelope-o"></i> Responder</span>
                    </a>
                    </div>
                    @endif
                    <div id="respuesta{{$lista->message_id}}" style="display: none">
                    <form method="post" action="{{ route('enviarMensajeRespuesta') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id='idOriginal' name="idOriginal" value="{{$lista->message_id}}">             
                        <input type="hidden" id='idRespuesta' name="idRespuesta" value="">
                             <div class="nuevoMensaje__container">
                                <label for="">Razon</label>
                                <input name="razon" type="text" class="form-control" required>
                            </div>
                            <div class="nuevoMensaje__container">
                                <label for="">Descripcion</label>
                                <textarea name="descripcion" id="editor" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="nuevoMensaje__container">
                                <label for="">Adjuntar archivos <span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span></label>
                                <input id="adjunto" name="adjunto" type="file" class="file">
                            </div>
                            <div class="text-right">
                                <input type="reset" value="Cancelar" class="btn btn-danger" onclick="cerrarRespuesta()">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                    @endif           
				</div>
			</div>
		</div>
    </div>

    <script src=" {{secure_asset('ckeditor/ckeditor.js')}} "></script>
    <script>
        ClassicEditor
            .create(document.querySelector( '#editor' ), {
            }) 
            .catch( error => {
                console.error( error );
            } );
           </script>
    <script>
        function load() {
            const ck = document.querySelector('.ck-content');
            ck.setAttribute('contenteditable', 'false');
          }
          window.onload = load;
        //   ocultar nombres de las personas que se le envio las notificaciones
        const contenedorNombres = document.querySelector('.nuevoMensaje__enviados-mail'),
                               mailVerMas = document.querySelector('.nuevoMensaje__enviados-vermas'),
                               mask = document.querySelector('.nuevoMensaje__enviados-mask');
          if(contenedorNombres.clientHeight > 150) {
            mask.style.display = 'block';
            mailVerMas.style.display = 'inline-block';
            contenedorNombres.style.height = '150px';
            mailVerMas.addEventListener('click', function() {
                if(contenedorNombres.clientHeight == 150) {
                    contenedorNombres.style.height = 'auto';
                    mask.style.display = 'none';
                    contenedorNombres.style.padding = '0 0 35px 0';
                    mailVerMas.textContent = 'Ver Menos'
                } else {
                    contenedorNombres.style.height = '150px';
                    mask.style.display = 'block';
                    contenedorNombres.padding = '0'; 
                    mailVerMas.textContent = 'Ver Mas'
                }
            })
          } else {
                mask.style.display = 'none';
                mailVerMas.style.display = 'none';
          }
function verRespuesta(id,res){
    if ($("#respuesta"+res).is(":visible")) {
    $("#respuesta"+res).hide();
}else{
    $('#idOriginal').val(id);
    $('#idRespuesta').val(res);
 $("#respuesta"+res).show();
}
}
function cerrarRespuesta(){
    $("#respuesta"+id).hide();
}

    </script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
   
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@endsection

