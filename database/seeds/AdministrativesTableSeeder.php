<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Administrative;

class AdministrativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = array('Rector','Secretaria','Colecturia','Docente','Representante');
        $faker = Faker::create();
        $i = 1;
        for ($f=0; $f < 4 ; $f++) { 
            foreach ($profile as $key => $value) {

             \DB::table('users_profile')->insert(array(
                //General
                'ci'            =>  $faker->isbn10,
                'nombres'       =>  $faker->firstNameFemale,
                'apellidos'     =>  $faker->lastName,
                'sexo'          =>  'Femenino',
                'fNacimiento'   =>  $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
                'correo'        =>  $faker->email,
                'movil'         =>  $faker->isbn10,
                //Adicional
                'bio'           =>  $faker->text(250),
                //Domicilio
                'dDomicilio'    =>  $faker->address,
                'tDomicilio'    =>  $faker->phoneNumber,
                //Cargo
                'cargo'         =>  $value,
                'userid'        =>  $i,
            ));
             $i++;


         }
     }

}
}

       /* for ($i=0; $i < 4; $i++){
        	\DB::table('administratives')->insert(array(
        		//General
        		'ci'			=>	$faker->isbn10,
        		'nombres'		=>	$faker->firstNameFemale,
        		'apellidos'		=>	$faker->lastName,
        		'sexo'			=>	'Femenino',
        		'fNacimiento'	=>	$faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        		'correo'		=>	$faker->email,
        		'movil'			=>	$faker->isbn10,
        		//Adicional
        		'bio'			=>	$faker->text(250),
        		//Domicilio
        		'dDomicilio'	=>	$faker->address,
        		'tDomicilio'	=>	$faker->phoneNumber,
        		//Cargo
        		'cargo'			=>	'Secretaria',
                'userid'        =>  $i == 1 ? 2 : null,
        	));
        }
        for ($i=0; $i < 3; $i++){
        	\DB::table('administratives')->insert(array(
        		//General
        		'ci'			=>	$faker->isbn10,
        		'nombres'		=>	$faker->firstNameFemale,
        		'apellidos'		=>	$faker->lastName,
        		'sexo'			=>	'Femenino',
        		'fNacimiento'	=>	$faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        		'correo'		=>	$faker->email,
        		'movil'			=>	$faker->isbn10,
        		//Adicional
        		'bio'			=>	$faker->text(250),
        		//Domicilio
        		'dDomicilio'	=>	$faker->address,
        		'tDomicilio'	=>	$faker->phoneNumber,
        		//Cargo
        		'cargo'			=>	'Colecturia',

                'userid'        =>  $i == 1 ? 3 : null,
        	));
        }
    }
}
*/