@section('PasoAPaso')
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-interval="false" >
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1" ></li>
              <!--
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2" ></li>
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="3" ></li>
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="4" ></li>
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="5" ></li>
              -->
              <li data-bs-target="#carouselExampleDark" data-bs-slide-to="6" ></li>
            </ol>

            <div class="carousel-inner">
                    <div class="{{$activo == 1 ? 'carousel-item active':'carousel-item'}}"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/1.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div align="center">
                                <div class="col-md-8" style="align-content: center;">
                                    <div class="matricula__matriculacion__input">
                                      <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                      <input type="hidden" name="estudiante" id="estudiante" class="form-control " value="{{$students->id}}" />
                                      <input type="hidden" name="ci" id="ci" class="form-control " value="{{$students->ci}}" />
                                            <p><h3>Estudiante:
                                            {{$students->nombres}} {{$students->apellidos}}
                                          </h3>
                                            </p>
                                              {{--<button class="btn btn-light " title="Editar" onclick="editarEstudiante()"><i class="fa fa-pencil icon__editar" title="Editar"></i></a>
                                              </button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    
                    <div class="{{$activo == 2 ? 'carousel-item active':'carousel-item'}}"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/2.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                              @forelse($padres as $padre)
                                                    <h3>Padre: {{$padre->nombres}} {{$padre->apellidos}}
                                                    </h3>
                                                    <span class="valorError">En caso de no ser el padre correcto, por favor seleccione uno de la lista ingresando los datos en el campo siguiente</span>
                                                    <input type="hidden" name="id_padre" id="id_padre" class="form-control claseUpdate" value="{{$padre->id}}" />
                                                    <input type="text" name="desPadre" id="desPadre" class="form-control " value="" placeholder="Seleccione padre" />
                                                @empty
                                                 <h3>Padre:
                                                </h3>
                                                <span class="valorError"><span class="valorError">Por favor seleccione el padre de la lista ingresando los datos en el campo siguiente, en caso de no encortrarse debe crear uno nuevo</span></span>
                                                <input type="hidden" name="id_padre" id="id_padre" class="form-control claseUpdate" value="" />
                                                <input type="text" name="desPadre" id="desPadre" class="form-control " value=""  placeholder="Seleccione padre" />
                                              @endforelse
                                                <div id="listPadre" style="display: none">
                                                </div>
                                                <button class="btn btn-light icon__ver" title="Ver" onclick="VerPadre('P');"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-light icon__editar" title="Editar" onclick="editarPadre('P');"><i class="fa fa-pencil" ></i>
                                                </button>
                                                <button class="btn btn-light icon__enviar-mensaje" title="Nuevo Padre" onclick="CrearPadre('P');"><i class="fa fa-user-plus" ></i>
                                                </button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="{{$activo == 3 ? 'carousel-item active':'carousel-item'}}"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/3.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                              @forelse($madres as $madre)
                                                    <h3>Madre: {{$madre->nombres}} {{$madre->apellidos}}
                                                    </h3>
                                                    <span class="valorError">En caso de no ser el padre correcto, por favor seleccione uno de la lista ingresando los datos en el campo siguiente</span>
                                                    <input type="hidden" name="id_madre" id="id_madre" class="form-control " value="{{$madre->id}}" />
                                                    <input type="text" name="desMadre" id="desMadre" class="form-control " value="" placeholder="Seleccione madre" />
                                                @empty
                                                 <h3>Madre:
                                                </h3>
                                                <span class="valorError"><span class="valorError">Por favor seleccione la madre de la lista ingresando los datos en el campo siguiente, en caso de no encortrarse debe crear uno nuevo</span></span>
                                                <input type="hidden" name="id_madre" id="id_madre" class="form-control " value="" />
                                                <input type="text" name="desMadre" id="desMadre" class="form-control " value=""  placeholder="Seleccione madre" />
                                              @endforelse
                                                <div id="listMadre" style="display: none">
                                                </div>
                                                <button class="btn btn-light icon__ver" title="Ver" onclick="VerPadre('M');"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-light icon__editar" title="Editar" onclick="editarPadre('M');"><i class="fa fa-pencil" ></i>
                                                </button>
                                                <button class="btn btn-light icon__enviar-mensaje" title="Nueva Madre" onclick="CrearPadre('M');"><i class="fa fa-user-plus" ></i>
                                                </button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="{{$activo == 4 ? 'carousel-item active':'carousel-item'}}"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/4.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                               @if($representantes->id!='')
                                                    <h3>Representante: {{$representantes->nombres}} {{$representantes->apellidos}}
                                                    </h3>
                                                    <span class="valorError">En caso de no ser el representante correcto, por favor seleccione uno de la lista ingresando los datos en el campo siguiente</span>
                                                <input type="hidden" name="id_representante" id="id_representante" class="form-control " value="{{$representantes->id}}" />
                                                <input type="text" name="desRepresentante" id="desRepresentante" class="form-control " value="" placeholder="Seleccione representante" />
                                                @else
                                                <h3>Representante:
                                                </h3>
                                                <span class="valorError"><span class="valorError">Por favor seleccione el representante de la lista ingresando los datos en el campo siguiente, en caso de no encortrarse debe crear uno nuevo</span></span>
                                                <input type="hidden" name="id_representante" id="id_representante" class="form-control " value="" />
                                                <input type="text" name="desRepresentante" id="desRepresentante" class="form-control " placeholder="Seleccione representante"  value="" />
                                              @endif
                                                <div id="repreDiv" style="display: none">
                                                </div>
                                                <button class="btn btn-light icon__ver" title="Ver" onclick="VerRepresentante();"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-light icon__editar" title="Editar" onclick="editarRepresentante();"><i class="fa fa-pencil" ></i>
                                                </button>
                                                <button class="btn btn-light icon__enviar-mensaje" title="Nuevo Representante" onclick="CrearRepresentante();"><i class="fa fa-user-plus" ></i>
                                                </button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="{{$activo == 5 ? 'carousel-item active':'carousel-item'}}"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/5.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                               @if($representantes->id!='')
                                                    <h3>Representante Financiero: {{$clientes->nombres}} {{$clientes->apellidos}}
                                                    </h3>
                                                    <span class="valorError">En caso de no ser el representante financiero correcto, por favor seleccione uno de la lista ingresando los datos en el campo siguiente</span>
                                                    <input type="hidden" name="id_financiero" id="id_financiero" class="financiero form-control "  value="{{$clientes->id}}" />
                                                    <input type="text" name="desFinanciero" id="desFinanciero" placeholder="Seleccione representante financiero" class="financiero form-control "  value="" />
                                                @else
                                                <h3>Representante Financiero:
                                                </h3>
                                                <span class="valorError"><span class="valorError">Por favor seleccione el representante financiero de la lista ingresando los datos en el campo siguiente, en caso de no encortrarse debe crear uno nuevo</span></span>
                                                <input type="hidden" name="id_financiero" id="id_financiero" class="form-control " value="" />
                                                <input type="text" name="desFinanciero" id="desFinanciero" class="form-control " placeholder="Seleccione representante financiero"  value="" onblur="act();" />
                                              @endif
                                                <div id="listFinanciero" style="display: none">
                                                </div>
                                                <button class="btn btn-light icon__ver" title="Ver" onclick="VerCliente();"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-light icon__editar" title="Editar" onclick="editarCliente();"><i class="fa fa-pencil" ></i>
                                                </button>
                                                <button class="btn btn-light icon__enviar-mensaje" title="Nuevo Cliente" onclick="CrearCliente();"><i class="fa fa-user-plus" ></i>
                                                </button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    -->
                     <div class="carousel-item"  data-interval="false">
                        <img src="{{secure_asset('img/admisiones/6.png')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                                <h3>Descargue los documentos</h3>
                                                <a class="btn btn-info" href="{{route('reporte.informacionPersonalMatriculaRepresentante', [$students->id, $periodo])}}"> <i class="fa fa-file"></i> Ficha de Datos</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    @php
                        $perfil = App\User::where('id',$students->idProfile)->first();
                        $credentials = array(['user' => $perfil->correo, 'pass' => '12345']);
                        //dd($credentials);
                    @endphp
                    <div class="carousel-item"  data-interval="false" style="height: 60vh;">
                        <!--<img src="{{secure_asset('img/admisiones/7.png')}}" class="d-block w-100" alt="...">-->
                        <div class="carousel-caption d-none d-md-block">
                                <div align="center">
                                    <div class="col-md-12" style="align-content: center;">
                                           <div class="matricula__matriculacion__input">
                                                @include('mail.notifyUserAndPasswordAdmision',['credentials' => $credentials])
                                                <h3>Si completo los pasos anteriores puede finalizar el proceso de actualización de datos</h3>
                                                <a class="btn btn-primary" href="#" id="Fin" onclick="finalizar();"><i class="fa fa-sign-out" > Finalizar</i>&nbsp;
                                                </a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                    </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
      </div>
<script type="text/javascript">
     $(document).ready(function() {
      $('.carousel').carousel('pause');
       $('.carousel').carousel({interval: false,
        });
    });
     function editarEstudiante(){
        $.ajax({
            url: '{{route('editarEstudiante', [$students->id] )}}',
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
     }
     $('#desRepresentante').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#repreDiv').show();


                    $('#repreDiv').html(data);
          }
         });
        }
        $(document).on('click','.repre', function(){
            if ($('#id_representante').val() != $(this).attr('id')) {
                $('#id_representante').val($(this).attr('id'));
                updateDatosGenerales(4);
        }
        $('#id_representante').val($(this).attr('id'));
        $('#desRepresentante').val($(this).text());
        $('#repreDiv').hide();
   });
    });
 $('#desFinanciero').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteFinanciero.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listFinanciero').show();


                    $('#listFinanciero').html(data);
          }
         });
        }
        $(document).on('click', '.finan', function(){
             if ($('#id_financiero').val() != $(this).attr('id')) {
                $('#id_financiero').val($(this).attr('id'));
                updateDatosGenerales(5);
        }
        $('#id_financiero').val($(this).attr('id'));
        $('#desFinanciero').val($(this).text());
        $('#listFinanciero').hide();
   });
    });
 $('#desPadre').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompletePadre.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listPadre').show();


                    $('#listPadre').html(data);
          }
         });
        }
        $(document).on('click', '.padre', function(){
            if ($('#id_padre').val() != $(this).attr('id')) {
                $('#id_padre').val($(this).attr('id'));
                updateDatosGenerales(2);
        }
        $('#id_padre').val($(this).attr('id'));
        $('#desPadre').val($(this).text());
        $('#listPadre').hide();
   });
    });
 $('#desMadre').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteMadre.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listMadre').show();
                $('#listMadre').html(data);
          }
         });
        }
        $(document).on('click', '.madre', function(){
        if ($('#id_madre').val() != $(this).attr('id')) {
            $('#id_madre').val($(this).attr('id'));
                updateDatosGenerales(3);
        }
        $('#id_madre').val($(this).attr('id'));
        $('#desMadre').val($(this).text());
        $('#listMadre').hide();
    });
    });


</script>
@endsection

