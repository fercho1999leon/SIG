<?php

use Illuminate\Database\Seeder;

class DatosPadresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("UPDATE `datospadres` SET `estado_civil`='Casado(a)'");
    }
}
