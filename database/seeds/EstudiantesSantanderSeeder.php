<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class EstudiantesSantanderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = array(
        	/*Secundaria*/
				array('0958577959','ALCIVAR QUIJIJE','MARIA JOSÉ','Femenino','1'), 
				array('2300080013','ANDRADE BARRE','VANESSA ALEXANDRA','Femenino','1'),
				array('1207649060','BEJARANO SANTANDER','REYNALDO ARTURO','Masculino','1'),
				array('0915370704','BRAVO CEDEÑO','CARMEN ALEXANDRA','Femenino','1'),
				array('0923477665','BRAVO TAPIA','EDUARDO ANDRES','Masculino','1'),
				array('0922431309','CASTRO BAZAN','OSCAR OMAR','Masculino','1'),
				array('0954082384','CRESPIN CHILA','JOSEPH ALEXANDER','Masculino','1'),
				array('0918284340','CRUZ ZAMORA','MISAEL IGNACIO','Masculino','1'),
				array('0930783220','CUERO LADINES','JHON FAVIO','Masculino','1'),
				array('1205481565','FLORES ORTIZ','GINGER ROMINA','Femenino','1'),
				array('0916450034','GARCIA GUARANDA','JUAN CARLOS','Masculino','1'),
				array('1126565543','GOMEZ ZULUAGA','ESTEFANIA','Femenino','1'),
				array('1304749243','INTRIAGO NAVIA','HENRY EMILIO','Masculino','1'),
				array('0922820493','LUCAS PINARGOTE','PABLO ALBERTO','Masculino','1'),
				array('0916788862','MIRANDA RAMIREZ','JOSE WILIAM','Masculino','1'),
				array('1102035118','NARVAEZ RODRIGUEZ','JUAN CARLOS','Masculino','1'),
				array('1309180386','PIN VELEZ','TERESA DEL PILAR','Masculino','1'),
				array('0926091687','PINCAY PEREZ','ADRIAN ALEXI','Masculino','1'),
				array('0911585362','QUIÑONEZ CAICEDO','EUCLIDES FIDEL','Masculino','1'),
				array('0924032980','SALAZAR ZAPATA','DIEGO FRANCISCO','Masculino','1'),
				array('0916182736','TELLO MENDEZ','BYRON GUILLERMO','Masculino','1'),
				array('1718977786','VASQUEZ VERA','KATHERIN DANIELA','Femenino','1'),
				array('0918444787','VILLA POMA','TANIA MARIA','Femenino','1'),
				array('0916416696','VILLA POMA','TANYA MERCEDES','Femenino','1'),
				array('1308405776','VILLAVICENCIO','BRAVO CARLOS NERY','Masculino','1'),
				array('0922635156','ZAMBRANO ASENCIO','RAFAEL FERNANDO','Masculino','1'),
				array('0927785063','ZAMBRANO LOMBEIDA','FAUSTO ENRIQUE','Masculino','1'),
			/*Primero de Bachillerato*/
				array('0950898221','ALARCON CEDEÑO','CARLOS ALFREDO','Masculino','2'),
				array('0920661824','GALLEGOS SARANGO','JORGE DANIEL','Masculino','2'),
				array('1312758574','MARCILLO CLAVIJO','MAIRA PATRICIA','Femenino','2'),
				array('0951584390','MENENDEZ GOYES','ADRIAN XAVIER','Masculino','2'),
				array('0917009235','MOREIRA CANDO','XAVIER AMADOR','Masculino','2'),
				array('1207614965','PEÑA HIDALGO','JOYSTICK STALIN','Masculino','2'),
				array('0952332286','RICAURTE DUMES','LUIS ANDRES','Masculino','2'),
				array('0931180707','RIZO CHANCAY','LUCIANA STEFANIA','Femenino','2'),
				array('0950061739','TRIVIÑO CAMPAZ','MARLON STEVEN','Masculino','2'),
				array('0950061762','TRIVIÑO CAMPAZ','RENE DANNER','Masculino','2'),
				array('0913332193','VERA LIMA','ALEX AGUSTIN','Masculino','2'),
				array('0950264465','VASQUEZ ABAD','JOSE EDUARDO','Masculino','2'),
			/*Segundo de Bachillerato*/
				array('0940193261','ALCIVAR LOZANO','MARIO ENRIQUE','Masculino','3'),
				array('1724866874','CEDEÑO RIVAS','ELVIS JAVIER','Masculino','3'),
				array('0915216188','ESPINOZA PEÑAFIEL','ENRIQUE RONALD','Masculino','3'),
				array('0917332264','GALARZA HERRERA','EVELIN PILAR','Femenino','3'),
				array('0978834537','LEON FRANCO','JHONNY OSWALDO','Masculino','3'),
				array('1311156846','MARIN VALDEZ','JOSUE DAVID','Masculino','3'),
				array('1311163560','MARIN VALDEZ','JACINTO DAMIAN','Masculino','3'),
				array('0987572781','MACIAS COBEÑA','JEFFERSON EDUARDO','Masculino','3'),
				array('0954734463','MACIAS COBEÑA','MANUEL EDUARDO','Masculino','3'),
				array('0920422854','LUNA FLORES','TATIANA DEL ROCIO','Femenino','3'),
				array('0702109653','ROMERO GONZAGA','ANA MIRIAN','Femenino','3'),
				array('0801708876','SIMISTERRA','ROSERO MELLER','Masculino','3'),
				array('1310590284','VERA VERA','MIGUEL ANGEL','Masculino','3'),
				array('0955113444','VILLACIS','INTRIAGO GIANLUCA PAOLO','Masculino','3'),
			/*Tercero de Bachillerato*/
				array('0918383209','DILLON MOLINA','BELGICA MABEL','Femenino','4'),
				array('0928058650','FRANCO VERA','ROSA YOLANDA','Femenino','4'),
				array('0957823032','GAZOLA ESTRELLA','GENESIS NICOLE','Femenino','4'),
				array('0930158977','PINARGOTE VASQUEZ','SULLY MICHELL','Femenino','4'),
				array('0920007143','SANCHEZ RODRIGUEZ','CHRISTIAN VALDEMAR','Masculino','4'),
				array('0952531929','TACURI ARTEAGA','BILLY JULIAN','Masculino','4'),
        );
	
		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key) {
		    $student = new Student2();
		        $student->ci = $key[0];
		        $student->nombres = $key[2];
		        $student->apellidos = $key[1];

		        $student->sexo = $key[3];
		        $student->fechaNacimiento = '1999-01-01';
		        $student->ciudad = 'GUAYAQUIL';
		        $student->direccion = 'GUAYAQUIL';
		        	//
		        $student->matricula = 'Ordinaria';
		        $student->numeroMatricula  = $student->id;
		        $student->idCurso = $key[4];
		        if($key[4]=='1'){
		        	$student->seccion = 'EGB';
		        }else{
		        	$student->seccion = 'BGU';
		        }
		        $student->idPeriodo = 1;
		        $student->retirado= 'NO';
		        	
		        // Se guarda el número de la matricula con la configuración general
		        $cont = Student2::all()->where('matricula', '!=','Pre Matricula')->count(); 
		        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
		        $student->numeroMatricula = $fecha."-".sprintf("%04d", $cont+1);;
		        $student->save();
		            //Se guarda el estudiante
		        echo '__'.$student->id.'     ';
		}
		$students = Student2::all();
        foreach($students as $student){
            // Conversión y extracción del primer nombre y primer apellido
            $nombres = explode(" ", $student->nombres);
            $apellidos = explode(" ", $student->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);

            $user_sentinel = [
            					'email'		=>	$primerNombre.'.'.$primerApellido."@uesantander.edu.ec",
            					'password'	=>	$student->ci
            				];
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
                    'correo'	    =>  $primerNombre.'.'.$primerApellido."@uesantander.edu.ec",
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
