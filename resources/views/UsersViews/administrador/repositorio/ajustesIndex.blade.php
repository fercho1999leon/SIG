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
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page"> <i class="fa fa-cogs" aria-hidden="true"></i> Ajustes Generales del Repositorio del Instituto Superior Técnico Rey David</h2>
            <div class="agregarSeccionCont">
               
            </div>
        </div>     
    </div>

    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <h2>Sección de Tipos de Documentos Admitidos</h2>
        <a href="{{ route('tipoDocumentos') }}">
            <button class="btn btn-primary">Listar Tipos de Documentos Admitidos</button>
        </a>
        <a href="{{ route('newDocument')}}">
            <button class="btn btn-primary" disabled>Agregar un Nuevo Tipo de Documento Admitido</button>
        </a>
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <h2>Sección de Estados de Documentos Admitidos</h2>
        <a href="{{ route('listStatusDocument') }}">
            <button class="btn btn-primary">Listar Estados de Documentos Admitidos</button>
        </a>
        <a href="{{ route('newStatus') }}">
            <button class="btn btn-primary" disabled>Agregar un Nuevo Estado Documento Admitido</button>
        </a>
    </div>
    
		<a class="button-br" href="repositorioGeneral">
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

