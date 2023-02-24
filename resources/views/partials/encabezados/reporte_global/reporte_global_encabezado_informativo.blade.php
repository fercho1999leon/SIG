<div class="row mb-3">
    <div class="col-xs-6 text-left">
        <p class="textoInformativo text-uppercase"><strong>CARRERA:</strong> {{ $carrera->nombre }}</p>
        <p class="textoInformativo text-uppercase"><strong>MATERIA:</strong> {{ $materia->nombre }}</p>
        @if ($docente == null) 
        <p class="textoInformativo text-uppercase"><strong>DOCENTE:</strong> S/N </p>    
        @endif
        @if ($docente != null || $docente != "")
        <p class="textoInformativo text-uppercase"><strong>DOCENTE:</strong> {{ $docente->nombres }}
            {{ $docente->apellidos }}</p>    
        @endif
        

    </div>
    <div class="col-xs-6 text-left">
        <p class="textoInformativo text-uppercase"><strong>FECHA:</strong> {{ $fecha }}</p>
        <p class="textoInformativo text-uppercase"><strong>SEMESTRE:</strong> {{ $semestre->nombsemt }}</p>
        <p class="textoInformativo text-uppercase"><strong>PARALELO:</strong> {{ $curso->paralelo }}</p>
    </div>
</div>
