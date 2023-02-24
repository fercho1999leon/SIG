<?php

use Illuminate\Database\Seeder;
use App\Student2;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use Carbon\Carbon;
use App\PeriodoLectivo;
use App\Student2Profile;
use App\Fechas;
use App\Course;
use Faker\Factory as Faker;

class EstudiantesDisenosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = array(



            // SEGUNDO A

            ['0956482160','REBECA SOFIA','CUADRADO LADINES','4'],
            ['0123456789','ARANZA VICTORIA','SILVA ISEAS','4'],
            ['0932454051','REBECA FABIANA','ZAMBRANO ORTIZ','4'],
            ['0123456789','FERNANDA MIA','BAQUE MARMOL','4'],
            ['0957600356','BRUNO ALEJANDRO','CALLE CRUZ','4'],
            ['0123456789','ELIS LUICIANO','BARRETO MOREIRA','4'],
            ['0956739858','AYLEEN ISABEL','MARTINEZ LATORRE','4'],
            ['0932185200','BOLIVAR ERNESTO','TORRES MENA','4'],
            ['1351133796','SANTHIAGO','CHAVEZ BAZURTO','4'],
            ['0961021607','DOUGLASS NICOLAS','CASTELLO MORALES','4'],
            ['0959070244','STEFANO ENRIQUE','AGUIRRE SANCHEZ','4'],
            ['0123456789','THIAGO ALESSANDRO','BRAVO VELEZ','4'],
            ['0932468515','BADIH FERES','HARB SEVERINO','4'],
            ['0932468531','SAID FERNANDO','HARB SEVERINO','4'],
            ['0932525280','MATEO ALEJANDRO','PASPUEL FERNANDEZ','4'],
            ['0958942880','DANIEL','GARCIA CASSANELLO','4'],

            
            // TERCERO A

            ['1350947188','CARLES EDUARDO','HIDALGO PINARGOTE','5'],
            ['0955927173','EMILIA VALENTINA','AGUIRRE ALCIVAR','5'],
            ['0932033509','SAMUEL IGNACIO','CHIRIBOGA DERENZIN','5'],
            ['0954777926','KIARA LILIANA','VELASQUEZ CARREÑO','5'],
            ['0123456789','ANNA GARDENIA','LUNG GERMAN','5'],
            ['0932201221','LUISANA CAMILA','COBEÑA RODRIGUEZ','5'],
            ['0932394232','SEBASTIAN EMANUEL','GOYA MEDINA','5'],
            ['0123456789','DARIANA VALENTINA','SANCHEZ PAREDES','5'],
            ['0932355746','EMILIO ALEJANDRO','CLAVIJO DIAZ','5'],
            ['0956054456','ALESSANDRO ENRIQUE','VALVERDE VARGAS','5'],
            ['0932333131','HENRY DANIEL','CHAVEZ VERA','5'],
            ['0932248263','KRISTEN LIZBETH','RUIZ GARCIA','5'],
            ['0144904851','PAULA ISABEL','RODRIGUEZ GONZALEZ','5'],
            ['0956069199','GADIEL ISMAEL','BURBANO INTRIAGO','5'],
            ['0123456789','JOSE DAVID','QUIÑONEZ RENDON','5'],

            
            //CUARTO A

            ['0932006752','LUCIANO','CABELLO ROBLES','6'],
            ['0931922124','NATHANAEL GERARDO','RODRIGUEZ BAÑOS','6'],
            ['0931739791','SINGLIA GIOVANNA','PINTO SCOTT','6'],
            ['0932159932','VALERY KRISTHEL','TORRES LOOR','6'],
            ['0123456789','ALESSIO MAXIMILIANO','HERRERA ALCIVAR','6'],
            ['0123456789','DAVID SEBASTIAN','QUINTO JIMENEZ','6'],
            ['0932126105','FERNANDO SEBASTIAN','ICAZA VILLARROEL','6'],
            ['0950477919','ARIANNA PAULA','TENORIO PULIDO','6'],
            ['0123456789','SALVADOR ANTONIO','GUANIN BASURTO','6'],
            ['0954300422','SCARLETT ROCIO','VILLEGAS RIVADENEIRA','6'],
            ['0123456789','CARLOS DANIEL','VALENCIA GAIBOR','6'],
            ['0959221995','WILLIAN XAVIER','JACOME DOMINGUEZ','6'],

            
            // QUINTO A

            ['0952630028','EDGAR EMANUEL','TOMALA TOMALA','7'],
            ['0931636310','RAFAELA ALEJANDRA','CUADRADO LADINES','7'],
            ['0123456789','SANTIAGO DANIEL','RAMOS TEJADA','7'],
            ['0951210038','NATHANAEL JOSUE','TORRES PAREDES','7'],
            ['1317249249','MARIA VALENTINA','ALCIVAR ORMAZA','7'],
            ['0931819379','DAVID GABRIEL','MENDOZA TAMAYO','7'],
            ['0136929220','SOFIA DE LOS ANGELES','REQUENA OROPEZA','7'],
            ['0931820740','JOSEPH ISAAC','LEON SALCEDO','7'],
            ['0931797963','DANESSA SAMANTHA','RODRIGUEZ ALCIVAR','7'],
            ['0123456789','ALEJANDRO JOEL','TRIANA MEDINA','7'],
            ['0952390193','ARIEL DANIEL','CLAVIJO DIAZ','7'],
            ['0931847966','NAHOMI SCARLET','VALVERDE VARGAS','7'],
            ['0052541530','VALENTINA ASHLEY','COBEÑA ROBLES','7'],
            ['0931714745','AMY LUCIANA','LANDIVAR GALLEGOS','7'],
            ['0123456789','ISABELA SOFIA','FREIRE MORAN','7'],
            ['0123456789','CARLOS ANDRES','BRAVO VELEZ','7'],
            ['0123456789','DAVID ALEJANDRO','IZQUIETA GONZALEZ','7'],
            ['0931865901','MIA RAFAELLA','PALACIOS ROSADO','7'],

            
            // SEXTO A

            ['0095444170','IGNACIO','BASURTO CARRERA','8'],
            ['0123456789','DYLAN XAVIER','VELIZ CALOZZUMA','8'],
            ['0123456789','ROMINA LISSETTE','MOROCHO MOROCHO','8'],
            ['0123456789','DAYANA NICOLE','TORRES CHAVEZ','8'],
            ['0931403737','ALEX DANIEL','POZO MAYORGA','8'],
            ['0931591135','PAUL DAVID','CHAVEZ VERA','8'],
            ['0950877415','IVAN SAMUEL','BLASCHKE PROCEL','8'],
            ['0950839894','ANTHONY ANDRES','PAREDES KUFFO','8'],
            ['0123456789','NATALIA MARINA','RAMOS TEJADA','8'],
            ['0931383848','BRYAN ANDRES','ALBUJA MOREIRA','8'],
            ['0950472092','VICTOR ANDRES','CARDENAS RIVADENEIRA','8'],

            
            // SÉPTIMO A

            ['0932130545','MARCO EDUARDO','VALLEJO CHAMBA','9'],
            ['0931263743','ANGELICA','VERA REYES','9'],
            ['0943827485','FRANK ALEXANDER','JURADO ZAMBRANO','9'],
            ['0931359780','JOEY RICHARD','VIVAR BRAVO','9'],
            ['0916209307','MATIAS DAMIAN','VERA FRANCO','9'],
            ['0930922711','DIANA ISABEL','HOLGUIN YELA','9'],
            ['0930930433','JHON MATIAS','BAÑOS LOYOLA','9'],
            ['0954945606','ROGER DANIEL','RODRIGUEZ ALCIVAR','9'],
            ['0930971379','RAQUEL NOEMI','MARIN VITERI','9'],
            ['0930850821','EVELYN CARLEIGH','RODRIGUEZ BAÑOS','9'],
            ['0950877795','JULIO FRANCISCO','CHOEZ ARIAS','9'],
            ['0123456789','DANNY MICHAEL','RAAK QUIMIS','9'],

            
            // OCTAVO A

            ['0096196553','LISANDRO AARON','SILVA ISEAS','10'],
            ['0930734785','ANNETTE ALEXANDRA','TENORIO PULIDO','10'],
            ['0930849773','DOMENICA NICOLE','NARANJO PARRA','10'],
            ['0951356567','MATIAS ROBERTO','MACIAS VERGARA','10'],
            ['0957214471','BRAULIO ELIAS','GANDO CROW','10'],
            ['0123456789','SAID XAVIER','MANZUR VERA','10'],
            ['0955698899','NICK JOEL','SANCHEZ UBILLUS','10'],

            
            // NOVENO A

            ['0932534308','SAMUEL SEBASTIAN','LEON CALDERON','11'],
            ['0930245519','ELLIOT MATIAS','TORRES MANZUR','11'],
            ['0954807095','RONALD ALEXANDRO','DELGADO FIGUEROA','11'],
            ['0940345739','TONY SEAN','TEJENA LITUMA','11'],
            ['0943531525','ASHLEY NICOLE','SOLIS MORAN','11'],
            ['0123456789','CARLOS ALBERTO','LOGROÑO SAENZ','11'],
            ['0930383211','CESAR SEBASTIAN','GUERRA RICAURTE','11'],
            ['0123456789','ALHIA DANIELA','RAAK QUIMIS','11'],

            
            // DÉCIMO A

            ['0932660962','GABRIELA DENISSE','ORELLANA ORTIZ','12'],
            ['0950876680','ANNIE SCARLLETTE','VEGA BAJAÑA','12'],
            ['0123456789','CARLOS DAVID','TORRES CHAVEZ','12'],
            ['0930016217','ELIAS JOSUE','MARIN VITERI','12'],
            ['0957795453','REBECA NOEMI','MARIN VITERI','12'],
            ['0928928423','MOISES ORLANDO','TORRES MAGALLANES','12'],

            
            // PRIMERO DE BACHILLERATO A

            ['0930562426','JOHAN XAVIER','VALLEJO MOREIRA','13'],
            ['0953032364','ANGELINA PAOLA','RODRIGUEZ ORELLANA','13'],
            ['0123456789','ERICKA CAROLINA','NIETO SISALIMA','13'],
            ['1754612297','MIGUEL ANGEL','ARBOLEDA QUIÑONEZ','13'],
            ['0123456789','ADRIANA STHEFANI','PANCHANA CRESPIN','13'],
            ['0954807012','NATASHA NAYELY','DELGADO FIGUEROA','13'],
            ['0930259726','SOPHIA ALLIE','ALCIVAR VELASQUEZ','13'],
            ['0931377741','SANTIAGO MIGUEL','MALAGON ESCOBAR','13'],
            ['0929355667','GIULIA','CICCARONE VILLACIS','13'],
            
            
        );

        $periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();// SE SELECCIONA EL PERIODO LECTIVO AL CUAL SE AGREGARAN LOS ESTUDIANTES
        foreach ($students as $key) {

            //REGISTRO EN LA TABLA STUDENTS2

            $curso = Course::where('id',(int)$key[3])->first();
            $student = new Student2();
            $student->ci = $key[0];
            $student->nombres = $key[1];
            $student->apellidos = $key[2];
            $student->sexo = 'Masculino';
            $student->fechaNacimiento = '1999-01-01';
            $student->ciudad = 'GUAYAQUIL';
            $student->direccion = 'GUAYAQUIL';
            $student->matricula = 'Pre Matricula';
            $student->idRepresentante = null;
            $student->provincia = 'GUAYAS';
            $student->canton = 'GUAYAQUIL';
            $student->parroquia = 'GUAYAQUIL';
            $student->fecha_matriculacion = null;
            if($key[3]<'6'){
                $student->seccion   = 'EI';
            }else{
                $student->seccion = 'EGB';
            }
            $student->retirado= 'NO';
            $student->bloqueado = 0;
            $student->transporte_id = null;
            $student->nivelDeIngles = null;
            $student->idPadre = null;
            $student->idMadre = null;
            $student->save();

            //REGISTRO EN LA TABLA STUDENTS2_PROFILE_PER_YEAR
            $dataProfile = Student2Profile::create([
                'fecha_matriculacion' => null,
                'idCurso' => (int)$key[3],
                'idPeriodo' => $periodo->id,
                'idRepresentante' => null,
                'idStudent' => $student->id,
                'transporte_id' => null,
                'seccion' => $student->seccion,
                'tipo_matricula' => 'Pre Matricula',
                'ciudad_domicilio' => 'GUAYAQUIL',
                'tipo_bloqueo' => null,
                'direccion_domicilio' => 'GUAYAQUIL',
                'telefono_movil' => '',
                'tipo_vivienda' => '',
                'nacionalidad' => 'ECUATORIANA',
                'hospital' => '',
                'indicaciones' => '',
                'nombre_contacto_emergencia' => 'NINGUNO',
                'parentezco_contacto_emergencia' => 'No tiene',
                'movil_contacto_emergencia' => '00000000',
                'nombre_contacto_emergencia2' => 'NINGUNO',
                'parentezco_contacto_emergencia2' => 'No tiene',
                'movil_contacto_emergencia2' => '00000000',
                'retirado' => 'NO',
                'se_va_solo' => 0,
                'ingreso_familiar' => '',
                'observacion_retirado' => '',
                'condicionado' => '',
                'discapacidad' => '',
                'porcentaje_discapacidad' => null,
                'seguro_institucional' => '',
                'nombre_seguro' => '',
                'numero_carnet' => '',
                'inclusion' => '',
                'alergias' => '',
                'fecha_expiracion_pasaporte' => '',
                'fecha_caducidad_pasaporte' => '',
                'fecha_ingreso_pais' => '',
                'celular' => '',
                'estado_civil_padres' => '',
            ]);
        }
    }
}
