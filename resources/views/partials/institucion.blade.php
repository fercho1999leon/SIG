	<div class="row">
		<div class="col-xs-12 white-bg">
			<div class="institucion__informacionPrimaria mt-1">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
						src="{{ secure_asset('img/logo/logo.png') }}"                  
					@else                     
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  
					@endif 
				alt="">
				<div class="institucion__informacionPrimaria__grid">
					<h3 class="institucion__informacionPrimaria__nombreInstitucion"> {{$institution->nombre}} </h3>
					<div class="institucion__informacionPrimaria__info__grid">
						<p class="m-0">Ecuador - {{$institution->ciudad}} <br><label class="institucion__informacionPrimaria__info--labelColor">Dirección</label></label></p>
						<p class="m-0">{{$institution->telefonos}}<br><label class="institucion__informacionPrimaria__info--labelColor">Telefonos</label></label></p>
						<p class="m-0">{{$institution->correo}}<br><label class="institucion__informacionPrimaria__info--labelColor">Correo</label></label></p>
						<p class="m-0">{{$institution->jornada}}<br><label class="institucion__informacionPrimaria__info--labelColor">Jornada</label></label></p>
						@if ($institution->horariosDeAtencion != null)
						<p class="m-0">{{$institution->horariosDeAtencion}}<br><label class="institucion__informacionPrimaria__info--labelColor">Horarios de Atención</label></label></p>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="institucion__informacionSecundaria mb-1">
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">MISIÓN</h3>
					<hr class="institucion__informacionSecundaria__hr">
					<p>{{$institution->mision}}</p>
				</div>
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">VISIÓN</h3>
					<hr class="institucion__informacionSecundaria__hr">
					<p>{{$institution->vision}}</p>
				</div>
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">HISTORIA</h3>
					<hr class="institucion__informacionSecundaria__hr">
					<p>{{$institution->historia}}</p>
				</div>
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">ANTECEDENTES</h3>
					<hr class="institucion__informacionSecundaria__hr">
					<p>{{$institution->antecedentes}}</p>
				</div>
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">SECCIÓN</h3>
					<hr class="institucion__informacionSecundaria__hr">
					@foreach ($courses->groupBy('seccion') as $key => $course)
						<p>
						{{$key == 'EI' ? 'Educación Inicial' : ''}}
						{{$key == 'EGB' ? 'Educación General Básica' : ''}}
						{{$key == 'BGU' ? 'Bachillerato General Unificado' : ''}}
						</p>
					@endforeach
				</div>
				<div class="institucion__informacionSecundaria__block">
					<h3 class="mb-0">AUTORIDADES</h3>
					<hr class="institucion__informacionSecundaria__hr">
					<p>{{$institution->representante1}}</p>
					<p>{{$institution->representante2}}</p>
					<p>{{$institution->representante3}}</p>
					<p>{{$institution->representante4}}</p>
					<p>{{$institution->representante5}}</p>
				</div>
				<div class="text-center">
					<a target="_blank" href="http://{{$institution->sitioWeb}}">{{$institution->sitioWeb}}</a>
				</div>
			</div>
		</div>
	</div>
