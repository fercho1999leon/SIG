      <div class="row text-center">
        <br>
        <br>
        <div class="col-xs-6">
            
            @if ($docente != null)
            <p class="">{{ $docente->nombres }} {{ $docente->apellidos }}</p>
            @endif
            {{--<p class="">______________________________</p>--}}
            <p class="nombreFirma">NOMBRE DEL DOCENTE</p>
        </div>
        @if ($docente != null)
            <p style="color: white;">{{ $docente->nombres }} {{ $docente->apellidos }}</p>
        @endif
        <div class="col-xs-6">
            {{--<p class="">______________________________</p>--}}
            <p class="nombreFirma">NOMBRE DEL SECRETARIO (A)</p>
        </div>
      </div>
      <br>
        <br>
      <div class="row text-center">
          <div class="col-xs-6">
              <p class="">______________________________</p>
              <p class="nombreFirma">FIRMA DEL DOCENTE</p>
          </div>
          
          <div class="col-xs-6">
              <p class="">______________________________</p>
              <p class="nombreFirma">FIRMA DEL SECRETARIO (A)</p>
          </div>
      </div>
      <div class="row text-center">
          <div class="col-xs-6">
              <p class="fechaFirma text-uppercase">FECHA DE ENTREGA: {{ $fecha }}</p>
          </div>
          <div class="col-xs-6">
              <p class="fechaFirma">FECHA DE RECEPCIÓN: _____________________________</p>
          </div>
      </div>
