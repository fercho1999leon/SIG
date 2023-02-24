<?php

use Illuminate\Database\Seeder;
use App\Supply;
class AporteSupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplies = Supply::all();

        foreach($supplies as $supply)
        {
            if($supply->nombre == "SUMATIVA" || $supply->nombre == "EVALUACION"){
                $supply->es_aporte = true;
                $supply->save();
            }
        }
    }
}
