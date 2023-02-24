<?php

use Illuminate\Database\Seeder;

class UsersPassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representantes = DB::table('users_profile')->where('cargo', 'Representante')->get();

        foreach($representantes as $representante){
            $user = Sentinel::findById($representante->userid);
            $credentials = [
                'email' => $representante->correo,
                'password' => '12345',
            ];
            $user = Sentinel::update($user, $credentials);
        }
    }
}
