			<div>
                <form action="{{route('EditarBecas')}}" method="POST" id='editBeca'>
                    <input type="hidden" name="id" value="{{$id}}">
                    {{ csrf_field() }}
					<div class="matricula__matriculacion__input">
						<label for="" class="matricula__matriculacion-label">Beca</label>
						<select name="beca" class="form-control">
							<option value="0">Sin Beca</option>
							@foreach($becas->where('tipo', 'BECA') as $beca)
                                <option 
                                    {{old('beca') == $beca->id ? 'selected' : ''}}
									@if ($crear !== true)
										@if( count($beca_estudiante) > 0)
											{{ $beca_estudiante->where('idBeca', $beca->id)->first() != null ? 'selected': '' }} 
										@endif
									@endif
									value="{{ $beca->id }}">{{ $beca->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="matricula__matriculacion__input" id="descuentos">
						<label for="" class="matricula__matriculacion-label">Descuentos</label>	
						<div class="descuentos__inputCheckbox-grid">
							@if (count($becas) == 0) 
								<p>No hay descuentos.</p>
							@endif
							@foreach($becas->where('tipo', 'DESCUENTO') as $beca)
								<div>
									<p class="descuentos__inputCheckbox">{{ $beca->nombre}} 
											<input type="checkbox" 
											value="{{ $beca->id }}" 
											class="form-control" 
										name="descuentos[]"
										@if ($crear !== true)
											@if(count($beca_estudiante) > 0)
												{{ $beca_estudiante->where('idBeca', $beca->id)->first() != null ? 'checked': '' }} 
											@endif
										@endif
										>
									</p> 
								</div>
							@endforeach
						</div>
                    </div>
                    <div class="text-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
			</div>