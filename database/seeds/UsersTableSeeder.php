<?php

use App\Institution;
use App\Usuario;
use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		$institution = Institution::first();
		$users = array(
			[	
				'nombres'    =>  'PINED',	
		    	'apellidos' => 'S.A.',	
		    	'email'    =>  'soporte@pined.ec',
		    	'password' => 'adminPINED',
				'sexo' => 'Masculino'
			]
        );
        $role = Sentinel::findRoleByName('Administrador');
        foreach ($users as $key) {
            $insert =[
                'email' => $key['email'],
                'password' => $key['password']
            ];
            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'nombres'   =>  $key['nombres'],
                'apellidos'   =>  $key['apellidos'],
                'sexo'   => $key['sexo'],
                'correo'   =>  $key['email'],
                'cargo'    => 'Administrador',
                'userid'   =>  $user->id
            ));
        } 
		$user = Usuario::find(1);
		$user->idPeriodoLectivo = $institution->periodoLectivo;
		$user->save();
    }
}
