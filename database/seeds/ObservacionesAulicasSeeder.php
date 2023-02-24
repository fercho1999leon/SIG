<?php

use App\ArchivosInstitucionales;
use Illuminate\Database\Seeder;

class ObservacionesAulicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArchivosInstitucionales::create([
			'nombre' => 'Observaciones Aulicas',
			'categoria' => 'Progreso Formativo',
			'acceso' => 'Administrador',
		]);
    }
}
