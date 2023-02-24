@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')
<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js">
</script>
<script
    src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js">
</script>
<style type="text/css">
tfoot {
    display: table-header-group;
}

div.micelda {
    text-align: left !important;
    width: 800px !important;
}
.my-swal {
  z-index: X!impotant;
}
#tablaEstudiantes {
    text-align: center;
}
.fondoBoton{
    background-color: steelblue !important;
    color: white !important;
}
</style>
</head>
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page"> <i class="fa fa-cogs" aria-hidden="true"></i> Agregar Repositorio Instituto Superior Técnico Rey David</h2>
            <div class="agregarSeccionCont">
               
            </div>
        </div>     
    </div>
    <br>
    <div class="panel pl-8 pr-8 matricula__matriculacion">
        <div class="matricula__matriculacion-block">
        <h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
        </div>
        <div > 
                    
        <div class="col-md-12">
            @if($repositorio['id_documente_type'] != "")
            <form id="repositorioFrom" action="{{ route('editRepositorioUpdate') }}" onsubmit="return enviar();" enctype="multipart/form-data"  method="post">
                <input type="hidden" name="idRepositorio" value="{{$repositorio['id']}}">
                <input type="hidden" name="idDocument" value="{{$document['id']}}">
            @endif
            @if($repositorio['id_documente_type'] == "")
            <form id="repositorioFrom" action="{{ route('newRepositorioCreate') }}" onsubmit="return enviar();" enctype="multipart/form-data"  method="post">
            @endif
            
                {{ csrf_field() }}
                
                    <div class="row">
                        <div class="col-md-4">
                           <label for="name" class="matricula__matriculacion-label">Seleccione el Tipo de Documento: </label>
                            <select name="typeDocument" id="typeDocument" class="form-control">
                                <option defaulf>Seleccione</option>
                                @foreach ($typeDocument as $item)
                                <option value="{{$item->id}}" {{($repositorio['id_documente_type']) == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-md-8 matricula__matriculacion__input">                        
                            <label for="title" class="matricula__matriculacion-label">Ingrese el Titulo del Documento: </label>
                            <input type="text" class="form-control" name="title" placeholder="Ejemplo: ERP de Gestion Empresarial" value="{{old('apellidos', $document['title'])}}">
                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="secundaryAutthor" class="matricula__matriculacion-label">Ingrese el Nombre del Primer Autor: </label>
                            <input type="text" class="form-control" name="primaryAutthor" placeholder="Ejemplo: Oscar Leonardo Cornejo Baquero" value="{{old('apellidos', $document['author_primary'])}}">

                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="auxiliaryAutthor" class="matricula__matriculacion-label">Ingrese el Nombre del Segundo Autor: </label>
                            <input type="text" class="form-control" name="secundaryAutthor" placeholder="Ejemplo: Oscar Leonardo Cornejo Baquero" value="{{old('apellidos', $document['author_secondary'])}}">
                            
                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="primaryAutthor" class="matricula__matriculacion-label">Ingrese el Nombre del Autor Auxiliar: </label>
                            <input type="text" class="form-control" name="auxiliaryAutthor" placeholder="Ejemplo: Oscar Leonardo Cornejo Baquero" value="{{old('apellidos', $document['author_auxiliary'])}}">
                        </div>
                        
                        <div class="col-md-4 matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Nombre del Docente Tutor </label>
								<input type="text" class="form-control input-sm" name="name_addressee" id="name_addressee" value="{{old('apellidos', $document['tutor'])}}">
                                <input type="hidden"  name="id_tutor" id="id_tutor" value="{{old('apellidos', $document['id_tutor'])}}">
                        </div>
                        <div class="col-md-8 matricula__matriculacion__input">
                        
								<label for="" class="matricula__matriculacion-label">Seleccione el Tutor * Este campo puede quedar vacio una vez seleccionado o escrito </label>
								<input class="form-control" type="text" name="" id="NuevoEmail"  placeholder="Seleccione Tutor" value="{{old('apellidos', $document['tutor'])}}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div id="listaCorreos"></div>
                        </div>
                        <div class="col-md-7 matricula__matriculacion__input">
                            <label for="keywords" class="matricula__matriculacion-label">Ingrese las palabras Claves: </label>
                            <input type="text" class="form-control" name="keywords" placeholder="Ejemplo: Software, Desarrollo web, Java" value="{{old('apellidos', $document['keywords'])}}">
                        </div>
                        <div class="col-md-5 matricula__matriculacion__input">
                            <label for="editorial" class="matricula__matriculacion-label">Ingrese el Editorial: </label>
                            <input type="text" class="form-control" name="editorial" placeholder="Ejemplo: Software, Desarrollo web, Java" value="{{old('apellidos', $document['editorial'])}}">
                        </div>
                        <div class="col-md-12 matricula__matriculacion__input">
                            <label for="summary" class="matricula__matriculacion-label">Ingrese el Resumen: </label>
                            <textarea name="summary" id="summary" form="repositorioFrom" class="form-control" rows="10" cols="50" value="{{old('apellidos', $document['summary'])}}">{{old('apellidos', $document['summary'])}}</textarea>
                        </div>

                        <div class="col-md-7 matricula__matriculacion__input">
                            <label for="promocion" class="matricula__matriculacion-label">Ingrese la Promocióon: </label>
                            <input type="text" class="form-control" name="promocion" placeholder="Ejemplo: IV Base de datos" value="{{old('apellidos', $document['promotion'])}}">
                        </div>
                        <div class="col-md-5 matricula__matriculacion__input">
                            <label for="numberOfPages" class="matricula__matriculacion-label">Número de Páginas: </label>
                            <input type="number" class="form-control" name="numberOfPages" placeholder="Ejemplo: 70" value="{{old('apellidos', $document['numberOfPages'])}}">
                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="uri" class="matricula__matriculacion-label">Seleccione el Documento: </label>
                          <!--  <input type="file" class="form-control" name="uri" placeholder="Ejemplo: Software, Desarrollo web, Java">-->
                            <input type="file" name="uri" id="uri" accept="application/pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" >
                            
                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="carrera" class="matricula__matriculacion-label">Seleccione la Carrera: </label>
                            <select class="form-control input-sm" name="curso" id="carrera">
                                <option default>Seleccione</option>
                                @foreach($careers as $career)
                                         <option value="{{ $career ['id'] }}" {{($repositorio['id_carrer']) == $career ['id'] ? 'selected' : ''}}>{{ $career ['nombre'] }}</option>   
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 matricula__matriculacion__input">
                            <label for="estado" class="matricula__matriculacion-label">Seleccione el estado del Nuevo Repositorio: </label>
                            <select class="form-control input-sm" name="estado" id="estado">
                                <option default>Seleccione</option>
                                <option value="Activo" {{($repositorio['status']) == "Activo" ? 'selected' : ''}}>Activo</option>   
                                <option value="Inactivo" {{($repositorio['status']) == "Inactivo" ? 'selected' : ''}}>Inactivo</option>   
                            </select>
                        </div>

                        <div class="col-md-4 matricula__matriculacion__input">
                            <input type="checkbox" class="form-check-input" name="subir_sin_archivo" id="subir_sin_archivo">
                            <label for="subir_sin_archivo" class="matricula__matriculacion-label">Seleccione si desea subir sin archivo </label>
                        </div>
                    </div>
                
                
                
                <br>
                <button type="submit" class="btn btn-primary form-control fondoBoton">Guardar</button>
            </form>
        </div>
    
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        
    </div>
    
		<a class="button-br" href="{{ route('repositorioGeneral') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
    
    
</div>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript"> 


function enviar() {
  var formulario = document.getElementById("repositorioFrom");
  var check = document.getElementById("subir_sin_archivo");
  if( $('#subir_sin_archivo').prop('checked') ) {
    formulario.submit();
    return true; 
}else{
    var file = $("#uri").val();
  if (file == '') {
    Swal.fire({
        icon: 'error',
        title: 'Error No se Puede Enviar el Formulario',
        text: 'Debe de Seleccionar un Documento',
    })
    return false;
    
  } else {
    //alert("Enviando el formulario");
    formulario.submit();
    return true;
  }
}


  
}


$(document).ready(function(){
 

	$("#name_addressee").hide();
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
});

function agregarEmail($id,$correo,$nombres,$apellidos){
    //alert($id);
	console.log($nombres);

    $('#listaCorreos').hide();
	
	$("#name_addressee").show();
	$("#name_addressee").val($nombres+' '+$apellidos);
    $("#id_tutor").val($id);
    
	//document.querySelector("").value = ;
    }
</script>
@endsection

