<style>
    .titulo{
        color: #000000;
        font-size: 20px;
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
       
    }
    .encabezado{
        font-size-adjust: 10px;
        text-align: left;
        background-color: #c4c9cc;
        border: #000000;
    }
    .encabezadoTabla{
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        background-color: #c4c9cc;
        border: #000000;
        
    }
</style>
<table>
    <thead>
    <tr>
        <th colspan="13" class="titulo" >KARDEX</th>
    </tr>
    
   
        
    
    <tr>
        <th colspan="3" class="encabezado" >Nº Matricula:</th>
        
        <td colspan="10" class="encabezado">{{$estudiante['numero_matriculacion']}}</td>
    </tr>
   
    <tr>
        <th colspan="3" class="encabezado">Cedula:</th>
        
        <td colspan="10" class="encabezado">{{$data['ci']}}</td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Apellidos:</th>
        
        <td colspan="10" class="encabezado">{{$data['apellidos']}}</td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Nombres:</th>
        
        <td colspan="10" class="encabezado">{{$data['nombres']}}</td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Teléfono:</th>
        
        <td colspan="10" class="encabezado">{{$data['telefono']}}</td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Dirección:</th>
        
        <td colspan="10" class="encabezado">{{$data['direccion']}} </td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Ciudad:</th>
        
        <td colspan="10" class="encabezado">{{$data['ciudad']}}</td>
    </tr>
    <tr>
        <th colspan="3" class="encabezado">Email:</th>
        
        <td colspan="10" class="encabezado">{{$data['correoElectronico']}}</td>
    </tr>
    
    
    <tr>
        <th colspan="1" class="encabezadoTabla"></th>
        <th colspan="2" class="encabezadoTabla">Fecha</th>
        <th colspan="1" class="encabezadoTabla">Ref</th>
        <th colspan="3" class="encabezadoTabla">MATRICULA</th>
        <th colspan="3" class="encabezadoTabla">CUOTAS</th>
        <th colspan="1" class="encabezadoTabla">Valor</th>
        <th colspan="1" class="encabezadoTabla">Pago</th>
        <th colspan="1" class="encabezadoTabla">Saldo</th>
    </tr>
    </thead>
    <tbody>
    
        <tr>
            <td colspan="1" style="background-color: #dde9c2;">S1</td>
            <td colspan="2" style="background-color: #dde9c2;">{{$costoMatricula?$costoMatricula->fecha_vencimiento:null}}</td>
            <td colspan="1" style="background-color: #dde9c2;">{{$costoMatricula?$costoMatricula->num_factura:null}}</td>
            <td colspan="3" style="background-color: #dde9c2;">MATRICULA {{$costoMatricula?$costoMatricula->concepto:null}}</td>
            <td colspan="3" style="background-color: #dde9c2;"></td>
            <td colspan="1" style="background-color: #dde9c2;">{{$costoMatricula?$costoMatricula->debito:null}}</td>
            <td colspan="1" style="background-color: #dde9c2;">{{$costoMatricula?$costoMatricula->credito:null}}</td>
            <td colspan="1" style="background-color: #dde9c2;">{{$costoMatricula?$costoMatricula->saldo:null}}</td>
        </tr>
        {{$j=1,
          $saldoTotal=0}}
            @foreach ($cuotasSemestre as $item)
            
            <tr>
                <td colspan="1" style="background-color: #a0b7c5;">S1</td>
                <td colspan="2" style="background-color: #a0b7c5;">{{$item->fecha_vencimiento}}</td>
                <td colspan="1" style="background-color: #a0b7c5;">{{$item->num_factura}}</td>
                <td colspan="3" style="background-color: #a0b7c5;"></td>
                <td colspan="3" style="background-color: #a0b7c5;">{{$item->concepto}} # {{$j}} Estado: {{$item->estado}}</td>    

                <td colspan="1" style="background-color: #a0b7c5;">{{$item->debito}}</td>
                <td colspan="1" style="background-color: #a0b7c5;">{{$item->credito}}</td>
                <td colspan="1" style="background-color: #a0b7c5;">{{$item->saldo}}</td>   
                {{$saldoTotal = $saldoTotal + (float)$item->credito}} 
            </tr>
            {{$j++}}
            @endforeach
            <tr>
                <td colspan="6" style="background-color: #a0b7c5;"></td>
                <td colspan="5" style="background-color: #ff0000; color: #fff">Total Recaudado por la Cuotas</td>
                <td colspan="2" style="background-color: #e7db97;">{{$saldoTotal}}</td>
            </tr>
            
     
   
    </tbody>
</table>