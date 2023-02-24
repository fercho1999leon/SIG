@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{ route('pagosCursoEstudiante', $student->id) }}">
    <button>
        <img src="../../../img/return.png" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg mb-1">
        <div class="padre-pago">
            <div class="profile-image mb-1">
                <img src="{{secure_asset('img/icono_persona.png')}}" alt="FACTURA" W width="30">
            </div>
            <div class="profile-info">
                <h2 class="no-margins">
                    {{ $student->nombres }} {{ $student->apellidos }}
                </h2>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>CURSO:</strong> {{ $course->grado }} {{ $course->paralelo}} 
                    </h3>
                </p>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>DIRIGENTE:</strong> {{ $tutor->nombres }} {{ $tutor->apellidos }}
                    </h3>
                </p>
            </div>
        </div>
    </div>
    <div class="white-bg p-1">
        <div class="header-pag-his">
            <div class="lista-prof">
                <select onchange="selectProfAsist()" class="form-control select-prof-asist">
                    <option value="" selected="selected" disabled="">PERIODO: 2018-2019</option>
                </select>
            </div>
        </div>
        <div class="bg-w-table" id="Q1">
            <div class="table-responsive">
                Valores de la factura a emitir
            	<p>Nombres:</p>
            	<p>Apellidos:</p>
            	<p>CI/RUC:</p>
            	<p>Fecha Emisión:</p>

            	<p>Numero de factura:</p>
                
            </div>
        	<div>
				<a target="_blank" href="{{ route('descargarFacturaPago') }}" class="color-inherit" style="">
					Aparece solo cuándo ingreso los datos de la factura<span style="font-size: 24px">GENERAR FACTURA</span>
					<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
				</a>
			</div>
        </div>
    </div>
</div>
@endsection