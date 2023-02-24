<?php

use Illuminate\Database\Seeder;
use App\Payment;
class TipoEmisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagos = Payment::all();
        
        foreach($pagos as $pago)
        {
            if($pago->tipo == "Matricula" || $pago->tipo == "Pension"){
                $pago->tipo_emision = "FACTURA";
                $pago->save();
            }else{
                $pago->tipo_emision = "RECIBO";
                $pago->save();
            }
        }
    }
}
