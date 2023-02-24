@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
							<a class="btn btn-block btn-primary compose-mail pinedTooltip" href="{{ route('notificacionesEnviarEstudiante') }}"> 
								<span class="pinedTooltipH">Nuevo Correo</span>
							</a>
                            <div class="space-25"></div>
                            <h5>CATEGORÍAS</h5>
                            <ul class="folder-list m-b-md p-0">
                                <li>
                                    <a href="{{ route('notificacionesEstudiante') }}">
                                        <i class="fa fa-inbox "></i> Bandeja de Entrada
                                        <span class="label label-warning pull-right">{{ $countMessages }}</span>
                                    </a>
								</li>
                                <li>
                                    <a href="{{ route('notificacionesEstudianteEnviados') }}">
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
            <div class="col-lg-9 animated fadeInRight">
                <div class="studentNotificaciones__header">
                    <h2 class="no-margin">Notificaciones.</h2>
                    <div class="studentNotificaciones__header--calendar">
                    </div>
                </div>
                <div class="mail-box tableNotificaciones">
                    <div class="table-responsive p-1">
                        <table id="tableNotificaciones" class="table table-hover table-mail">
							<thead>
								<th>Nombres</th>
								<th>Cargo</th>
								<th>Mensaje</th>
								<th>Fecha</th>
								<th></th>
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
										<a href="{{ route('notificacionesVerEnviadosEstudiante',['id' => $message->id]) }}">
											@foreach ($users[$message->id]->take(3) ?? [] as $user)
                                                {{$user->apellidos}} {{$user->nombres}}{{$loop->index+1 != 3 ? ',': '.....'}}
                                            @endforeach
										</a>
									</td>
									<td width="50" class="text-left">
										<div class="flex">
											@if($message->cargo == "Administrador")
											<span class="label label-info pull-right">{{ substr($message->cargo, 0, 3)}}</span>
											@endif
											@if($message->cargo == "Docente")
											<span class="label label-danger pull-right">{{ substr($message->cargo, 0, 3)}}</span>
											@endif
											@if($message->cargo == "Representante")
											<span class="label label-primary pull-right">{{ substr($message->cargo, 0, 3)}}</span>
											@endif
											@if($message->cargo == "Institucional")
											<span class="label label-navy pull-right">{{ substr($message->cargo, 0, 3)}}</span>
											@endif
											@if($message->cargo == "Estudiante")
											<span class="label label-warning pull-right">{{ substr($message->cargo, 0, 3)}}</span>
											@endif
										</div>
									</td>
									<td class="mail-subject">
										<a href="{{ route('mostrarMensaje',['id' => $message->id]) }}">{{ $message->razon }}</a>
									</td>
									<td class="text-right mail-date" width="100">{{ date('d-m-Y', strtotime($message->created_at))  }}
									</td>
									<td width="5">
										@if ($eliminarMensaje->valor == '1')
											<form action="{{route($route, $message->id)}}" method="post">
												{{ csrf_field() }}
												<button class="bg-none no-border" type="submit">
													<i class="fa fa-trash icon__eliminar"></i>
												</button>
											</form>
										@endif
									</td>
								</tr>
							@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection