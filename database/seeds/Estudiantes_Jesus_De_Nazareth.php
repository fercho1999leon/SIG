<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class Estudiantes_Jesus_De_Nazareth extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	$students = array(
	        //INICIAL 2:::1

			//PRIMERO:::2

			//SEGUNDO:::3
				['1234567890','ACOSTA RAMIREZ','ASTRID GABRIELA','Femenino', '3'],
				['1234567890','ALARCON QUINTERO','ALAN ESTEBAN','Masculino', '3'],
				['1234567890','BARAHONA ALVARADO','DARLIN ANALY','Masculino', '3'],
				['1234567890','CABRERA LAURIDO','JAIDEN AKEMI','Masculino', '3'],
				['1234567890','CABRERA PARRAGA','GABRIEL MOISES','Masculino', '3'],
				['1234567890','CABRERA VERA',' ESTHER ZHARICK','Femenino', '3'],
				['1234567890','CALDERON RAMOS','ASHLEY VALENTINA','Femenino', '3'],
				['1234567890','CASTRO GARCIA','EDWIN STALIN','Masculino', '3'],
				['1234567890','CEBALLOS CORREA','HELIANNY MILAGROS','Femenino', '3'],
				['1234567890','CHAVARRIA ALARCON','ADRIAN  EVERTH','Masculino', '3'],
				['1234567890','CISNEROS IBARRA','MANUEL ARTURO','Masculino', '3'],
				['1234567890','GARCIA MEDINA','EMILIO ISAAC','Masculino', '3'],
				['1234567890','HEREDERO DELGADO','JULIA ELIZABETH','Femenino', '3'],
				['1234567890','JARAMILLO MERA','KENDRA NINOSKA','Femenino', '3'],
				['1234567890','JARAMILLO RAMON','MAITE DAYANNA','Femenino', '3'],
				['1234567890','LA ROSA PAZMIÑO','ARLETH ODALYS','Femenino', '3'],
				['1234567890','MACIAS FARIAS','DAYANARA MAYENSI','Femenino', '3'],
				['1234567890','MANYA ROVALINO','JHON SEBASTIAN','Masculino', '3'],
				['1234567890','MILLAN SUAREZ','CARMEN SAMANTHA','Femenino', '3'],
				['1234567890','MINA ESPINOZA','DIDIER ENRIQUE','Masculino', '3'],
				['1234567890','MORALES LOPEZ','JESUS ANTONIO','Masculino', '3'],
				['1234567890','MORAN NAPA','ISABEL DEL ROCIO','Femenino', '3'],
				['1234567890','MOREIRA SUAREZ','FIORELA MABEL','Femenino', '3'],
				['1234567890','NOGALES LOPEZ','ASHLEY KATHEINE','Femenino', '3'],
				['1234567890','PEREZ MOROCHO','LUIS ALEJANDRO','Masculino', '3'],
				['1234567890','PICO ROLDAN','MATHEW JULIAN','Masculino', '3'],
				['1234567890','PLAZA MERO','KENDRA BELEN','Femenino', '3'],
				['1234567890','PLUA MARTINEZ','WIDED NATASHA','Femenino', '3'],
				['1234567890','SAAVEDRA SEVERINO','AHIAS DANIEL','Masculino', '3'],
				['1234567890','SANCHEZ RAMIREZ','NAYDELIN ELIZABETH','Femenino', '3'],
				['1234567890','VASCONES ZAMORA','IKER ISAIAS','Masculino', '3'],
				['1234567890','ZAMBRANO MUÑOZ','EDUAR  ALEXANDER','Masculino', '3'],
				['1234567890','ZAMORA QUIRUMBAY','SHARELY ANAIS','Femenino', '3'],
				['1234567890','ZAVALA CHONG','DIDIER ALEXANDER','Masculino', '3'],
				['1234567890','ZEBALLOS DOMINGUEZ','JEREMIAS ERICK','Masculino', '3'],

			//TERCERO:::4
				['1234567890','ALVEAR CHALAN','KARLA EDITH','Femenino','4'],
				['1234567890','BAJAÑA SANCHEZ','ADRIANA JAHAYRA','Femenino','4'],
				['1234567890','BARRETO RUIZ','ANGIE ANAHI','Femenino','4'],
				['1234567890','BUENO MURILLO','SANTIAGO JOSE','Masculino','4'],
				['1234567890','CEDEÑO CRUZ','JOSTIN ALEXANDER','Masculino','4'],
				['1234567890','CEDEÑO VACA','MATIAS ISMAEL','Masculino','4'],
				['1234567890','CONTRERAS LOZADA','BILLY GABRIELLE','Femenino','4'],
				['1234567890','CRUZ MURILLO','HAYDEE CORAYMA','Femenino','4'],
				['1234567890','DUEÑA PEÑAFIEL','NAHOMI XIOMARA','Femenino','4'],
				['1234567890','EPINOZA BARRERA','EZEQUIEL ESAU','Masculino','4'],
				['1234567890','FARIAS LUCAS','KEYLA MONSERRATE','Femenino','4'],
				['1234567890','GARCIA ALVAREZ','DAYANARA JACQUELINE','Femenino','4'],
				['1234567890','GOMEZ HERNANDEZ','LUIS DANIEL','Masculino','4'],
				['1234567890','GONZALEZ PORRAS','DYLAN DIONICIO','Masculino','4'],
				['1234567890','HUACON MARURI','FIORELLA SAMANTHA','Femenino','4'],
				['1234567890','LETURNE FALCONI','BRIANA CAMILA','Femenino','4'],
				['1234567890','LINDAO MALAVE','CESAR ANTONIA','Masculino','4'],
				['1234567890','MERCHAN PILOSO','KARLA MAITHE','Femenino','4'],
				['1234567890','ORDOÑEZ CHAMAIDAN','ANDREW NEY','Masculino','4'],
				['1234567890','ORTIZ BURGOS','MELANIE NARCISA','Femenino','4'],
				['1234567890','PALACIO CEDEÑO','ADAM GAEL','Masculino','4'],
				['1234567890','PANCHANA VILEMA','ADRIAN JESÚS','Masculino','4'],
				['1234567890','PEÑAFIEL FIGUEROA','KAREN AILYN','Femenino','4'],
				['1234567890','REYES MERCHAN','MAYKEL EMANUEL','Masculino','4'],
				['1234567890','ROLDAN LOPEZ','LADY ELIZABETH','Femenino','4'],
				['1234567890','SANCHEZ RUDA','SAMANTHA LETIZIA','Femenino','4'],
				['1234567890','SOLIZ QUISHPE','BRITHANY JESSICA','Femenino','4'],
				['1234567890','SORIA MICHUY','JOFFRE MATEO','Masculino','4'],
				['1234567890','VICTORES PAREJA','KENIA VALERIA','Femenino','4'],
				['1234567890','VILLAMAR VILLÓN','OSCAR ANTONIO','Masculino','4'],
				['1234567890','VINCES RIVAS','LINDA BRIGITH','Femenino','4'],
				['1234567890','ZUÑIGA HERNANDEZ','MAELY AILY','Femenino','4'],

			//CUARTO:::5
				['1234567890','ARELLANO PALMA','DANNA SHIRLEY','Femenino','5'],
				['1234567890','BAQUERIZO BRIONES','LAYLA NAOMI','Femenino','5'],
				['1234567890','BERMUDEZ SAA','FRANCISCO ANTONIO','Masculino','5'],
				['1234567890','BOLAÑOS SALAVARRIA','JOSE ANDRES','Masculino','5'],
				['1234567890','BONILLA BAÑO','DANNY DOUGLAS','Masculino','5'],
				['1234567890','CABRERA LAURIDO','HUMBERTO SAMIR','Masculino','5'],
				['1234567890','CASTRO REYES','KEVIN ALFREDO','Masculino','5'],
				['1234567890','CHAVARRIA ALARCON','LEONELA DEL ROCIO','Femenino','5'],
				['1234567890','CISNEROS IBARRA','AURORA MARIA','Femenino','5'],
				['1234567890','FONG ESPINOZA','JADE BETHSABE','Femenino','5'],
				['1234567890','GALARZA ANCHUNDIA','DYLAN ARIEL','Masculino','5'],
				['1234567890','GOITIA GAVIDIA','JOSE ALBERTO','Masculino','5'],
				['1234567890','LICOA BENAVIDES','VICTORIA VALESKA','Femenino','5'],
				['1234567890','LLAPA RONQUILLO','BENJAMIN TIAGO','Masculino','5'],
				['1234567890','LUNA REINA','GABRIELA ARIANNA','Femenino','5'],
				['1234567890','MAYA ZUÑIGA','MAURA ANDREA','Femenino','5'],
				['1234567890','MURILLO RIASCO','JUSTIN EDUARDO','Masculino','5'],
				['1234567890','PEÑAFIEL SUAREZ','EDGAR JOSUE','Masculino','5'],
				['1234567890','POTES CALLE','MELANIE ABIGAIL','Femenino','5'],
				['1234567890','RUGEL GUERRERO','MAIKEL STIVEN','Masculino','5'],
				['1234567890','SANCHEZ QUIJIJE','JOSE LUIS','Masculino','5'],
				['1234567890','SANTANA PINELA','JANDRY ALEXANDER','Masculino','5'],
				['1234567890','TOMALA LEON','EZEQUIEL JEREMIAS','Masculino','5'],
				['1234567890','TOMALA LEON','ISMAEL JOSUE','Masculino','5'],
				['1234567890','VILLALVA JARAMILLO','FRANCISCO EFRAIN','Masculino','5'],
				['1234567890','VILLEGAS MARCILLO','CARLOS ANTONIO','Masculino','5'],

			//QUINTO:::6
				['1234567890','ALVAREZ CRUZ','LIAN JESUS','Masculino','6'],
				['1234567890','BOLAÑOS SALAVARRIA','DAYRA BELINDA','Femenino','6'],
				['1234567890','CADENA SUAREZ','ANTHONY ALESSANDRO','Masculino','6'],
				['1234567890','CASTRO GARCIA','ALLISON GABRIELA','Femenino','6'],
				['1234567890','CELI BAJAÑA','MIA MICHELLE','Femenino','6'],
				['1234567890','COELLO VILLAMAR','DARIO ISAAC','Masculino','6'],
				['1234567890','CRUZ QUITO','DIEGO SEBASTIAN','Masculino','6'],
				['1234567890','GALARZA ANCHUNDIA','JAMILETH ABRIL','Femenino','6'],
				['1234567890','ITURRALDE SUAREZ','LEONELA STEFANIA','Femenino','6'],
				['1234567890','LA ROSA PAZMIÑO','MIKE JARED','Masculino','6'],
				['1234567890','LETURNE FALCONI','BIANCA NATASHA','Femenino','6'],
				['1234567890','LINO QUINTO','VANIA ANAHI','Femenino','6'],
				['1234567890','NARANJO CEDEÑO','MIGUEL ANGEL','Masculino','6'],
				['1234567890','PANCHANA VILEMA','ABRAHAM ENRIQUE','Masculino','6'],
				['1234567890','PEÑAFIEL SALAZAR','ALISON DOMENICA','Femenino','6'],
				['1234567890','PEÑAFIEL VINCES','RICARDO ADRIAN','Masculino','6'],
				['1234567890','QUINDE ORTIZ','ANGEL JOSEPH','Masculino','6'],
				['1234567890','QUINTERO GUERRA','DEIVER ISAAC','Masculino','6'],
				['1234567890','REYES NAVARRETE','CARLOS JOSUE','Masculino','6'],
				['1234567890','RODRIGUEZ VELEZ','MATHIAS ALEJANDRO','Masculino','6'],
				['1234567890','RUGEL SOLORZANO','ALEX DAVID','Masculino','6'],
				['1234567890','TENECELA JARAMILLO','GABRIEL SEBASTIAN','Masculino','6'],
				['1234567890','TOMALA QUINTO','KEYLA ALEJANDRA','Femenino','6'],
				['1234567890','TOMALA ROSALES','MAITE FIORELLA','Femenino','6'],
				['1234567890','VILLALVA JARAMILLO','FRANCHESCA ISABELLA','Femenino','6'],
				['1234567890','VILLON RICHARD','MOISES SEBASTIAN','Masculino','6'],

			//SEXTO:::7
				['1234567890','ALARCON QUINTERO','NAYELI JULEXI','Femenino','7'],
				['1234567890','ALVAREZ CALLE','JEMIMA ILIANA','Femenino','7'],
				['1234567890','BRIONES CHANCAY','MACOLY MAIKY','Masculino','7'],
				['1234567890','CARPIO MORANTE','CARLOS DARIO','Masculino','7'],
				['1234567890','CHAPELLIN MURILLO','DIEGO JESUS','Masculino','7'],
				['1234567890','COLMENAREZ GRANADOS','JOSE DAVID','Masculino','7'],
				['1234567890','CRUZ MERA','NAOMI LISSETH','Femenino','7'],
				['1234567890','FERNANDEZ TOMALA','JUAN DAVID','Masculino','7'],
				['1234567890','GUERRERO BLANCAS','SAUL JEREMIAS','Masculino','7'],
				['1234567890','JIMENEZ SAILEMA','MARÍA FERNANDA','Femenino','7'],
				['1234567890','LINDAO MALAVE','SEBASTIAN STEVEN','Masculino','7'],
				['1234567890','LINO QUINTO','ADRIANA VALESKA','Femenino','7'],
				['1234567890','LLAPA RONQUILLO','DAVID EMANUEL','Masculino','7'],
				['1234567890','MARCILLO RIVADENEIRA','MATIAS ALBERTO','Masculino','7'],
				['1234567890','NAPUD SALAZAR','LUZ SCARLETT','Femenino','7'],
				['1234567890','PAZMIÑO SOLORZANO','NESLIER JOHAO','Masculino','7'],
				['1234567890','PORRAS QUIÑONEZ','ADRIAN JOSUA','Masculino','7'],
				['1234567890','QUEZADA RAMIREZ','CHARLOTTE MILENE','Femenino','7'],
				['1234567890','RODRIGUEZ SAILEMA','DYLAN ALEXANDER','Masculino','7'],
				['1234567890','RODRIGUEZ VELEZ','CAMILA PAULETTE','Femenino','7'],
				['1234567890','SORIA MICHUY','JEIMMY STEFANIA','Masculino','7'],
				['1234567890','TOMALA LEON','MILCA ABIGAIL','Femenino','7'],
				['1234567890','TORRES VEGA','JENNIFER VALERIA','Femenino','7'],
				['1234567890','VELIZ DEL SALTO','IDRIS DAMARIS','Femenino','7'],
				['1234567890','ZAMBRANO SOLIS','SCARLET VALENTINA','Femenino','7'],
				['1234567890','ZAMORA CAMPOVERDE','EMMANUEL JUSTIN','Masculino','7'],
				['1234567890','ZAVALA BASTIDAS','EDISON JESSID','Masculino','7'],

			//SEPTIMO:::8
				['1234567890','ARELLANO PALMA','ANGELO BLAS','Masculino','8'],
				['1234567890','BRIONES MERCHAN','STHEFANIA CAROLINA','Femenino','8'],
				['1234567890','CABELLO GUARIMATA','ORIANA MICHELL','Femenino','8'],
				['1234567890','CABEZA CHERE','JORDAN EZEQUIEL','Masculino','8'],
				['1234567890','CELI BAJAÑA','JESSIEL JAZIRY','Masculino','8'],
				['1234567890','CELI BAJAÑA','JHOJAN JOSUE','Masculino','8'],
				['1234567890','CERCADO VERA','NICOLAS JEREMIAS','Masculino','8'],
				['1234567890','CHONG LOOR','WILLIAN SAUL','Masculino','8'],
				['1234567890','CORREA ESTRADA','MARIANA ALEJANDRA','Femenino','8'],
				['1234567890','CORREA ESTRADA','MARIANNI MILAGROS','Femenino','8'],
				['1234567890','CRUZ VASCONE','DAHILY EDITA','Femenino','8'],
				['1234567890','DELGADO BORBOR','JEREMY SEBASTIAN','Masculino','8'],
				['1234567890','FONG ESPINOZA','LIA ODETH','Femenino','8'],
				['1234567890','GARCIA ALVAREZ','YUREN OMAR','Masculino','8'],
				['1234567890','LARROSA VILLEGAS','XAVIER ALFONSO','Masculino','8'],
				['1234567890','LOOR ALCIVAR','SCARLETH MELANY','Femenino','8'],
				['1234567890','MAYA ZUÑIGA','JORGE LUIS','Masculino','8'],
				['1234567890','MERA SANTANA','LIMBER ALEXIS','Masculino','8'],
				['1234567890','MORA SAILEMA','ISAAC STALYN','Masculino','8'],
				['1234567890','MORA SAILEMA','JOSE ABRAHAM','Masculino','8'],
				['1234567890','MORAN NAPA','ROLANDO ALEXANDER','Masculino','8'],
				['1234567890','MORAN SATAN','MAYKEL DAVID','Masculino','8'],
				['1234567890','PEREZ LOPEZ','ANDREA ESTEFANIA','Femenino','8'],
				['1234567890','PINARGOTE CEDEÑO','ANDREA TAIS','Femenino','8'],
				['1234567890','QUINTO CALDERÓN','VALERIA FIORELLA','Femenino','8'],
				['1234567890','RIZZO SANTOS','JUSTIN JOSEPH','Masculino','8'],
				['1234567890','SANTANA MAYEA','JARLINE ELIZABETH','Femenino','8'],
				['1234567890','SUAREZ CEDEÑO','STEFFANY NAYESKA','Femenino','8'],
				['1234567890','TAGLE RUIZ','KERLY MARIELA','Femenino','8'],
				['1234567890','TORRES CASTRO','ANGEL STEVEN','Masculino','8'],
				['1234567890','VILLON PLACENCIO','NOELIA ALEJANDRA','Femenino','8'],
				['1234567890','ZAMORA CAMPOVERDE','JOVANNA SAMANTHA','Femenino','8']
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
        	$student->seccion = 'EGB';
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
        }
		


        $students = Student2::all();
        foreach($students as $student){
            // Conversión y extracción del primer nombre y primer apellido
            $nombres = explode(" ", $student->nombres);
            $apellidos = explode(" ", $student->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);

            $user_sentinel = [
            					'email'	=>	$primerNombre.'.'.$primerApellido.$student->id."@pined.com",
            					'password'	=>	"12345"
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
