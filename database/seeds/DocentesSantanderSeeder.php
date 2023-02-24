<?php

use Illuminate\Database\Seeder;

class DocentesSantanderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docentes = array(
        	array('Liliana','Vasquez','Femenino','lilia.vasquez@uesantander.edu.ec','Lili@2019'),
			array('Carlos','Palacios','Masculino','carlos.palacios@uesantander.edu.ec','C@rlos2019'),
			array('Luis','Quijano','Masculino','luis.quijano@uesantander.edu.ec','Luis-2@19'),
			array('Felix','Vasconez','Masculino','felix.vasconez@uesantander.edu.ec','Felix-2@19'),
			array('Jose','Intriago','Masculino','jose.intriago@uesantander.edu.ec','Jose-2@19'),
			array('Jack','Vera','Masculino','jack.vera@uesantander.edu.ec','J@ck-2019'),
			array('Luis','Molina','Masculino','luis.molina@uesantander.edu.ec','Luis-2@19'),
			array('Cesar','Araujo','Masculino','cesar.araujo@uesantander.edu.ec','Ces@r-2019'),
			array('Maria','Perez','Femenino','maria.perez@uesantander.edu.ec','Mari@-2019'),
			array('Farid','Cedeño','Masculino','farid.cedeno@uesantander.edu.ec','F@rid-2019'),
			array('Cesar','Araujo','Masculino','cesar.jose@uesantander.edu.ec','Ces@r-2019'),
        );
        $role = Sentinel::findRoleByName('Docente');
        foreach ($docentes as $key) {
              
            $insert =[
                'email' => $key[3],
                'password' => $key[4]
            ];
            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'nombres'   =>  $key[0],
                'apellidos'   =>  $key[1],
                'sexo'   => $key[2],
                'correo'   =>  $key[3],
                'cargo'    => 'Docente',
                'userid'   =>  $user->id
            ));
        } 


    }    
}
