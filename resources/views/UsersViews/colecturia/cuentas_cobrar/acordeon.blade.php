@php
  use App\Cuentasporcobrar;
  $cuentas_por_cobrar = Cuentasporcobrar::
          join('students2_profile_per_year','students2_profile_per_year.id','=','cuentas_por_cobrar.cliente_id')        
          ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
          ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
          ->join('Semesters', 'cuentas_por_cobrar.id_semesters','=', 'Semesters.id')
          ->select(
          'cuentas_por_cobrar.id as idCuenta'
          ,'cuentas_por_cobrar.fecha_emision as fecha_emision',
          'cuentas_por_cobrar.fecha_vencimiento as fecha_vencimiento',
          'cuentas_por_cobrar.comprobante_id as comprobante_id',
          'Semesters.nombsemt as semestre',
          DB::raw("CONCAT(students2.nombres, ' ', students2.apellidos) AS full_name"),
          'cuentas_por_cobrar.concepto as concepto',
          'cuentas_por_cobrar.saldo as saldo',
          'cuentas_por_cobrar.debito as debito',
          'cuentas_por_cobrar.credito as credito',
          \DB::raw('(CASE
              WHEN cuentas_por_cobrar.status = "1" THEN "POR VENCER"                        
              WHEN cuentas_por_cobrar.status = "2" THEN "PAGADA"                        
              WHEN cuentas_por_cobrar.status = "3" THEN "ABONADO"                        
              WHEN cuentas_por_cobrar.status = "4" THEN "EN PROCESO DE VERIFICACION"   
              WHEN cuentas_por_cobrar.status = "0" THEN "ELIMINADA"                        
              WHEN cuentas_por_cobrar.status = "10" THEN "PAGO RECHAZADO POR INCONSISTENCIA"   
              END) AS estado'),
          DB::raw("cuentas_por_cobrar.saldo - cuentas_por_cobrar.debito as deuda"),
          'students2.ci as cedulaEstudiante',
          'students2.id as IDEstudiante'
      )->orderBy('cuentas_por_cobrar.id')
      ->where('cuentas_por_cobrar.status','!=','0')
      ->where('students2.id',$IDEstudiante)
      ->get();
@endphp

<button class="accordion" id="{{$IDEstudiante}}">{{$full_name}}</button>
<div class="panel" id="#{{$IDEstudiante}}">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Id</th>
        <th>Fecha Emision</th>
        <th>Fecha Vencimiento</th>
        <th>Comprobante</th>
        <th>Semestre</th>
        <th>Concepto</th>
        <th>Saldo</th>
        <th>Debito</th>
        <th>Credito</th>
        <th>Deuda</th>
        <th>Estado</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cuentas_por_cobrar as $cuentas)
        <tr>
          <td>{{$cuentas->idCuenta}}</td>
          <td>{{$cuentas->fecha_emision}}</td>
          <td>{{$cuentas->fecha_vencimiento}}</td>
          <td>{{$cuentas->comprobante_id}}</td>
          <td>{{$cuentas->semestre}}</td>
          <td>{{$cuentas->concepto}}</td>
          <td>{{$cuentas->saldo}}</td>
          <td>{{$cuentas->debito}}</td>
          <td>{{$cuentas->credito}}</td>
          <td>{{$cuentas->deuda}}</td>
          <td>{{$cuentas->estado}}</td>
          <td>
            @include('UsersViews.colecturia.cuentas_cobrar.accion',[
              'idCuenta' =>  $cuentas->idCuenta,
              'IDEstudiante' =>  $cuentas->IDEstudiante,
              'fecha_emision' =>  $cuentas->fecha_emision,
              'fecha_vencimiento' =>  $cuentas->fecha_vencimiento,
              'concepto' =>  $cuentas->concepto,
              'saldo' =>  $cuentas->saldo
            ])
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
