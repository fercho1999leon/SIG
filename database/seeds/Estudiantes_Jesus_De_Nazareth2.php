<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class Estudiantes_Jesus_De_Nazareth2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	/*$students = array(
			//INICIAL 2:::1
				['1234567890','ALARCON  AGUIRRE','JHON ALEJANDRO','Masculino', '1'],
				['1234567890','AVENDAÑO LOJANO','SELISHA ALAIA','Masculino', '1'],
				['1234567890','BAQUE ARIZALA','ALLAN  MATHIAS','Masculino', '1'],
				['1234567890','BARAHONA ALVARADO','SUSANA JESUS','Masculino', '1'],
				['1234567890','BARRIOS  GUARIMATA','FRANJHETR DE JESÚS','Masculino', '1'],
				['1234567890','BOHORQUEZ SALAZAR','LIAM JACOB','Masculino', '1'],
				['1234567890','BONILLA BAÑO','DEIVID JUNIOR','Masculino', '1'],
				['1234567890','CANESSA GUILLEN','THIAGO NATHANIEL','Masculino', '1'],
				['1234567890','CARRANZA SALTOS ','MAYKEL EFREN','Masculino', '1'],
				['1234567890','CASTRO BURGOS','DYLAN EZEQUIEL','Masculino', '1'],
				['1234567890','CATAGUA SALAZAR','ANGELICA ESTHER','Masculino', '1'],
				['1234567890','CEDEÑO VACA','BRIANNA VALENTINA','Masculino', '1'],
				['1234567890','CEVALLOS PARRALES','JANDRY  ISAURO','Masculino', '1'],
				['1234567890','CHOEZ PAJA','VALENTINA MICHELLE','Masculino', '1'],
				['1234567890','CONTRERAS LOZADA','FANNY  NATASHA','Masculino', '1'],
				['1234567890','ESPARZA ALVAREZ','FRANKLIN ENRIQUE','Masculino', '1'],
				['1234567890','FERNANDEZ TOMALA','PAULA ELIZABETH','Masculino', '1'],
				['1234567890','GOITIA GAVIDIA','MARIA VICTORIA','Masculino', '1'],
				['1234567890','GUERRERO PAZMIÑO','ALEXA SOFIA','Masculino', '1'],
				['1234567890','LA ROSA PAZMIÑO','DANIELA JUSLINE','Masculino', '1'],
				['1234567890','LARA CASQUETE','JAELA AYTANA','Masculino', '1'],
				['1234567890','LOZANO JACOME','SCARLETT ANAHY','Masculino', '1'],
				['1234567890','MARCILLO ZAMORA','DECKER ISAAC','Masculino', '1'],
				['1234567890','MIELES HURTADO','LIAM ISAIAS','Masculino', '1'],
				['1234567890','MORALEZ LOPEZ','MILEY MARIE','Masculino', '1'],
				['1234567890','MOREIRA PEREZ','AYLIN PAULETTE','Masculino', '1'],
				['1234567890','NOGALES LOPEZ','MELISA LISBETH','Masculino', '1'],
				['1234567890','PAZMIÑO MOLINA','MIKE JAVIER','Masculino', '1'],
				['1234567890','PEÑAFIEL VINCES','ALAN DYLAN','Masculino', '1'],
				['1234567890','POVEDA BRIONES','MATHEW ALEJANDRO','Masculino', '1'],
				['1234567890','RIVERA CHONG','DAIBELYN ALEJANDRA','Masculino', '1'],
				['1234567890','ROCHA MOLME','GEOVANNY JEIMAR','Masculino', '1'],
				['1234567890','RODRIGUEZ BELTRAN','SHELMY VALENTINA','Masculino', '1'],
				['1234567890','SAAVEDRA MERELO','JAZMIN NOEMI','Masculino', '1'],
				['1234567890','TOMALA CHOEZ ','KEYLA DALESKA','Masculino', '1'],
				['1234567890','VELÍZ  ROSALES','JOSE EMILIANO','Masculino', '1'],
				['1234567890','VICTORES PAREJA','ASHLEY  FRANCHESCA','Masculino', '1'],
				['1234567890','VICTORES PAREJA','ASHLEY CHARLOTTE','Masculino', '1'],
				['1234567890','VINCES RIVAS','AINOHA CATALINA','Masculino', '1'],
				['1234567890','ZAMBRANO NIETO','CARLOS ALBERTO','Masculino', '1'],
			
			//PRIMERO:::2
				['1234567890','BARAHONA VELIZ','CLAUDIO ERICK','Masculino', '2'],
				['1234567890','BARRIOS GUARIMATA','FABIANA DE JESÚS','Masculino', '2'],
				['1234567890','BARZOLA ASTUDILLO','MATTHEW EMANUEL','Masculino', '2'],
				['1234567890','BERMUDEZ SAA','SUSANA ANTONIA','Masculino', '2'],
				['1234567890','CABRERA VERA','ANA PAULETTE','Masculino', '2'],
				['1234567890','CARPIO MORANTE','EMILY MAYERLI','Masculino', '2'],
				['1234567890','CEDEÑO PALACIOS','JOAO MATHEO','Masculino', '2'],
				['1234567890','CEVALLOS LOZADA','LUIS NEHEMIAS','Masculino', '2'],
				['1234567890','CHAVEZ MENDOZA','SAMUEL MATIAS','Masculino', '2'],
				['1234567890','DICAO MORA','DANIEL RAFAEL','Masculino', '2'],
				['1234567890','FERNANDEZ ASTUDILLO','SAMUEL DAVE','Masculino', '2'],
				['1234567890','GOMEZ JARAMILLO','NATHALIE  SCARLET','Masculino', '2'],
				['1234567890','GONZALEZ PORRAS','IAN STHEFAN','Masculino', '2'],
				['1234567890','GRACIA AYOVI','MATHIAS LEONARDO','Masculino', '2'],
				['1234567890','GUTIERREZ FIGUEROA','RYAN MATHEWS','Masculino', '2'],
				['1234567890','GUTIERREZ FREIRE','ALLISON ANABELL','Masculino', '2'],
				['1234567890','LOPEZ RIZO','SHEYLA MISHELLE','Masculino', '2'],
				['1234567890','MINA RAMIREZ','LUZ LINA','Masculino', '2'],
				['1234567890','PICO ROLDAN','EMILIANO SAMUEL','Masculino', '2'],
				['1234567890','PIGUAVE PIHUAVE','MIA MISHELLE','Masculino', '2'],
				['1234567890','QUINTO CHILAN','CAMILA NOELIA','Masculino', '2'],
				['1234567890','RAMIREZ BRICEÑO','DIEGO JOSE','Masculino', '2'],
				['1234567890','REYES BAQUE','LIANA THAISZ','Masculino', '2'],
				['1234567890','RIZO TORRES','LEANDRO MATHIAS','Masculino', '2'],
				['1234567890','RUIZ FRANCO','ROSE VALENTINA','Masculino', '2'],
				['1234567890','SANCHEZ QUISPE','IRIS MARICELA','Masculino', '2'],
				['1234567890','SANCHEZ RODRIGUEZ','VALESKA BRIGGITTE','Masculino', '2'],
				['1234567890','SANTANA SANTISTEVAN','SANTIAGO MATHIAS','Masculino', '2'],
				['1234567890','SANTANNA PINELA','JORGE ALEJANDRO','Masculino', '2'],
				['1234567890','SORNOZA ALVARADO','DERECK LIAM','Masculino', '2'],
				['1234567890','TAGLE GANCHOZO','JOHAN PATRICIO','Masculino', '2'],
				['1234567890','TORRES CASTRO','ELIZABETH STEFANIA','Masculino', '2'],
				['1234567890','VEGA ROLDAN','JOHAN SEBASTIAN','Masculino', '2'],
				['1234567890','ZAMBRANO GARCES','OLINDA NOEMI','Masculino', '2'],
				['1234567890','ZUÑIGA FLORES','ASHLEY JORDANNA','Masculino', '2']

		);
		$role = Sentinel::findRoleByName('Estudiante');
        foreach ($students as $key) {
        	echo $key[0].'  '.$key[1].' '.$key[2];
        	//echo '           ';

        	$student = new Student2();
        	$student->ci = $key[0];
        	$student->nombres = $key[2];
        	$student->apellidos = $key[1];
        	$student->sexo = $key[3];
        	$student->fechaNacimiento = '2010-01-02';
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	//
        	$student->matricula = 'Ordinaria';
        	$student->numeroMatricula  = $student->id;
        	$student->idCurso = $key[4];
			if ($key[4]==2){ $student->seccion = 'EGB';}elseif($key[4]==1){$student->seccion = 'EI';}
			
        	//
        	$student->idPeriodo = 1;
        	$student->retirado= 'NO';
        	
        	// Se guarda el número de la matricula con la configuración general
        	$cont = Student2::all()->where('matricula', '!=','Pre Matricula')->count(); 
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
        	$student->numeroMatricula = $fecha."-".sprintf("%04d", $cont+1);;
        	$student->save();
            //Se guarda el estudiante
        	echo '__'.$student->id.'     ';
		}*/
		

		
        $students2 = Student2::all();
        foreach($students2 as $student){
			
            // Conversión y extracción del primer nombre y primer apellido
            $nombres = explode(" ", $student->nombres);
            $apellidos = explode(" ", $student->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);

            $user_sentinel = [
            			'email'	=>	$primerNombre.'.'.$primerApellido.$student->id."@pined.com",
            			'password'	=>	"12345"
							];
			$error = User::where('correo',$user_sentinel)->get();
			if ($error->isEmpty()){
				$user= Sentinel::registerAndActivate($user_sentinel);
            // Registra el rol de los usuarios 
            $role= Sentinel::findRoleByName("Estudiante");
            $role->users()->attach($user);
            $idProfile = DB::table('users_profile')
                ->insertGetId([
                    'ci'	        =>	$student->ci,	
                    'nombres'	    =>	$student->nombres,
                    'apellidos'	    =>	$student->apellidos,
                    'sexo'	        =>	$student->sexo,
                    'fNacimiento'	=>	$student->fechaNacimiento,
                    'correo'	    =>  $primerNombre.'.'.$primerApellido.$student->id."@pined.com",
                    'dDomicilio'	=>	$student->dDomicilio,
                    'tDomicilio'	=>	$student->tDomicilio,
                    'cargo'	        =>	"Estudiante",	
                    'userid'        =>  $user->id,
                    'created_at'	=>	date("Y-m-d H:i:s"),
                ]);
            $student->idProfile = $idProfile;

			$student->save();
			}
        }


    }
}
