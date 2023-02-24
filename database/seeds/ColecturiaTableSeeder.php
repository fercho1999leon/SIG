<?php

use Illuminate\Database\Seeder;

class ColecturiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Colecturía
        $users = array(
            [  'email'  =>  'colecturia1@gmail.com',
                'password' =>  'colecturiaJP',       
                'nombres'  =>   'COLECTURIA ', 
                'apellidos' => '1',
                'sexo'  =>  'Femenino'
            ],
            [  'email'  =>  'colecturia2@gmail.com',
                'password' =>  'colecturiaJP',       
                'nombres'  =>   'COLECTURIA ', 
                'apellidos' => '2',
                'sexo'  =>  'Femenino'
            ]
        );
        $role = Sentinel::findRoleByName('Colecturia');
        foreach ($users as $key) {
            print($key['email']);
            $insert =[
                'email' => $key['email'],
                'password' => $key['password']
            ];
            
            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'nombres'   =>  $key['nombres'],
                'apellidos'   =>  $key['apellidos'],
                'sexo'   =>  $key['sexo'],
                'correo'   =>  $key['email'],
                'cargo'    => 'Colecturia',
                'userid'   =>  $user->id
            ));
        } 

        
    }
}
