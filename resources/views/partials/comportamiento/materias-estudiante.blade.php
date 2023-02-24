{{ csrf_field() }}

<div class="mail-box tableNotificaciones">
        <div class="table-responsive p-1">
          <table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
          	<table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
          		<h3 class="text-center uppercase">Comportamiento del estudiante según materia</h3>
            <thead>
				<tr class="table__bgBlue">
				<th width="5%">#</th>
                <th width="25%">Materia</th>
                <th width="5%">Nota</th>
                <th width="35%">Observación</th>
                <th width="25%">Docente</th>

					</tr>
					</thead>
					@foreach($comp->sortByDesc('id') as $comportamiento)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td>{{$comportamiento['nombre']}}</td>
							<td class="text-center">
								{{$comportamiento['nota']}}
							</td>
							<td>
								{{$comportamiento['observacion']}}
							</td>
							<td>
								{{$comportamiento['nombres']}} {{$comportamiento['apellidos']}}
							</td>
						</tr>
					@endforeach
				</table>
				</div>
</div>
