@php
$user_data = session('user_data');
$estudiante = session('estudiante');
$tMessages = session('tMessages');
use App\Student2;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;

$institution = Institution::first();
@endphp
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
</style>
</head>
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    @if(Session::has('alert'))

    <div class="alert alert-danger alert-block">
    {{Session::get('alert')}}
    <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
    @endif
    <div class="row wrapper white-bg titulo-separacion noBefore">
     
            
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Documentación de Estudiante</h2>
            <a href="{{ route('addDocument') }}">
                <button class="btn btn-primary">Agregar Nuevo Documento</button>
            </a>
        </div>   
        
    </div>  

    <div class="row wrapper" style="overflow-x: auto !important;">
        <form method="post" action="{{route('documentStudentStore')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            Seleccione el tipo de Documento a Cargar: 
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="documentType" id="documentType">
                                <option >Seleccione</option>
                                @foreach ($documentType as $item)
                                    <option value="{{$item->id}}">{{$item->name_type}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-md-3"></div>
                        <div id="link" class="col-md-9"></div>
                        <br><br>               
                        <input type="hidden" name="docType" id="docType" value="{{route('rutaDocumento','')}}">
                        <input type="hidden" name="studen" id="studen" value="{{$estudiante->id}}">
                        <input type="hidden" name="cedula" id="cedula" value="{{$estudiante->ci}}">
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            Seleccione el Documento a Cargar: 
                        </div>
                        <div class="col-md-9">
                            <input type="file" id="documento" name="documento" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" class="btn btn-primary pull-right">
                    <i class="fa fa-upload" aria-hidden="true"></i> &nbsp;Cargar Documento
                </button>
            </div>

            
        </form>
    </div>
        
		<a class="button-br" href="{{ route('documentacionEstudiantil') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
        
 
</div>
@endsection
@section('scripts')

<script>
var documentType = document.getElementById('documentType');

//console.log(url);
documentType.addEventListener('change', function() {
    var selectedOption = this.options[documentType.selectedIndex];
    //alert(selectedOption.value);
    var url = $('#docType').val()+'/'+documentType.value;
   /// console.log(url);
    $.ajax({
          url:url,
          data:{'idDoc':selectedOption.value},
          type:'get',
          success: function (response) {
             // console.log(response);
            if(response != ""){
                var respuesta = response;
                $('#link').show();
                document.getElementById("link").innerHTML += 
                "<a id='link2' class='form-control' href="+respuesta+"><i class='fa fa-cloud-download' aria-hidden='true'></i> Descargar Documento Asociado</a>";
            
            }else{
                var elemento = document.getElementById("link2");
                padre = elemento.parentNode;
		        padre.removeChild(elemento);
                $('#link').hide();
            }
            

          },
          statusCode: {
             404: function() {
                alert('web not found');
             }
          },
          error:function(x,xs,xt){
              //nos dara el error si es que hay alguno
              window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
          }
       });
});

</script>
@endsection