@php

namespace App\Http\Controllers;

use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\LibroAutorController;
use App\User;
use Sentinel;
use Flash;
use Illuminate\Support\Facades\Session;
$usuario = User::where('userid', Sentinel::getUser()->id)->first();
$libros = LibroController::getAllBooks();
$autores = AutorController::getAllAuthors();
$categorias = CategoriaController::getAllCategories();
@endphp

@extends('layouts.master2')
@section('assets')

<link rel="stylesheet" type="text/css"
  href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
  @include('layouts.nav_bar_top')
  <div class="row wrapper white-bg titulo-separacion noBefore">
    <div class="col-xs-12 titulo-separacion">
      <h2 class="title-page text-uppercase">Bbblioteca</h2>
    </div>
  </div>
  <div class="row wrapper">
    <div class="col-xs-12 p-1 bg-black">
      <h1 class="text-uppercase text-white" style="text-align: center">Sección Importación de Libros Masivos</h1>
    </div>
  </div>
  
@if(Session::has('alert'))

<div class="alert alert-success alert-block">
  {{Session::get('alert')}}
  <button type="button" class="close" data-dismiss="alert">×</button>
</div>
@endif
  
  <div class="row wrapper">
    <div class="col-xs-12 bg-white p-1">
        <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row wrapper">
                <div class="col-3">
                    <div class="mb-3">
                        
                        <label class="from-label" for="alumnos">Seleccionar archivo de Excel para Importar los Libros</label>
                        <input class="form-control" name="alumnos"type="file" id="alumnos">
                      </div>
                    
                      
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</div>

</div>

@endsection

@section('scripts')
<script>
    
</script>
<script type="text/javascript"
  src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
@endsection