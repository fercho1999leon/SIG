<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use App\PeriodoLectivo;
//use Carbon\Carbon;
use App\AsistenciaParcial;
use App\Fechas;
use App\Student2Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EstudiantesSantaMarthaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $students = array(
    		

			//INICIAL 1 A-1
			['GARCIA FERNANDEZ','ANGELA RAPHAELA','EL LIMON','20002183','suelfer28@hotmail.com','1','3/14/2019','1352407819','FEMENINO','1/1/2000','PORTOVIEJO','NINGUNO','1','EI'],
			['ESTÈVEZ PÀRRAGA','ISABELLA ANALIA','PORTOVIEJO/URBANIZACIÒN PORTO NUEVO 2','2001489',
			'gaby_parraga03@pined.ec','2','4/10/2019','1352297509','FEMENINO','2/3/2016','PORTOVIEJO','NINGUNO','1','EI'],
			['MEZA MIELES','CRISTHIAN RAFAEL','COLON','999564210',
			'shirlhemieles1990@gmail.com','3','28/03/209','1352223588','MASCULINO','S/N','PORTOVIEJO','NINGUNO','1','EI'],
			['MENDOZA ZAMBRANO','EDUARDO E,ILIANO','COLON','999750378','taniaz19@yahoo.com','4','4/4/2019','1352204562','MASCULINO','9/21/2015','PORTOVIEJO','NINGUNO','1','EI'],
			['MOLINA SALTOS','ABRAHAN MARCELO','EL CADY','S/N','abrahan.molina@YAHOO.ES','5','3/11/2019','1352188450','MASCULINO','9/6/2015','PORTOVIEJO','NINGUNO','1','EI'],
			['PALMA MORRILLO','DYLAN JOAO','EL LIMON','2000539','lirio-14@hotmail.com','6','3/18/2019','1352210056','MASCULINO','10/7/2015','PORTOVIEJO','NINGUNO','1','EI'],
			['PERALTA OCHOA','SANTIAGO  JESUS','COLON','2420866','santiago.peralta@pined.ec','7','3/18/2019','1352276487','MASCULINO','1/1/2000','PORTOVIEJO','NINGUNO','1','EI'],
			['MERINO REZABALA','GERALD GABRIEL','EL NARANJO','2420505','andreitakatherine@hotmail.com','8','3/11/2019','1352339566','MASCULINO','4/25/2016','PORTOVIEJO','CNH','1','EI'],
			['ARTEAGA GALARZA','JESUS JHAREN','EL LIMON','2000543','titicris14789@hotmail.com','9','4/7/2019','1352345241','MASCULINO','4/19/2016','PORTOVIEJO','NINGUNO','1','EI'],

			//INICIAL 2 A-2
			['ZAMBRANO PARRAGA','NIKY STALYN','LA MOCORA','2420463','niky.zambrano@pined.ec','10','4/11/2019','1351976194','MASCULINO','11/16/2014','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['BRAVO GARCIA ISMAELALESSANDRO','','EL NARANJO','S/N','mikidenissem@hotmail.com',
			'11','4/23/2019','1352021172','MASCULINO','1/19/2015','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['VITERI MENENDEZ','SOPHIA GUADALUPE','EL LIMON','2044136','rovisome@hotmail.com','12','4/11/2019','135200775','MASCULINO','12/22/2014','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['MOLINA OJEDA','IVAN ANDRES','SANTA ANA','2431739','ivan-chino77@hotmail.com','13','4/8/2019','1352073231','FEMENINA','3/20/2015','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['PEREZ ALCIVAR','MATIAS','EL NARANJO','2001232','matias.perez@pined.ec','14','3/4/2019','1352057150','MASCULINO','2/28/2015','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['MOREIRA BRAVO','JOSTYN ISRAEL','EL LIMON','2001641','gladysloor_22@hotmail.com','15','5/2/2019','1351960180','MASCULINO','10/27/2014','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['CEVALLOS SANTANA','ALAN ALEJANDRO','ESTANCIA VIEJA','420075','alan.cevallos@pined.ec','16','03/004/2019','1311970659','MASCULINO','11/21/2014','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['CHICA GUERRERO','FERNANDO RAFAEL','EL NARANJO','S/N','gemita19941@hotmail.com','17','03/19/2019','1352040651','MASCULINO','1/1/2000','PORTOVIEJO','NINGUNA','2','EI'],
			['GONGORA TAPIA','ANDERSON SANTIAGO','EL NARANJO','S/N','anderson.gongora@pined.ec','18','03/21/2019','1351984925','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['QUIROZ PONCE','MARIA JOSE','EL CADY','2420592','maria.quiroz@pined.ec','19','3/13/2019','1352131765','FEMININA','1/1/2000','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['BRIONES MENDIETA','WALTER EDUARDO','EL NARANJO','S/N','walter.briones@pined.ec','20','4/9/2019','1352219974','MASCULINO','7/24/2015','PORTOVIEJO','NINGUNA','2','EI'],
			['LOOR','IAN','EL NARANJO','S/N','ian.loor@pined.ec','21','1/1/20000','1111111111','MASCULINO','1/1/2000','PORTOVIEJO','NINGUNA','2','EI'],
			['PICO VIDAL','KAREN','EL LIMON','S/N','karen.pico@pined.ec','22','1/1/20000','1111111111','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['BAZURTO PICO','SOFIA','EL LIMON','S/N','sofia.bazurto@pined.ec','23','1/1/20000','1111111111','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','2','EI'],
			['MACIAS MIELES','SERGIO THADEO','EL NARANJO','S/N','sergio.macias@pined.ec','24','1/1/20000','1111111111','MASCULINO','1/1/2000','PORTOVIEJO','NINGUNA','2','EI'],
			['BRIONES MACIAS','JOSTYN','EL NARAJO','S/N','jostyn.briones@pined.ec','25','1/1/20000','1111111111','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','2','EI'],

			//PRIMERO A-3
			['AGUILAR CEDEÑO','GISLEY VALENTINA','EL LIMON','431116','mariaveronica2112@hotmail.com','26','4/18/2019','13511382062','MASCULINO','1/2/2014','PORTOVIEJO','AUGUSTA UGALDE','3','EGB'],
			['CEVALLOS AVILA','DAYANA JULEISY','EL NARANJO','S/N','dayana.cevallos@pined.ec','27','1/1/20000','1111111111','MASCULINO','1/1/2000','PORTOVIEJO','','3','EGB'],
			['CEVALLOS BRIONES','MARIA EMILIANA','EL NARANJO','2421280','maria.cevallos@pined.ec','28','3/18/2019','1351004872','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','3','EGB'],
			['GARCIA BAQUE','SHIARETH DARIANA','MONTECRISTE','S/N','dayan_vd1994@hotmail.com','29','4/1/2019',
			'1351876022','FEMENINO','8/8/2014','PORTOVIEJO','SANTA MARTHA','3','EGB'],
			['LOOR MACIAS','AMY ALEJANDRA','EL LIMON','417705','alemaciash-156@outlook.com','30','4/3/2019','1351764269','FEMENINO','5/15/2014','PORTOVIEJO','SANTA MARTHA','3','EGB'],
			['MENDOZA PALMA','MILTON LEANDRO','EL N ARANJO','S/N','milton.mendoza@pined.ec','31','3/21/2019','1351144678','MASCULINO','1/1/2000','PORTOVIEJO','REMIGIO BRIONES','3','EGB'],
			['MERO MACIAS','KEYLI YULIBETH','EL CADY -COLON','S/N','ylmacias96@hotmail.com','32',
			'3/11/2019','1351845209','FEMENINA','7/22/2014','PORTOVIEJO','SIMON BOLIVAR','3','EGB'],
			['MORILLO DELGADO','EIZA PAULETTE','EL NARANJO','420604','teresadelgado1994@hotmail.com','33','4/15/2019','1351015126','FEMENINA','9/30/2013','PORTOVIEJO','SANTA MARTHA','3','EGB'],
			['PICHUCHO GARCIA','ALAN ALESSANDRO','EL NARANJO','2420210','rossygarcia1997@hotmail.com','34','4/10/2019','1351778913','MASCULINO','20114/06/01','PORTOVIEJO','REMIGIO BRIONES','3','EGB'],
			['PINARGOTE ZAMBRANO','TYLER DAVID','EL LIMON','2000504','mrzp_73@hotmail.com','35','4/18/2019','135168967','MASCULINO','4/15/2014','PORTOVIEJO','AUGUSTA UGALDE','3','EGB'],
			['RESABALA SALTOS','ADRIANA SHARYTH','EL CADY','S/N','adriana.resabala@pined.ec','36','1/1/2000',
			'1111111111','FEMENINA','1/1/2000','PORTOVIEJO','','3','EGB'],

			//SEGUNDO A-4
			['SORNOZA MAYORGA',' EIMY AINHOA','LA MOCORA','420659','mayc30@hotmail.com','37','4/22/2019','1350988000','FEMENINA','9/8/2015','PORTOVIEJO','SAN RAFAEL','4','EGB'],
			['VERGARA CEVALLOS','JULLIAN STEFANO','','2430467','ceci_1431@hotmail.com','38','4/17/2019','1351606239','MASCULINO','4/6/2014','PORTOVIEJO','RIO PORTOVIEJO','4','EGB'],
			['ZAMBRANO AGUAIZA','DANNA LEONELA','','2442900','mariaaguaiza@gmail.com','39','3/21/2019','1351893365','FEMENINA','1/1/2000','PORTOVIEJO','ESPIRITO SANTO','4','EGB'],
			['ARTEAGA PARRAGA','DOMENICA SOFIA','EL CADY','2420012','domenica.arteaga@pined.ec','40','4/3/2019','1317294773','FEMENINA','1/14/2013','PORTOVIEJO','SANTAMARTHA','4','EGB'],
			['BAZURTO MOREIRA','ASHLEY MELINA','EL LIMON','2000490','jennyedgar14@hotmail.com','41','4/9/2019','1350709539','FEMENINA','4/3/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['BRAVO CEME','CESAR MATHIAS','EL LIMON','S/N','mariafcm_95@hotmail.com','42',
			'4/15/2019','1350899926','MASCULINO','6/6/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['CEVALLOS SANTANA','KATALEHIA ALEJANDRA','ESTANCIA VIEJA','2420075','katalehia.cevallos@pined.ec','43','4/3/2019','1317158952','FEMENINA','10/21/2012','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['CLAVIJO PICO','LUISANA DAMARIS','COLON','S/N','normi24@live.com','44','4/22/2019',
			'1350944698','FEMENINA','20103/08/12','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['GARCIA ALCIVAR','MARIA ALEJANDRA','MOCORA','2420153','verocal2008@hotmail.com','45','4/12/2019','1350364483','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['GARCIA VELEZ','EVELYN AINOHA','EL NARANJO','S/N','jessyvelez15@hotmail.com',
			'46','4/16/2019','1317372272','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['GOMEZ VELASQUEZ','DULCE SELENA','LA MOCORA','S/N','yadira_marianela@hotmail.com','47',
			'3/13/2019','1317313144','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['GUEVARA CEDEÑO ','MIGUEL SANTHIAGO','','S/N','miguel.guevara@pined.ec','48','3/13/2019',
			'1311714156','MASCULINO','10/13/2012','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['MIELES UBILLUS','DANNA THAYLLIN','EL NARANJO','S/N','danna.mieles@pined.ec','49','3/13/2019',
			'1350868822','FEMENINA','2/1/2014','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['MOLINA SALTOS','MATEO NICOLAS','EL CADY','S/N','mateo.molina@pined.ec','50','3/11/2019',
			'1350745715','MASCULINO','4/7/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['MOREIRAMORRILLO','ALEXIS JAIR','EL LIMON','2000539','leikar_21@hotmail.com','51','3/12/2019','131762893','MASCULINO','4/6/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['MOREIRA ZAMBRANO','MIGUEL STEFANO','CALLE LAS ACACIAS','2431879','dezasa@hotmail.com','52','4/3/2019','1317123790','MASCULINO','11/13/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['PERALTA OCHOA','MARIA PAULA','COLON','2420866','maria.peralta@pined.ec','53','3/18/2019','1350892590','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['PERALTA PARRAGA','LUISANA VALENTINA','EL LIMON','20001374','luisana.peralta@pined.ec','54',
			'3/18/2019','131737402','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['ROJAS ESPINOZA','ANALY FERNANDA','PACHINCHE AFUERA','S/N','pedrorojas1981@hotmail.com',
			'55','3/15/2019','1317127932','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['TAPIA VELIZ','BRAYLIN STUARD','EL NARANJO','2420234','valeriaveliz69@hotmail.es','56','3/26/2019','1317160230','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['VERA MENDOZA','SHARA MICHELLE','EL NARANJO','S/N','shara.vera@hotmail.com','57',
			'4/22/2019','1310482409','FEMENINO','2/9/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],
			['ZAMBRANO LOOR','VALESKA GUADALUPE','EL LIMON','2431021','valeska.zambrano@pined.ec','58','5/7/2019',
			'1311804668','FEMENINO','6/15/2013','PORTOVIEJO','SANTA MARTHA','4','EGB'],

			//TERCERO A-5
			['BRIONES INTRIAGO','YANDRY JOMAR','EL NARANJO','2421145','isabel-intriago12@hotmail.com','59','13/03/20109','1317017539','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['BRIONES MACIAS','NASHLY FIORELLLA','EL NARANJO','S/N','alexa_888@hotmail.com','60','3/27/2019',
			'1317017539','FEMENINO','3/27/2019','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['BRIONES MENENDEZ','JOHAN ARMANDO','LOS ANGELES','S/N','johan.briones@pined.ec','61','3/26/2019',
			'1350296230','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['CEVALLOS MERA','THIAGO JUNIER','EL LIMON','S/N','gabrielameramecias@gmail.com','62',
			'3/13/2019','1317048260','MASCULINO','9/3/2013','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['GARCIA ALCIVAR','ROQUE ANDREE','LA MOCORA','24220897','enrosario@gmail.com','63','4/1/2019','1351357148','MASCULINO','2011/27/09','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['GONZALES SANTANA','JEREMY JESUS','EL LIMON','2000515','maribel.santameza@gmail.com','64','3/13/2019','1350246573','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['GOROZABEL CEDEÑO','SANTIAGO DANIEL','EL LIMON','2000744','mary_83@hotmail.com','65','4/17/2019','1317886487','MASCULINO','11/4/2011','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['MACIAS DELGADO','KEYLA STEFANY','EL NARANJO','S/N','keylamacias@pined.ec','66','3/19/2019',
			'1316966470','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['MACIAS PALMA','MATHIAS GEOVANNY','EL LIMON','2000550','mathias.macias@pined.ec','67','4/25/2019','1351864713','MASCULINO','10/8/2011','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['MENDOZA ZAMBRANO','DANIA EDUARDA','COLON','S/N','tanniaz19@yahoo.com','68','4/4/2019',
			'1350196620','FEMENINO','1/16/2012','PORTOVIEJO','CRISTO REY','5','EGB'],
			['MERA ALAVA','DUMAR ROUSSET','EL CADY','S/N','dumar011@hotmail.com','69','4/30/2019',
			'1350366603','MASCULINO','9/12/2011','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['MOREIRA BRIONES','KIARA NICOLLE','EL NARANJO','S/N','kiara.moreira@pined.ec','70','4/30/2019','1351903115','FEMENINO','1/23/2012','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['NAZARENO ZAMBRANO','ELIZABETH SOLANGE','ESTANCIA VIEJA','S/N','elizabeth.nazareno@pined.ec','71','3/13/2019','1317213922','FEMENINO','5/26/2014','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['QUIROZ PARRAGA','MAYDELIN ALEJANDRA','EL CADY','S/N','maydelin.quiroz@pined.ec','72'
			,'4/3/2019','1350749089','FEMENINO','10/21/2011','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['QUIROZ PONCE','MARCELA VALENTINA','EL CADY','2420592','marcela.quiroz@pined.ec','73','3/13/2019','1350181309','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['SANTANA ALCIVAR','MARCELO JESUS','LA MOCORA','2421005','erivi_2808@hotmail.es','74','3/26/2019','1350280416','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['SORNOZA CALLE','BRIHANNA GABRIELA','EL LIMON','2000769','eriksusana13@hotmail.com','75','3/13/2019','1317053310','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['VERA CARBO','JULIAN ALEXANDER','15 DE ABRIL Y PARAISO','2430802','julian.vera@pined.ec','76','4/1/2019','1316988961','MASCULINO','6/15/2012','PORTOVIEJO','SANTA MARTHA','5','EGB'],
			['ZAMBRANO PARRAGA','NIURKA NORIETH','LA MOCORA','2420463','niurka.zambrano@pined.ec','77','4/11/2019','1317104592','FEMENINO','9/16/2012','PORTOVIEJO','SANTA MARTHA','5','EGB'],

			//CUARTO A-6
			['ANDRADE ESPINOZA','BAYRON MATHIAS','ESTANCIA VIEJA','2421247','laurita.e.espinoza@hotmail.com','78','3/14/2019','135051965','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','6','EGB'],
			['GOYTIA MIELES','AISHA VALENTINA','EL LIMON','S/N','dramiels@hotmail.com','79',
			'5/9/2019','1350079123','FEMENINO','1/8/2011','PORTOVIEJO','TENIENTE HUGO ORTIZ','6','EGB'],
			['IBARRA VILLACRESES','MARIA JOSE','EL NARANJO','S/N','vibarragas65@yahoo.com','80',
			'4/1/2019','1350245849','FEMENINO','4/8/2011','PORTOVIEJO','LUCESITA','6','EGB'],
			['PEREZ ALCIVAR','SOFIA','EL LIMON','20001232','sofia.perez@pined.ec','81','4/3/2019','1350058853','FEMENINO','4/12/2011','PORTOVIEJO','SANTA MARTHA','6','EGB'],
			['PICO VIDAL','CARLITA DAILY','EL LIMON','S/N','carlita.pico@pined.ec','82','1/1/20000',
			'1111111111','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','6','EGB'],
			['VERA CARBO','AARON SEBASTIAN','15 DE ABRIL Y PARAISO','2430802','aaron.vera@pined.ec','83','4/1/2019','952737674','MASCULINO','3/13/2011','PORTOVIEJO','SANTA MARTHA','6','EGB'],

			//QUINTO A-7
			['BASURTO PICO','TAHIZ JIMILETH','EL LIMON','S/N','tahiz.basurto@pined.ec','84','1/1/20000',
			'1315912913','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['CEVALLOS BRIONES','EDISON FABIAN','EL NARANJO','2421280','edison.cevallos@pined.ec','85','1/1/20000','1351618978','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['GARCIA FERNANDEZ','MAYDELIN NOHELIA','EL NARANJO','2043100','gema1990may@hotmail.com','86','4/1/2019','1317896619','FEMENINO','10/28/2009','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['GONGORA TAPIA','ANGELA FERNANDA','EL NARANJO','S/N','angela.gongora@pined.ec',
			'87','3/21/2019','1315699544','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['IBARRA GARCIA','LEONARDO WLADIMIR','EL LIMON','200864','hildaig4@hotmail.es','88','4/10/2019','1315804235','MASCULINO','2/4/2010','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['MACIAS PONCE','RUMARI MAHLI','EL LIMON','S/N','rumari.macias@pined.ec','89',
			'3/15/2019','1350306807','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['MOREIRA QUIROZ','JEMBER DAVID','EL NARANJO','2421163','jember.moreira@pined.ec','90','3/19/2019','1350404776','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','7','EGB'],
			['RODRIGUEZ QUIROZ','ROUSMERYE MIKAELA','EL LIMON','2000624','rousmerye.rodriguez@pined.ec','91','4/17/2019','1350479414','FEMENINO','3/17/2010','PORTOVIEJO','LORENZO LUZIRIAGA','7','EGB'],

			//SEXTO A-8
			['FERNANDEZ CEDEÑO','MAYKELL JOSEPH','EL NARANJO','2420470','maykell.fernandez@pined.ec','92','180/03/2019','1351619000','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['GARCIA GARCIA','JOSEPH PAUL','LA MOCORA','S/N','joseph.garcia@pined.ec','93',
			'3/18/2019','1350223960','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['MEDRANDA DELGADO','KARLA EDITH','EL NARANJO','S/N','barabaradelgadop@gmail.com','94',
			'3/21/2019','1315985752','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['ORMAZA QUIROZ','MATEO BENJAMIN','EL LIMON','2000537','mateo.ormaza@pined.ec','95','3/18/2019','1315532059','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['PICO ROLDAN','PEDRO JARETH','EL LIMON','S/N','roony_241@hotmail.com','96',
			'4/16/2019','1351302219','MASCULINO','5/8/2009','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['VERA CARBO','PAULINA DENISSE','15 DE ABRIL Y PARAISO','S/N','paulina.vera@pined.ec','97',
			'4/1/2019','1727372664','FEMENINA','10/15/2009','PORTOVIEJO','SANTA MARTHA','8','EGB'],
			['VERA MENDOZA','DAVID URIEL','EL NARANJO','S/N','david.vera@pined.ec','98',
			'4/22/2019','1316173408','MASCULINO','4/22/2019','PORTOVIEJO','SANTA MARTHA','8','EGB'],

			//SEPTIMO A-9
			['ALCIVAR LOOR','MARBY GINELL','EL LIMON','2001228','marjoryloor1979@gmail.com','99','3/18/2019','1350331078','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['CEVALLOS MERA','JURIEL JOAQUIN','EL LIMON','2000593','juriel.cevallos@pined.ec','100','3/18/2019','1316162799','MASCULINO','3/18/2019','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['ESPINOZA ZAMBRANO','IVIS DOMENICA','ESTANCIA VIEJA','S/N','ivis.espinoza@pined.ec','101','3/19/2019','1315775583','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['FRANCO ALCIVAR','MELANY NAHOMY','MEDARDO CEVALLOS','2650402','melany.franco@pined.ec','102','3/19/2019','1351547318','FEMENINO','9/6/2008','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['LOOR ZAMBRANO','SASKYA NATASHA','COLON','S/N','saskya.loor@pined.ec','103',
			'1/1/20000','1234567890','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['MACIAS ALCIVAR','DOMENICA TAIRISHA','EL GUABITO','2001581','domenica.macias@pined.ec','104','3/18/2019','1351621246','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['PERALTA PARRAGA','EMILY JULIETH','EL LIMON','20001374','emily.peralta@pined.ec','105','3/18/2019','131616274','FEMENINA','1/1/2000','PORTOVIEJO','SANTA MARTHA','9','EGB'],
			['RODRIGUEZ QUIROZ','BIANKA ANDREINA','EL LIMON','2000624','bianka.rodriguez@pined.ec','106','4/17/2019','1350479448','FEMENINO','8/1/2008','PORTOVIEJO','LORENZO LUZIRIAGA','9','EGB'],
			['ZAMBRANO AGUAIZA','DOMENICA ABIGAIL','CALLE VICENTE MACIAS','S/N','domenica.zambrano@pined.ec','107',
			'3/21/2019','1315912772','FEMENINA','1/1/2000','PORTOVIEJO','MARTHA BUCARAN DE ROLDOS','9','EGB'],

			//OCTAVO A-10
			['BRIONES MENENDEZ','HUBER ARMANDO','LOS ANGELES','340309','huber.briones@pined.ec',
			'108','3/26/2019','1315989846','MASCULINO','1/1/2000','PORTOVIEJO','','10','EGB'],
			['CEVALLOS LOOR',' ANGEL JOSHUA','','S/N','angel.cevallos@pined.ec','109',
			'3/26/2019','1350121966','MASCULINO','6/29/2007','PORTOVIEJO','REMIGIO BRIONES','10','EGB'],
			['IBARRA VILLACRESES','VICTOR JOSE','EL NARANJO','S/N','victor.ibarra@pined.ec','110',
			'4/1/2019','1350245880','MASCULINO','1/25/2008','PORTOVIEJO','LUCESITA','10','EGB'],
			['MACIAS CEDEÑO','AYANE JULIE','EL NARANJO','S/N','ayane.macias@pined.ec','111',
			'4/10/2019','1316342334','FEMENINA','6/22/2007','PORTOVIEJO','SANTA MARTHA','10','EGB'],
			['MOREIRA CHINGA','KRISS ELIZABETH','EL LIMON','432070','kriss.moreira@pined.ec','112','4/7/2019','1317871844','FEMENINA','7/14/2007','PORTOVIEJO','LORENZO LUZIRIAGA','10','EGB'],
			['ZAMBRANO MACIAS','BRITHANY SAMIA','EL GUABITO','S/N','brithany.zambrano@pined.ec','113',
			'4/17/2019','1350741227','FEMENINO','3/17/2010','PORTOVIEJO','SANTA MARTHA','10','EGB'],

			//NOVENO A-11
			['ALCIVAR ZAMBRANO','JHONNY JAVIER','LA MOCORA','S/N','jhonny.alcivar@pined.ec',
			'114','1/1/20000','1111111111','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['CEDEÑO ZAMBRANO','LUIS MARIO','EL LIMON','2001381','luis.cedeno@pined.ec','115',
			'3/19/2019','1314469907','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['ESPINOZA ESPINOZA','MELANIE ROMINA','ESTANCIA VIEJA','2420707','melanie.espinoza@pined.ec','116','3/19/2019',
			'1350977714','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['IBARRA GARCIA','DOMENICA ISABELLA','EL LIMON','200864','domenica.ibarra@pined.ec','117',
			'4/10/2019','1315528107','FEMENINO','7/7/2006','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['MENDOZA MIELES','RICARDO JAIR','EL NARANJO','2421074','ricardo.mendoza@pined.ec','118','4/3/2019',
			'1350097166','MASCULINO','4/3/2019','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['MENDOZA ZAMBRANO','ZOE KARINA','EL NARANJO','2421074','zoe.mendoza@pined.ec','119',
			'4/3/2019','1316626878','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['MOREIRA SOLORZANO','DANNY JOSTYN','EL NARANJO','S/N','danny.moreira@pined.ec','120','3/19/2019',
			'1316442480','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['PARRAGA FERNANDEZ','HELLEN ANAHI','EL NARANJO','S/N','hellen.parraga@pined.ec','121','1/1/20000',
			'1111111111','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],
			['TAPIA VELIZ','SCARLETTE NATASHA','EL NARANJO','2420234','scarlette.tapia@pined.ec',
			'122','3/26/2019','1350404040','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','11','EGB'],

			//DECIMO A-12
			['ALCIVAR PALMA','ERICK GONZALO','LA MOCORA','2421005','erick.alcivar@pined.ec','123','4/22/2019','1314011329','MASCULINO','2005/24/10','PORTOVIEJO','SANTA MARTHA','12','EGB'],
			['FERNANDEZ BRIONES','XIMENA LUCRECIA','','S/N','ximena.fernandez@pined.ec','124','1/1/20000','1111111111','FEMENINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','12','EGB'],
			['MACIAS PONCE','JEREMMY JONAS','EL LIMON','S/N','jeremy.macias@pined.ec','125','3/19/2019','1350306849','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','12','EGB'],
			['SOLORZANO PINARGOTE','ERWIN ALEXIS','EL NARANJO','S/N','erwin.solorzano@pined.ec','126','3/19/2019','1316660313','MASCULINO','1/1/2000','PORTOVIEJO','SANTA MARTHA','12','EGB'],
			['ZAMBRANO LOOR','LUIS ALBERTO','EL LIMON','2431021','luis.zambrano@pined.ec','127','5/7/2019','1350064372',
			'MASCULINO','4/15/2005','PORTOVIEJO','SANTA MARTHA','12','EGB']

		);

		$idPeriodo = PeriodoLectivo::where('nombre', '2019-2020')->first();
		
		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
			$student->ci = $key[7];
			$student->nombres = $key[1];
			$student->apellidos = $key[0];
			$student->sexo = $key[8];
			$student->fechaNacimiento = $key[9];
			$student->ciudad = $key[10];
			$student->direccion = $key[2];
			$student->matricula = 'Ordinaria';
			$student->idCurso = $key[12];
			$student->institucionAnterior = $key[11];
			$student->fecha_matriculacion = $key[6];
			$student->telefono = $key[3];
			$student->retirado= 'NO';
			
			//SE GUARDA LA SECCION DEPENDIENDO DEL CURSO
			$student->seccion = $key[13];
			
			// Se guarda el número de la matricula con la configuración general
			$cont = Student2::all()->where('matricula', '!=','Pre Matricula')->count();
			$fecha = $key[6];
			$student->numeroMatricula = $fecha."-".sprintf("%04d", $cont+1);
			$date = Carbon::now();
			$fechaMatricula = $date->toDateString($key[6]);
			$student->save();

			// SE GUARDA REGISTRO EN LA NUEVA TABLA ESTUDIANTE POR AÑO
			$dataProfile = Student2Profile::create([
				'fecha_matriculacion' => $fechaMatricula,
				'idCurso' => $student->idCurso,
				'idPeriodo' => $idPeriodo->id,
				'idStudent' => $student->id,
				'seccion' => $student->seccion,
				'tipo_matricula' => $student->matricula,
				'ciudad_domicilio' => $student->ciudad,
				'direccion_domicilio' => $student->direccion,
				'retirado' => 'NO',
			]);
			
			$this->creacionDeAsistenciaParcial($dataProfile->id, $idPeriodo);
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
	}
	public function creacionDeAsistenciaParcial($idStudent, $idPeriodo) {
		$parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
		foreach ($parciales as $parcial) {
			AsistenciaParcial::create([
				'idStudent' => $idStudent,
				'parcial' => $parcial,
				'idPeriodo' => $idPeriodo->id,
			]);
		}
	}
}