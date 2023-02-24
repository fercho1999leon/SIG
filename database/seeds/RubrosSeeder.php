<?php

use Illuminate\Database\Seeder;

use App\Payment;
use App\Rubro;
class RubrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::beginTransaction();
        $idPeriodo = 1;
        Rubro::create([
            'tipo_rubro' => 'Pension',
            'tipo_emision' => 'FACTURA',
            'idPeriodo' => $idPeriodo
        ]);

        Rubro::create([
            'tipo_rubro' => 'Matricula',
            'tipo_emision' => 'FACTURA',
            'idPeriodo' => $idPeriodo
        ]);

        Rubro::create([
            'tipo_rubro' => 'Ambiente_Digital',
            'tipo_emision' => 'RECIBO',
            'idPeriodo' => $idPeriodo
        ]);

        Rubro::create([
            'tipo_rubro' => 'Robotica_Educativa',
            'tipo_emision' => 'RECIBO',
            'idPeriodo' => $idPeriodo
        ]);

        $pagos = Payment::all();

        foreach ($pagos as $key => $value) {
            $rubro = Rubro::where('tipo_rubro', $value->tipo)->first();
            $value->idRubro = $rubro->id;
            $value->save();
		}
		DB::commit();
    }
}
