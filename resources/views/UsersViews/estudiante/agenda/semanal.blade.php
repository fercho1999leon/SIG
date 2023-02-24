@extends('layouts.master') 
@section('content')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper border-bottom white-bg" style="background: #ebebed">
        <div class="row wrapper border-bottom white-bg">
            <div class="repProfileHijo--cont">
                <figure class="repProfileHijo__resumen--img">
                    <img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                </figure>
                <div class="repProfileHijo__resumen--info">
                    <h3 class="repProfileHijo__resumen--name">{{$student->nombres}} {{$student->apellidos}}</h3>
                    <hr>
                    <div class="repProfileHijo__resumen--curso">
                        <h4>
							<strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{$course->especializacion}} </h4>
                        <h4>
                            <strong>DOCENTE: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.agenda._semanal',[
			'admin' => false,
			'perfil' => 'estudiante'
		])
    </div>
</div>
@endsection