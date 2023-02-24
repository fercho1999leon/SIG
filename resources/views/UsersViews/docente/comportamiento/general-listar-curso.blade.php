@section('contentPanel')
  <div class="mail-box tableNotificaciones">
        <div class="table-responsive p-1">
          <table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
            <thead>
              <tr>
                <th>#</th>
                <th>Estudiante</th>
                <th>Nota</th>
                <th>Observación</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>@foreach ($students as $student)
              <form id="form1">
                <tr class="read" style="cursor:pointer;" id="mostrar">
                <td> {{$loop->iteration}} </td>
                @php
                  $studiante = App\Student2::findOrFail($student->idStudent);
                  $comp = $studiante->comporMateria($materia->id,$parcial);
                  $observacion='';
                  $nota='';
                  $Id='';
                if (!$comp==null) {
                  $observacion=$comp->observacion;
                  $nota=$comp->nota;
                  $Id=$comp->id;                  
                }
                @endphp
                <td> 
                  <input class="custom-input" type="hidden" name="id_estudiante" id="id_estudiante{{$loop->iteration}}" value="{{$student->idStudent}}"> 
                  {{$student->apellidos}} {{$student->nombres}}        
                </td>
                <td>
                <select name="select_nota" id="select_nota{{$loop->iteration}}">
                <option value="0" >--</option>
                <option value="A" {{$nota == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{$nota == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{$nota == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{$nota == 'D' ? 'selected' : '' }}>D</option>
                <option value="E" {{$nota == 'E' ? 'selected' : '' }}>E</option>
                </select>                                
                </td>
                <td>
                  <textarea  id="text_area{{$loop->iteration}}" rows="1" cols="50">{{$observacion}}</textarea>
                </td>
                <td>
                  <a onclick="eliminar_comportamiento({{$Id}})">
                    <i class="fa fa-trash icon__eliminar"></i>
                 </a>
                </td>
                </tr>
                <input type="hidden"  id="contador" value="{{$loop->count}}"> 
                @endforeach
              </form>
            </tbody>
          </table>
                    
                    <div class="text-right">
                  <button onclick="add_comportamientos('{{$materia->id}}','{{$parcial}}');" class="mb-1 btn btn-primary">Actualizar Comportamiento</button>
                </div>      
        </div>     
      </div>
    </div>
@endsection