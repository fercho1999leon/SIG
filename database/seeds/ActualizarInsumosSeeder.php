<?php

use Illuminate\Database\Seeder;
use App\Supply;
class ActualizarInsumosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insumos = Supply::where('nombre','EVALUACION')->get();

        foreach($insumos as $insumo)
        {
            $insumo->es_aporte = true;
            $insumo->save();
        }
    }
}
