<?php

use App\Clasesdestreza;
use Illuminate\Database\Seeder;

class SeAgregaEamenQuimestralEnClasesDEstrezas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$destrezas = Clasesdestreza::where('parcial', '')->get();
		foreach ($destrezas as $destreza) {
			$destreza->parcial = 'EXQ1';
			$destreza->save();
		}
    }
}
