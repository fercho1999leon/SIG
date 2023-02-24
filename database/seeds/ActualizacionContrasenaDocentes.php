<?php

use App\Administrative;
use Illuminate\Database\Seeder;

class ActualizacionContrasenaDocentes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docentes = Administrative::where('cargo', 'Docente')->get();
        foreach ($docentes as $docente) {
            $user = Sentinel::findById($docente->userid);
            $credentials = ['password' => $docente->ci ?? '12345'];
            Sentinel::update($user, $credentials);
        }
    }
}
