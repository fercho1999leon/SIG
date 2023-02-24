<?php

use App\Administrative;
use Illuminate\Database\Seeder;

class ActualizacionContrasenaRepresentante extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representantes = Administrative::where('cargo', 'Representante')->get();
        foreach ($representantes as $representante) {
            $user = Sentinel::findById($representante->userid);
            $credentials = ['password' => $representante->ci ?? '12345'];
            Sentinel::update($user, $credentials);
        }
    }
}
