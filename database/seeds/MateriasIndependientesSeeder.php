<?php

use Illuminate\Database\Seeder;
use App\Matter;
class MateriasIndependientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matters = Matter::all();
        foreach($matters as $matter)
        {
            $matter->independiente = 1;

            $matter->save();
        }        
    }
}
