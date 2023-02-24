@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Proveedor
                <small>Nuevo Registro</small>
            </h2>
            
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" value="" name="tipo_usuario">

                @include('partials.proveedores.fichaProveedor')

            </form>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection