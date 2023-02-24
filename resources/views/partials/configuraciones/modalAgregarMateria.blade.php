<style>
	.mul-select{
		width: 100%;
	}
</style>
<div class="modal fade" id="dirModalAgregarMateria{{$course->id}}" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
	<div class="modal-dialog dirModalAgregarGrado" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Agregar Materia</h3>
			</div>
			<div class="modal-body">
				<form action="{{route('addMatter')}}" method="POST"  id="addMatterForm">
					{{csrf_field()}}
					<input type="hidden" name="idCurso" value="{{$course->id}}" >
					<div class="agregarCurso--info">
						<label for="">Nombre Completo</label>
						<textarea name="nombre" class="form-control" rows="5"></textarea>
					</div>
					<div class="agregarCurso--info">
						<label for="">Nombre Abreviado</label>
						<input id="subjAbrv" name="nombre_abreviado" type="text" class="form-control">
					</div>
					<div class="agregarCurso--info">
						<label for="">Observación</label>
						<textarea class="form-control" name="observacion" rows="5" id="comment"></textarea>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="agregarCurso--aula">
						<label for="">Materias de Flujo</label>
						<div class="form-group">
							<div class="agregarCurso__labels">
								<div>
									<input type="checkbox" name="t_matter" id="t_matter{{$course->id}}" onclick="predecesoras({{$course->id}})">
									<label for="Si1">Si&nbsp;&nbsp;&nbsp;</label>
									<div  id="ver_menu_predecesoras{{$course->id}}" style="display: none">
									<!--<select class="itemName form-control" name="itemName" id="itemName">
										<option value="0">-- Seleccione Materia --</option>
									</select>-->
									
										<div >
											<select class="form-control" multiple="multiple"  name="itemat[]" id="itemat" ></select>
										</div>
									</div>						
								</div>
							</div>
						</div>
					</div>

					<!--<div id="matterselection" style="display: none">
						<label for="">Materias Seleccionadas</label>
						<input type='text' id='hiddenNOT' readonly class="form-control" value=''/>
						<input type="text" id='prueba' name='prueba' value='' data-role="tagsinput" />
					</div>-->

					<!--
					<select id="lenguajes" multiple="true" class="mul-select">
						<option value="Javascript">Javascript</option>
						<option value="Python">Python</option>
						<option value="LISP">LISP</option>
						<option value="C++">C++</option>
						<option value="jQuery">jQuery</option>
						<option value="Ruby">Ruby</option>
					</select>
					-->





					
					
					<!--<div class="agregarCurso--info">
						<label for="">Area</label>
						@if ($course->seccion === 'EI')
							<select name="area" class="form-control">
								<option value="">Sin asignaci�n...</option>
								@foreach ($areas->where('seccion', 'EI') as $area)
									<option value="{{$area->id}}">{{$area->nombre}}</option>
								@endforeach
							</select>
						@elseif($course->seccion === 'EGB')
							<select name="area" class="form-control">
								<option value="">Sin asignaci�n...</option>
								@foreach ($areas->where('seccion', 'EGB') as $area)
									<option value="{{$area->id}}">{{$area->nombre}}</option>
								@endforeach
							</select>
						@else
							<select name="area" class="form-control">
								<option value="">Sin asignaci�n...</option>
								@foreach ($areas->where('seccion', 'BGU') as $area)
									<option value="{{$area->id}}">{{$area->nombre}}</option>
								@endforeach
							</select>
						@endif
					</div>-->
					
					
					<div class="hr-line-dashed"></div>
					<div class="agregarCurso--aula">
						<label for="">Visibilidad en  </label>
						<div class="agregarCurso__labels">
							<div>
								<input type="radio" name="visible" value="true" id="Si1" checked>
								<label for="Si1">Si</label>
							</div>
							<div>
								<input type="radio" name="visible" value="false" id="No1">
								<label for="No1">No</label>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="agregarCurso--aula">
						<label for="">Es Principal</label>
						<div class="agregarCurso__labels">
							<div>
								<input type="radio" name="principal" value="true" id="Si1" onclick="desactivar()" checked>
								<label for="Si1">Si</label>
							</div>
							<div>
								<input type="radio" name="principal" value="false" id="No1" onclick="activar()">
								<label for="No1">No</label>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					
					<!--<div class="agregarCurso--aula">
						<label for="">Cualitativa</label>
						<div class="agregarCurso__labels">
							<div>
								<input type="checkbox" name="t_calif" id="t_calif{{$course->id}}" onclick="cualitativa({{$course->id}})">
								<label for="Si1">Si&nbsp;&nbsp;&nbsp;</label>
								
								<div id="ver_menu_cualitativo{{$course->id}}" style="display: none">
								<select name="idEstructura" class="form-control">
								<option value="">Sin asignaci�n...</option>
								@foreach ($cualitativas as $cualita)
									<option value="{{$cualita->id}}">{{$cualita->nombre}}</option>
								@endforeach
							</select>
							</div>
							</div>
						</div>
					</div>-->
					
					<!--<div class="hr-line-dashed"></div>-->
					<div class="agregarCurso--aula">
						<div class="form-group">
							<label for="iddocente">Docente:</label>
							<select class="form-control" name="idDocente">
								<option value="null">Sin Asignación...</option>
								@foreach($docentes as $docente)
									<option value="{{$docente->userid}}">{{$docente->apellidos}}  {{$docente->nombres}} </option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="input" class="btn btn-primary">GUARDAR</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Include plugin -->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
-->
<!--
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--<link href="/css/select2.min.css" rel="stylesheet">
	
    <script src="js/select2.min.js"></script>-->
	<!--<link href="{{ secure_asset('css/select2.min.css') }}" rel="stylesheet">-->
	<!--<script src="{{secure_asset('js/select2.min.js')}}"></script>-->
	<script src="{{secure_asset('js/plugins/select2/select2.full.min.js')}}"></script>
	<link href="{{ secure_asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">


<!--
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
-->


<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
  
 <style> 
  /*.select2-close-mask{
    z-index: 2099;
	}*/
  .select2-dropdown{
		z-index: 3051;
	}
	
	.select2-selection {
   
    height: auto !important;
   
}
	/*
	.select2-container {
    width: 100% !important;
    padding: 0;
	}*/
	
	/*.select2-container.select2-container--default.select2-container--open  {
  z-index: 5000;
}*/
	
  /*.select2-container {
    z-index:10050;
}*/
</style>
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
<!--
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	



	



	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.css" integrity="sha512-Lif7u83tKvHWTPxL0amT2QbJoyvma0s9ubOlHpcodxRxpZo4iIGFw/lDWbPwSjNlnas2PsTrVTTcOoaVfb4kwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
-->


<script>
	
function cualitativa($curso){
		console.log('entraaaaaa cualitativa');
		var isChecked = document.getElementById('t_calif'+$curso).checked;
		if(isChecked){
		$('#ver_menu_cualitativo'+$curso).show();
		}else{
		$('#ver_menu_cualitativo'+$curso).hide();
		}
	}
function predecesoras($curso){
	console.log($curso);
	console.log('entraaaaaa cualitativa');
	var isChecked = document.getElementById('t_matter'+$curso).checked;
	if(isChecked){
	$('#ver_menu_predecesoras'+$curso).show();	
	$('#matterselection').show();
	

	}else{	
		console.log('nock');
	//$('#itemName').val(null);
	//$("#item").val([]).change();
	//$("#itemat").select2('val', '');
	//$("#item").val('xxxxx').change();
	//document.getElementById('$itemat').innerHTML = ""

	//$("#itemat option:selected").removeAttr("selected"); 
	//$("#itemat option:selected").prop("selected", false); 
	//$("#itemat").select2("clearSelection"); 

	//$("#itemat").select2('refresh'); 
		//sirveparalalgo
	$("#itemat option[value]").remove(); 

	$('#ver_menu_predecesoras'+$curso).hide();
	$('#matterselection').hide();
	}
}
//$("#itemat option[value]").remove(); 

//var selected;
//var array = new Array();
//	$("#matters").change(function () {
//		console.log('entra select');
//		var name= document.getElementById("matters");
//		var selected = name.options[name.selectedIndex].text;
//		console.log('selected',selected);


		

//		$("#hiddenNOT").val(selected);
		//var valor = selected;
		//console.log('valor',valor);
		//array = new Array(5);
		
		//for (let i = 0; i < 5; i++) {
		//array[i] = selected();
		//	array.push(selected);
		//}
//		array.push(selected);
//		console.log(array);
//		console.log('ad',array);
//		console.log(array.length);
//		console.log('valor',array[0]);

//		$("#hiddenNOT").val(array);
		//$('#prueba').tagsinput('add', array);
		//console.log('arreglo',array);
		//$("#prueba").val(selected);
		//$("#prueba").tagsinput(array);
		//$('#prueba').val(array).tagsinput();
		//$("#prueba").tagsinput(selected);
//	});
	//$("#hiddenNOT").val(array);
	//$("#hiddenNOT").val(array[1]);
//	console.log('aaaaa',array);
	//console.log('arr',array[0]);
//	console.log(array.length);
	
//	console.log(array.length);
	//console.log(Array.isArray(array));
	/*for (let i = 0; i < 5; i++) {
		console.log('entra arre');
		//array[i] = selected();
		//	array.push(selected);
		$("#hiddenNOT").val(array[i]);
	}*/
	//console.log('af',array);
	//$('#prueba').val(array).tagsinput();
	//$('#prueba').tagsinput('add', array);
	//$("[name=prueba]").data('tagsinput').itemsArray;
	
//$("#prueba").val('aaaa');
//var id='1';
//$("#prueba").val(selected);
//var tagsValue = 'Jakarta,Bogor,Bandung';
//$('#prueba').val(tagsValue).tagsinput();



//$('#prueba').tagsinput({
//  confirmKeys: [13, 44, 32]
//});

/*
$(document).ready(function(){
	$(".mul-select").select2({
		placeholder:"Escoja Materia",
		tags: true,
		tokenSeparators: ['/',',',','," "]
	})
})*/

/*$('#itemat').select2({
        dropdownParent: $('#dirModalAgregarMateria{{$course->id}}')
    });*/
	//$.fn.modal.Constructor.prototype.enforceFocus = function() {};
//$.fn.modal.Constructor.prototype.enforceFocus = $.noop;
/*$('select:not(.normal)').each(function () {
            $(this).select2({
                dropdownParent: $('#dirModalAgregarMateria{{$course->id}}') 
            });
        });*/


$(document).ready(function () {



	
$('#itemat').select2({
        placeholder: 'Seleccione',
		tokenSeparators: [','],
		multiple: true,

		tags: true,
		//maximumSelectionLength: 2, // Número máximo de selecciones
		selectOnClose: true,
		//containerCssClass: ':all:',
        ajax: {
          url: '/materiasEdicion-lista',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nombre,
                        id: item.id
                    }
                })
            };
          },
          //cache: true
        }
      });
	});
	/*$('#itemat').select2({
        dropdownParent: $('#dirModalAgregarMateria{{$course->id}}')
    });*/

//$("#mul-select").select2("destroy").select2({});
//$("#itemName").select2("destroy").select2({});
//$( window ).load(function() {
//	$("#mul-select").select2("destroy").select2({});
//});
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};

//posiblemente
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};
/*$('#itemat').select2({
  dropdownParent: $('#myModal')
});*/

/*$('#lenguajes').select2({
        //dropdownParent: $('#dirModalAgregarMateria{{$course->id}}')
		dropdownParent: $ ('. modal-body', '#dirModalAgregarMateria{{$course->id}}')
    });*/



/*
$('.itemName').select2({
  placeholder: 'Select an item',
  ajax: {
    url: 'materiasEdicion/agregar',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.nombre,
                  id: item.id
              }
          })
      };
    },
    cache: true
  }
});
*/

//var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
/*
$(document).ready(function() {
	console.log('ee');
	$('#itemName').select2({
		
		ajax: {
			type: "post",
			dataType:"json",
			data: function(params){
				console.log('q',params);
				return{
					//_token: CSRF_TOKEN,
					search: params.term
				};
			},
			processResults: function(response){
				console.log('d');
				return{
					results: response
				};
			},
			cache: true
			/*success:function (response){
				var response = JSON.parse(response);
				console.log(response);
				$.each(response, function(i,v){
					$('#itemName').append('<option value=' + v.id +'>'+ v.nombre + '</option>');
				});
			}
		}
	});
});
*/
    
 /*   
    $.ajax({
    type: 'GET',
    url:'materiasEdicion/agregar',
    success: function (response){
    var response = JSON.parse(response);
    console.log(response);
    if(response ==''){
      $('#itemName').empty();
      $('#itemName').append('<option value="0" disabled selected>No hay materias Disponibles</option>');
    }
    else {
    

      $.each(response,function(i, v) {
        
                $("#itemName").append('<option value=' + v.id + '>' + v.nombre +  '</option>');
                               
          });
    }

    }
    });
    });
  });
*/





</script>
