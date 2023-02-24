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
           
        </div>   
        
    </div>  

    <div class="row wrapper" style="overflow-x: auto !important;">
        <form method="post" action="{{route('documentoAutorizado')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            Documento:
                        </div>
                        <div class="col-md-9">
                            <label for=""><img src="{{secure_asset($documento->url)}}" width="70%" alt=""></label>
                            
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            Estado del Documento: 
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="documentType" id="documentType">
                                <option >Seleccione</option>
                                @foreach ($status as $item)
                                    <option value="{{$item->id}}" {{$documento->id_status == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="idDoc" value="{{$documento->id}}">
                    </div>
                    <br>
                    <br>
                    <br>
                    
                </div>
                <button type="submit" data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" class="btn btn-primary pull-right">
                   &nbsp;Actualizar Estado Documento
                </button>
            </div>

            
        </form>
    </div>
        
		<a class="button-br" href="{{ route('manejoDocumentos') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
        
 
</div>
@endsection
