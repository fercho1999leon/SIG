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
            <h2 class="title-page"> <i class="fa fa-cogs" aria-hidden="true"></i> Agregar tipo de Documento Aceptado en el Repositorio del Instituto Superior Técnico Rey David</h2>
            <div class="agregarSeccionCont">
               
            </div>
        </div>     
    </div>
    @if($seccion == 1)
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <h2>Agregar un Nuevo Tipo de Documento</h2>
        
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <div class="col-md-8">
            <form action="{{ route('newDocumentStore') }}" method="post">
                {{ csrf_field() }}
                <label for="name" class="form-control">Ingrese el Nombre del Documento: </label>
                <input type="text" class="form-control" name="name" placeholder="Nombre del tipo de Documento">
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-primary form-control fondoBoton">Guardar</button>
            </form>
        </div>
        
    </div>
    @endif
    @if($seccion == 2)
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <h2>Actualizar Tipo de Documento</h2>
        
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <div class="col-md-8">
            <form action="{{ route('tipoDocumentoUpdate') }}" method="post">
                {{ csrf_field() }}
                <label for="name" class="form-control">Ingrese el Nombre del Documento: </label>
                <input type="text" class="form-control" name="name" placeholder="Nombre del tipo de Documento" value="{{$typeDocument->name}}">
                <input type="hidden" name="id" value="{{$typeDocument->id}}">
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-primary form-control fondoBoton">Actualizar</button>
            </form>
        </div>
        
    </div>
    @endif
		<a class="button-br" href="{{ route('tipoDocumentos') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
    
    
</div>
@endsection
@section('scripts')
<script type="text/javascript"> 

</script>
@endsection

