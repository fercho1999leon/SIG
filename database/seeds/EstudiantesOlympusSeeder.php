<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\AsistenciaParcial;
use App\Fechas;
use App\Student2Profile;
use Illuminate\Support\Facades\DB;

class EstudiantesOlympusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $students = array(


            // PRIMERO BACHILLERATO UNIFICADO

            ['DIAZ CASTRO','DIEGO SEBASTIAN','1'],
            ['ESCOBAR RIOS','PAULA VALERIA','1'],
            ['MACAS JIMENEZ','DAVID ALEJANDRO','1'],
            ['MASACELA TINGO','DANA ESCOLIN','1'],
            ['MATA PRADO','JORGE ALBERTO','1'],
            ['MEJIA JIMENEZ','JENNIFER YANELA','1'],
            ['MORETA GARCIA','JUSTIN EMILIANO','1'],
            ['RUIZ BERMUDEZ','MIRKA BELEN','1'],
            ['SILVA MENDOZA','YOSELYN JASMIN','1'],


            // DECIMO A

            ['JARA SILVA','CHRISTIAN ENRIQUE','2'],
            ['PORRO CASTRO','KIARA NICOLLE','2'],
            ['ROMERO INDACOCHEA','DANIELA ESTHER','2'],


            // NOVENO A

            ['ARTEAGA BURGOS','MARIA FERNANDA','3'],
            ['CAMBA CHIRIGUAYA','MICHELLE ESTEPHANIA','3'],
            ['CEDEÑO TORRES','FREDDY ALEXIS','3'],
            ['ESCOBAR BARRIGA','ESTEBAN JOEL','3'],
            ['GARCIA ACOSTA','ARANTXA ALEJANDRA','3'],
            ['LASSO LASSO','MARIA JOSÉ','3'],
            ['MASACELA TINGO','YDALI CATHERIN','3'],
            ['MEDINA HERAS','CARLOS RAUL','3'],
            ['MORA BETANCOURTH','MATIAS ALEJANDRO','3'],
            ['MOREIRA VITE','JOSE ALEJANDRO','3'],
            ['ORTIZ MARIN','PEDRO ISAIAS','3'],
            ['PICO SANDOVAL','DOMENICA DENNISSE','3'],
            ['PLAZA ANDRADE','DIEGO ISAAC','3'],
            ['VALVERDE RON','NADIA ESTEPHANI','3'],


            // OCTAVO A

            ['BARAHONA CANALES','ENARDO ANDRES','4'],
            ['CARRASCO PLAZA','EDU SANTIAGO','4'],
            ['CEDEÑO SABANDO','MATEO JOSE','4'],
            ['DUARTE CORENA','HANNYER JOSE','4'],
            ['IDROVO SUAREZ','VALERY VALEZKA','4'],
            ['LOPEZ ALVAREZ','ADRIANA NATALIA','4'],
            ['MEJIA JIMENEZ','MARCO VICNICIO','4'],
            ['MOREIRA VITE','VALERIA ESTEFANIA','4'],
            ['VANEGAS SALTOS','SCARLETT ANLLELY','4'],
            ['CHAVEZ CARANQUI','AMY','4'],


            // SEPTIMO A

            ['BENAVIDEZ LOPEZ','DANIEL','5'],
            ['CAMBA CHIRIGUAYA','STEVEN GUILLERMO','5'],
            ['CAMBA JARRIN','MATTHEW ALEJANDRO','5'],
            ['DIAZ MIRANDA','ADRIAN ALESSANDRO','5'],
            ['DUARTE CORENA','HAYDDER KALETH','5'],
            ['GUTIERREZ PARRA','DANIEL ALEJANDRO','5'],
            ['IDROVO LINDAO','JOSE DAVID','5'],
            ['LUZURIAGA BAQUE','PAULA ODETH','5'],
            ['MACAS JIMENEZ','DAYANA ISABEL','5'],
            ['MONTOYA YAGUAL','ABEL','5'],
            ['MORA BETANCOURTH','CLARA EMILIA','5'],
            ['OLVERA BLANCA','MIA ALEXIA','5'],
            ['RUIZ  BERMUDEZ','ROBINSON FABIAN','5'],
            ['TRIGUERO DIAZ','VALERY IA','5'],
            ['URIARTE HERNANDEZ','FABRICIO','5'],
            ['VALVERDE RON','ANTONY JEAN','5'],
            

            // SEXTO A

            ['CEPEDA FLORES','ABIMAEL JARID','6'],
            ['ESCOBAR  BARRIGA','JEFFERY SANTIAGO','6'],
            ['ESCOBAR RIOS','ISABEL DOMENICA','6'],
            ['FIGUEROA VERA','MARIO MARTIN','6'],
            ['NUÑEZ SAAVEDRA','JUAN PABLO','6'],
            ['PALMA MORAN','MANUEL ANTONIO','6'],
            ['PLUA VELASQUEZ','DANTE ALEMBERT','6'],
            ['QUITIO MORA','MAYLEEN NOEMI','6'],
            ['VACA RUIZ','EMILY ABIGAIL','6'],
            ['ZAMBRANO CASTAÑEDA','JEREMY SAMUEL','6'],
            
            
            // QUINTO A

            ['BRAVO VITE','LISA SOFIA','7'],
            ['BURGOS RIVERA','ALEJANDRO FERNANDO','7'],
            ['CASTRO ORTEGA','KEVIN JAHIR','7'],
            ['CHIRIGUAYA RUIZ','ASHLEY NICOLE','7'],
            ['MASACELA TINGO','ANGEL MATEO','7'],
            ['PINTAG MOROCHO','WILLIAN MATIAS','7'],
            ['CHAVEZ CARANQUI','ERICK','7'],
            
            
            // CUARTO A

            ['ALVAREZ CAMPOZANO','VALENTINA DANIELA','8'],
            ['BAILON LIMA','DAIAN','8'],
            ['CEDEÑO MOREIRA','AMELIA CAMILA','8'],
            ['COBOS LAVAYEN','JOSUE DAVID','8'],
            ['DIAZ CASTRO','CAMILA ABIGAIL','8'],
            ['DIAZ MIRANDA','SEBASTIAN MATEO','8'],
            ['FERNANDEZ TACURI','EDUARDO JHALIP','8'],
            ['HERRERA VERA','MARIA JOSE','8'],
            ['HIDALGO DIMITRAKIS','JORGE ABRAHAM','8'],
            ['LOPEZ ALVAREZ','MARIA DEL CARMEN','8'],
            ['MATAMOROS JERVIS','VALENTINA MERCEDES','8'],
            ['OBANDO ZAMBRANO','FRANKLIN ALEJANDRO','8'],
            ['ORTIZ AYALA','MATHIAS ADRIAN','8'],
            ['PINTAG MOROCHO','KRISTEL ANGELICA','8'],
            ['TORRES GOMEZ','JOSUE RAFAEL','8'],
            ['TROYA PINCAY','ADRIAN ISAIAS','8'],
            ['ZAVALA UNAMUNO','CAMILA ANDREA','8'],


            // TERCERO A

            ['ACOSTA MATA','ARIANNA SOFIA','9'],
            ['ALMIÑA GOMEZ','AILEEN FRANCESCA','9'],
            ['BEJARANO TITUAÑA','MATWEW PAUL','9'],
            ['BENAVIDES MEZA','RONALD ALEJANDRO','9'],
            ['CEVALLOS VASQUEZ','CHISTIAN EZEQUIEL','9'],
            ['CRUZ VALLEJO','DOMENIK JOHAN','9'],
            ['FERNANDEZ CUNDURI','FRANK ADRIANO','9'],
            ['FIGUEROA VERA','KIARA YULIET','9'],
            ['GARCIA PALADINES','FABRICIO ALEXANDER','9'],
            ['HIDALGO RUIZ','MATEO LEONEL','9'],
            ['LANDIRES VEGA','ROBERTA VALENTINA','9'],
            ['LEON ORTEGA','DAMIAN JAVIER','9'],
            ['MUNERA CARRIZO','JOSUE ALEJANDRO','9'],
            ['PLAZA PARRA','NAZRI BENJAMIN','9'],
            ['TORRES POTES','FERNANDA VALESKA','9'],
            ['UBIDIA TUAREZ','MATHIAS ANDRES','9'],
            ['VALLEJO CAMPOVERDE','MARÍA EMILIA','9'],
            ['ZAMBRANO CASTAÑEDA','DANNA PAOLA','9'],
            

            // SEGUNDO A

            ['ALAY ROMERO','ERWIN MATHEWS','10'],
            ['ARTEAGA BURGOS','WILSON JESUS','10'],
            ['BUENDIA SUAREZ','ISABELLA ALEJANDRA','10'],
            ['CHIRIGUAYA RUIZ','AILYN ARIANNA','10'],
            ['ESPINOZA LINARES','ELVIS RAFAEL','10'],
            ['GARAY CEVALLOS','GLORIA','10'],
            ['GUADAMUD BAZURTO','BRITHANY ADRIANA','10'],
            ['LASSO LASSO','SURY SHARLOTTE','10'],
            ['MATAMOROS MUÑIZ','JOSE ESTEBAN','10'],
            ['MENOSCAL DOMINGUEZ','DANNA AYLIN','10'],
            ['OBANDO ZAMBRANO','VALERIA MADELINE','10'],
            ['ORTIZ VILLACRES','JUAN MATHIAS','10'],
            ['PANCHANA GUEBLA','BRITTANY FRANCHESCA','10'],
            ['PAUTA RONQUILLO','LEONARDO DAVID','10'],
            ['PINCAY GONZALEZ','RAPHAELLA ALEJANDRA','10'],
            ['PLUA CHOEZ','ASHLEY SCARLETH','10'],
            ['SILVA MANZANO','SAMANTHA SCARLETT','10'],
            ['TROYA PINCAY','DIEGO NICOLAS','10'],
            

            // PRIMERO A

            ['ANDRADE PALADINES','AXEL ENRIQUE','11'],
            ['BAILON ROCAFUERTE','IRIS LUCIANA','11'],
            ['BERRIO FUENTES','JUAN SALVADOR','11'],
            ['CARCAMO MORALES','ANTHONY GADIEL','11'],
            ['GARAY VALDEZ','LUIZ MIGUEL','11'],
            ['MENDIETA FLORES','ANGELINA ROMY','11'],
            ['MUÑIZ BAZURTO','FRANKLIN JAVIER','11'],
            ['NOBOA ALVARADO','ARIANNA FRANCESCA','11'],
            ['ORTIZ VILLACRES','ISAIAS CRISTIAN','11'],
            ['PERALTA CEBALLOS','JOSÉ LUIS','11'],
            ['PONGUILLO ORTIZ','LESLIE NAHOMY','11'],
            ['POVEDA CAMACHO','BRIANA BELEN','11'],
            ['RIOS RODRIGUEZ','ISABELLA SUSETH','11'],
            ['SEGARRA FREIRE','ANA VALESKA','11'],
            ['TAPIA ARRIAGA','CAMILA YAMILET','11'],
            ['VALLEJO CAMPOVERDE','SEBASTIÁN FERNANDO','11'],
            ['VELASCO GARCIA','GUIDO DANIEL','11'],
            ['VILLACRES ENDARA','BRUNO SEBASTIAN','11'],
            

            // INICIAL 2

            ['BAILON LIMA','VICTOR','12'],
            ['BRAVO VILLACIS','ANDERSON','12'],
            ['CASTRO REYES','JUAN DIEGO','12'],
            ['CEDEÑO MOREIRA','XIMENA AGUSTINA','12'],
            ['IBARRA ESPINOZA','RAFAELA IRINA','12'],
            ['JIMENEZ BRAVO','AMELIA RAQUEL','12'],
            ['MORAN CHANALATA','ALHELI DAIARA','12'],
            ['ORTIZ MARIN','LIAN','12'],
            ['PINCAY GONZALEZ','AGUSTINA','12'],
            ['POVEDA CAMACHO','DIEGO THIAGO','12'],
            ['SEGARRA FREIRE','MANUEL ANTONIO','12'],
            ['VACA ITURRALDE','AMELIA LUCÍA','12'],
            

            // INICIAL 1

            ['CAMBA CHIRIGUAYA','NAOMI SCARLETT','13'],
            ['CORNEJO MOREANO','DALIA ALEJANDRA','13'],
            ['FARIAS MUÑOZ','VALENTINA','13'],
            ['GARAY VALDEZ','DANNA FIORELLA','13'],
            ['GUIJARRO FERNANDEZ','LUCIANO EDUARDO','13'],
            ['GUZÑAY ROJAS','BENYAMIN KENNETH','13'],
            ['MEDINA COVEÑA','ARIANNA MARTHINA','13'],
            ['MENDIETA FLORES','ISAIAS BENJAMIN','13'],
            ['MENOSCAL DOMINGUEZ','YANIZ ISABELLA','13'],
            ['OBANDO ZAMBRANO','AUDREY AMELIA','13'],
            ['PARDO MURILLO','DAVID ELIECER','13'],
            ['PINCAY CALDERON','NATALIA ISABELLA','13'],
            ['SANZ PEÑAFIEL','MARIA VICTORIA','13'],
            ['TROYA PINCAY','VALENTINA ISABEL','13'],
            
        );


		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
        	$student->ci = '0123456789';
        	$student->nombres = $key[1];
        	$student->apellidos = $key[0];
        	$student->sexo = 'Masculino';
        	$student->fechaNacimiento = '01-01-2000';
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	$student->matricula = 'Ordinaria';
            $student->idCurso = $key[2];
            
            //SE GUARDA LA SECCION DEPENDIENDO DEL CURSO
			if ($key[2]>11){               $student->seccion = 'EI';			}
			if ($key[2]>1 && $key[2]<12){  $student->seccion = 'EGB';			}
			if ($key[2]=1){                $student->seccion = 'BGU';			}
			
        	$idPeriodo = 1;
        	$student->retirado= 'NO';

        	// Se guarda el número de la matricula con la configuración general
        	$cont = Student2::all()->where('matricula', '!=','Pre Matricula')->count(); 
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
        	$student->numeroMatricula = $fecha."-".sprintf("%04d", $cont+1);;
            $fechaMatricula = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now());
            $student->save();

            // SE GUARDA REGISTRO EN LA NUEVA TABLA ESTUDIANTE POR AÑO
            $dataProfile = Student2Profile::create([
                'fecha_matriculacion' => $fechaMatricula,
				'idCurso' => $student->idCurso,
                'idPeriodo' => $idPeriodo,
				'idStudent' => $student->id,
				'seccion' => $student->seccion,
				'tipo_matricula' => $student->matricula,
				'ciudad_domicilio' => $student->ciudad,
				'direccion_domicilio' => $student->direccion,
				'retirado' => 'NO',
            ]);
            $this->creacionDeAsistenciaParcial($dataProfile->id, $idPeriodo);
            
            //Se guarda el estudiante
            $dataProfile->save();
        	echo '__'.$student->id.'     ';
		}

		$students2 = Student2::all();
		foreach($students2 as $student){
			
            // Conversión y extracción del primer nombre y primer apellido
            $nombres = explode(" ", $student->nombres);
            $apellidos = explode(" ", $student->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);

            $user_sentinel = [
            			'email'	=>	$primerNombre.'.'.$primerApellido.$student->id."@pined.ec",
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
                        'correo'	    =>  $primerNombre.'.'.$primerApellido.$student->id."@pined.ec",
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
        DB::commit();
    }
    public function creacionDeAsistenciaParcial($idStudent, $idPeriodo) {
		$parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
		foreach ($parciales as $parcial) {
			AsistenciaParcial::create([
				'idStudent' => $idStudent,
				'parcial' => $parcial,
				'idPeriodo' => $idPeriodo,
			]);
		}
	}
}
