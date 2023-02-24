<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;

class RepresentantesElSamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reps = array(
			array('0914288006','Andrade Calle','Martha','01/01/1990','josemallatagsi@gmail.com','1234567890'),
			array('0912620598','Arbaiza Pluas','Ingrid Débora','01/01/1990','ingrid.76@hotmail.com','1234567890'),
			array('0930094263','Arroyave Orellana','Michelle Carolina','01/01/1990','michu_1604@hotmail.com','1234567890'),
			array('0918730151','Bajaña Rendon','Zayda Ximena','01/01/1990','abustancastro@hotmail.com','1234567890'),
			array('0702889767','Balladares Flores','Jacinta Aracelys','01/01/1990','repuestosmulticar@hotmail.com','1234567890'),
			array('0918603234','Barquet Perez','Priscilla','01/01/1990','priscka270678@hotmail.com','1234567890'),
			array('0909317471','Bello Castro','Zoraida Josefina','19/3/1964','nuevoblogzoraida@gmail.com','0984119378'),
			array('0914522156','Benavides Galvez','Gisella Mariela','15/11/1970','gisellamariela@gmail.com','0982485093'),
			array('0703959676','Benavides Perez','Jessica Alexandra','01/01/1990','bjessiquita@hotmail.com','0990167870'),
			array('1204573214','Bobadilla Santillan','Nancy Raquel','01/01/1990','nancysport.cdeportiva@hotmail.com','1234567890'),
        );

		$role = Sentinel::findRoleByName('Representante');
		foreach ($reps as $key) {
			
            $insert =[
                'email' => $key[4],
                'password' => $key[0]
            ];
            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'ci'            =>  $key[0],
                'nombres'       =>  $key[1],
                'apellidos'     =>  $key[2],
                'sexo'          =>  'Femenino',
                'correo'        =>  $key[4],
                'cargo'         => 'Representante',
                'userid'        =>  $user->id
            ));
            //echo $key[0].' '.$key[1].' '.$key[2].' '.$key[3].' '.$key[4].' '.$key[5].'            ';
        } 


    }
}
