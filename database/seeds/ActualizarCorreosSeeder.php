<?php

use App\Usuario;
use App\Administrative;
use App\Student2;
use Illuminate\Database\Seeder;

class ActualizarCorreosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudiantes = Student2::where('matricula', 'Ordinaria');
        foreach ($estudiantes as $estudiante) {

            $user_profile = Usuario::findOrFail($estudiante->idProfile);
            if(!is_null($user_profile)) {
                $user = Sentinel::findById($user_profile->userid);
                $user->email = $user_profile->correo;
                $user->save();
            }
            // $credentials = ['password' => $estudiante->ci ?? '12345'];
            // Sentinel::update($user, $credentials);
        }
    }
}
