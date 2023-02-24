@section('contentPanel')
  <div class="mail-box tableNotificaciones">
        <div class="table-responsive p-1">
          <table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>idCliente</th>
                <th>Cliente</th>
                <th>Factura</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Estatus</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody> @foreach($historico as $historia)           
                <tr class="read" style="cursor:pointer;" id="mostrar_{{$historia->id}}">
                <td>  
                {{$historico->perPage()*($historico->currentPage()-1)+$loop->iteration}}          
                </td>
                <td>  
                {{$historia->created_at}}              
                </td>
                <td>
                {{$historia->idCliente}}
                </td>
                <td>
                {{$historia->ClientePEL->nombres}}
                </td>
                <td>
                {{$historia->MerchantTransactionId_DF}}
                </td>
                <td>
                  {{$historia->codigo_error}}
               </td>
               <td>
                 {{substr($historia->descripcion_error, 0,50)}}
               </td>
                <td>
                  {{$historia->total}}
                </td>
                <td>
                  {{$historia->status}}
                </td>
                <td>
                <a onclick="ver_transaccion({{$historia->id}})">
                <i class="fa fa-eye icon__ver"></i>&nbsp;
                </a>
                 <a onclick="eliminar_transaccion({{$historia->id}})">
                    <i class="fa fa-trash icon__eliminar"></i>
                 </a>
               
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>     
      </div>
    </div>
@endsection