<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\FacturaDetalle;
use App\Student2;

class Registro_Datos_Cliente_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $count = 0;
        $students = FacturaDetalle::all();

        foreach( $students as $student){
            $estudiante = Student2::findOrFail($student->idEstudiante);
            if($estudiante->numero_identificacion==NULL){
                $cliente = Cliente::findOrFail($student->idCliente);

                $estudiante->numero_identificacion = $cliente->cedula_ruc;
                $estudiante->facturacion_apellidos = $cliente->apellidos ;
                $estudiante->facturacion_nombres = $cliente->nombres;
                $estudiante->facturacion_correo = $cliente->correo ;
                $estudiante->facturacion_movil = $cliente->telefono ;
                $estudiante->facturacion_convencional = $cliente->telefono ;
                $estudiante->save();
                $count++;
            }
        }
        
        //echo $count;
    }
}
