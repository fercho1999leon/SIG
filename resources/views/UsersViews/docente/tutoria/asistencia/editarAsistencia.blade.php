@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">
				{{App\Course::nombreCurso($student->course)}}
                <small>: {{ $student->student->apellidos }} {{ $student->student->nombres }}</small>
            </h2>
          
        </div>
    </div>
	<div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="panel panel-default pt-1 pb-1">
                <div class="faltasAbreviatura">
                    <span>A: Atrasos</span> <span>FJ: Faltas justificadas</span> <span>FI: Faltas injustificadas</span>
                </div>
                <form method="POST" action="{{ route('updateAsistenciaReporteTutor', [$student->id, $parcial]) }}">
                    {{ csrf_field() }}

                    <div class="editComportamiento-grid cardBackgroundBlueSuave">
                        <h2 class="text-center no-margin">{{ $student->apellidos }} {{ $student->nombres }}</h2>
                        <br>
                        <div class="a-asistenciaConfiguraciones ">
							<p class="no-margin fz19 bold text-color"><span>A</span></p>
							<input type="number" class="form-control" name="atrasos" min="0" max="100" 
								value="{{$student->asistenciaParcial($parcial)->atrasos}}">
							<p class="no-margin fz19 bold text-color"><span>FJ</span></p>
							<input type="number" class="form-control" name="faltas_justificadas" min="0" max="100" 
								value="{{$student->asistenciaParcial($parcial)->faltas_justificadas}}">
							<p class="no-margin fz19 bold text-color"><span>FI</span></p>
							<input type="number" class="form-control" name="faltas_injustificadas" min="0" max="100" 
								value="{{$student->asistenciaParcial($parcial)->faltas_injustificadas}}">
                        </div>
                        <button type="submit" class="btn btn-success">ACTUALIZAR</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')

@endsection

