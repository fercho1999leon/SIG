<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class EstudiantesTiaPiedacitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = array(


            // PRIMERO A

            ['0123456789','BARROS JUPITER','DOMENICA VALENTINA','01-01-2000','1'],
            ['0123456789','BOHORQUEZ URIÑA','ASHLEY','01-01-2000','1'],
            ['0123456789','BRIONES MORALES','SARAHY PAOLA','01-01-2000','1'],
            ['0123456789','BUENAÑOS VARGAS','ADRIANO ENRIQUE','01-01-2000','1'],
            ['0123456789','BUSTOS FRANCO','ALISHA ODALIS','01-01-2000','1'],
            ['0123456789','CAGUAS FUENTES','LUCAS ISMAEL','01-01-2000','1'],
            ['0123456789','CAMACHO DIAZ','JOANY JULIETTE','01-01-2000','1'],
            ['0123456789','CENTENO MURILLO','JAEL BRIGITTE','01-01-2000','1'],
            ['0123456789','COCA ARANA','SANTIAGO NICOLAS','01-01-2000','1'],
            ['0123456789','CHIPRE VILLAGRAN','LEONELA KAROLAINE','01-01-2000','1'],
            ['0123456789','ELAO YAGUAL','NAIYEL MATT','01-01-2000','1'],
            ['0123456789','ESCALANTE MENDOZA','ASHLEY TATIANA','01-01-2000','1'],
            ['0123456789','GARCIA CONSTANTINE','JADIEL ALESSANDRO','01-01-2000','1'],
            ['0123456789','ITURRALDE CASIERRA','YAEL FERNANDO','01-01-2000','1'],
            ['0123456789','ITURRALDE CHAVEZ','DYLAN STEFANO','01-01-2000','1'],
            ['0123456789','LUJANO FIGUEROA','BRITHANY NICOLE','01-01-2000','1'],
            ['0123456789','MARIDUEÑA PEÑAFIEL','DAYANNA VALENTINA','01-01-2000','1'],
            ['0123456789','MIRANDA BAIDAL','LUIS EZEQUIEL','01-01-2000','1'],
            ['0123456789','MORALES GUERRERO','ELVIS SANTIAGO','01-01-2000','1'],
            ['0123456789','MOREIRA MUÑOZ','LUIS ADRIAN','01-01-2000','1'],
            ['0123456789','MURILLO QUIROLA','CALLIET VERONICA','01-01-2000','1'],
            ['0123456789','ORTEGA ECHEVERRIA','JESUS MIGUEL','01-01-2000','1'],
            ['0123456789','PARRAGA QUIMI','MELISSA JULIETH','01-01-2000','1'],
            ['0123456789','PEÑAFIEL SANCHEZ','DYLAN CALEB','01-01-2000','1'],
            ['0123456789','RAMIREZ MONAR','NICOLAS AUGUSTO','01-01-2000','1'],
            ['0123456789','RAMOS PEREZ','ANGELINE MADELINE','01-01-2000','1'],
            ['0123456789','SANCHEZ TUTIVEN','MATHEW XAVIER','01-01-2000','1'],
            ['0123456789','SIGUENCIA PAZ','DERIAN JAVIER','01-01-2000','1'],
            ['0123456789','SILVA SAUCEDO','PIERINA SOLANGE','01-01-2000','1'],
            ['0123456789','TORRES RODRIGUEZ','ANGEL ELIAS','01-01-2000','1'],
            ['0123456789','VARGAS VILLAMAR','DOMENICA ANALIA','01-01-2000','1'],
            ['0123456789','VELEZ CEDEÑO','ALFREDO ARIEL','01-01-2000','1'],


            // PRIMERO B

            ['0958391716','ALDAZ BAQUE','JONATHAN MATEO','29-03-2014','2'],
            ['0957471865','ALVAREZ PACHECO','HANNE DAYANARA','16-12-2013','2'],
            ['0958172462','ARREAGA CAPUTI','NAYUA ROMINA','13-02-2014','2'],
            ['0959146747','CASTILLO SUAREZ','NICOLAS GABRIEL','04-04-2014','2'],
            ['0959519836','CASTRO PINCAY','EMMA YULEXY','11-09-2014','2'],
            ['0958943201','CHAGUAY GARCÍA','TIVANNA CHARLOTTE','13-05-2014','2'],
            ['0957415532','CHALEN ESPINOZA','BENJAMIN  STEVEN','15-11-2013','2'],
            ['0956834634','CHAVEZ GUAÑO','THIAGO ISAIAS','06-10-2013','2'],
            ['0932479744','FLORES CARPIO','ASHLEY NICOLE','10-01-2014','2'],
            ['0957823396','INGA TORRES','FABRICIO MILLAN','14-12-2013','2'],
            ['0959061508','JAIME SALVATIERRA','JEAN EZEQUIEL','06-06-2014','2'],
            ['0956275366','LANDIVAR  ABAD','IAN  MARKOS','30-06-2013','2'],
            ['0932615792','LEMA ESPINOZA','JULIO DAVID','01-07-2014','2'],
            ['0932451586','MACIAS ORMEÑO','ISAAC GABRIEL','29-11-2013','2'],
            ['0951006693','MITE GRACIA','ITZI TAMIAK','13-05-2014','2'],
            ['0932443443','MORENO GARCÍA','RODRIGO ISAIAS','22-10-2013','2'],
            ['0957232267','MURILLO MERA','MATHEWS EMILIANO','13-11-2013','2'],
            ['0959708124','ORELLANA ANGULO','DAVID ALBERTO','06-06-2014','2'],
            ['0959237587','PACHECO CAMPODONICO','GIA MAYTE','23-07-2014','2'],
            ['0958135493','PAZ CABRERA','DYLAN RAFAEL','01-10-2013','2'],
            ['0959226614','PAZ ANCHUNDIA','JANDRY PAUL','01-08-2014','2'],
            ['0959893561','RAMIREZ MIRANDA','THIAGO EZEQUIEL','24-08-2014','2'],
            ['0959034935','RAMIREZ SOLARTE','NAOMI BRIGGITTE','08-06-2014','2'],
            ['0956888572','REYES MARRIOTT','LUCAS MIGUEL','16-10-2013','2'],
            ['0959022773','ROSERO VERA','THIAGO EMILIANO','28-05-2014','2'],
            ['0955242953','SANCHEZ FERNANDEZ','DYLAN FABIAN','15-01-2013','2'],
            ['0958531147','SANCHEZ TUTIVEN','PEDRO SEBASTIAN','09-03-2014','2'],
            ['0932642523','SILVA SAUCEDO','DANNA MILENA','25-08-2014','2'],
            ['0954263950','VANEGAS MONTENEGRO','ALONSO ELIAS','10-03-2014','2'],
            ['0-959224157','VELEZ ALCIVAR','DOMENICK GABRIEL','17-06-2014','2'],
            ['0-932470636','VERA MARIN','JOHN','19-12-2013','2'],
            ['0-958535387','VERA MORENO','NICOLE FERNANDA','04-04-2014','2'],
            ['0-959157488','VILLON BAQUE','KENNETH ISAIAS','03-11-2013','2'],
            ['3050270036','ZAMORA CAICEDO','FRANCESCO RAMON','04-05-2014','2'],


            // PRIMERO C

            ['0095989110','APOLINARIO ORTEGANO','KYARA SCARLETH','19-06-14','3'],
            ['0958986671','ARRIAGA TRIVIÑO','ALLISON ANAHI','10-04-14','3'],
            ['0959263864','BRITO CANDELARIO','ETHAN LEONEL','13-08-14','3'],
            ['0956820732','CAJAMARCA VALDERRAMA','PAULETTE BRIANNA','07-10-13','3'],
            ['0932687148','CARRERA VERA','EITHAN ALAN','31-07-14','3'],
            ['0957429517','CASTRO CHIA','DYLAN JESUS','02-12-13','3'],
            ['0959456997','CHIMBO VALLEJO','MATHIAS ALEJANDRO','13-11-13','3'],
            ['0932450067','COELLO ARGUELLO','DOMENICA SAMANTHA','11-11-13','3'],
            ['0958539926','CUESTA JURADO','SOPHIA VANINA','09-03-14','3'],
            ['0932653413','DELGADO PELAEZ','ALEJANDRO CALEB','14-09-14','3'],
            ['0932612146','FAJARDO INFANTE','MAVERICK GABRIEL','29-06-14','3'],
            ['0959704917','FAJARDO ALONSO','CRISTHEL MARINA','18-09-13','3'],
            ['0960018497','FLORES CONTRERAS','JOHN LIAM','04-06-14','3'],
            ['0959007212','GOMEZ VILLAO','SERGGY MAXIMILIANO','08-05-14','3'],
            ['0932589062','GOMEZ MONTAÑO','DERECK ELIAN','11-05-14','3'],
            ['0959061144','GONZALEZ MUÑOZ','MAYRA KAELY','28-05-14','3'],
            ['0957392822','JORDAN PLUAS','MATEO JOSUE','30-11-13','3'],
            ['0959583402','MAGALLANES BRIONES','JUAN DAVID','30-06-14','3'],
            ['0932608987','MIRANDA CEDEÑO','YANNICK RICARDO','25-06-14','3'],
            ['0932569429','MIRANDA PRECILLA','AISHA ALEJANDRA','25-04-14','3'],
            ['0959193681','MONTALBAN ROBAYO','ADRIANO JOSUE','28-07-14','3'],
            ['0932500408','NAVARRETE PACHIZ','BRUNO ALESSANDRO','30-01-14','3'],
            ['0932633993','NEIRA CORNEJO','MARTHIN STEFANO','24-07-14','3'],
            ['0959658741','RIVERA PESANTEZ','JHOSEP EZEQUIEL','26-06-14','3'],
            ['0932562911','RONQUILLO IZUIERDO','STEVEN MATHIAS','15-04-14','3'],
            ['0960366508','SALAZAR VELASTEGUI','ANDREW JOSUE','08-10-13','3'],
            ['0956947394','SOLIS LUZARRAGA','ASHLEY VALENTINA','10-10-13','3'],
            ['0958617037','SOLIS VERA','MATHIAS SANTIAGO','16-10-13','3'],
            ['0959931452','SOLORZANO CARRERA','KHEYSSY DENESSA','30-05-14','3'],
            ['0932531759','TAMAYO ACUÑA','JOSUE ALEJANDRO','18-03-14','3'],
            ['0957805047','URBINA MORENO','HAILEY CRISTEL','26-12-13','3'],
            ['0959150624','VALVERDE ROJAS','RACHEL DAYNA','14-07-14','3'],

            
            // SEGUNDO A

            ['0955391529','Alvear León','Yaneris Anahi','07-02-12','4'],
            ['0956353916','Arroyo Soto','Aída Sadie','20-06-13','4'],
            ['0956013916','Barrera Holguín','Leslie Paulette','27-01-13','4'],
            ['0954921433','Beltrán Delgado','Noe Ezequiel','11-06-12','4'],
            ['0955690177','Cervantes García','Sofía Rafaela','20-03-13','4'],
            ['0954841045','Chávez Sánchez','George Maximiliano','07-11-12','4'],
            ['0956546030','Chiriboga Coba','Jason Yulians','22-05-13','4'],
            ['0955585088','Flores Velasco','Ivanna Irina','30-11-12','4'],
            ['0932360092','Garzón Morán','Naomi Elizabeth','17-06-13','4'],
            ['0954442703','Gómez Rúa','Mike Jared','11-07-12','4'],
            ['0956165724','Guasco Coello','Justyn Santiago','09-03-12','4'],
            ['0955071568','Ibáñez Guaraca','Brenda Valentina','13-12-12','4'],
            ['0932230303','Ladines Ramirez','Caleb Misael','11-12-12','4'],
            ['0956988661','Lara Aldas','Charlotte Yimerly','05-11-12','4'],
            ['0957086093','Lucero Tomala','Emily Gabriela','24-06-13','4'],
            ['0954650685','Mantilla  Mora','Valery Ninoska','11-08-12','4'],
            ['0956660823','Maquilon Prieto','Milán Maximiliano','12-06-13','4'],
            ['0932223621','Maridueña Sáenz','Jake Colón','24-11-12','4'],
            ['1234567890','Medranda Molina','Danna Elisa','13-06-13','4'],
            ['0995513766','Mejía Mancero','Danna Angeline','17-12-12','4'],
            ['0956476055','Mendoza Almeida','Gerard Mike','20-07-13','4'],
            ['0956452684','Molina Bustamante','Jonathan Isaac','05-08-13','4'],
            ['0960866531','Molina Montero','Kent Angel','21-06-13','4'],
            ['0955792163','Neira Vasconez','Bianca Susana','29-03-13','4'],
            ['0932362528','Ochoa Mora','Renata Maite','19-12-12','4'],
            ['0932200165','Paladines Pozo','Romina Alexandra','29-09-12','4'],
            ['0954890067','Parrales Angulo','Anggie Nicole','22-12-12','4'],
            ['0932095714','Pico Vélez','Ashley  Valeria','24-04-12','4'],
            ['1234567890','Quinteros Medina','Samarha Maraneth','20-11-13','4'],
            ['0955821871','Rodríguez Collazo','Ketzia Maite','11-04-13','4'],
            ['0955719083','Sabando Palacios','Mike Benjamin','07-12-12','4'],
            ['0955558689','Sánchez Alcivar','Génesis Belén','18-12-12','4'],
            ['0932648595','Sánchez Izquierdo','John Jesús','16-09-13','4'],
            ['0955817580','Tagle Farro','Geanella Kristell','04-04-13','4'],
            ['0956959290','Yepez Solórzano','Mía Catherine','18-03-13','4'],
            

            // SEGUNDO B
            
            ['0954892790','BARRE PALMA','TABATA BRIANNA','26-11-12','5'],
            ['0956428031','BENITEZ COVEÑA','LUCIANA VALENTINA','22-04-13','5'],
            ['0956565500','COCA VERA','ABDIEL JESÚS','29-08-13','5'],
            ['0955934005','CORREA RODRIGUEZ','KENNY ISAIAS','23-04-13','5'],
            ['0932449465','FERNÁNDEZ ALDAS','JENNEDITH KATLEEN','19-08-13','5'],
            ['0955158985','FLORES SIMBALA','ISABEL CRISTINA','30-11-12','5'],
            ['0956489298','GÓMEZ GUAÑO','KARLA VALENTINA','15-12-13','5'],
            ['0956042295','GUAMAN SUÁREZ','CHARLOTTE THAIS','21-04-13','5'],
            ['0959568973','GUTIERREZ IZURIETA','KEYLA FERNANDA','13-10-12','5'],
            ['0932373129','HOLGUIN CASTRO','ANTHONY ERICK','22-07-13','5'],
            ['0956678585','JACOME RODRÍGUEZ','BRAULIO SANTINO','06-08-13','5'],
            ['2450674615','MAGALLAN NUÑEZ','SHANIK JAHIRY','18-07-13','5'],
            ['0956647069','MALDONADO PLAZA','MATHEWS ALEJANDRO','16-04-13','5'],
            ['0932356272','MARIDUEÑA PEÑAFIEL','OTTO CALEB','04-12-12','5'],
            ['0956317853','MARQUEZ TOMALA','ANGELINA MARIBEL','15-06-13','5'],
            ['0958908410','MARTINEZ PACHECO','ROBINSON LUCIANO','23-05-13','5'],
            ['0954831632','MEDINA CARCHI','EDWIN HERNAN','19-10-12','5'],
            ['0957651011','MEDINA LEON','JEZIAH ISABELLA','22-12-12','5'],
            ['0932208150','MONROY SIMBALA','FIORELLA SOFIA','20-10-12','5'],
            ['0955120993','MONTERO CHAMAIDAN','JENNIFER ABIGAIL','13-12-12','5'],
            ['0954798906','OLVERA TORRES','IVAN RAFAEL','07-11-12','5'],
            ['0955641600','OLVERA VERA','DANIELLA VALENTINA','17-03-13','5'],
            ['0932219215','PAZMIÑO LEMOS','CHRISTOPHER STALIN','24-11-12','5'],
            ['0956604417','QUIMÍ MERCHAN','MATHIAS EZEQUIEL','28-08-13','5'],
            ['0932354434','RAMIREZ MITE','DYLAN RICARDO','22-06-13','5'],
            ['0959007345','REYES MORETA','NOELIA ANAHI','08-10-13','5'],
            ['0932215064','SAAVEDRA TRUJILLO','NEY EFRAIN','01-11-12','5'],
            ['0956492292','SALAZAR CANDO','MIKAELA BELEN','09-08-13','5'],
            ['0932209760','SALVATIERRA GARCIA','VALENTINA ISKRA','26-10-12','5'],
            ['0956496749','SOLIS MONTERO','CALEB HERNAN','30-01-13','5'],
            ['0932242779','TORRES LUNA','SAMANTHA ELIZABETH','28-12-12','5'],
            ['0956578876','VALVERDE ZEBALLOS','STEVEN SAMUEL','03-12-12','5'],
            ['0954790929','VELARDE VERA','IVANNA ANELIS','31-10-12','5'],
            ['0955308614','VERA CATAGUA','LUIS ALEJANDRO','17-01-13','5'],
            ['0955990429','VERA CHIPRE','ANTONIO EMILIANO','09-09-12','5'],
            ['0932395437','VERA LOPEZ','MILAN MISAEL','31-08-13','5'],
            ['0956168090','YAGUAL RAMIREZ','SEBASTIAN ALESSANDRO','01-11-12','5'],
            

            // SEGUNDO C

            ['0958141251','Brito Candelario','Damian Ezequiel','24-02-13','6'],
            ['0954779377','Bustamane Burgos','Valeria','29-10-12','6'],
            ['0956940746','Calero Vásconez','Gustavo Adrián','24-08-13','6'],
            ['0956355417','Castillo Alava','Isis Valeria','11-07-13','6'],
            ['0960298750','Castillo Pinargote','Didier','02-08-13','6'],
            ['0955102926','Cortez Paramo','Isabella Anahi','30-12-12','6'],
            ['0956169718','Corzo Chia','Yeicko Axel','30-01-13','6'],
            ['0955549704','De la Cruz Lino','Maria Teresa','03-03-13','6'],
            ['0932243199','Delgado Pelaez','Luis Emanuel','03-01-13','6'],
            ['0954926614','Estrada Segarra','Domenica','01-12-12','6'],
            ['1350633440','Gonzalez Quimiz','Christen','25-02-13','6'],
            ['0956845341','Guarnizo Espinoza','Thiago Dierick','21-02-13','6'],
            ['0932212368','Guerrero Coca','Fernando','17-10-12','6'],
            ['0955977251','Guillen Gamboa','Liam Emiliano','26-04-13','6'],
            ['0932259864','Lucero Rodriguez','Taylor','06-01-13','6'],
            ['0954676623','Martinez Desideria','Daniela Solange','02-02-13','6'],
            ['0932349343','Medina Ramos','Emilio','12-06-13','6'],
            ['0932240336','Monar Fiallos','Adriana','27-12-12','6'],
            ['0955838156','Morán Metiga','Jordana','08-11-12','6'],
            ['0932314545','Moreira Muñoz','Rafael Enrique','15-04-13','6'],
            ['0955827118','Moreno Villa','Clark Johnson','18-07-12','6'],
            ['0957760077','Moyota Peralta','Kristell','10-06-13','6'],
            ['0932389968','Neira Cornejo','Mathias','19-08-13','6'],
            ['0955024831','Parraga Quimi','Rebeca Abigail','16-11-13','6'],
            ['0956604367','Piñancela Anchundia','Thiago','20-07-13','6'],
            ['0955075452','Posso Yepez','Daniela Anahi','28-12-12','6'],
            ['0956840292','Rizo Panchana','Fiorella','23-09-13','6'],
            ['0956638167','Sanchez Haro','Nigel Nasib','06-09-13','6'],
            ['0956109755','Schuldt Aguirre','Adamaris','22-05-13','6'],
            ['0956642995','Sosa Zambrano','Bruno','08-09-13','6'],
            ['0955710025','Suarez Gómez','Danna','19-01-13','6'],
            ['0956563043','Suarez Troya','Daniela Marisol','09-01-13','6'],
            ['0931979058','Tumbaco Jacome','Valentina','23-12-11','6'],
            ['0932365489','Tumbaco Yagual','Andres Aaron','22-06-13','6'],
            ['0954927315','Yagloa  Morales','Roy Matias','02-02-12','6'],
            ['0955705264','Yagual Torres','Luis Mathias','10-03-13','6'],
            ['0932279227','Zambrano Jimenez','Luciana','16-02-13','6'],
            ['0932357562','Rodriguez Valenzuela','Luciana Fiorella','31-05-13','6'],
            

            // TERCERO A

            ['1234567890','Arias Torres','Nathalia','01-01-19','7'],
            ['1234567890','Auz Coca','Lessie Yanel','02-01-19','7'],
            ['1234567890','Caba Delgado','Christopher Joseph','03-01-19','7'],
            ['1234567890','Castro Sánchez','Eliana Tahiz','04-01-19','7'],
            ['1234567890','Chipre Alvarado','Kenneth Eduardo','05-01-19','7'],
            ['1234567890','Contreras Gonzales','Rafaela','06-01-19','7'],
            ['1234567890','Cortes Morales','Brithanny Brigitte','07-01-19','7'],
            ['1234567890','Cruz Chuya','Nathan Maximiliano','08-01-19','7'],
            ['1234567890','Cuero Hurtado','Stefano Emmanuel','09-01-19','7'],
            ['1234567890','Espín Jiménez','Johan Sebástian','10-01-19','7'],
            ['1234567890','Fernández Valderrama','Domenica','11-01-19','7'],
            ['1234567890','Gacía Vásquez','Luciana Paulette','12-01-19','7'],
            ['1234567890','Guerrero Nuñez','Abigail Stefania','13-01-19','7'],
            ['1234567890','Jugacho Morales','Carlos David','14-01-19','7'],
            ['1234567890','Landázuri Vargas','Jassy Alexander','15-01-19','7'],
            ['1234567890','Lindao Verduga','Angel Sebastian','16-01-19','7'],
            ['1234567890','Loor Reyes','Jacob Raymod','17-01-19','7'],
            ['1234567890','López Ordoñez','Piero Alejandro','18-01-19','7'],
            ['1234567890','Machuca Calle','Mathias Gabriel','19-01-19','7'],
            ['1234567890','Macías Ormeño','Ezequiel Wladimir','20-01-19','7'],
            ['1234567890','Mackensie Del Rosario','Irina','21-01-19','7'],
            ['1234567890','Maisingher Méndez','Scarlet Gloria','22-01-19','7'],
            ['1234567890','Mendieta Martínez','Lia Poletl','23-01-19','7'],
            ['1234567890','Mendoza Granados','Jhon Michael','24-01-19','7'],
            ['1234567890','Montalaban Robayo','Mathias Alejandro','25-01-19','7'],
            ['1234567890','Montenegro Velasco','Jesús','26-01-19','7'],
            ['1234567890','Noboa Sánchez','Analy Abigail','27-01-19','7'],
            ['1234567890','Pachito Coral','Carlos Aaron','28-01-19','7'],
            ['1234567890','Parra Alay','Melanie Francesca','29-01-19','7'],
            ['1234567890','Pesantes López','Darla','30-01-19','7'],
            ['1234567890','Reyes Marriot','Luias Miguel','31-01-19','7'],
            ['1234567890','Rodríguez Caicedo','Andy Thomas','01-02-19','7'],
            ['1234567890','Salavarría Peñafiel','Keyra Yaileen','02-02-19','7'],
            ['1234567890','Sánchez Vera','Angeline Jared','03-02-19','7'],
            ['1234567890','Sosa Zambrano','Damaris Gerly','04-02-19','7'],
            ['1234567890','Tamayo Rugel','Julián Salvatore','05-02-19','7'],
            ['1234567890','Torres Burbano','Taira','06-02-19','7'],
            ['1234567890','Vélez Quinde','Jeremías Benjamín','07-02-19','7'],
            ['1234567890','Vera Marín','Tiffany','08-02-19','7'],
            ['1234567890','Yaguana Muñoz','Kelly Amaya','09-02-19','7'],            


            // TERCERO B

                

            // CUARTO A
            // CUARTO B
            // CUARTO C
            // QUINTO A
            // QUINTO B
            // SEXTO A
            // SEXTO B
            // SEXTO C
            // SEPTIMO A
            // SEPTIMO B
            // OCTAVO A
            // OCTAVO B
            // NOVENO A
            // NOVENO B
            // DECIMO A

            
            





        );

		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key) {
		    $student = new Student2();
            $student->ci = $key[0];
            $student->nombres = $key[2];
            $student->apellidos = $key[1];
            $student->sexo = $key[3];
            $student->fechaNacimiento = '2010-01-01';
            $student->ciudad = 'DURAN';
            $student->direccion = 'DURAN';
            $student->matricula = 'Ordinaria';
            $student->numeroMatricula  = $student->id;
            $student->idCurso = $key[4];
            $student->seccion = 'EGB';
            $student->idPeriodo = 2;
            $student->retirado= 'NO';
                
            // Se guarda el número de la matricula con la configuración general
            $cont = Student2::all()->where('matricula', '!=','Pre Matricula')->count(); 
            $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
            $student->numeroMatricula = $fecha."-".sprintf("%04d", $cont+1);;
            $student->save();
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
            					'email'		=>	$primerNombre.'.'.$primerApellido.$student->id."@pined.ec",
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
}

