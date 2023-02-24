<?php

use Illuminate\Database\Seeder;

class DocentesTheoConstanteParraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$docentes = array(
        	array('0922340849','FACONES BARRETO','CRISTINA','Femenino','correodocente1@pined.ec'),
			array('0908073356','ZUÑIGA FLORES','LETTY JANET','Femenino','correodocente2@pined.ec'),
			array('0929316495','CEDEÑO ZUÑIGA','GABRIELA CECIBEL','Femenino','correodocente3@pined.ec'),
			array('0916293227','GOMEZ IZURIETA','ELVIA JAZMIN','Femenino','correodocente4@pined.ec'),
			array('0910378868','FREIRE MARIÑO','MARCIA PIEDAD','Femenino','correodocente5@pined.ec'),
			array('0940585755','CHUQUI LEÓN','JOHANA JACQUELINE','Femenino','correodocente6@pined.ec'),
			array('0951898949','MELENDEZ ORELLANA','JULIA AZUCENA','Femenino','correodocente7@pined.ec'),
			array('0930307509','TRIVIÑO REYES','REBECA ELIZABETH','Femenino','correodocente8@pined.ec'),
			array('0930138300','ARIAS CONTRERAS','GEANINE DENNISE','Femenino','correodocente9@pined.ec'),
			array('0921164141','BENAVIDEZ YAGUAL','KERLY PAMELA','Femenino','correodocente10@pined.ec'),
			array('0908698251','BENAVIDES CASTILLO','GINA JUSTINA','Femenino','correodocente11@pined.ec'),
			array('0910550383','BENITES VERA','AMALIA MARCELA','Femenino','correodocente12@pined.ec'),
			array('0910980952','CARRANZA MACIAS','LEIDER OSWALDO','Masculino','correodocente13@pined.ec'),
			array('0910272855','LARENAS JIMENEZ','EDITH RUTH','Femenino','correodocente14@pined.ec'),
			array('0952034213','CABEZAS ARREAGA','CRISTHIAN ALEXANDER','Masculino','correodocente15@pined.ec'),
			array('0906514153','RODRIGUEZ CONFORME','VICTOR EMILIO','Masculino','correodocente16@pined.ec'),
			array('0926687906','RUIZ QUINTONG','MARIA MERCEDES','Femenino','correodocente17@pined.ec'),
			array('0907753487','ROSADO MUÑOZ','MARIA DE LOURDES','Femenino','correodocente18@pined.ec'),
        );
        $role = Sentinel::findRoleByName('Docente');
        foreach ($docentes as $key) {
              
            $insert =[
                'email' => $key[4],
                'password' => $key[0]
            ];
            $user =  Sentinel::registerAndActivate($insert);
            $role->users()->attach($user);
            \DB::table('users_profile')->insert(array(
                'ci'   => $key[0],
                'nombres'   =>  $key[2],
                'apellidos'   =>  $key[1],
                'sexo'   => $key[3],
                'correo'   =>  $key[4],
                'cargo'    => 'Docente',
                'userid'   =>  $user->id
            ));
        } 
    }
}
