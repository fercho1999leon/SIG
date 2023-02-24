<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class DocentesVicenteAmadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docentes = array(
        	array('linzandayana18@gmail.com','DAYANA','LINZAN','Femenino','1314983550'),
			array('dylan31201@live.com','JASMIN','BRAVO','Femenino','1309364455'),
			array('karolylio@hotmail.com','KAROL','ALVAREZ ROLDAN','Femenino','1314717321'),
			array('nellysalvatierramarquez@hotmail.com','NELLY MARILU','SALVATIERRA MARQUEZ','Femenino','1302295942'),
			array('jvelez.mariana@gmail.com','JASMIN','VELEZ','Femenino','1308569100'),
			array('mayraveliz@hotmail.com','MAYRA JACQUELINE','VELIZ MENDOZA','Femenino','1312746017'),
			array('Ibarra.wendy1984@gmail.com','WENDY','IBARRA','Femenino','921088860'),
			array('asaltos6156@hotmail.com','ALEXIS','SALTOS CATAGUA','Masculino','1312916156'),
			array('Mikathaly@homtail.com','PATRICIA THALIA','PLUA PALMA','Femenino','1350124788'),
			array('Sarmando_8689@hotmail.com','ARMANDO','SANCHEZ','Masculino','1310480858'),
			array('cicg7@hotmail.com','CONCEPCION','CEVALLOS','Femenino','1311972457'),
			array('carmi.rivera86@gmail.com','CARMEN','MORA','Femenino','1310734643'),
			array('patriciobravo87@gmail.com','PATRICIO','BRAVO','Masculino','1311747206'),
			array('marialoortuarez@hotmail.com','MARIA BENEDICTA','LOOR TUAREZ','Femenino','1304232539'),
			array('Yemar_china@hotmail.com','MARGARITA YESENIA','CEVALLOS MACIAS','Femenino','1307785319'),
			array('Katakyuhan@gmail.com','GEMA','CATAGUA VELEZ','Femenino','1351743473'),
			array('michelletriples@gmail.com','MICHELLE','CATAGUA VELEZ','Femenino','1315825172'),
			array('rcheer@hotmail.com','RICHARD','CUSME','Masculino','1313309088'),
        );
        
        $role = Sentinel::findRoleByName('Docente');
        foreach ($docentes as $key) {
              
            $insert =[
                'email' => $key[0],
                'password' => $key[4]
            ];


            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'nombres'   =>  $key[1],
                'apellidos'   =>  $key[2],
                'sexo'   => $key[3],
                'correo'   =>  $key[0],
                'cargo'    => 'Docente',
                'userid'   =>  $user->id
            ));
        }
       
    }
}
