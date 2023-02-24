<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Student2;
class Students2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        // $faker = Faker::create();
    	// for ($i=0; $i < 60; $i++) {
        //     $gen = rand(1,2);
    	// 	\DB::table('students2')->insert(array(
            
	    //     'ci'           =>  $faker->isbn10,
        //     'nombres'       => $gen == 1 ? $faker->firstNameMale : $faker->firstNameFemale,
        //     'apellidos'     =>  $faker->lastName,
        //     'sexo'          =>  $gen == 1 ? 'Masculino' : 'Femenino',
        //     'fechaNacimiento'   =>  $faker->date($format = 'Y-m-d', $max = '2016-01-01'),
        //     'ciudad'        =>  'Guayaquil',
        //     'direccion'     =>  $faker->address,
         
        //     'matricula'     => 'Ordinaria',
	    //     'idCurso'		=>	rand(1,12),

	    // 	));
        // }
        \DB::table('roles')->insert([
            ['name'	=>	'Estudiante','slug'	=>	'UsersViews.estudiante']
        ]);

        $students = Student2::all();

        foreach($students as $student){
            $user_sentinel = ['email'	=>	$student->id."@pined.com",'password'	=>	"12345"];
            $user= Sentinel::registerAndActivate($user_sentinel);
            //registra el rol de los usuarios 
            $role= Sentinel::findRoleByName("Estudiante");
            $role->users()->attach($user);
            $idProfile = DB::table('users_profile')
                ->insertGetId([
                    'ci'	=>	$student->ci,	
                    'nombres'	=>	$student->nombres,
                    'apellidos'	=>	$student->apellidos,
                    'sexo'	=>		$student->sexo,
                    'fNacimiento'	=>	$student->fechaNacimiento,
                    'correo'	=>$student->id."@pined.com",
                    //'movil'	=>	$student->movil,
                    //'bio'	=>	$student->bio,
                    'dDomicilio'	=>	$student->dDomicilio,
                    'tDomicilio'	=>	$student->tDomicilio,
                    'cargo'	=>	"Estudiante",	
                    'userid'   =>  $user->id,
                    'created_at'	=>	date("Y-m-d H:i:s"),
                ]);
            $student->idProfile = $idProfile;

            $student->save();
        }
       
    }
}
