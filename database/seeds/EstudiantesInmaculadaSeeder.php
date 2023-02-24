<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class EstudiantesInmaculadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
    	$students = array(

            // INICIAL 2

            ['AUCANCELA MOREIRA','JEREMY JAVIER','MASCULINO','10-04-15','1'],
            ['BAQUERIZO MERA','THIAGO ANDRE','MASCULINO','21-03-15','1'],
            ['BENITES TORAL','MARLON GABRIEL','MASCULINO','26-06-15','1'],
            ['CALLE MEJIA','ELIZABETH','FEMENINO','18-12-15','1'],
            ['CAMEJO GALAN','DANTE STEFFANO','MASCULINO','09-01-15','1'],
            ['CAMPAÑA FREIRE','JAIR MATEO','MASCULINO','05-09-14','1'],
            ['CATAGUA GOYA','DERIAN ALEXANDER','MASCULINO','20-07-15','1'],
            ['COLL AVILA','WELLINGTON ALEXANDER','MASCULINO','01-08-15','1'],
            ['CORREA MOREIRA','SCARLETH VALENTINA','FEMENINO','26-08-14','1'],
            ['DAVILA GOYA','ROMINA  LISSARET','MASCULINO','14-07-15','1'],
            ['GUAMAN GRANOBLE','JENNIFER NALLELY','FEMENINO','15-09-14','1'],
            ['HERRERA ATIENCIA','MELODY ANAHI','FEMENINO','28-05-15','1'],
            ['JAIME HARO','OANA YULEXY','FEMENINO','28-10-14','1'],
            ['PAZMIÑO ALVAREZ','EDUARDO RUBEN','MASCULINO','04-04-15','1'],
            ['RECALDE ALAVA','CAMILA DALESKA','FEMENINO','30-04-15','1'],
            ['ROMERO CORREA','DERECK  STEVEN','MASCULINO','14-05-15','1'],
            ['ROMERO GAVILANEZ','JEAN PIERRE','MASCULINO','13-05-15','1'],


            // PRIMERO A

            ['ALCIVAR HOLGUIN','EVELYN ALEJANDRA','FEMENINO','20-07-14','2'],
            ['ALCIVAR SABEDRA','AMELIA LUISIANA','MASCULINO','23-09-13','2'],
            ['ALVAREZ DI LORENZO','AISHA ANGELINA','FEMENINO','03-09-13','2'],
            ['ALVAREZ PINCAY','JHANNA ARIAGNETH','FEMENINO','27-11-13','2'],
            ['BALLAS LOPEZ','ARIANA VALENTINA','FEMENINO','04-02-14','2'],
            ['BARROS BOLAÑOS','DAMIAN SANTIAGO','MASCULINO','21-04-14','2'],
            ['CARDENAS ZUÑIGA','DANNA PAULINA','FEMENINO','29-05-14','2'],
            ['CARRASCO PUENCHERA','CRISTHIAN DAVID','MASCULINO','22-05-14','2'],
            ['CARRIEL VASQUEZ','ISMAEL SHAWN','MASCULINO','20-03-14','2'],
            ['CASTRO NAVAS','LARITZA SAMANTHA','FEMENINO','10-10-13','2'],
            ['CATAGUA  GOYA','ASHLEY KRISTEL','FEMENINO','26-07-13','2'],
            ['CHININ ROBALLO','ROMINA CHARLOTTE','FEMENINO','24-10-13','2'],
            ['COLL GOYA','DYLAN SEBASTIAN','MASCULINO','19-11-13','2'],
            ['CONFORME PIN','ASHLEY DAYLI','FEMENINO','06-09-13','2'],
            ['DAVID SALAS','ASHLEY PAULETTE','FEMENINO','26-04-14','2'],
            ['GUACHAMIN LEON','THIAGO ALEXANDER','MASCULINO','29-04-14','2'],
            ['IDROVO RUIZ','AYTANA FIORELLA','FEMENINO','28-12-13','2'],
            ['JIMENEZ SEGURA','ANNIE SCARLETH','FEMENINO','15-04-14','2'],
            ['LAINEZ BAJAÑA','EDWIN DARIEL','MASCULINO','08-02-14','2'],
            ['LUGO MORALES','MARIANGEL CRISTINA','FEMENINO','02-03-14','2'],
            ['MENDEZ VINUEZA','VALERIA GINA','FEMENINO','05-11-13','2'],
            ['NARVAEZ VERA','ARIANNA LORENA','FEMENINO','25-11-13','2'],
            ['NAULA CORTEZ','JOSE NICOLAS','MASCULINO','03-04-14','2'],
            ['PALAGUACHI MORA','KEYLI NAYDELIN','FEMENINO','18-09-13','2'],
            ['PLAZA ZUÑIGA','KEITLYN SCARLETH','FEMENINO','09-11-13','2'],
            ['PONCE CERCADO','DAYRA VANESSA','MASCULINO','16-10-13','2'],
            ['VALAREZO ZAMORA','SASKIA ALEXANDRA','FEMENINO','05-07-14','2'],
            ['VARGAS MERA','MAYERLI ALEXANDRA','FEMENINO','27-04-14','2'],
            ['VIZUETA DIAZ','ARIANA ANTONELLA','FEMENINO','17-03-14','2'],


            // SEGUNDO A

            ['AGUIRRE MORA','SARAY FERNANDA','FEMENINO','17-07-13','3'],
            ['ALVERCA JIMENEZ','ITZEL CRISTEL','FEMENINO','01-02-13','3'],
            ['CALLE SALDAÑA','NATHALY  GUADALUPE','FEMENINO','22-06-13','3'],
            ['CORNEJO BRIONES','AXEL STEFANO','MASCULINO','01-11-12','3'],
            ['GOMEZ TOMALA','PAUL NICOLAS','MASCULINO','23-07-13','3'],
            ['HERAS PINOS','SOFIA BELEN','FEMENINO','03-10-12','3'],
            ['LLERENA CABRERA','DARIO ABINADI','MASCULINO','15-07-13','3'],
            ['MACIAS MATUTE','AARON ALEXIS','MASCULINO','20-02-13','3'],
            ['MARTINEZ BOHORQUEZ','JILKA ZHARID','FEMENINO','05-06-13','3'],
            ['MOSQUERA TORAL','SHEYLA MARISOL','FEMENINO','16-05-13','3'],
            ['NARVAEZ VERA','JOSE MATHEO','MASCULINO','16-11-12','3'],
            ['NARVAEZ VICUÑA','SNAYDER MATIA','MASCULINO','19-10-12','3'],
            ['PINCAY MACIAS','JOSTHYN JEAMPIER','MASCULINO','24-02-13','3'],
            ['RIVAS GUAMAN','CHRISTOPHER EMILIANO','MASCULINO','18-07-13','3'],
            ['SATIAN JURADO','ASHLEY GINETH','FEMENINO','11-10-11','3'],
            ['TORAL CASTRO','MEDELEINE','FEMENINO','05-08-13','3'],
            ['ZAMBRANO MERA','ANGELA CRISTEL','FEMENINO','14-03-13','3'],
            ['ZUÑIGA SALAZAR','ARIANA VALENTINA','FEMENINO','16-02-13','3'],


            // TERCERO A

            ['AGUILERA CORDERO','BRITTANY WALESKA','FEMENINO','31-03-12','4'],
            ['ALCIVAR TORRES','LESLY ANAHY','FEMENINO','17-03-12','4'],
            ['ALULEMA BUENO','KELVIN MATIAS','MASCULINO','22-11-11','4'],
            ['ARGUDO MOLINA','MADELYNE  BRIGGITTE','FEMENINO','04-11-11','4'],
            ['BARCOS MENDOZA','KARINA LISSBETH','FEMENINO','18-01-12','4'],
            ['COLOMA LARA','CARLOS ADRIAN','MASCULINO','07-03-12','4'],
            ['DAVILA GOYA','SCARLET MARCELA','FEMENINO','05-02-12','4'],
            ['DIAZ PIMENTEL','VALENTHINA ANTONELA','FEMENINO','21-05-10','4'],
            ['FERNANDEZ ALAVA','CECILIA ALEJANDRA','FEMENINO','05-01-12','4'],
            ['FRANCO SINALUISA','CORAIMA ELIZABETH','FEMENINO','14-05-12','4'],
            ['LAINEZ BAJAÑA','JUAN DANIEL','MASCULINO','21-05-12','4'],
            ['LARA ESPINOZA','ALAN RAUL','MASCULINO','06-08-12','4'],
            ['LEON GASTIABURO','ANGEL SANTIAGO','MASCULINO','03-04-12','4'],
            ['MARTILLO VIZUETA','DOMENICA PAULETTE','FEMENINO','22-03-12','4'],
            ['MARTINEZ BOHORQUEZ','DASHA JULIETTE','FEMENINO','02-10-11','4'],
            ['MOREIRA MENESES','MELANIE JULIANA','FEMENINO','07-03-12','4'],
            ['MOSQUERA TORAL','JEYSER JAVIER','MASCULINO','02-10-11','4'],
            ['PASTUIZACA HERAS','MARIA JOSE','FEMENINO','05-04-12','4'],
            ['QUINDE CORDERO','XAVIER ANDRES','MASCULINO','19-09-11','4'],
            ['RIVAS PEREZ','JOSE SEBASTIAN','MASCULINO','16-05-12','4'],
            ['SOLORZANO PARRAGA','ALAN JOSE','MASCULINO','12-12-11','4'],
            ['ULLOA RODRIGUEZ','ISAAC EMMANUEL','MASCULINO','21-12-11','4'],
            ['ZAMORA MORA','AXEL GEOVANNY','MASCULINO','25-10-11','4'],


            // CUARTO A

            ['AVILEZ BARBECHO','YAJAIRA AIMEE','FEMENINO','21-09-10','5'],
            ['BRIONES INTRIAGO','AIDAN SANTIAGO','MASCULINO','13-06-11','5'],
            ['CAGUANA VILLA','ASHLEY MARINA','FEMENINO','26-07-11','5'],
            ['CALLE BORBOR','ANGIE LADY','FEMENINO','21-04-11','5'],
            ['CAMPUZANO DUQUE','DANNA ADELISE','FEMENINO','13-11-10','5'],
            ['CARCELEN NARANJO','LUIS KEYLER','MASCULINO','11-11-10','5'],
            ['CARRASCO PUENCHERA','KATHERIN DANIELA','FEMENINO','01-12-10','5'],
            ['ESPINOZA CAICEDO','EMILY MICHELL','FEMENINO','04-01-11','5'],
            ['GONZALEZ GOMEZ','CARLOS EDUARDO','MASCULINO','15-07-11','5'],
            ['HERAS CORREA','RICARDO FRANCISCO','MASCULINO','01-02-11','5'],
            ['LAINES MARQUEZ','KEKSYA MAITE','FEMENINO','12-07-11','5'],
            ['LAINES QUINTANA','VALESKA VALENTINA','MASCULINO','23-07-11','5'],
            ['MARTINEZ  CHIMBO','ANDY SALVADOR','MASCULINO','07-06-11','5'],
            ['MENDEZ VINUEZA','BRENDA ANGELICA','FEMENINO','04-06-11','5'],
            ['ORTEGA SANCHEZ','CESAR JOEL','MASCULINO','08-07-11','5'],
            ['POZO MENDOZA','MILENA  ANTONELA','FEMENINO','01-05-11','5'],
            ['RAMOS PADILLA','PAZ EMILIA','FEMENINO','15-12-10','5'],
            ['RIOFRIO FLORES','DOMENICA ASHLEY','FEMENINO','28-04-11','5'],
            ['TACO MOREIRA','MARCOS ELIAS','MASCULINO','08-06-11','5'],
            ['UZHO  ORTIZ','ANTHONY  GABRIEL','MASCULINO','22-09-10','5'],
            ['VARGAS MERA','DERICK EDUARDO','MASCULINO','23-07-11','5'],
            ['VILLAMIL CARVAJAL','ASHLEY CAROLINA','FEMENINO','29-09-10','5'],
            ['ZAMBRANO CEVALLOS','SCARLETH MARIANA','FEMENINO','19-05-11','5'],


            // QUINTO A

            ['ALCIVAR SABEDRA','MARIA EMILIA','FEMENINO','16-12-09','6'],
            ['ARANDA ARCE','JOSHUA NATHAN','MASCULINO','22-02-10','6'],
            ['ARROBA CORDOVA','DEYANIRA GISSELA','FEMENINO','15-04-09','6'],
            ['CAMPAÑA  FREIRE','JHOSUE ALEJANDRO','MASCULINO','19-01-10','6'],
            ['CASTRO CHAVEZ','NELLY HELEN','FEMENINO','07-05-10','6'],
            ['GOYA MORLA','PAULINA VICTORIA','FEMENINO','20-08-10','6'],
            ['LAINES QUINTANA','MICHELLE VALERIA','FEMENINO','09-01-10','6'],
            ['NIETO CAMACHO','MARIA GABRIELA','FEMENINO','22-05-10','6'],
            ['ORTIZ LAZO','JHOSUE MIGUEL','MASCULINO','13-09-10','6'],
            ['PIÑA ABRIL','ESTRELLA  JACKELINE','FEMENINO','07-02-10','6'],
            ['TOLEDO HERRERA','ALLISON  SOLANGE','FEMENINO','09-02-10','6'],
            ['VALLE GOMEZ','DRAKE ALFREDO','MASCULINO','17-04-10','6'],
            ['VELEZ VILLAPRADO','BRITANY VALESKA','FEMENINO','16-12-09','6'],


            // SEXTO A

            ['BAUTISTA MACAS','DIANA CAROLINA','FEMENINO','18-02-09','7'],
            ['BOHORQUEZ CASTILLO','NORELYS RENATA','FEMENINO','14-05-09','7'],
            ['GARCIA CORONEL','JUDITH VICTORIA','FEMENINO','16-12-08','7'],
            ['GASTIABURO  SARES','ANANY SOBEX','FEMENINO','01-06-09','7'],
            ['HERAS CORREA','MARIANA ALEJANDRA','FEMENINO','29-01-09','7'],
            ['HERRERA VEGA','PAULA GABRIELA','FEMENINO','23-02-09','7'],
            ['JAEN MORANTE','HELEN CAMILA','FEMENINO','10-04-09','7'],
            ['JAIME HARO','KERLY MAHOLY','MASCULINO','22-09-09','7'],
            ['LARGO BEJARANO','DEIBY DARECK','MASCULINO','07-01-08','7'],
            ['MANCERO ALVEAR','SEBASTIAN ALEJANDRO','MASCULINO','25-07-09','7'],
            ['ROMERO CHAVEZ','ANABEL VALENTINA','FEMENINO','19-05-09','7'],
            ['SILVA  DAVID','RONNY SALVADOR','MASCULINO','16-10-09','7'],
            ['TACO MOREIRA','CELINE VALESKA','FEMENINO','02-04-09','7'],


            // SEPTIMO A

            ['ALVAREZ PINCAY','BRYAN ADRIAN','MASCULINO','12-03-08','8'],
            ['BURGOS CARCHI','PABLO MANUEL','MASCULINO','16-04-08','8'],
            ['CALLE PALACIOS','DOMENICA ELIZABETH','FEMENINO','06-03-08','8'],
            ['CARPIO PONCE','JOSTIN  FERNANDO','MASCULINO','14-08-08','8'],
            ['CASTRO CHAVEZ','STEVEN ADRIAN','MASCULINO','14-02-08','8'],
            ['CEDEÑO AVILA','JENNIFER NAYELLY','FEMENINO','27-01-08','8'],
            ['CEVALLOS AVILA','LEONELA  VIVIANA','FEMENINO','03-05-08','8'],
            ['CHAUCA FUENTES','MARGARETH JANICE','FEMENINO','01-04-08','8'],
            ['CHININ ROBALLO','ADAMARIS NAYEVY','FEMENINO','27-09-08','8'],
            ['CORDOVA NAVAS','ASHLEY ANAHIS','FEMENINO','08-11-07','8'],
            ['FAJARDO CEVALLOS','LADY LISBETH','FEMENINO','11-08-08','8'],
            ['FLORES MEJIA','DULCE MARIA','FEMENINO','26-09-08','8'],
            ['GOMEZ TOMALA','ASHLEY PAULINA','FEMENINO','01-02-08','8'],
            ['GUZMAN PESANTEZ','RONNY SANTIAGO','MASCULINO','21-04-08','8'],
            ['ICAZA VIDAL','EMILY GEOVANNA','FEMENINO','01-12-08','8'],
            ['LOOR VERA','JORDAN STEVEN','MASCULINO','01-11-07','8'],
            ['NARVAEZ VICUÑA','JHON SEBASTIAN','MASCULINO','11-07-08','8'],
            ['NARVAEZ VINCES','AMY ELYSE','FEMENINO','19-06-08','8'],
            ['NOVILLO FLORES','MALENA GERALDY','FEMENINO','20-11-08','8'],
            ['NUMERABLE ILER','MARVIN ISMAEL','MASCULINO','05-02-07','8'],
            ['PORTILLA MACIAS','ANAHI SALOME','FEMENINO','17-01-08','8'],
            ['RIOFRIO FLORES','DANNY JOSUE','MASCULINO','14-05-08','8'],
            ['SALAVARRIA  GONGORA','LINDA GENESIS','FEMENINO','02-04-07','8'],
            ['SALAVARRIA GONGORA','JHON ROMEL','MASCULINO','11-10-08','8'],
            ['SAMANIEGO QUICHIMBO','ZAHIRA DANIELA','FEMENINO','02-07-08','8'],
            ['TORRES CALLE','JEFF EDUARDO','MASCULINO','16-04-08','8'],


            // OCTAVO A

            ['AVILA ZAMORA','DARWIN ADOLFO','MASCULINO','30-10-07','9'],
            ['BENITES TORAL','GABRIELA ANAHI','FEMENINO','13-12-07','9'],
            ['BURBANO YEPEZ','KATHERINE MAYLIN','FEMENINO','06-02-07','9'],
            ['CAICEDO GONZALEZ','MATHEW XAVIER','MASCULINO','30-10-07','9'],
            ['CARDENAS LARA','JUSTIN ALEXANDER','MASCULINO','08-05-07','9'],
            ['CEDEÑO NAANCHI','DANIELA  ELIZABETH','FEMENINO','29-09-07','9'],
            ['CEVALLOS EVANGELISTA','RAMON EMANUEL','MASCULINO','12-04-07','9'],
            ['COELLO VILLAGOMEZ','ODALYS  ANAHI','FEMENINO','23-08-07','9'],
            ['ENCALADA VILLA','EMILY SUSANA','FEMENINO','23-08-07','9'],
            ['GAME PRADO','BRYAN ARMANDO','MASCULINO','16-11-07','9'],
            ['JAIME HARO','JEFFERSON ERICK','MASCULINO','01-08-07','9'],
            ['JIMENEZ CRUZ','ADRIAN MICHAEL','MASCULINO','27-02-06','9'],
            ['LOOR AREVALO','OSWALDO JEAN PIERRE','MASCULINO','20-06-07','9'],
            ['LOPEZ AVILA','JORDAN STEVEN','MASCULINO','16-01-07','9'],
            ['LOZADA MORA','LADY STEFANY','FEMENINO','05-10-07','9'],
            ['MORAN ZAMBRANO','LADY DANIELA','FEMENINO','10-04-19','9'],
            ['MURILLO CUZME','NATASHA NAOMI','FEMENINO','15-01-07','9'],
            ['POZO MENDOZA','ZULLY  ANAHI','FEMENINO','01-09-07','9'],
            ['RIZZO VILLAMAR','LUIS STEVEN','MASCULINO','13-12-07','9'],
            ['ROMERO CHAVEZ','ANA ISABEL','FEMENINO','28-11-07','9'],
            ['SAFADI CAMPUZANO','ALEJANDRO MAGNO','MASCULINO','04-05-07','9'],
            ['SALAS VILLALTA','NINOSKA VANESSA','FEMENINO','18-10-07','9'],
            ['TAPIA CARRIEL','CRISTOPHER SAMUEL','MASCULINO','29-07-06','9'],
            ['ULLOA VILLEGAS','MAXWELL XAVIER','MASCULINO','24-01-07','9'],
            ['URUCHIMA CUSME','WIMPER LARRY','MASCULINO','24-08-07','9'],
            ['VILLAMAR ALVAREZ','ERICK JEANPIERRE','MASCULINO','13-11-13','9'],
            ['ZAMBRANO MERA','MADELYN MAYERLY','FEMENINO','31-05-07','9'],


            // NOVENO A

            ['ALAVA VILLEGA','SHASKIA MILENA','FEMENINO','29-08-06','10'],
            ['ANDRADE CHAUCA','MELANIE BRIGITTE','FEMENINO','28-11-05','10'],
            ['BENITEZ MUÑOZ','ALANS PABLO','MASCULINO','14-05-06','10'],
            ['CANALES MUNZON','CRISTHINA LUCIA','FEMENINO','13-12-06','10'],
            ['CASTRO HUILCA','NATALY ANAHY','FEMENINO','24-02-06','10'],
            ['DI LORENZO PAGUAY','LUIGGI PIERO','MASCULINO','09-12-05','10'],
            ['ENCALADA BRIONES','ALLISON MICHELLE','FEMENINO','04-01-07','10'],
            ['GOMEZ CHABLA','ANGIE MABEL','FEMENINO','23-07-06','10'],
            ['GUAMBA YAGUANA','EVER JEANPIERRE','MASCULINO','16-08-06','10'],
            ['INTRIAGO CORONEL','RAMON JACINTO','MASCULINO','14-06-06','10'],
            ['JUNCO BURBANO','HECTOR IVAN','MASCULINO','22-05-05','10'],
            ['LAINES COLOMA','ELKIN FERNANDO','MASCULINO','24-06-06','10'],
            ['LARA CAGUANA','ANAHI GUADALUPE','FEMENINO','04-08-06','10'],
            ['MARCA FAJARDO','KERLY DAYANNA','FEMENINO','21-05-06','10'],
            ['MORENO RUIZ','MYCKEL JOSUE','MASCULINO','01-07-06','10'],
            ['MUNZON ENCALADA','NOHELIA ANAHI','FEMENINO','31-03-06','10'],
            ['ORTIZ LAZO','VALERIA MARIEL','FEMENINO','17-07-07','10'],
            ['RISCO MARIN','ZURY TATIANA','FEMENINO','11-12-06','10'],
            ['ROMERO CORREA','EDISON ARIEL','MASCULINO','25-02-06','10'],
            ['RUIZ CASTRO','ELKIN  ARIEL','MASCULINO','04-10-06','10'],
            ['SANTANA ORTIZ','KRISTHEL ANDREA','FEMENINO','17-06-06','10'],
            ['SATIAN JURADO','JHONATHAM GUILLERMO','MASCULINO','10-04-19','10'],
            ['TAPIA BAJAÑA','GENESIS NARCISA','FEMENINO','28-05-06','10'],
            ['ULLOA VILLEGAS','EDGAR RAMSES','MASCULINO','09-02-06','10'],
            ['VILLAGOMEZ JIMENEZ','KRISTEL ARIANA','FEMENINO','07-01-05','10'],
            ['ZAMBRANO MERA','WILSON ELIAS','MASCULINO','03-01-06','10'],
            ['ZUÑIGA VALENCIA','NAYROVIT SCARLET','FEMENINO','12-06-06','10'],
            
            
            // DECIMO A

            ['ACOSTA CALLE','GEOCONDA CAROLINA','FEMENINO','01-03-05','11'],
            ['ACOSTA PIN','NAYTHAN ALBERTO','MASCULINO','18-03-05','11'],
            ['ARANDA ARCE','TIFFANY YANIXA','FEMENINO','14-01-06','11'],
            ['BAQUERIZO MERA','JULIO RAUL','MASCULINO','13-01-06','11'],
            ['BOLAÑOS  VERA','JENNIFER DAYANA','FEMENINO','02-10-04','11'],
            ['CAMPOVERDE MELENDEZ','DENILSON RAY','MASCULINO','26-02-05','11'],
            ['CARDENAS RODRIGUEZ','EVA DAYANNA','FEMENINO','12-02-06','11'],
            ['CASTRO CHAVEZ','LUIS FERNANDO','MASCULINO','12-11-04','11'],
            ['CONTRERAS  ORTIZ','SANTIAGO JAVIER','MASCULINO','25-09-05','11'],
            ['CORONEL CASTRO','LESHILE PAMELA','FEMENINO','11-07-02','11'],
            ['GARCIA DEL PEZO','BIANCA LAYLA','FEMENINO','09-02-05','11'],
            ['GONZALES VILLACRES','LUIS ANTHONY','MASCULINO','23-06-05','11'],
            ['GOYA MORLA','LUIS STEVEN','MASCULINO','15-08-05','11'],
            ['GUARANDA BAYAS','ADRIAN DAVID','MASCULINO','19-10-04','11'],
            ['GUZMAN ONOFRE','ALESSANDRO MICHELE','MASCULINO','05-03-03','11'],
            ['GUZMAN ONOFRE','GIANNI  ALESSANDRO','MASCULINO','25-03-03','11'],
            ['HERAS CORREA','EMILY JOHANNA','FEMENINO','04-12-04','11'],
            ['JIMENEZ CUASAPAZ','EMILY DANIELA','FEMENINO','02-07-06','11'],
            ['LOOR GUAMAN','SANDER STEVEN','MASCULINO','23-03-05','11'],
            ['MAYORGA RAMOS','DEYANIRA VERONICA','FEMENINO','10-08-05','11'],
            ['MENDEZ VINUEZA','VERONICA LUCIA','FEMENINO','25-11-05','11'],
            ['MOLINA DUEÑAS','VALESKA ANGELINE','FEMENINO','21-07-05','11'],
            ['NIETO CAMACHO','AMY DANIELA','FEMENINO','13-06-05','11'],
            ['ORTIZ CUSME','HANNY ANAIS','FEMENINO','23-08-05','11'],
            ['PEÑARANDA  ALVARADO','LESLIE NAYELLY','FEMENINO','10-11-05','11'],
            ['POZO MENDOZA','ERIKA NAYELLY','FEMENINO','02-10-05','11'],
            ['RAMIREZ JIMENEZ','FRANK STEVEN','MASCULINO','27-10-04','11'],
            ['REGALADO ACOSTA','RICHARD ADRIAN','MASCULINO','30-08-05','11'],
            ['VELEZ SICHA','JENNIFER ANDREA','FEMENINO','12-06-05','11'],
            ['VIDAL VILLAPRADO','BRITNEY BRIGGITTE','FEMENINO','03-10-05','11'],
            ['VILLASAGUA JARAMILLO','MARYLIN  DANIELA','FEMENINO','02-12-03','11'],
            ['ZAMBRANO QUILCA','BELLA MICHELLE','FEMENINO','27-07-05','11'],
            ['ZANZZI DOMINGUEZ','DONNY GIANLUIGI','MASCULINO','26-07-05','11'],
            
            
            // PRIMERO BACHILLERATO A

            ['CAJAMARCA FRANCO','DULIS FERNANDO','MASCULINO','16-05-04','12'],
            ['CALLE BORBOR','FREDDY STEVEN','MASCULINO','06-08-04','12'],
            ['CHANCAY PEREZ','ANDREA ELIZABETH','FEMENINO','12-07-02','12'],
            ['CORDERO SANCHEZ','XAVIER SEBASTIAN','MASCULINO','21-07-03','12'],
            ['ESTRADA TEJENA','ANTHONY  GEOVANNY','MASCULINO','20-06-04','12'],
            ['FUENTES SALDAÑA','ENRIQUE STUAR','MASCULINO','28-01-04','12'],
            ['GUEVARA SARMIENTO','JOSUE ISAAC','MASCULINO','29-07-04','12'],
            ['HERAS LEON','KAREN YAMILET','FEMENINO','21-03-04','12'],
            ['HERRERA SANCHEZ','JHAN HARLYS','MASCULINO','11-06-04','12'],
            ['HIDALGO GUAMAN','ANTHONY EDUARDO','MASCULINO','08-08-03','12'],
            ['LOOR GOMEZ','FERNANDA NICOLE','FEMENINO','14-03-04','12'],
            ['LOPEZ URGILES','JORDI BRYAN','MASCULINO','17-06-04','12'],
            ['LOZANO CARVAJAL','BELLA NUBE','FEMENINO','15-06-04','12'],
            ['PERALTA PIZA','ANGELICA NARCISA','FEMENINO','08-07-02','12'],
            ['PINCAY MACIAS','ANTHONY JOHAO','MASCULINO','14-09-03','12'],
            ['SOLIS FUENTES','LUIS ALEJANDRO','MASCULINO','30-04-04','12'],
            ['VALLE LEON','ELKIN JAIR','MASCULINO','19-11-04','12'],
            ['VICUÑA MEJIA','SMELYN ISRAEL','MASCULINO','21-04-04','12'],
            
            
            // SEGUNDO BACHILLERATO A

            ['ALVAREZ PINCAY','CRISTELL ADRIANA','FEMENINO','27-11-02','13'],
            ['ARGUDO  MOLINA','NATHALY  SILVANA','FEMENINO','25-01-03','13'],
            ['ARGUDO  SOLIS','FLOR LUCIA','FEMENINO','10-10-02','13'],
            ['AVILEZ BARBECHO','ANAHI ADAMARIS','FEMENINO','29-06-03','13'],
            ['CAJILIMA  CAMPOS','JONATHAN DARIO','MASCULINO','01-01-02','13'],
            ['CAMEJO MERA','JOSTIN ARIEL','MASCULINO','30-11-03','13'],
            ['CAMPUZANO ANZULES','PEDRO JOEL','MASCULINO','24-11-03','13'],
            ['CORTEZ ERAZO','MAILY NICOLE','FEMENINO','05-08-03','13'],
            ['DI LORENZO PAGUAY','ALFREDO ANSELMO','MASCULINO','21-05-03','13'],
            ['GARCIA AREVALO','ODALYS YULEISI','FEMENINO','18-09-03','13'],
            ['GUERRERO VEGA','KARLA MICHELLE','FEMENINO','17-11-02','13'],
            ['HURTADO CHININ','MARIANA GABRIELA','FEMENINO','24-09-03','13'],
            ['MACIAS MATUTE','MICHELLE  STEPHANY','FEMENINO','09-03-03','13'],
            ['MARCA FAJARDO','LISSBETH KAROLINA','FEMENINO','27-11-03','13'],
            ['MARTOS MORA','MIGUEL LEONARDO','MASCULINO','06-01-04','13'],
            ['MEJIA MITE','GENESIS ANUSKA','FEMENINO','08-05-03','13'],
            ['MOLINA YAURE','DAVID JOSEPH','MASCULINO','12-11-01','13'],
            ['MUÑOZ CORONEL','MAYIN DAYANARA','FEMENINO','30-09-02','13'],
            ['NARVAEZ VICUÑA','ALEXANDER ADRIAN','MASCULINO','18-01-04','13'],
            ['NOBOA GUZMAN','BRIGGITH VANESSA','FEMENINO','27-12-02','13'],
            ['NUMERABLE  ILER','LEONCIO EVARISTO','MASCULINO','29-05-03','13'],
            ['PIGUAVE CORREA','KEVIN EDUARDO','MASCULINO','20-09-02','13'],
            ['TULCANAZA MERA','AUGUSTO ALEXANDER','MASCULINO','11-10-02','13'],
            ['ZUÑIGA VELIZ','ANGIE MERCEDES','FEMENINO','09-01-04','13'],
            
            
            // TERCERO BACHILLERATO A

            ['ALVEAR URGILES','STALIN ALEJANDRO','MASCULINO','03-08-00','14'],
            ['BURBANO NUMERABLE','ROOBERTT JESUS','MASCULINO','13-11-02','14'],
            ['DAVILA RENDÓN','GUSTAVO ADOLFO','MASCULINO','26-08-02','14'],
            ['DOICELA PESANTEZ','ERICK JOHAM','MASCULINO','20-09-02','14'],
            ['ESCOBAR LEÓN','ANGIE NAYELLY','FEMENINO','18-01-02','14'],
            ['FAJARDO CEVALLOS','DANIELA FERNANDA','FEMENINO','21-04-02','14'],
            ['HERAS LEON','JESUS EDUARDO','MASCULINO','24-11-02','14'],
            ['HERRERA VEGA','PAULINA ZAYLI','FEMENINO','22-05-02','14'],
            ['LARA CAGUANA','JESSICA MARIA','FEMENINO','20-06-02','14'],
            ['MALDONADO GARCÍA','MAYELIN ANABELLA','FEMENINO','17-04-02','14'],
            ['MARIDUEÑA GALABAY','DENILSON LUIS','MASCULINO','12-08-02','14'],
            ['MARTINEZ CHIMBO','BRYAN ISMAEL','MASCULINO','11-12-00','14'],
            ['MEDINA VILLAVICENCIO','DANIELA DENISSE','FEMENINO','02-04-02','14'],
            ['MOLINA DUEÑAS','GENESIS NICOLE','FEMENINO','05-07-02','14'],
            ['PEÑA GONZALEZ','MORELIA ISABEL','FEMENINO','12-02-02','14'],
            ['PONCE CERCADO','DERICK JOEL','MASCULINO','01-10-02','14'],
            ['SALDAÑA MONTENEGRO','SHEYLA STEFFANIA','FEMENINO','08-01-02','14'],
            ['SATIAN JURADO','EDISON ANTHONY','MASCULINO','07-05-02','14'],
            ['SOLIS FUENTES','JESUS ALBERTO','MASCULINO','26-06-01','14'],
            ['ULLOA CHAVEZ','CARLOS JOSIMAR','MASCULINO','29-08-02','14'],
            ['ZUÑIGA CAJAMARCA','VANESSA LISSETH','FEMENINO','11-11-02','14'],
            ['ZUÑIGA VELIZ','EMILY FERNANDA','FEMENINO','15-09-02','14']
        );

		
		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
        	$student->ci = '1234567890';
        	$student->nombres = $key[1];
        	$student->apellidos = $key[0];
        	$student->sexo = $key[2];
        	$student->fechaNacimiento = $key[3];
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	//
        	$student->matricula = 'Ordinaria';
        	$student->numeroMatricula  = $student->id;
        	$student->idCurso = $key[4];
			if ($key[4]<4){ 

				$student->seccion = 'EI';
			}else{

				$student->seccion = 'EGB';
			}
			
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
