<?php

use Illuminate\Database\Seeder;
use App\Student2;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\User;
use Carbon\Carbon;
use App\Fechas;
use App\Course;
use Faker\Factory as Faker;

class EstudiantesTheoConstanteParraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = array(
        	/* INICIAL 1 */
				array('0960468023','ARELLANO RODRIGUEZ','KAMILL DANIELA','Femenino','1'),
				array('0960562635','BANCHON ZÚÑIGA','ETHAN YESHUA','Masculino','1'),
				array('0960371680','CARRANZA SERRANO','AARON FERNANDO','Masculino','1'),
				array('0960477958','CASTILLO JARAMILLO','IKER KERIM','Masculino','1'),
				array('0932865447','ESPINOZA MORENO','ADRIAN EMMANUEL','Masculino','1'),
				array('0960642395','FREIRE RAMOS','JEREMY MATHIEU','Masculino','1'),
				array('0932819154','GONZALEZ LEON','CONNIE PATRICIA','Femenino','1'),
				array('0932932155','LEÒN MERINO','EDUARDO ANDRÈS','Masculino','1'),
				array('1757439573','MOLINA VELIZ','DRAKE ALEXANDER','Masculino','1'),
				array('0961412467','NAZARENO PONCE','NOA EVALUNA','Masculino','1'),
				array('0851127209','PIANCHICHE OLIVO','GEORGE FABIAN','Masculino','1'),
				array('0960539583','QUIROZ POVEDA','MARTINA ISABELLA','Femenino','1'),
				array('0960205904','RAMIREZ FAJARDO','OANA CAROLINE','Femenino','1'),
				array('0959884701','VALVERDE HERRERA','SKAROLAY MISCHELL','Femenino','1'),

			/* INICIAL 2 */
				array('0959687948','ALTAMIRANO HUACON','JULEN MARTIN','Masculino','2'),
				array('0959787904','ANDRADE CASTRO','EMMANUEL','Masculino','2'), 
				array('0959766262','ARMIJOS QUIÑONEZ','MARTIN SANTIAGO','Masculino','2'),
				array('0961234580','BRAVO VILLACRES','DOMINIC GADIEL','Masculino','2'),
				array('0932671514','CÁCERES FALCONES','MARIUXI ELIZABETH','Femenino','2'),
				array('0932762958','CARPIO VARGAS','FARID ESAUD','Masculino','2'),
				array('0960058261','CHILUISA CORTEZ','DEREK DENIS','Masculino','2'),
				array('0959323031','CHOEZ RONQUILLO','MELANIE ARELIS','Masculino','2'),
				array('0932738347','ESPINOZA CHALEN','CRISTIAN MAYKEL','Masculino','2'),
				array('1251513774','GAMBOA ESPINOZA','STEFANO BERNABE','Masculino','2'),
				array('0932731912','GARCIA MARTILLO','ELIETTE CAROLA','Femenino','2'),
				array('0959992694','GUTIERREZ PINO','ALINA DAYRA','Femenino','2'),
				array('0959570730','LEON ESTEVES','RAFAELLA ALEJANDRA','Femenino','2'),
				array('0959806399','MASCOTE PINCAY','SHAILYN KESHYA','Femenino','2'),
				array('0959600487','MONTALVO MANJAREZ','JESÚS ELIAN','Masculino','2'),
				array('0959703430','MONTECEL CHAVEZ','DEREKS LUIS','Masculino','2'),
				array('0959673047','MOROCHO SINCHE','DAYANNA ARACELY','Femenino','2'),
				array('0959387994','NARANJO GANCHOZO','JUAN PABLO','Masculino','2'),
				array('0959750449','NARANJO VALERO','ADRIANNE MAYERLY','Femenino','2'),
				array('0932684400','PEÑAFIEL BERMUDEZ','RUTH ALEXANDRA','Femenino','2'),
				array('0932665201','PESANTES MENDEZ','THIAGO ISAÍAS','Masculino','2'),
				array('1251504781','PICO IZQUIERDO','KATHERIN ODETTE','Femenino','2'),
				array('0960414431','REINA ARCE','THIAGO SAUL','Masculino','2'),
				array('0960999605','RODRIGUEZ NOBOA','JESÚS FERNANDO','Masculino','2'),
				array('0959944851','SARAGUAYO CEVALLOS','MARIANA VALENTINA','Femenino','2'),
				array('0932647704','SERRANO PEREZ','JOHANNA LISSETTE','Femenino','2'),
				array('0932674328','SURIAGA VILLAMAR','BARAC ROBERTO','Masculino','2'),
				array('0959644394','VALDEZ VALDEZ','OHANA JULIETTE','Femenino','2'),
				array('0959564956','VELASQUEZ ARIAS','MEGAN SOL','Femenino','2'),
				array('1729833549','VELASQUEZ VELASQUEZ','EVENIN AYHARA','Femenino','2'),
				array('0932723752','VERA LUQUE','ANNIE CHARLOTTE','Femenino','2'),
				array('0959530270','ZHENG LOPEZ','ZILAN JUDIT','Femenino','2'),

			/* PRIMERO A */
				array('0958678724','ACOSTA CASTRO','SELENY ALEXANDRA','Femenino','3'),
				array('0957750839','ALBAN GUTIERREZ','ASHLEY JAZMIN','Femenino','3'),
				array('0958361925','ALVARADO BARZOLA','JOSÉ SAMUEL','Masculino','3'),
				array('0958070633','BANCHÓN ZÚÑIGA','NOA AYLINE','Femenino','3'),
				array('0932480486','BARRIONUEVO NUÑEZ','KONNIE RAPHAELLA','Femenino','3'),
				array('0959113754','CARRILLO RIVERA','ISIS KEYSHA','Femenino','3'),
				array('0932522741','CASTRO LAGO','MAYLU CAROLINA','Femenino','3'),
				array('0957123227','FRANCO MACÍAS','HEIDY VALENTINA','Femenino','3'),
				array('0932533300','GARCÍA QUIÑONEZ','MARÍA JOSÉ','Femenino','3'),
				array('1753524618','JIMENEZ ARREAGA','LUIS SANTIAGO','Masculino','3'),
				array('0932588528','MACÍAS VAQUERO','JOSHUA ISRRAEL','Masculino','3'),
				array('0932449986','MONTES LEÓN','ELIANA KADISHA','Femenino','3'),
				array('0956937767','MONTOYA CRESPO','ABRAHAM','Masculino','3'),
				array('0956783039','MOROCHO SINCHE','MIJAIL ELEAZAR','Masculino','3'),
				array('0960082717','NAZARENO PONCE','ORQUIDEA KIRINA','Femenino','3'),
				array('0932631831','QUINTANILLA BAJAÑA','LIONEL ANDRÉ','Masculino','3'),
				array('0959203761','QUINTERO TORRES','ZAHIR DARIEL','Masculino','3'),
				array('0956605588','SUNTAXI VERA','THIAGO ANDRÉS','Masculino','3'),
				array('0958650657','URETA QUINDE','SANTIAGO MATHÍAS','Masculino','3'),
				array('0956815070','VERA RUIZ','JOSÉ GABRIEL','Masculino','3'),

			/* SEGUNDO A */
				array('0932372618','AREVALO UZHO','ALONSO JEREMÍAS','Masculino','4'),
				array('0956963052','BRICEÑO CAMBA','SEBASTIÁN LENÍN','Masculino','4'),
				array('0956465025','CARABAJO BARRERA','BRIANNA VALENTINA','Femenino','4'),
				array('0932199714','CARRILLO PANCHANA','KEILER JOSHUA','Masculino','4'),
				array('0955870464','CASTAÑEDA ARRATA','FAUSTO ALONSO','Masculino','4'),
				array('0955437702','CHICA ARRIAGA','MILENA ALEJANDRA','Femenino','4'),
				array('0955806575','DECKER TORRES','DAVID ALEJANDRO','Masculino','4'),
				array('0955203484','GUERRERO VARGAS','JARITZA FERNANDA','Femenino','4'),
				array('0955759600','HENRIQUEZ DUEÑAS','CAMILA JULIETTE','Femenino','4'),
				array('0954809174','JAIME PITA ANGIE','ALEXANDRA','Femenino','4'),
				array('0956256457','LEÓN ESTEVES','ALEJANDRO YERAY','Masculino','4'),
				array('0957476021','MONTERO CALVOPIÑA','JUAN JOSÉ','Masculino','4'),
				array('0954866935','MORA CARVAJAL','TIFFANY ARIANNA','Femenino','4'),
				array('0956273213','NAZARENO CASTILLO','SONNY DIONDREA','Masculino','4'),
				array('0962753588','ORTEGA PALACIOS','JEHRSON JOAO','Masculino','4'),
				array('0956160907','PALADINES ZURITA','ISAAC SEBASTIÁN','Masculino','4'),
				array('0932244999','PARRALES ARTEAGA','MATHEW ANTONIO','Masculino','4'),
				array('0960003200','ROMERO MIRANDA','CARLOS JOSE','Masculino','4'),
				array('0956034375','SÀNCHEZ HUIRACOCHA','MATEO GABRIEL','Masculino','4'),
				array('0956153456','TEJADA SOTO','AMY GIOVANNA','Femenino','4'),
				array('0954043469','VALENCIA GARCIA','NICOLLE JESSENIA','Femenino','4'),

			/* TERCERO A */
				array('0954174363','ALIAGA PIGUAVE','ANGELINA VIOLETTE','Femenino','5'),
				array('0953472438','ALTAMIRANO RODRIGUEZ','ROBERTO EMANUEL','Masculino','5'),
				array('0953505179','ANDRADE MUÑOZ','CALEB JOSUÉ','Masculino','5'),
				array('2450556028','ARIAS CALERO','KYARA ALESKA','Femenino','5'),
				array('1089615788','ARIAS TORO','ISABELLA','Femenino','5'),
				array('0804751899','BEDOYA QUINTERO','FIORELLA JALENA','Femenino','5'),
				array('0953120011','BUSTAMANTE FRANCO','KAROL RAFAELA','Femenino','5'),
				array('0954101556','CALDERÓN BENAVIDES','EZEQUIEL RANDY','Masculino','5'),
				array('0953823523','CALVA CHICAIZA','ALICE GIANELLA','Femenino','5'),
				array('0953042363','CÓRDOVA VERA','JANETH ALEJANDRA','Femenino','5'),
				array('0959609553','CUNALATA CRESPÍN','JEAN CARLOS','Masculino','5'),
				array('0931946255','DELGADO ARCE','IKER ANDRES','Masculino','5'),
				array('0952787380','DÌAZ ROSALES','ARIANA CAMILA','Femenino','5'),
				array('0953949229','FALCONES MORALES','PAULA MAYLEEN','Femenino','5'),
				array('0954795167','FIERRO ZAVALA','MATHÍAS ARGENIS','Masculino','5'),
				array('0932023955','FLORES JURADO','MIA VALENTINA','Femenino','5'),
				array('0303039663','GANCHOZO ZAMBRANO','FRANCISCO SCOTT','Masculino','5'),
				array('0957722408','GÒMEZ MARCILLO','MELANIE ANAHÌ','Femenino','5'),
				array('0650420359','GUZMÁN AUCANCELA','LUIS ÁNGEL','Masculino','5'),
				array('1750634444','JIMENEZ ARREAGA','VALENTINA SAMANTHA','Femenino','5'),
				array('0953418894','LARA POVEDA','VALESKA MAYTTE','Femenino','5'),
				array('0954959770','LUDIZACA AGUIRRE','JESÚS ELÍAS','Masculino','5'),
				array('0955985833','LUJANO MURILLO','GRACE JORDANA','Femenino','5'),
				array('0951736107','LUQUE VERA KENNETH','XAVIER','Masculino','5'),
				array('0931993984','MARCILLO SOLIS','JADE ELIZABETH','Femenino','5'),
				array('0953158912','MONTES LEÓN','SOFÍA BELÉN','Femenino','5'),
				array('0955103726','MORALES RODRIGUEZ','MATEO LEONEL','Masculino','5'),
				array('0931310122','MOSQUERA CHÁVEZ','JOSÉ ALEJANDRO','Masculino','5'),
				array('0954238275','PALMA REYES','EMMA ESTHER','Femenino','5'),
				array('0954435509','QUIMIS ACOSTA','CARLOS ISAAC','Masculino','5'),
				array('0932122773','QUIÑONEZ LEÒN','AMY GABRIELA','Femenino','5'),
				array('1728759570','REINOSO ROSALES','VALENTINA','Femenino','5'),
				array('1316830775','REYES MIRANDA','CRISTINA BELÉN','Femenino','5'),
				array('0954010039','RUIZ LUCAS','GÉNESIS ELIZABETH','Femenino','5'),
				array('0953987393','SIERRA SÁNCHEZ','MARCOS EDGAR','Masculino','5'),
				array('0960141471','TORRES RAMIREZ','MARIO EZEQUIEL','Masculino','5'),
				array('0954486106','TUQUINGA AUCANCELA','ALLISON AILEEN','Femenino','5'),
				array('0650155328','TUQUINGA SINCHI','ABIGAIL ALEXANDRA','Femenino','5'),
				array('0932172273','VALDIVIEZO TROYA','ALEXIA CAMILA','Femenino','5'),
				array('0952859197','VEINTIMILLA INTRIAGO','PAULA DAYANNA','Femenino','5'),
				array('0953066057','VILLALBA LAYANA','MOISÉS ARIEL','Masculino','5'),

			/* CUARTO A */
				array('0952144731','BALDEÒN RICAURTE','HERNAN LEONARDO','Masculino','6'),
				array('0953928694','BALSECA PAGUAY','ALLISON IVONNE','Femenino','6'),
				array('0952475036','BAQUERIZO DEL PEZO','ADRIANO SEBASTIAN','Masculino','6'),
				array('0952341097','BEJAR SANCHEZ','MELANIE GIANELLA','Femenino','6'),
				array('0953961307','CARRANZA SERRANO','STEVE ANTHONY','Masculino','6'),
				array('0850144825','CEDEÑO VERNAZA','KERRY OSMANI','Masculino','6'),
				array('1750981175','CERVANTES RIVADENEIRA','SHELLEY DAYANARA','Femenino','6'),
				array('0952610772','CEVALLOS QUIMÍ','ADRIANA VALENTINA','Femenino','6'),
				array('0952899557','CHANG PINTO','ALEXANDER KENNETH','Masculino','6'),
				array('0952199917','GANCHOZO ZAMBRANO','CAROLINA PAULETTE','Femenino','6'),
				array('0957661796','GUAYRACAJA AUCANCELA','DAYANNA MABEL','Femenino','6'),
				array('0952325132','LÓPEZ DELGADO','NATHALIA RAFAELLA','Femenino','6'),
				array('0953236890','MONTERO CALVOPIÑA','ANA PAULA','Femenino','6'),
				array('0952428373','MORA CARVAJAL','GREGORY DAVID','Masculino','6'),
				array('1750696062','NAZARENO ZAMBRANO','ISAAC JOSUE','Masculino','6'),
				array('0951071182','NEIRA ZÚÑIGA','NICOLÁS ALEJANDRO','Masculino','6'),
				array('0953260767','ORTEGA PALACIOS','CHRISTIAN FERNANDO','Masculino','6'),
				array('0951541630','PADILLA MAZZINI','GERSON ALEJANDRO','Masculino','6'),
				array('0953090297','PASPUEL ESCALA','BARBARA MAYERLY','Femenino','6'),
				array('0931675839','QUIÑONEZ ARREAGA','ANA BELEN','Femenino','6'),
				array('0850005182','REQUEJO VILELA','JERSON NEYMAR','Masculino','6'),
				array('0931679740','RIVERA VACACELA','ISIS GERALDINE','Femenino','6'),
				array('0952193225','RUIZ LUCAS','FABIAN JEREMIAS','Masculino','6'),
				array('0952859536','VILLAVICENCIO NAZARENO','EMANUEL CAMILO','Masculino','6'),
				array('0951477439','ZÚÑIGA ALCIVAR','ANDREW DILAN','Masculino','6'),

			/* QUINTO A*/
				array('0961375383','ALBANO CARRILLO','SEBASTIÁN ANDRÉS','Masculino','7'),
				array('0943213876','ALVARADO VILLAFUERTE','EDUARDO JESÚS','Masculino','7'),
				array('0941680597','BENAVIDES ORTÌZ','ANGEL XAVIER','Masculino','7'),
				array('0951131960','BURGOS PANTA','ADRIANA MYLENA','Femenino','7'),
				array('0950959098','CAGUA CEDEÑO','GÉNESIS GEOVANNA','Femenino','7'),
				array('0955724505','CALDERÓN BENAVIDES','BRITNEY ESTHER','Femenino','7'),
				array('0950908293','CALVA CHICAIZA','MELANIE DAYANA','Femenino','7'),
				array('0957756539','CASTAÑEDA BUSTAMANTE','KARINA ELIZABETH','Femenino','7'),
				array('0958052847','CASTRO PINTO','SARA CAMILA','Femenino','7'),
				array('0957670243','ESCALANTE BUSTAMANTE','DERLYN JOSTIN','Masculino','7'),
				array('0954562583','GUEVARA INTRIAGO','ANA PAULA','Femenino','7'),
				array('0957688542','HERNÁNDEZ GONZÁLEZ','MAYKEL MOISÉS','Masculino','7'),
				array('0931475354','IZQUIERDO REYES','SANTIAGO GABRIEL','Masculino','7'),
				array('1727040113','LOPEZ BALDEÒN','LESLY BRIGITTE','Femenino','7'),
				array('0952340131','LUDIZACA AGUIRRE','BRUNO ENRIQUE','Masculino','7'),
				array('0952433787','MOROCHO VARGAS','JUSTYN ADREAN','Masculino','7'),
				array('0950721464','PERALTA MATUTE','JOSUÉ SANTIAGO','Masculino','7'),
				array('0954770442','QUINTANILLA BAJAÑA','CAMILA ALEXANDRA','Femenino','7'),
				array('0950992487','REDROVÀN SÀNCHEZ','ALEXIS ANDRÈS','Masculino','7'),
				array('0950445874','REYES NAVARRETE','CARLOS JOSUE','Masculino','7'),
				array('1251052625','VARGAS JIMENEZ','EZEQUIEL AUSTIN','Masculino','7'),
				array('0953247178','ZAMBRANO VARGAS','VALENTINA AYELEN','Femenino','7'),

			/* SEXTO A */
				array('0952926681','AGUILAR SOTOMAYOR','NATHALIA FRANCHESCA','Femenino','8'),
				array('0950118174','AGUIRRE BELTRÁN','NICOLE SCARLET','Femenino','8'),
				array('0950335893','ANGULO BELTRAN','REBECA ABIGAÍL','Femenino','8'),
				array('0803965979','BONE CASTILLO','JOSELIN JARELL','Femenino','8'),
				array('0930793492','BRIONES MATUTE','AMANDA PAULINA','Femenino','8'),
				array('0930840848','CARPIO VARGAS','ANGIE NICOLE','Femenino','8'),
				array('0953758679','CASTILLO ALCIVAR','ALEX GABRIEL','Masculino','8'),
				array('0931026934','CASTRO ARRATA','DIANA SOLANGE','Femenino','8'),
				array('0955907159','CEDEÑO URRESTA','GEORGETTE DE JESUS','Masculino','8'),
				array('0931189880','DELGADO TOMALÁ','DANNY JAVIER','Masculino','8'),
				array('0931262877','FIERRO ZAVALA','KLÉBER ALEXANDER','Masculino','8'),
				array('0950313080','GONZÁLEZ CÓRDOVA','DINARA ESTHER','Femenino','8'),
				array('0957833783','GUALLASACA CRUZ','DANNA ZHARYCK','Femenino','8'),
				array('0943481267','LUJANO MURILLO','TAMARA MAYENSI','Femenino','8'),
				array('0956149470','MARQUEZ ARIAS','VICTORIA SOFIA','Femenino','8'),
				array('0941775504','MASCOTE PINCAY','JORDANA PAULETTE','Femenino','8'),
				array('0931358204','MAYORGA CARPIO','DEBBIES JAVIER','Masculino','8'),
				array('1208638138','MENDOZA SOLÒRZANO','MELANY DANIZA','Femenino','8'),
				array('0943232751','MONSERRATE SANTISTEVAN','ERICK DAVID','Masculino','8'),
				array('0957978539','MORAN MERINO','JEREMÌAS JAIR','Masculino','8'),
				array('0944327758','OROZCO ARIAS','THOMAS DAVID','Masculino','8'),
				array('0958398489','PALOMINO PALACIOS','GABRIELA MIkAELA','Femenino','8'),
				array('0931066161','PERALTA RIZZO','EMELY ROMINA','Femenino','8'),
				array('0951514660','RIVERA SÁNCHEZ','ALAN JESÚS','Masculino','8'),
				array('0950600890','ROMERO MORA','JUSTIN DAVID','Masculino','8'),
				array('1350717623','SALTOS BERMELLO','JESUS MATHIAS','Masculino','8'),
				array('0956832364','VALDIVIEZO GAVIDIA','CAMILA ALEJANDRA','Femenino','8'),
				array('0952091585','VEINTIMILLA INTRIAGO','VALENTINA LILIBETH','Femenino','8'),
				array('0950123901','VILLAVICENCIO NAZARENO','ISAAC GEREMÍAS','Masculino','8'),
				array('0950317248','YEPEZ PANTA','ANTONIO ESTEBAN','Masculino','8'),

			/* SEPTIMO A*/
				array('0952479343','ALVEAR AGUIRRE','BRAITHON ARON','Masculino','9'),
				array('0954179602','ARCE ALMEA','JANNY LIANET','Femenino','9'),
				array('0955987466','ARMENDARIZ','SÁNCHEZ GILDA DANNELHÉ','Femenino','9'),
				array('0950692673','AROCA TROYA','JEREMY ALEXANDER','Masculino','9'),
				array('0952740538','BRIONES ROBLES','DAIKY DE JESÚS','Masculino','9'),
				array('3050085764','BUESTÁN ESTUPIÑAN','CRISTINA VALERIA','Femenino','9'),
				array('0930549605','CAJAPE ELÍAS','KRISTELL AHYLIN','Femenino','9'),
				array('0955963343','CALDERÓN ZÚÑIGA','SAMUEL ANDRÉS','Masculino','9'),
				array('1725217200','CEDEÑO VERNAZA','JORKAEL JEFFREN','Masculino','9'),
				array('0959131756','CHUQUI ARAGADBAY','SERGIO ISRAEL','Masculino','9'),
				array('0953690203','ESCALANTE FLORES','BRITHANY MILENA','Femenino','9'),
				array('0941712796','FRANCO MOSQUERA','ANAÍS GISSELL','Femenino','9'),
				array('0941350092','GUEVARA INTRIAGO','DAVID ROBERTO','Masculino','9'),
				array('0954057873','JURADO OSTAIZA','JEREMY JESÚS','Masculino','9'),
				array('1234567890','LEÓN PALACIOS','KARIN RAFAELA','Femenino','9'),
				array('0929319531','LÒPEZ BALDEÒN','EMILY JUDITH','Femenino','9'),
				array('0958584195','LÓPEZ DELGADO','VALERIA ELIZABETH','Femenino','9'),
				array('0954476008','MACÍAS ORTEGA','EMERSON MOISÉS','Masculino','9'),
				array('0929402220','MARIDUEÑA GOYA','MELL ANAHÍ','Femenino','9'),
				array('0954526752','MONTALVAN PINEDA','MATIAS DANIEL','Masculino','9'),
				array('0953378387','MOROCHO SINCHE','BEZALEEL ALEXANDER','Masculino','9'),
				array('0940589039','PASPUEL ESCALA','JENIFER DAYANA','Femenino','9'),
				array('0956893481','PERALTA MATUTE','CRISTEL YANELA','Femenino','9'),
				array('0954770301','QUINTANILLA BAJAÑA','JEREMY JESÚS','Masculino','9'),
				array('0850276536','REQUEJO VILELA','SCARLETH THAÍS','Femenino','9'),
				array('0941777005','SIERRA SÀNCHEZ','SAHID ABRAHAM','Masculino','9'),
				array('3050440290','VALLE MATEUCCI','SILVIA CRISTINA','Femenino','9'),
				array('0940526676','VINUEZA LANDÀZURI','JEFFERSON ELIAS','Masculino','9'),
				array('0953434800','YÉPEZ ZURITA','HANNY AUDREY','Masculino','9'),
				array('0930204052','ZÚÑIGA LIMA','BRYAN NAHIM','Masculino','9'),
				array('0943505180','ZÚÑIGA LIMA','DAVID ANDRÉS','Masculino','9'),

			/* OCTAVO A */
				array('1753866308','AGUILAR SOTOMAYOR','STEPHANY ALEJANDRA','Femenino','10'),
				array('0951491406','AGUIRRE BELTRÁN','MATÍAS DANIEL','Masculino','10'),
				array('0950375048','ALBAN MACÌAS','ISAAC MARTÌN','Masculino','10'),
				array('0953823697','ARTEAGA RODRIGUEZ','OMAR STEVEN','Masculino','10'),
				array('0955946249','BARONA RECALDE','EDDER JESÚS','Masculino','10'),
				array('0956339063','BUSTAMANTE QUINTERO','ANA ROMINA','Femenino','10'),
				array('0930218029','CASTILLO JARAMILLO','LARRY ROOSBEL','Masculino','10'),
				array('0955907076','CEDEÑO URRESTA','TATIANA JUDELKIS','Femenino','10'),
				array('0929101707','CHANG PINTO','AILEEN SUYING','Femenino','10'),
				array('0930031562','CHOEZ RONQUILLO','NATHALY NOEMI','Femenino','10'),
				array('0952932770','CUADRADO HERRERA','DEA ESTHER','Masculino','10'),
				array('0957451057','CUSQUILLO GUANANGA','EVELYN FAUSMIRI','Femenino','10'),
				array('0942583238','DIAZ LITARDO','JAVIER JESÚS','Masculino','10'),
				array('1728522176','GÓNGORA LEÓN','JAIRO CENERY','Masculino','10'),
				array('0928811611','GONZÁLEZ CÓRDOVA','YORVIN ELÍAS','Masculino','10'),
				array('0955304142','GONZALVO BONE','MARLEN VALESKA','Femenino','10'),
				array('1729395408','LARA MEDINA','MARIO DANIEL','Masculino','10'),
				array('1004533368','LIMAICO REMACHE','SAYURI MAYERLI','Masculino','10'),
				array('0959290263','LLERENA MARTÍNEZ','ISAAC DAVID','Masculino','10'),
				array('0952398618','MACKAY MONTOYA','WINSTON JARED','Masculino','10'),
				array('0951706001','MENDOZA RODAS','ALAN ANTONIO','Masculino','10'),
				array('0943075671','MONSERRATE SANTISTEVAN','ALEXANDER SEGUNDO','Masculino','10'),
				array('0959078825','NEIRA ZÚÑIGA','MARCELO ESTEBAN','Masculino','10'),
				array('0952923068','OSORIO ROMAN','SAMUEL GERARDO','Masculino','10'),
				array('0930120449','PEREZ ICAZA','FRANCIA DAYANARA','Femenino','10'),
				array('0850512963','PERLAZA NAZARENO','BIANCA NICOLE','Femenino','10'),
				array('0950803775','PESANTES MÉNDEZ','OSCAR DAVID','Masculino','10'),
				array('0954229753','REINA ARCE','NAYELI GERALDINE','Femenino','10'),
				array('0957063340','REYES HERRERA','CHRISTIAN ANDRÉ','Masculino','10'),
				array('0958422107','RODRIGUEZ NOBOA ','JEREMY BENJAMIN','Masculino','10'),
				array('0951498914','RONQUILLO SAA','ANDRÉS SEBASTIÁN','Masculino','10'),
				array('0958392573','SANTIANA ALVAREZ','DYLLAN AYRTON','Masculino','10'),
				array('0951255785','TOSCANO BOHORQUEZ','RICARDO ANDRÉS','Masculino','10'),
				array('0951255751','TOSCANO BOHORQUEZ','ROSSY ANNABELLA','Femenino','10'),
				array('0952488542','TRIVIÑO PEREZ','DOMÉNICA DEL ROCIO','Femenino','10'),
				array('0930271986','URETA QUINDE','ANDRÉS EDUARDO','Masculino','10'),
				array('0953084118','VERA RODRIGUEZ','AMMY ANAHÌ','Femenino','10'),
				array('0955979216','ZAMORA NARANJO','ANDY MARSHALL','Masculino','10'),

			/* NOVENO A */
				array('0940339831','AGUIRRE OVIEDO','JONATHAN ANDRÉS','Masculino','11'),
				array('0953468394','ALTAMIRANO RODRIGUEZ','SAMUEL ISAIAS','Masculino','11'),
				array('0943764522','ANDRADE JÁCOME','REBECA NALLELY','Femenino','11'),
				array('0957036403','ARMENDARIZ NOBOA','NOEMÌ ELIZABETH','Femenino','11'),
				array('0943608075','BRAVO VILLACRES','NAOMI JOHANNA','Femenino','11'),
				array('0941684078','CARRANZA SÁNCHEZ','VICTOR ALFONSO','Masculino','11'),
				array('0941970915','CEVALLOS LEÓN','NAHOMY MEYLING','Femenino','11'),
				array('0950236174','CEVALLOS QUIMI','ANGEL RAÚL','Masculino','11'),
				array('0957647522','COLOMA FLOR','MEGHAN SAMADI','Femenino','11'),
				array('0952199552','GANCHOZO ZAMBRANO','ALLISON ANGELINA','Femenino','11'),
				array('3050256498','GARCIA MARTILLO','ASTRID PAOLA','Femenino','11'),
				array('0943616102','GÓMEZ DEL SALTO','AIDAN ISAÍAS','Masculino','11'),
				array('0951968783','JATI VILLAO','ABRAHAN MOISÉS','Masculino','11'),
				array('1729395465','LARA MEDINA','ÁNGEL DAVID','Masculino','11'),
				array('1234567890','LEÓN PALACIOS','CARLOS JOAB','Masculino','11'),
				array('0923849314','MARIDUEÑA GOYA','ITALO SAID','Masculino','11'),
				array('0932486764','MONTECEL CHAVEZ','NORY JAMILEY','Femenino','11'),
				array('0952480945','NAVARRO BOLAÑOS','CRISTHOPER GABRIEL','Masculino','11'),
				array('0927780411','PASPUEL ESCALA','GUILERMO ALDAY','Masculino','11'),
				array('0952193308','PEÑAFIEL BERMUDEZ','AARON OSWALDO','Masculino','11'),
				array('0951419696','PINCAY RODRIGUEZ','ASHLEY NATASHA','Femenino','11'),
				array('0952890317','PINELA MENDOZA','KRISTEL VALERIA','Femenino','11'),
				array('0953020666','RAMIREZ BARBECHO','GABRIEL AARON','Masculino','11'),
				array('0943513994','REMACHE QUITIO','JESÚS ADRIÁN','Masculino','11'),
				array('0943885491','RONQUILLO SAA','ITZEL ALEJANDRA','Femenino','11'),
				array('0927850610','SABANDO QUEZADA','THIAGO JEREMY','Masculino','11'),
				array('0953481702','SOUSA INDACOCHEA','JAVIER ANTONIO','Masculino','11'),
				array('2300797061','VELASQUEZ RIVADENEIRA','BRYAN DAVID','Masculino','11'),
				array('0944141688','VICUÑA TOLEDO','KIANNY AISHA','Femenino','11'),
				array('0957970957','VILLAFUERTE DELGADO','SCARLET DAYANNA','Femenino','11'),
				array('0953203718','VILLAVICENCIO NAZARENO','CHRISTOPHER ALEXANDER','Masculino','11'),
				array('0956126395','VILLENA PACHECO','MISAEL ALBERTO','Masculino','11'),

			/* DECIMO A */
				array('0952483832','ALVEAR AGUIRRE','MISEL VALESKA','Femenino','12'),
				array('0943268664','BARROS MARTILLO','MARVIN ENRIQUE','Masculino','12'),
				array('0803178391','BONE CASTILLO','JOSEPH JOHAN','Masculino','12'),
				array('0929951432','BUSTAMANTE VALLEJO','ROBERTO CARLOS','Masculino','12'),
				array('0952146389','CAJAPE ELÍAS','NAOMI ANNABELL','Femenino','12'),
				array('0955963269','CALDERÓN ZÚÑIGA','KARLA NAJHANY','Femenino','12'),
				array('0951946540','CORTEZ GUERRERO','MICHELLE DENISSE','Femenino','12'),
				array('0954690640','DUQUE GALLARDO','DANIEL ANTONIO','Masculino','12'),
				array('0959183807','ESPINOZA HOLGUÍN','MARIA DE LOS ÁNGELES','Femenino','12'),
				array('0953595600','ESPINOZA PACHECO','NICKY JOSÉ','Masculino','12'),
				array('0954383287','MEDINA REA','JUAN FRANCISCO','Masculino','12'),
				array('0926902636','MINA CAICEDO','OBED PATRICIO','Masculino','12'),
				array('0958419608','MONTES DE OCA PALACIOS','EDDIE MISAEL','Masculino','12'),
				array('0926720574','0RTIZ MURILLO','LUIS SEBASTIAN','Masculino','12'),
				array('0954057675','OSTAIZA INTRIAGO','JOSTIN GONZALO','Masculino','12'),
				array('1351210800','OVIEDO CEVALLOS','ROMINA CRISTEL','Femenino','12'),
				array('0955908892','PALMA REYES','MOISÉS ISRAEL','Masculino','12'),
				array('0951565308','PARRALES BARROS','GÉNESIS MERCEDES','Femenino','12'),
				array('0955574025','SÁNCHEZ CARRASCO','VICENTE MOISES','Masculino','12'),
				array('0953820339','SILVA PALACIOS','MELANY JUSTINE','Femenino','12'),
				array('0931151633','TOPA FREIRE','ROBERTO ISMAEL','Masculino','12')
        );
	/*
		echo count($students);
		for($i=0; $i<count($students); $i++){
			echo $students[$i][0];

		}
	*/
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
		        	//
		        $student->matricula = 'Ordinaria';
		        $student->numeroMatricula  = $student->id;
		        $student->idCurso = $key[4];
		        if($key[4]=='1' || $key[4]=='2'){
		        	$student->seccion = 'EI';
		        }
		        if($key[4]=='3' || $key[4]=='4' || $key[4]=='5' || $key[4]=='6' || $key[4]=='7' || $key[4]=='8' || $key[4]=='9' || $key[4]=='10' || $key[4]=='11' || $key[4]=='12'){
		        	$student->seccion = 'EGB';
		        }
		        $student->idPeriodo = 1;
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
