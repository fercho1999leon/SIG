<p class="card-text"><strong>Estudiante:</strong> {{$students->nombres}} {{$students->apellidos}}</p>
@forelse($padres as $padre)
<p class="card-text"><strong>Padre:</strong> {{$padre->nombres}} {{$padre->apellidos}}</p>
@empty
<p class="card-text"><strong>Padre:</strong></p>
@endforelse
@forelse($madres as $madre)
<p class="card-text"><strong>Madre:</strong> {{$madre->nombres}} {{$madre->apellidos}}</p>
@empty
<p class="card-text"><strong>Madre:</strong></p>
@endforelse
<p class="card-text"><strong>Representante:</strong> {{$representantes->id!='' ? $representantes->nombres.' '.$representantes->apellidos : ''}} </p>
<p class="card-text"><strong>Repr. Financiero:</strong> {{$clientes->id!='' ? $clientes->nombres.' '.$clientes->apellidos : ''}}</p>
