<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EliminacionDeClientesSinDatos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('clientes')->whereNull('cedula_ruc')->delete();
    }
}
