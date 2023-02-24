<div class="row">
		<div class="col-md-3">
			<div class="ibox float-e-margins">
				<div class="ibox-content mailbox-content">
					<div class="file-manager">
						<a class="btn btn-block btn-primary compose-mail" href="{{ route('notificacionesEnviar') }}"> Nuevo Correo</a>
						<div class="space-25"></div>
						<h5>CATEGORÍAS</h5>
						<ul class="folder-list m-b-md p-0">
							<li>
								<a href="{{ route('notificacionesRecibidos') }}">
									<i class="fa fa-inbox "></i> Bandeja de Entrada
									<span class="label label-warning pull-right">{{ $countMessages }}</span>
								</a>
							</li>
							<li>
								<a href="{{ route('notificacionesEnviados') }}">
									<i class="fa fa-envelope-o"></i> Enviados
									<span class="label label-primary pull-right">{{ $countSend }}</span>
								</a>
							</li>
						</ul>
						@include('partials.notificaciones._categorias')
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9 animated fadeInRight">
			<div class="studentNotificaciones__header">
				<h2 class="no-margin">Notificaciones.</h2>
				<div class="studentNotificaciones__header--calendar">
				</div>
			</div>
			<div class="mail-box tableNotificaciones">
				<div class="table-responsive p-1">
					<table id="tableNotificaciones" class="table table-hover table-mail">
						<thead>
							<tr>
								<th>Nombres</th>
								<th>Cargo</th>
								<th>Mensaje</th>
								<th>Fecha</th>
							</tr>
						</thead>
						<tbody>
						@foreach($messages as $message)
						@if(isset($message->visto))
							@if($message->visto == false)
							<tr class="unread" style="cursor:pointer;">
							@else
							<tr class="read" style="cursor:pointer;">
							@endif
						@else
						<tr class="read" style="cursor:pointer;">
						@endif
							<td class="mail-contact" width="200">
								<a href="{{ route('mostrarMensaje',['id' => $message->id]) }}">
									{{ $message->nombres." ".$message->apellidos }}
								</a>
							</td>
							<td>
								@if($message->cargo == "Administrador")
								<span class="label label-info pull-left">{{ substr($message->cargo, 0, 3)}}</span>
								@endif
								@if($message->cargo == "Docente")
								<span class="label label-danger pull-left">{{ substr($message->cargo, 0, 3)}}</span>
								@endif
								@if($message->cargo == "Representante")
								<span class="label label-primary pull-left">{{ substr($message->cargo, 0, 3)}}</span>
								@endif
								@if($message->cargo == "Institucional")
								<span class="label label-navy pull-left">{{ substr($message->cargo, 0, 3)}}</span>
								@endif
							</td>
							<td class="mail-subject">
								<a href="{{ route('mostrarMensaje',['id' => $message->id]) }}">{{ $message->razon }}</a>
							</td>
							<td class="text-left mail-date" width="100">{{ date('d-m-Y H:m:s', strtotime($message->created_at))  }}
							</td>
						</tr>
						@endforeach						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@section('scripts')
	<script src="{{secure_asset('js/datatables.js')}}"></script>
	<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
	@endsection
	