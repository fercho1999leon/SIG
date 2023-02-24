<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class EstudiantesMiguelAngelZambranoSeeder extends Seeder
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

            ['0956458301','CAMILA JAZLYN','ANCHUNDIA BARREIRO','Masculino','1'],
            ['0958907875','HECTOR SANTIAGO','ARREAGA TREJO','Masculino','1'],
            ['0958888752','JUAN DIEGO','BAJAÑA YEPEZ','Masculino','1'],
            ['0956484133','ETHAN JARED','BAQUERIZO PERALTA','Masculino','1'],
            ['0959203233','ASHLEY SAHARA','CALLE CEVALLOS','Masculino','1'],
            ['0959474602','DOMENIK NUBRAZCA','CASTRO SOLIZ ','Masculino','1'],
            ['0932407349','SARAY ABIGAIL','CEDEÑO ALVARADO','Masculino','1'],
            ['0959740143','NELLY DAILYD ','ESPINOZA RIOS ','Masculino','1'],
            ['0932580046','SAMUEL ISAAC','HUARACA CHICAIZA','Masculino','1'],
            ['0959309667','SCARLETTE LEONOR','LLAMUCA REYES ','Masculino','1'],
            ['0958924359','RONNY EZEQUIEL','LOPEZ CABRERA ','Masculino','1'],
            ['0958975633','IVAN EZEQUIEL ','MALDONADO ABRIL ','Masculino','1'],
            ['0932586613','KATHERLEY DAYANA ','MONAR ZAMBRANO ','Masculino','1'],
            ['1755998570','EITHAN DRAKE ','ORTIZ PUYA ','Masculino','1'],
            ['0958328346','KIMBERLY MICAELA','PACHECO MERA ','Masculino','1'],
            ['1317403705','CATTEYA SARAI','QUIJIJE BOLAÑOS','Masculino','1'],
            ['0960689115','CAROS STEFANO','RAMOS BEJARANO ','Masculino','1'],
            ['0958816761','MARIA DE LOS ANGELES','ROSALES ZAMBRANO','Masculino','1'],
            ['0956411128','AINOHA ODALES','VALAREZO REINOSO','Masculino','1'],
            ['1251388367','ANDREA YULIETH','VERA SUAREZ','Masculino','1'],


            // SEGUNDO A

            ['0955397559','CORAIMA NOELIA','BAJAÑA YEPEZ','Masculino','2'],
            ['0954731493','LESLY ASHLEY','BONE MANTILLA','Masculino','2'],
            ['0954073250','DARIO JAVIER','CHAVEZ NARANJO ','Masculino','2'],
            ['0955657911','ELIZABETH NICOLE','DIAS TROYA','Masculino','2'],
            ['0952673192','NATHALY BEATRIZ','DIAS TROYA','Masculino','2'],
            ['0956857973','ELKIN MATHIAS','HERRERA BAZURTO','Masculino','2'],
            ['0959194416','ALINA RAFAELA','JARRIN CORDOVA','Masculino','2'],
            ['0954255683','WINTER ERNESTO','LIBERIO PINARGOTE','Masculino','2'],
            ['0961062874','KEVIN SAUL','MAZAMBA CEDEÑO','Masculino','2'],
            ['0955408315','ASHLEY ESTHER','MEJIA ESTRELLA','Masculino','2'],
            ['0954828943','KAREN LILIANA','MORAN LOOR','Masculino','2'],
            ['0956448575','GARY STEVENS','MORAN MEDINA','Masculino','2'],
            ['0956320790','MARCELT MILAN','ORDOÑEZ HURTADO','Masculino','2'],
            ['0956330567','JANDRY JARED','RODRIGUEZ SALTOS','Masculino','2'],
            ['0932232689','DAYANARA DE LOS ANGELES','SUAREZ RODRIGUEZ','Masculino','2'],
            ['0956368013','JIMMY ESTEVAN','VILLAMAR RIVERA','Masculino','2'],


            // TERCERO A

            ['0951859800','MADELINE ARLETH','CALDERON LOPEZ','Masculino','3'],
            ['0953284452','ANDREW MATHIAS','CARABAJO GUEVARA','Masculino','3'],
            ['0959651225','CRISTHIAN JARIEL','CASTRO SOLIZ','Masculino','3'],
            ['0950955757','JOHANNE JEREMY','CEDEÑO RODRIGUEZ','Masculino','3'],
            ['0955108626','BRITHANY GABRIELA','GARCIA CONTRERAS','Masculino','3'],
            ['0931970008','ROSSELYN ARIANNA','JARRIN CORDOVA ','Masculino','3'],
            ['0952712024','DENISSE FERNANDA','JIMENEZ ORTIZ','Masculino','3'],
            ['0123456789','SANTIAGO DAVID','MORALES FLORES','Masculino','3'],
            ['0953829769','MILLER DANIEL','PACHECO PIZA ','Masculino','3'],
            ['0955760830','MAILY ESTHER','PALMA PARRALES','Masculino','3'],
            ['0650096043','JAVIER ALEXANDER','PEREZ PINTA','Masculino','3'],
            ['0959677923','VALENTINA SHANNEL','RIVERA ALVARADO','Masculino','3'],
            ['0955983523','KARLA JAYLENE','ROSALES ZAMBRANO','Masculino','3'],
            ['0123456789','NAOMI ALEJANDRA','VARGAS VERA','Masculino','3'],
            ['0955092499','VANESSA MARIA','VECILLA DOMINGUEZ','Masculino','3'],
            ['0956595235','GIAN LUCAS','VILLENA VERA','Masculino','3'],
            ['0954231171','GABRIEL ISAAC','ZUMBA PAZMIÑO','Masculino','3'],


            // CUARTO A

            ['0931893598','JEREMY ALEXANDER','AGUILERA CEDEÑO','Masculino','4'],
            ['0958939209','JANDRY SAMUEL','ARREAGA TREJO','Masculino','4'],
            ['0952284024','MAICKOL XAVIER','ARROYO ONOFRE','Masculino','4'],
            ['0958712408','ANGELA DAMARIS','BRAVO CASTILLO','Masculino','4'],
            ['0951928233','RAFAEL MISAEL','BRIONES ANGUS','Masculino','4'],
            ['0957770175','EMILY PAULETTE','BUENAÑO COTALLAT ','Masculino','4'],
            ['0941915373','GABRIELA PAULINA','CARRILLO PAREDES','Masculino','4'],
            ['0958311763','DYLAN MATHIAS','CEDEÑO BRIONES','Masculino','4'],
            ['0951594803','MANUEL TOBIAS','GAVILANES ESTRADA','Masculino','4'],
            ['0953177755','SCARLETH VALENTINA','GUERRERO CARVAJAL','Masculino','4'],
            ['0953062684','JOSE DANIEL','JARAMILLO MONTERO','Masculino','4'],
            ['0931807325','KIARA CECILIA','MEJIA ESTRELLA','Masculino','4'],
            ['0123456789','JULIAN MATIAS','MONTALVO GUAMAN','Masculino','4'],
            ['0955470679','MARVIN ARIEL','MONTES VILLACRES','Masculino','4'],
            ['0959599945','LORENA CAROLINA','MORAN NUÑEZ','Masculino','4'],
            ['0952657211','DEIVI MIGUEL','MOREIRA GOMEZ ','Masculino','4'],
            ['0940342207','ALEJANDRA ELIZABETH','NOLE ARCOS','Masculino','4'],
            ['0123456789','JOSUE DANIEL','ORDOÑEZ CUEVA','Masculino','4'],
            ['0952143030','SHEYLA SOLANGE','ORDOÑEZ HURTADO','Masculino','4'],
            ['0952020162','ANGEL ADRIAN','PISFIL DELGADO','Masculino','4'],
            ['0953558814','MARIA DEL CARMEN','RIOS LAVANDA','Masculino','4'],
            ['0951464353','MATEO JOEL','RIVADENEIRA HERNANDEZ ','Masculino','4'],
            ['0952975654','RENATA VALENTINA','SOLANO GUZMAN ','Masculino','4'],
            ['0952397602','AXEL WLADIMIR','TAPIA QUIMIS','Masculino','4'],
            ['0951906692','KARLA XIOMARA','VARGAS CEPEDA','Masculino','4'],


            // QUINTO A

            ['0123456789','RUTH GEOVANNA','ALULEMA FIGUEROA ','Masculino','5'],
            ['0955761622','MIGUEL ANTONIO','CARCELEN MORALES','Masculino','5'],
            ['0952211688','ALISSON KATIUSKA','CARVAJAL PIEDRAHITA','Masculino','5'],
            ['0957819469','AARON ARMANDO','CEDEÑO CUSME','Masculino','5'],
            ['0950381319','EMILY ARIANA','HIDALGO VELEZ','Masculino','5'],
            ['0953113792','RENATO NILMAR','MARTINEZ ARANA','Masculino','5'],
            ['0952408391','ZULLY ESTHEFANIA','MOREIRA ARIAS','Masculino','5'],
            ['0942745274','JEANPIERRE MAURICIO','MOTA COLOMA','Masculino','5'],
            ['0953356482','DYLAN JAVIER','OCHOA AVILES','Masculino','5'],
            ['0952628287','JEREMIAS BENJAMIN','PAREDES SANCHEZ','Masculino','5'],
            ['0941915720','ANA PAULA','PAZ BALLESTEROS','Masculino','5'],
            ['0951264746','DAVIS SEBASTIAN','PIN ROMERO','Masculino','5'],
            ['0950949040','MIGUEL ANGEL','QUINDE REYES','Masculino','5'],
            ['0951432277','VALERIA PAULINA','RUIZ VARAS','Masculino','5'],
            ['0931529341','FERNANDO ISAIAS','SOLANO GUZMAN ','Masculino','5'],
            ['0958785750','KIMBERLY ALEJANDRA','TOALA MARQUEZ','Masculino','5'],
            ['0931288336','DOMINIQUE ANAIS','VILLENA VERA','Masculino','5'],
            ['0931523518','MIGUEL AARON','ZUMBA PAZMIÑO','Masculino','5'],
            

            // SEXTO A

            ['0931306336','BRITNEY CRISTINE','AGUILERA CEDEÑO','Masculino','6'],
            ['0958341216','ERICK DANIEL','ATANCURI VARGAS','Masculino','6'],
            ['0804211316','JOHN TERRY','BONE MANTILLA','Masculino','6'],
            ['0958270050','MIKE ARIEL','BRAVO SAONA','Masculino','6'],
            ['0175368583','ELIAN ISMAEL','CALDERON SALTOS','Masculino','6'],
            ['0958239733','JOHNNY JOSE','CONDOR ALMEIDA','Masculino','6'],
            ['0941972630','DIANA LISBETH','GUERRERO CARVAJAL','Masculino','6'],
            ['0958272189','BRITANY ELIZABETH ','GUTIERREZ AGUIRRE ','Masculino','6'],
            ['0958347676','ADRIAN JOSUE ','HIDALGO BUSTAMANTE ','Masculino','6'],
            ['1729925642','MELANIE MICHELLE ','JIMENEZ LOGROÑO','Masculino','6'],
            ['0123456789','CRISTHIAN MARCELO','LARREA ROSADO','Masculino','6'],
            ['0941916637','GENESIS NATASHA','MEDINA ORNA','Masculino','6'],
            ['0954162053','DAMARIS RAQUEL','MORAN NUÑEZ','Masculino','6'],
            ['0954649760','STEVEN GABRIEL','MURILLO INGA','Masculino','6'],
            ['0958005027','MICHAEL LEONEL','MUÑOZ TORRES','Masculino','6'],
            ['0123456789','JUAN DAVID ','OSSA MORENO','Masculino','6'],
            ['0930851910','PAULET DAYANNA','PINARGOTE PEÑA','Masculino','6'],
            ['1351264120','ADRIANA MICHELLE','PISFIL DELGADO','Masculino','6'],
            ['0958371510','SAUL MOISES','PURIZAGA MACIAS','Masculino','6'],
            ['0850879347','ORIANA LISBETH','SOLIS SOLORZANO','Masculino','6'],
            ['0958723686','CAMILA THAIZ','TUBON FUENTES','Masculino','6'],
            ['0953304201','PAMELA NORELI','VELIZ TRIVIÑO','Masculino','6'],
            ['0951887777','KATHERINE JULEXI','ZAMBRANO ARROYO','Masculino','6'],
            ['0930903059','RICARDO ALEXANDER','ZUMBA PAZMIÑO','Masculino','6'],
            

            // SEPTIMO A

            ['0953760154','DANNA HILLARY ','ARGUELLO FLORES','Masculino','7'],
            ['0932500838','JUAN FELIPE ','BARAHONA BRAVO ','Masculino','7'],
            ['0944230358','ALEXIS YANDEL','BAZURTO BAQUERO','Masculino','7'],
            ['0951587260','JEAN PIERRE','CELI CASTRO','Masculino','7'],
            ['0943720565','GISELLE ALEXANDRA ','CORDOVA RIVERA','Masculino','7'],
            ['0955711320','DENISSE ALEXANDRA','ENRIQUEZ FLORES','Masculino','7'],
            ['0957224850','IGNACIO GEOVANNY','HAZ CARRILLO','Masculino','7'],
            ['0952629616','JIMMY JESUS','JARAMILLO LAY','Masculino','7'],
            ['0952149672','ALISSON ROMINA','MAZAMBA CEDEÑO','Masculino','7'],
            ['0951556836','KRISTELL KAROLAYN','ORDOÑEZ HURTADO','Masculino','7'],
            ['0943975409','KEVIN ALEXANDER','PACHECO LEON','Masculino','7'],
            ['0958115396','DOMENIK FRANCHESCA','PIN ROMERO','Masculino','7'],
            ['0957859812','ANTHONY REINALDO','PRECIADO MONSERRATE','Masculino','7'],
            ['0955114178','CRISTHIAN ISRAEL','RODRIGUEZ QUISPE','Masculino','7'],
            ['0804495000','JORGE ARMANDO','ROJAS BAUTISTA','Masculino','7'],
            ['0951864461','CARLOTA MICAELA','VALLEJO LUJANO','Masculino','7'],


            // OCTAVO A

            ['0955977368','ROMINA MARICELL','ALAVA  BONILLA','Masculino','8'],
            ['0953927175','VALESKA PAULETTE','AREVALO BAÑO','Masculino','8'],
            ['0960828978','CRISTIAN SEBASTIAN','ASTUDILLO PILOZO','Masculino','8'],
            ['0123456789','JAMILET ESTEFANIA','BARROS PAREDES','Masculino','8'],
            ['0943725366','GENESIS ABIGAIL','BRAVO CASTILLO ','Masculino','8'],
            ['0952510980','EMILY CAROLINA','CALDERON SALTOS','Masculino','8'],
            ['0605844190','DAVID ALEJANDRO','CAMPOVERDE ALCOCER','Masculino','8'],
            ['0944131291','ARLETTE VANESSA','CANDO GOMEZ','Masculino','8'],
            ['1729787919','MOISES ISAAC','CEDEÑO ALVARADO','Masculino','8'],
            ['0955317128','GEORGE JAIR','CHAVEZ HERNANDEZ','Masculino','8'],
            ['0951222678','JOHN SAMUEL','CONDOR ALMEIDA','Masculino','8'],
            ['0952790368','MELISSA AILEEN','CORREA BUENO','Masculino','8'],
            ['0941972218','NOHELIA ELIZABETH','DE JESUS MEDINA','Masculino','8'],
            ['0958014284','JUAN DIEGO','FLORES MONTOYA','Masculino','8'],
            ['0943475756','ALEXIS SAMIR','FRANCO CANTOS','Masculino','8'],
            ['0930445986','YAMILET JAQUELINE','GREFA DE LA CRUZ ','Masculino','8'],
            ['0952299089','MILENA EMELY','GUAMAN ALVARADO','Masculino','8'],
            ['0954115333','MARIA PAULA','GUTIERREZ ROMERO','Masculino','8'],
            ['0956744197','DANNY NELSON','HERRERA BAZURTO','Masculino','8'],
            ['0956743967','WILLIAM SEBASTIAN','HERRERA BAZURTO','Masculino','8'],
            ['0955716915','ELKIN ALEJANDRO','INDACOCHEA LEON','Masculino','8'],
            ['0953729621','ISAAC ISMAEL','LASCANO LEON','Masculino','8'],
            ['0958624595','KEVIN JESUS','MEDINA GARCES','Masculino','8'],
            ['0958581860','BRITHANY DAILYNG','MONTOYA SORNOZA','Masculino','8'],
            ['0941097453','JOSELIN VALERIA','MORETA SACOTO','Masculino','8'],


            // OCTAVO B

            ['0952392306','STEFANYA MICHELL','MAGALLANES MERCHAN','Masculino','9'],
            ['0123456789','JEFERSON ALEJANDRO','NIEVES PACHANO','Masculino','9'],
            ['0955810171','MAILER ABRAHAM','PALMA PARRALES','Masculino','9'],
            ['0952196046','SAMUEL JESUA','PAREDES SANCHEZ','Masculino','9'],
            ['0803553684','PAULO JAYDAN','PAZ BALLESTEROS','Masculino','9'],
            ['0929585438','NELSON DANIEL','PICO ONOFRE','Masculino','9'],
            ['0953358421','MARIO RENE','PINCAY QUIÑONEZ','Masculino','9'],
            ['0606297489','CARLA VICTORIA','PONCE VILLON','Masculino','9'],
            ['0956149553','ARIEL NICOLAI','PRECIADO MONSERRATE','Masculino','9'],
            ['0955078076','SCARLET JAMILETH ','RIVERA MIRANDA ','Masculino','9'],
            ['0957576853','DARLYN FELIPE','ROMERO POMADER','Masculino','9'],
            ['0944370303','DAYVER DANIEL','SANDOVAL POMADER','Masculino','9'],
            ['0953444809','MATHEUS DAVID','SOLORZANO SANDOVAL','Masculino','9'],
            ['0955797873','JOSE AARON','TRAVEZ PAZ','Masculino','9'],
            ['0955797428','MICHAEL DOUGLAS','TRAVEZ PAZ','Masculino','9'],
            ['0957701717','MARBELIS YELIMAR','VALLEJO ERAZO','Masculino','9'],
            ['0950525899','LISBETH NARCISA','VALLEJO VITE','Masculino','9'],
            ['0951910686','NAOMI YULEXI','VARGAS CEPEDA','Masculino','9'],
            ['0956314405','KAREN NOEMI','VILLAMAR RIVERA','Masculino','9'],
            ['1729274777','BRYAN ELIAS','ZAMBRANO ALVIA','Masculino','9'],
            ['0951887579','JUSTIN STALYN','ZAMBRANO ARROYO','Masculino','9'],
            ['0943674770','JOSE ANDRES','ZURITA VARGAS','Masculino','9'],


            // NOVENO A

            ['0950010157','CHRISTIAN JOSUE ','ACOSTA DE LA TORRE','Masculino','10'],
            ['0944379700','ELMO JOSUE','AGUIRRE ROBLES','Masculino','10'],
            ['0956279772','ANDRY AARON','ALAVA MENDEZ','Masculino','10'],
            ['0958262933','ASHLY ESTEFANIA','BAJAÑA SOBREVILLA','Masculino','10'],
            ['0940120967','PABLO ALEJANDRO','BARZALLO ZAMBRANO','Masculino','10'],
            ['0943301283','AXEL ADRIAN','BAZURTO BAQUERO','Masculino','10'],
            ['0951737568','GIA MARIE','BRAVO CEDEÑO','Masculino','10'],
            ['0957804453','RAUL ALESSANDRO','BUENAÑO COTALLAT','Masculino','10'],
            ['0951848803','AMANDA CAMILA','CABRERA BEDOYA','Masculino','10'],
            ['0941567786','MERLINA LUCIANA ','CANO RIOS','Masculino','10'],
            ['0950146845','DEIBY DUVAN','CASTILLO PRECIADO','Masculino','10'],
            ['0955493523','PIERINA PAULETTE','CASTRO TENORIO','Masculino','10'],
            ['0958681439','JOYCE SAMANTHA','CHAGUAY DELGADO','Masculino','10'],
            ['0953569555','JORGE PAUL','CHAMBA GUTIERREZ','Masculino','10'],
            ['0958623688','ANA ALEXANDRA','COX QUIÑONEZ','Masculino','10'],
            ['0958014359','JEAN PAUL','FLORES MONTOYA','Masculino','10'],
            ['0943579391','ODETTE ANAHI','GARCIA JARAMILLO','Masculino','10'],
            ['0952991420','TIFANNY NOELIA','GUADALUPE SAQUICELA','Masculino','10'],
            ['0941972648','ANGEL ALEXANDER','GUERRERO CARVAJAL','Masculino','10'],
            ['0953229358','DANILO DAVID','HUARACA NIAMA','Masculino','10'],
            ['0957615701','NEISER JAVIER','LOOR CARDENAS','Masculino','10'],
            ['0953747532','GRACE ELIANA','LOOR MACIAS','Masculino','10'],
            ['1350313589','KARLA GUADALUPE','LOOR REZABALA','Masculino','10'],
            ['0952694883','ROMINA DEL CARMEN','LOPEZ CABRERA','Masculino','10'],
            ['0943695114','ASHLEE DAYANARA','MONTES CONDOR','Masculino','10'],
            ['0956377113','MELQUICEDEC ADEMIR','NAVARRETE GUEVARA','Masculino','10'],
            ['0956005995','EMILY VALERIA','PACHECO LEON','Masculino','10'],
            ['1317673018','ALLISON JAMILETH','PISFIL DELGADO','Masculino','10'],
            ['0952009157','ASHELY NICCOL','RIOS ALARCON','Masculino','10'],
            ['0955199336','EDISON JOEL','RIVERA MIRANDA','Masculino','10'],
            ['0959126574','EZEQUIEL NEHEMIAS','RIVERA YUNDA','Masculino','10'],
            ['0956271787','JOSE GUSTAVO','SANIPATIN GUEVARA','Masculino','10'],
            ['1501308777','DANIELA ISABEL','SERRANO LOOR','Masculino','10'],
            ['1501314833','PEDRO LEONARDO','SERRANO LOOR','Masculino','10'],
            ['0803736479','MARIA MICHELLE','SOLIS SOLORZONO','Masculino','10'],
            ['0927900761','BRUNO JOAQUIN','TORRES CABELLO','Masculino','10'],
            ['0955092705','CARLOS MANUEL','VECILLA DOMINGUEZ','Masculino','10'],
            ['0941696650','ISAAC ALONSO','ZAMORA NAULA','Masculino','10'],
            

            // DECIMO A

            ['0650326390','KATHERYN PAULINA','AGUALSACA PEREZ','Masculino','11'],
            ['0942997743','CARLOS DANIEL','ALVARADO VERA','Masculino','11'],
            ['0941494056','RICHARD EDUARDO','BOLAÑOS VILLEGAS ','Masculino','11'],
            ['0956321905','GABRIELA DARLENE','CALERO RAMIREZ','Masculino','11'],
            ['0952276483','ASHLEY BRIGGITTE','CRUZ IDROVO','Masculino','11'],
            ['0943690586','CRISTHOFER MICHAEL','ESPINOZA MERCHAN','Masculino','11'],
            ['0953813292','HELEN DAYANARA','FRANCO TERAN','Masculino','11'],
            ['0956271936','EILEEN GEOVANNA','GINES VERA','Masculino','11'],
            ['0941239378','PEDRO ANTUAD','GOMEZ CAICEDO','Masculino','11'],
            ['0941776619','KAROLYN MILENA','GUTIERREZ SIERRA','Masculino','11'],
            ['0950301002','ZUKY JANETH','JIMENEZ FRANCO','Masculino','11'],
            ['0953729464','GENESIS TAMARA','LASCANO LEON','Masculino','11'],
            ['0953583523','NEYBER ALEXANDER','LOOR CARDENAS','Masculino','11'],
            ['0954791075','JENIFER NAYELY','LOPEZ BERZOSA','Masculino','11'],
            ['0958527558','BRYAN DENILSON','MACIAS ORTEGA','Masculino','11'],
            ['0955130372','GLORIA ESTEFANIA','MEZA HURTADO','Masculino','11'],
            ['0958486532','MARIA BELEN','MURILLO MUÑOZ','Masculino','11'],
            ['0956031124','DAYANNA SCARLET','ORDOÑEZ RODRIGUEZ','Masculino','11'],
            ['2200436539','NAYELI ALEJANDRA ','ORTEGA VIVAR','Masculino','11'],
            ['2200436547','YAMILE ALEJANDRA','ORTEGA VIVAR','Masculino','11'],
            ['0955238589','MAYOLET NAOMI','PLUAS CHALEN ','Masculino','11'],
            ['0606248177','WILSON DANIEL','PONCE VILLON','Masculino','11'],
            ['8170708773','MIGUEL ANGEL','QUIÑONEZ MENDOZA','Masculino','11'],
            ['0951537950','DAVID DANIEL','REINOSO CAAMAÑO','Masculino','11'],
            ['0952091718','EDISON CESAR','RODRIGUEZ INTRIAGO','Masculino','11'],
            ['0951851450','ADANELYS SHARAY','SALAZAR MACIAS','Masculino','11'],
            ['0956328587','JOHN ALEXANDER','SANCHEZ WILA','Masculino','11'],
            ['0956282131','SAMUEL JOSE','SANIPATIN GUEVARA','Masculino','11'],
            ['0958292435','JUDITH JULIANA','SELLAN BARRIENTO','Masculino','11'],
            ['0803733468','ELKIN ALBERTO','SOLIS SOLORZANO','Masculino','11'],
            ['0956237101','AMY DAYANNA','TUBON FUENTES','Masculino','11'],
            ['0955642657','JIMMY SAMUEL','VALDOSPINO MORANTE','Masculino','11'],
            ['0953188547','DARLA MELISSA','VALENCIA ZUÑIGA','Masculino','11'],
            ['0123456789','KEYLA NATHALY','VALLEJO VITE','Masculino','11'],
            ['0955923321','MOISES FERNANDO','VERA MOREIRA ','Masculino','11'],
            ['0956202469','LESLIE NOELIA','VIDAL CHALLA','Masculino','11'],
            ['0956271142','JOSE ARTURO','VILLAGOMEZ SANCHEZ','Masculino','11'],
            ['0803360817','SHEILA ANAIS','ZAMBRANO BALLADARES','Masculino','11'],
            

            // PRIMERO BACHILLERATO CONTABILIDAD A

            ['0605592609','EDWIN PATRICIO','AGUALSACA PEREZ','Masculino','12'],
            ['0958519191','YESSYA ESTHER','ARREAGA LITARDO','Masculino','12'],
            ['0944313824','JESUS ADRIAN','BASURTO BRAVO ','Masculino','12'],
            ['0927373886','ALEXA THAIS','BAZAN TENORIO','Masculino','12'],
            ['0952038529','ALAN JOEL','BERMUDES INDACOCHEA','Masculino','12'],
            ['0951914167','CARLA AMY','BURGOS ORELLANA','Masculino','12'],
            ['0952685386','HEIDY KIARA','CEDEÑO BERSOZA','Masculino','12'],
            ['0956109706','MARIA JOSE','CEVALLOS HUANCAYO','Masculino','12'],
            ['0954626164','JEREMY ARIEL','ESPINOZA MARTINEZ','Masculino','12'],
            ['0943121186','MICHELLE DENISSE','ESPINOZA VILLEGAS ','Masculino','12'],
            ['0953066750','ERICKA JAMILET','FAJARDO ACOSTA','Masculino','12'],
            ['0953951258','BRITTANY ALEXANDRA','FIGUEROA CEDEÑO','Masculino','12'],
            ['0955458898','CARLA DEL ROCIO','GREFA DE LA CRUZ','Masculino','12'],
            ['0957807126','KENNIA FERNANDA','GUAMAN PILOSO','Masculino','12'],
            ['0943577155','ANGEL MICHAEL','JIMENEZ LOGROÑO','Masculino','12'],
            ['0929953198','WILMER JAZMANI','LITARDO GONZAGA','Masculino','12'],
            ['0952694891','LIZ KAMELY','LOPEZ CABRERA','Masculino','12'],
            ['0954285722','CARLOS GUILLERMO','MACIAS MOLINA','Masculino','12'],
            ['0952400315','ARIANA THAYNA','MALDONADO ABRIL','Masculino','12'],
            

            // PRIMERO BACHILLERATO CONTABILIDAD B

            ['0956925242','ANGIE ALEJANDRA','MARIN AVILA','Masculino','13'],
            ['0926150145','LUIS MARIO','MARTINEZ ARANA','Masculino','13'],
            ['0951014190','CARLA ARLETTE','MATA CAZCO','Masculino','13'],
            ['0955057088','MARIA FERNANDEZ','MEDINA MAURAD','Masculino','13'],
            ['0928551092','VARELIN TATIANA','MICOLTA PEREA','Masculino','13'],
            ['1250302849','ANDERSON ALEXANDER','MONTOYA PONCE','Masculino','13'],
            ['0941911562','JOSE ANDRES','MONTOYA SORNOZA','Masculino','13'],
            ['0952578227','ANA CRISTINA','MORALES BONILLA','Masculino','13'],
            ['0951558204','MELANNY MARCELA','ORDOÑEZ HURTADO','Masculino','13'],
            ['0954700993','DAYRON GUILLERMO ','POMADER ROMERO','Masculino','13'],
            ['0958371403','EDITH LISSETTE','PURIZAGA MACIAS','Masculino','13'],
            ['0943304691','FRANKLIN ALEJANDRO','RAMOS BEJARANO','Masculino','13'],
            ['0958766065','SOLANGE DENISSE','RODRIGUEZ VERA','Masculino','13'],
            ['0958785255','LEONARDO CARLOS','TOLEDO NAZARENO','Masculino','13'],
            ['0956274849','ALLAN JOSUE','VARGAS CORTEZ','Masculino','13'],
            ['0956437560','EMILY NAYELI','VELIZ TRIVIÑO','Masculino','13'],
            ['0957852775','DAYCE MARIBEL','VERA ROMERO','Masculino','13'],
            ['0953612900','KENETH JOHAN','VILLALTA REYES','Masculino','13'],
            ['0955487560','JORGE ADONNYS','ZAMBRANO SALGUERO','Masculino','13'],
            

            // SEGUNDO BACHILLERATO CONTABILIDAD A

            ['0955714142','JEREMY JESUS','ANDRADE MARIN','Masculino','14'],
            ['0956611677','GENESIS MELINA','AVILA ROJAS','Masculino','14'],
            ['0940992811','BRITHANY PILAR','BEJAR AGUIRRE','Masculino','14'],
            ['0940196249','JOSE ANDRES','CABALLERO GOMEZ','Masculino','14'],
            ['0943288175','LOURDES DEL CARMEN','CABRERA LOZANO','Masculino','14'],
            ['0956322028','CARLA STEFANIA','CALERO RAMIREZ','Masculino','14'],
            ['1727149187','MIGUEL ANGEL','CARVAJAL PIEDRAHITA','Masculino','14'],
            ['0941493025','MELANIE ASHLEY','CHIRIGUAY ROGEL','Masculino','14'],
            ['0927357467','CHIARA ELIZABETH','DE LA VERA LIMA','Masculino','14'],
            ['0955827571','DOUGLAS ALEXANDER','GALARZA MORAN','Masculino','14'],
            ['0123456789','NICOLE MICHELLE','GUARACA CARANQUI','Masculino','14'],
            ['0943244046','DAYANA DALESKA','HERRERA RODRIGUEZ','Masculino','14'],
            ['0928565480','HAO HUI ','HU QUIÑONEZ','Masculino','14'],
            ['0952700268','BRYAN JAVIER','JARAMILLO LAY','Masculino','14'],
            ['0958374506','EDWIN JONATHAN','JIMENEZ GARCIA','Masculino','14'],
            ['0955258314','CARLOS STEVEN','LIBERIO GUTIERREZ','Masculino','14'],
            ['0956787543','ALIAN ANTONIO','LOPEZ MUÑOZ','Masculino','14'],
            ['0958372138','MARCOS ANTONIO','LOPEZ PACHECO','Masculino','14'],
            ['0956269740','MELANIE STEPHANIE','LOZANO GOMEZ','Masculino','14'],
            ['0952578185','ADRIAN AARON','MORALES BONILLA ','Masculino','14'],
            ['0941225914','MARISELA KATHERINE','MORAN GARCIA','Masculino','14'],
            ['0951488873','JEANCARLO ALAN','NUÑEZ BEDOYA','Masculino','14'],
            ['0941563660','ADRIANA FIORELLA','ORDOÑEZ CARRASCO','Masculino','14'],
            ['0956031074','MARIA JOSE','ORDOÑEZ RODRIGUEZ','Masculino','14'],
            ['0941233678','JHOSELYN ALEXANDRA','PEREEZ CEPEDA','Masculino','14'],
            ['0943237362','MICHAEL STEVEN','REYES FLORES','Masculino','14'],
            ['1350313530','ANGIE BEATRIZ','REZABALA CHANCAY','Masculino','14'],
            ['0957571813','MARIA SILVANA','ROBLES CHELE','Masculino','14'],
            ['0956269880','AMBAR SCARLHE','ROSALES MEZA','Masculino','14'],
            ['0952533388','ADRIAN ENRIQUE','SAITEROS FLORES','Masculino','14'],
            ['0956271738','SARA ESTHER','SANIPATIN GUEVARA','Masculino','14'],
            ['0950578799','MELANIE ANDREA','SORIA BRUNES','Masculino','14'],
            ['0958689887','OSWALDO ISAU','URRESTA SUAREZ','Masculino','14'],
            ['0956201479','IRIS MILENA','VIDAL CHALLA','Masculino','14'],
            ['0943191742','NALLELY STEFANIA','ZAMBRANO ALVIA','Masculino','14'],
        );

		
		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
        	$student->ci = $key[0];
        	$student->nombres = $key[1];
        	$student->apellidos = $key[2];
        	$student->sexo = $key[3];
        	$student->fechaNacimiento = '01-01-2000';
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	//
        	$student->matricula = 'Ordinaria';
        	$student->numeroMatricula  = $student->id;
        	$student->idCurso = $key[4];
			if ($key[4]>11){ 

				$student->seccion = 'BGU';
			}else{

				$student->seccion = 'EGB';
			}
			
        	//
        	$student->idPeriodo = 2;
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
