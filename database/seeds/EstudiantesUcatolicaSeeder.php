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

class EstudiantesUcatolicaSeeder extends Seeder
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


            // INICIAL 2 A (3 AñOS)

            ['0960712586','ANAHI LUCIANA','CARRIEL SANCHEZ ','2'],
            ['0960741957','LUCAS GASTON','CASTAÑEDA PACHECO ','2'],
            ['0960826782','TAYRA FRANSHESKA','CHACAGUASAY ILVIS ','2'],
            ['0932957582','BENJAMIN NICOLAJ','CRUZ  TREJO ','2'],
            ['0932905656','EMILIANO DAVID','DAVILA CORNEJO ','2'],
            ['0932919285','OSCAR MATEO','GUAILLAS MANZANO ','2'],
            ['0932940760','SANTIAGO NICOLAS','GUILLEN CEVALLOS ','2'],
            ['0960734218','THOMAS ANDRES','LEON VERA ','2'],
            ['0932905367','CESAR SAMUEL','PALACIOS YANCE ','2'],
            ['0960631810','MEILING CRISTINA','RODRIGUEZ RODRIGUEZ ','2'],
            ['0960794097','JAVIER FRANCISCO','SANCHEZ SAÑAY ','2'],
            ['0961101607','AARON CALEB','URGILES VULGARIN ','2'],
            ['0960888527','PEDRO GABRIEL','VILLACRESES ROJAS ','2'],
            ['0932948359','BRUNO ANDRES','VILLAMAR TORRES','2'],
            ['0960764504','EDUARDO XAVIER','VILLAO  TUAREZ ','2'],
            ['0960906097','SCARLETT LUCCIANNA','VINUEZA TINOCO ','2'],
            ['0960570216','JOHANNA MAITE','ZAMBRANO JACOME','2'],
            

            // INICIAL 2 B (3AñOS)

            ['0932895436','GIOVANNI DAVID','BURNHAM QUIÑONEZ ','3'],
            ['0960378115','LUCIANA MARTINA','CADENA BARBERAN ','3'],
            ['0932855836','ARIANNA SOPHIA','CAMPOVERDE LUNA ','3'],
            ['0960628733','FABIANA VICTORIA','CORDOVA SOLIS ','3'],
            ['0960401313','CRISTHIAN JARED','CRUZ LEON ','3'],
            ['0960480762','THIAGO ANDRE','CRUZ ORELLANA ','3'],
            ['0960405231','GERMAN SEBASTIAN','CRUZ ORTIZ ','3'],
            ['0960468486','VALERIA SOPHIA','DAVILA MORLA ','3'],
            ['0960493310','IKER EMILIANO','DE VERA FLORENCIA ','3'],
            ['0960253623','MARIA PAZ','DELGADO ALONZO ','3'],
            ['0932884984','MATEO ITZAE','IRIGOYEN TORRES ','3'],
            ['0960434249','ADRIAN STEVEN','JIMENEZ GARCIA ','3'],
            ['0960521060','JULIO CESAR','LEON QUINTERO ','3'],
            ['0932882418','CARLOS ALEJANDRO','MONTALVO OLVERA ','3'],
            ['0960465409','NORMA ALEJANDRA','MOSQUERA ABARCA ','3'],
            ['0960531374','EZEQUIEL ALESSANDRO','OLEAS PAUCAR ','3'],
            ['0123456789','ARIANNA MELISSA ','RIOS MOREIRA ','3'],
            ['0932948367','TOMAS ANDRES','VILLAMAR TORRES ','3'],


            // INICIAL 2 C (3 AñOS)

            ['0960297687','DIEGO JOSUE','ATAUCHI PINCAY ','4'],
            ['0932843899','MARCOS FABRIZZIO','CABRERA RUIZ ','4'],
            ['3050455405','ANGEL IGNACIO','CARREÑO RODRIGUEZ ','4'],
            ['0960256295','BRITHANNY SOFIA','CEDEÑO MATUTE ','4'],
            ['0932874290','CARLOS OTMARO','CORDOVA ESCOBAR','4'],
            ['0960232189','FRANCISCO EMANUEL','CORAL URUETA ','4'],
            ['0960215044','DIEGO XAVIER','ESPINOZA TENORIO ','4'],
            ['0960259174','MAXIMILIANO JESUS','GAMBOA PANIMBOZA ','4'],
            ['0960289981','NATALIA SAMANTHA','GARCES ZAMBRANO ','4'],
            ['0960280865','LUCIANA VICTORIA','MORALES GUAJALA','4'],
            ['0932862923','MATHIAS HERNAN','ORTIZ YANCE ','4'],
            ['0932835143','KARLA RAFAELA','PANCHANA MORALES','4'],
            ['0960409985','JAKE MATTHEW','RIVERA DELGADO','4'],
            ['0960273365','LUIS JOSHUE','RUALES CUERO ','4'],
            ['0932830227','DANTHE MATHIAS','VALVERDE SALINAS ','4'],
            ['0960345080','SOPHIA LISSETTE','VILLAMAR LOOR ','4'],
            ['0960319903','JULIO CESAR','YANTEN DIAZ','4'],


            // INICIAL 2 A (4 AñOS)

            ['0932815913','CATALINA PAULETTE','AYALA ACOSTA ','5'],
            ['0932813066','DAVID SEBASTIAN','BORJA VILLACIS ','5'],
            ['0932772247','AYLEEN ANABELLA','CALVOPIÑA PERALTA ','5'],
            ['0960098358','MIA ALEJANDRA','CARRASCO GONZALEZ ','5'],
            ['0932807084','ANA VICTORIA','CHICAIZA QUIÑONEZ ','5'],
            ['0932872807','THIAGO EZEQUIEL','ESPINEL MORANTE ','5'],
            ['0960145415','BENJAMIN JEREMIAS','FABRE ROBLES ','5'],
            ['0932811854','DEREK SAMUEL','FERNANDEZ ALVAREZ ','5'],
            ['0960034056','RAPHAEL ARTURO','GAITAN SANTISTEVAN ','5'],
            ['0932796121','EMMA VIVIANA','HINOJOSA CASTRO ','5'],
            ['0932792914','FIORELLA VALENTINA','JORDAN CEDILLO ','5'],
            ['0960082071','THIAGO XAVIER','MERA CALDERON','5'],
            ['0960156537','JOSHUA EMILIANO','MONAR RODRIGUEZ ','5'],
            ['0959974932','CORINA YULIETH','ORTEGA BENJUMEA ','5'],
            ['0960043255','MIA NATALIA','ORTEGA MARTILLO ','5'],
            ['0932792732','JOSE FERNANDO','RAMOS MALAVE ','5'],
            ['0932806029','MATEO ANDRES','SIERRA GUERRERO ','5'],
            ['0960079655','AMANDA GRACE','TUAREZ FONSECA ','5'],
            ['0932801483','ROMINA VALENTINA','VARGAS RUIZ ','5'],
            ['0960085090','MIGUEL ANDRES','VILLALVA PALMA ','5'],
            ['0932812621','KEVIN AARON','ZAMBRANO VERA ','5'],


            // INICIAL 2 B (4 AñOS)

            ['0932700412','BRISSET ANTUANETTE','ALVARADO CEDEÑO ','6'],
            ['0530667984','GABRIELLE SEBASTIAN','CANO','6'],
            ['0932753130','CRISTINA DENISSE','CEDEÑO PAREDES ','6'],
            ['0959962796','JOSE DAVID','DOYLET VILLAVICENCIO ','6'],
            ['0960076362','SANTIAGO LEVI','FAUSTOS YANCE ','6'],
            ['0932683311','DAVID ELIAN','LARA GALARZA ','6'],
            ['0959725466','WALTER JARETH','LAURIDO LOPEZ ','6'],
            ['0932737794','JOSUE RAFAEL','LOPEZ AREVALO','6'],
            ['0932772726','IVANNA PAULETT','MENDOZA BANCHON ','6'],
            ['0959932385','DARIEL ANDRES','MEZA HERRERA ','6'],
            ['0960043230','AMELIA REBECA','ORTEGA MARTILLO ','6'],
            ['0959873027','ISABELLA ARELI','ORTIZ BERMEJO ','6'],
            ['0959955030','LIANG ABEL','PALMA ZAMBRANO ','6'],
            ['0932753825','ETHAN SANTIAGO','PAUTA MENDEZ ','6'],
            ['0932762750','MIA DELIA','PESANTES MACIAS','6'],
            ['0959897158','CARLOS ISMAEL','RAMOS ASTUDILLO ','6'],
            ['0932755200','OMAR SAID','REYES PEREZ ','6'],
            ['0932753338','LUCIANA DANIELA','ROJAS VALVERDE ','6'],
            ['0959991969','CLARA RENATA','SALGADO GALLARDO ','6'],
            ['0932766215','DIEGO LIONEL','TIGSE LUNA ','6'],
            ['0959870056','NATALIA GABRIELA','ZAMBRANO IBANEZ ','6'],
            

            // INICIAL 2 C (4 AñOS)

            ['0932723125','THIAGO EZEQUIEL','ALAVA TORRES ','7'],
            ['0932730864','JOSE JULIAN','BAJAÑA BENITEZ ','7'],
            ['0932722085','VICTORIA ISABELLA','BATALLAS RIVERA ','7'],
            ['0959543018','EMILIO SAUD','CAJAS RAMIREZ ','7'],
            ['0932767726','DANNA VALESKA','CONFORME SALVATIERRA ','7'],
            ['0959755927','ERICA MINERVA','CRESPO PLUA ','7'],
            ['0959708090','VICTORIA SOFIA','ESPINOZA MATIZ ','7'],
            ['0932729924','ANAHI','FRANCO RAMIREZ ','7'],
            ['0932735103','DANNA FERNANDA','GARCES SALAZAR ','7'],
            ['0932687510','LEONE ALEJANDRO','LALAMA FLORES ','7'],
            ['0959726878','ALEXIS FERNANDO','LOPEZ RIVERA ','7'],
            ['0959680802','SERGIO DANIEL','LOPEZ SOLEDISPA ','7'],
            ['0932737893','DAVID GABRIEL','LOZANO CRUZ ','7'],
            ['0932743461','ROBERTO ADRIAN','MACIAS QUIMIS ','7'],
            ['0932710171','ISABELLA DAYANA','PALACIOS FRANCO ','7'],
            ['0932688112','JAYLENE ISABELLA','PALADINES PLUAS ','7'],
            ['0932717614','ETHAN JOSUE','PAREDES JIMENEZ ','7'],
            ['0959863986','ARTURO EZEQUIEL','RIOS MORAN ','7'],
            ['0959655267','JOSSELYN DOMENICA','RONQUILLO MORAN ','7'],
            ['0932723398','ELIANA LEONOR','SANCHEZ CERVANTES','7'],
            ['0932720865','ISABELLA ESTEFANIA','SANCHEZ GARZON ','7'],
            ['0959639717','IGNACIO JAVIER','TORRES  GARCIA ','7'],


            // INICIAL 2 D (4 AñOS)

            ['0932685290','KEVIN JAIR','ARREAGA MUÑIZ ','8'],
            ['0932711245','ANNIE VALENTINA ','BAQUERIZO   NORIEGA ','8'],
            ['1151016878','RONNALD ALEJANDRO','CAMPOVERDE SANMARTIN ','8'],
            ['0932640410','CAMILA NAOMI','CARPIO PAREDES ','8'],
            ['0932683444','SEBASTIAN WILLIAM','CARVAJAL ESCALANTE ','8'],
            ['0932645369','EMANUEL JIMPSON','CARVALLO LAJONES ','8'],
            ['0932676596','JULIAN EMILIO','CEPEDA ZURITA ','8'],
            ['0932718349','ISABELLA VALESKA','CRUZ MENDOZA ','8'],
            ['0932676315','JOSE XAVIER','FREIRE CALERO ','8'],
            ['0932658990','JAVIER IGNACIO','HUAYAMABE LARREA ','8'],
            ['0932632581','DYLAN ALEJANDRO','LARA LAZO ','8'],
            ['0932623333','JHOMAR THIAGO','LUNA REYES ','8'],
            ['0959537309','HENRY MAXIMILIANO','MANRIQUE PONCE ','8'],
            ['0932674153','MAYRA MONSERRATE','MARTINEZ SANTAMARIA ','8'],
            ['0959516436','MIA ISABELLA','MENDEZ BAQUERO ','8'],
            ['0959334335','IVANNA POLET','MENDIETA MAYFREN ','8'],
            ['0932656689','KENDRY DIDIER','NIETO GAVILANES ','8'],
            ['0959258591','KLEBER ENRIQUE','POSLIGUA IGLESIAS ','8'],
            ['0959569591','JUAN ANDRES','RUIZ RAZZO ','8'],
            ['0959509167','AIDANA NAYARA','SALCEDO CARRANZA ','8'],
            ['0959458563','LIAM NOE','TORRES PERALTA ','8'],
            ['0959780784','LEONOR ANARELLA','YANEZ MENDOZA ','8'],


            // PRIMERO A

            ['0932392046','BRYAN DIMITRI','ALMEIDA RODITI ','9'],
            ['0959128851','LEONEL GONZALO','ALVARADO PEÑAFIEL','9'],
            ['0932619729','SANTIAGO EMMANUEL','BALLADARES DIAZ ','9'],
            ['0932370844','ANALIA ZAFRINA','BAZURTO MEDINA ','9'],
            ['0957696743','VERONICA ANGELINA','BUSTAMANTE BRAVO ','9'],
            ['0932567779','NOELIA CATALINA ','CANESSA VERA ','9'],
            ['0958070252','DIEGO ALEJANDRO ','CARDENAS LEON ','9'],
            ['0957864887','ERYK MAXIMILIANO','CHELA NUÑEZ ','9'],
            ['0958986101','CAMILA ALEJANDRA','CHICAIZA LLUGSHA ','9'],
            ['0959128950','MATIAS NOEL','CORREA ORRALA','9'],
            ['0958226631','RICARDO MATIAS ','CUADRA GARCIA ','9'],
            ['0932482383','MIA PAOLA','FLOR  VULGARIN','9'],
            ['0932589450','JOSUE ANIBAL','GUERRA AVILES ','9'],
            ['0958385635','ALEJANDRA MARELYS','GUERRERO REINOSO ','9'],
            ['0959246067','EMA MICAELA','MEDINA CRESPO ','9'],
            ['0932516529','SABRINA ISABELLA','MUÑOZ MARISCAL ','9'],
            ['0932537624','KAREN ELENA ','ORTEGA  MARTILLO','9'],
            ['0956606529','JONATHAN ANTONIO','PALACIOS RUIZ ','9'],
            ['0956581631','GIULIANA NAOMI','PAREDES MORAN ','9'],
            ['0957814098','DIEGO EMILIANO','PAZ PARRA','9'],
            ['0958443988','PEYTON SARAHI','SALVATIERRA IDROVO ','9'],
            ['0958582462','FABIANA PAULETTE','TERAN  YEPEZ ','9'],
            ['0933007908','MIA VALENTINA','VELIZ PAZMIÑO ','9'],
            ['0932470255','LEONARDO ELIAS','ZAMBRANO CAICEDO ','9'],


            // PRIMERO B

            ['0958345795','SAMANTHA DENISSE','BANCHON PERALTA ','10'],
            ['0932519069','JAMES JULIAN','BRAVO MOLINA ','10'],
            ['0956559413','VICTORIA EMILY','CAJAS RAMIREZ ','10'],
            ['0932361785','DANIEL SEBASTIAN','CARPIO PAREDES ','10'],
            ['0960153294','SURI SHAIEL','CEDEÑO VEGA ','10'],
            ['0932749302','VICENTE DANILO','CHAMORRO GAIBOR ','10'],
            ['0932454671','LUCIANNA PAULETTE','ESPAÑA VARGAS ','10'],
            ['0958179608','MIGUEL ADOLFO','FREIRE REYES ','10'],
            ['0957978745','CRISTOPHER ALEJANDRO','JARAMILLO SOLIS ','10'],
            ['0923503924','JORGE PAUL','LLUSCA ALMEIDA ','10'],
            ['0932517386','JOSE FRANCISCO','LOOR YEPEZ ','10'],
            ['0957194244','VIOLETTE VALENTINA','MENDOZA HUNTER ','10'],
            ['0932621378','DYLAN JAHIR','MEZA SORIANO ','10'],
            ['0932467186','DAMARYS FABIANA ','NAVARRETE TROYA ','10'],
            ['0958929382','FREDDY SAUL','NONURA SANCHEZ ','10'],
            ['0932402480','AYNOA CAMILA ','OCHOA FALCONES ','10'],
            ['0959754524','CAMILA ALICIA','PLAZA PACHECO ','10'],
            ['0958998775','LUCIANA SARIAH','PONCE ROSADO ','10'],
            ['0932538028','HENRY ARTURO','RIOS MOREIRA ','10'],
            ['0932405202',' ISABELLA PAULLETE','ROSALES RODRIGUEZ','10'],
            ['0956632244','GRACE ZULAY','SALAZAR ARTEAGA ','10'],
            ['0959688706',' NATHALIA RAFAELA','TORAL IBARRA','10'],
            ['0958052417','ENGELLY LISSETH','VINCES LOPEZ ','10'],
            ['0932471832','MATIAS JAVIER','YUQUILIMA AMON ','10'],


            // PRIMERO C

            ['0958792533','SOPHIA DAYANNA','APUPALO CASTRO ','11'],
            ['0958396822','MATTHEW XAVIER','ARIAS CASTRO ','11'],
            ['0958825382','LUCAS GABRIEL ','ARMAS   VELASQUEZ ','11'],
            ['0956621668','MIRELLY SOPHIA','BOSQUEZ VINUEZA ','11'],
            ['0932576291','CARLOS DAVID','BRIONES RIVERA ','11'],
            ['0956430995','EMILY GIOVANNA','CAICEDO MEJIA ','11'],
            ['0957424781','ISAAC JOSE','CASTILLO MARTILLO ','11'],
            ['0956874853','STEFANIA EVANGELINE','CORAL URUETA ','11'],
            ['0956775639','JORGE ANDRES','GONZALEZ AVILES ','11'],
            ['0959194564','LIA RAPHAELA','GUILINDRO ZAMORA ','11'],
            ['0932438989','VALERIE ELEANE','HARO QUINDE ','11'],
            ['0957231137','NINOSKA ANABELLA','JARAMILLO YANTEN ','11'],
            ['0932428394','CHRISTINA KENDRA','LEON CABADA ','11'],
            ['0960192359','THIAGO GABRIEL','LOPEZ GOMEZ ','11'],
            ['0932539646','EMILIANO VALENTIN','MIELES GOMEZ ','11'],
            ['0932609274','SEAN MAIKELL','MOSCOSO PILATAXI ','11'],
            ['0932592892','MATHIAS ALBERTO','NARANJO RUGEL ','11'],
            ['0932525249','VICTORIA GABRIELA','ORTIZ AVILES ','11'],
            ['0932594450','KYARA VALENTINA','RIVERA VITERI','11'],
            ['0932624323','LUCIANA MARGARITA','SACA FAUBLA ','11'],
            ['0932457971',' CALEB AMIR','SOLIS MIRANDA','11'],
            ['0959603713','PAULA','VELIZ FLOR ','11'],
            ['0958840712','FABIANA ISABELLA','ZAMBRANO MENDIETA ','11'],


            // SEGUNDO A

            ['0955647458','KRISTEN MELINA','AGUILAR MONTES ','12'],
            ['0955206461',' ALLAN DANIEL ','BAQUERIZO NORIEGA','12'],
            ['0932263452','ANA MARIA','BATALLAS RIVERA ','12'],
            ['0932222144','OLIVER DAVID  ','ESPINOZA  VERGARA  ','12'],
            ['0932236029','MARIA PAZ','FARFAN HENRIQUEZ','12'],
            ['0954785572',' IVANNA VALESKA','FERNANDEZ  CARRILLO','12'],
            ['0932297849','BIANCA SOFIA','GONZALEZ  MORALES ','12'],
            ['0955547773','DANIEL ANTONIO','GUTIERREZ CASTRO ','12'],
            ['0932197536','DIEGO STEFANO','JAMBAY BRIONES ','12'],
            ['932322597','LUCIANA DOMENICA ','MENDIETA BAJAÑA ','12'],
            ['0956215297','MOISES ANDRES','MENESES RIASCO ','12'],
            ['0932166507','SCARLETT GENEVIEVE','MERA  ALBAN ','12'],
            ['0932205685','YARELYS NARCISA','NAVAS  TRIANA ','12'],
            ['0932154131','JULIET MARIANA','PALACIOS PILOSO ','12'],
            ['0932217797','JAIME ELIAS','QUIÑONEZ BRAVO ','12'],
            ['0932304546',' SANTIAGO DAVID','REYES  BARRERA  ','12'],
            ['0932361702','ISAAC DANIEL','RODRIGUEZ PILAY ','12'],
            ['0954639811','CAMILA DANIELA','SAMANIEGO CABRERA ','12'],
            ['0956523757','EMILIANO SEBASTIAN','SOTO ROMERO ','12'],
            ['0956034193',' MARCO JOAO','TOLEDO NEIRA','12'],
            ['0932299332','KEIRA VALENTINA','TORAL IBARRA','12'],
            ['0955984059','KATALINA ELIZABETH','YANEZ YUQUILEMA ','12'],
            ['0932370778','LEONARDO BENJAMIN','ZAMORA  BAYAS ','12'],
            ['0955253307','NICOLAS ANDRES','ZAPATA MOYA ','12'],


            // SEGUNDO B

            ['0955809975',' ESTEFANO VALENTINO','ALVARADO PEÑAFIEL','13'],
            ['0932359490','BIANCA ANABELLA','BARRE VERA ','13'],
            ['0932264039','DANIEL NICOLAS','BOHORQUEZ  ARELLANO ','13'],
            ['0932155955','YESHUA MARTIN','CABALLERO MELENDREZ ','13'],
            ['0955802913','CRISTOPHER RICARDO','CHIMBO MARTILLO ','13'],
            ['0932317183','JORDY GUSTAVO  ','DAVILA  CORNEJO ','13'],
            ['0955947247','MAYUMI ALEJANDRA','DEMERA WONG ','13'],
            ['0932181613','CAMILA LUCCIANA','DUMANI PACHECO ','13'],
            ['0932253586','FIORELLA NAOMI','ESPINOZA BALON ','13'],
            ['0955011440','ISABELLA CRISTINA','GORDILLO MENDOZA ','13'],
            ['0954996948',' ISABELLA     ','HIDALGO  HENRIQUEZ','13'],
            ['0932259757','VALERIA FERNANDA','HINOJOSA  CASTRO ','13'],
            ['0932336753','RUBBER JEANPOOL','LOOR  CARRASCO ','13'],
            ['0955231527',' THIAGO JACOB','LOOR PEREZ','13'],
            ['0932201296','MATTHEW SEBASTIAN','MANRIQUE ANCHUNDIA ','13'],
            ['0955776117','MATHIAS SAMUEL','NOBOA RESABALA ','13'],
            ['0954468229','PABLO SEBASTIAN','ORRALA CALERO ','13'],
            ['0932213903','LUCIANA JACQUELINE','PAREJA  JAIME ','13'],
            ['0955580048','MAYTHE ADABEL','PEREZ BENAVIDES ','13'],
            ['0932251523','LUCIANA VALENTINA ','RODRIGUEZ  CORREA ','13'],
            ['0955996178','DIEGO FERNANDO','SANCAN JARAMILLO ','13'],
            ['0954985875','AMELIA BELEN','TUAREZ FONSECA ','13'],
            ['0954639290','SALMA DANIELLA','VEINTIMILLA FIGUEROA ','13'],
            ['0956507420','ANDREW GIOVANNI','VELEZ MALDONADO ','13'],


            // TERCERO A

            ['0932170780','SURI VALESKA','AGUIRRE PAZMIÑO ','14'],
            ['0953225257','DANNA VALENTINA','ALBUJA LOAYZA ','14'],
            ['0953273620',' TAIRA ROMINA','ALVAREZ REINA','14'],
            ['1350284939','IVANNA JULIETTE','BURBANO LOZA ','14'],
            ['0953183563','ELIAN ALEJANDRO','CASTAÑEDA PACHECO ','14'],
            ['0932082993','CHIARA VALENTINA   ','CASTRO  FALCONES ','14'],
            ['0954170510','ALIZ ADAMARIS','CEDEÑO MOSQUERA ','14'],
            ['0932122781','DANNA AGUSTINA','CEPEDA ZURITA ','14'],
            ['0953222981','MATHIAS JOSUE','DELGADO PONGUILLO ','14'],
            ['0931922116','ANDREA XIOMARA','FERNANDEZ CARRILLO ','14'],
            ['0954441473','ALEXANDER EDUARDO  ','GARZON   MORALES ','14'],
            ['0954161592','SELENA STEFANIA','GOMEZ  BARBOSA ','14'],
            ['0931958003','MIGUEL ANGEL ','GRANADOS   MORENO           ','14'],
            ['0954703773','ELISA MIA','MEDINA   CRESPO      ','14'],
            ['0954312690','JUAN SEBASTIAN ','MENDEZ   BAQUERO   ','14'],
            ['0932145550','ADELA ISABEL  ','RIOS   MOREIRA ','14'],
            ['0954097762','LUCIANA RAFAELA','RODAS MONCAYO ','14'],
            ['0932158892','EMILIO JESUS  ','RUGEL  AVENDAÑO ','14'],
            ['0953859394','BRYAN GIOVANNY','SELLAN VENTURA ','14'],
            ['0931955397','CAMILA NICOLE    ','TORRES VILLAVICENCIO ','14'],
            ['0932173008','JAIME LEONARDO','VARGAS PEÑAHERRERA ','14'],
            ['0957624083','GIULIANO','VASQUEZ ZUMBA ','14'],


            // TERCERO B

            ['0953453149','DAYANNA RAFAELA','ARIZAGA ROMERO ','15'],
            ['0952453421','CARLOS ANDRES','ARRIAGA SUAREZ ','15'],
            ['0952354785',' HEIDY AMELIA','BOSQUEZ VINUEZA','15'],
            ['0932164288','ADAMARIS LILIBETH  ','CARDENAS SUAREZ       ','15'],
            ['0932121577',' DAMIANA MICHELLE','DIAZ ESPINOZA','15'],
            ['0932116981','CARLA RAFAELLA','ESPAÑA VARGAS ','15'],
            ['0932237555','CHRISTOPHER ALEXANDER','ESPINOZA DIAZ ','15'],
            ['0954117321','ANDRES ERNESTO ','FAUSTOS YANCE ','15'],
            ['0954590923','JOSE ARMANDO','JINES CAJAS ','15'],
            ['0954292603','MATHEWS DARLING','LASCANO VARGAS ','15'],
            ['0932111594','CAMILA GUADALUPE','LOOR  MERO ','15'],
            ['0954495099','NATASHA CAMILA','LOPEZ OCHOA ','15'],
            ['1755839907','GEORGE DOMINIQUE','MEDINA  MONCAYO ','15'],
            ['0932135460',' JEREMY JOHAN','MERO BRIONES','15'],
            ['0954121166','PAULETTE ALANNA','NIETOGAVILANES ','15'],
            ['0932146541','LINDA ELIZABETH','PARRA RICAURTE ','15'],
            ['0931940837','DANNA IRINA','PERDOMO  BUSTOS','15'],
            ['0954016341','ELIAS GEOVANNY','RODRIGUEZ TREJO ','15'],
            ['0954176046','SAMANTHA KATRINA','SALVADOR SUAREZ ','15'],
            ['0952946333','ERICK JAHIR','SALVATIERRA IDROVO ','15'],
            ['0953036134','DANIELLA TAIS','SAMPEDRO IZA ','15'],
            ['0931946552','ARIANA DANIELLA','SANCAN JARAMILLO ','15'],


            // CUARTO A

            ['0952088672','ANA PAULA','ALVARADO FIGUEROA ','16'],
            ['0951462613','LEONARDO NICOLAS','APUPALO CASTRO ','16'],
            ['0961419447','CAMILO ANDRES','BAIDAL SELLAN ','16'],
            ['0931853857','MATIAS GABRIEl','BATALLAS RIVERA ','16'],
            ['0952002756','SAMANTHA MICAELA','BORBOR BAQUE ','16'],
            ['0951508159','SERGIO MATIAS','CADENA BARBERAN ','16'],
            ['0952770220','MAILYNG PAOLA','CARRASCO CARPIO ','16'],
            ['0931736532','MARIA ROMINA','CHAMORRO GAIBOR ','16'],
            ['0931826978','JOSE MIGUEL','CORDOVA ILLINGWORTH ','16'],
            ['0931802409','MARIA EMILIA','CORREA ESPINOZA ','16'],
            ['0952577583','SAMUEL ADRIAN','DONOSO GONZALEZ ','16'],
            ['0951459098','GEMA GUADALUPE','GONZALEZ AVILES ','16'],
            ['0931850457','CRISTINA VALERIA','GONZALEZ SALGUERO ','16'],
            ['0952298800','MATHIAS DUVAN','JURADO LUNA ','16'],
            ['0931961197','GIANCARLOS ENRIQUE','LEON   AVILES ','16'],
            ['0931608962','DANIEL FRANCISCO','LOOR  YEPEZ ','16'],
            ['0951338177','MAITE VERONICA','MANRIQUE PONCE ','16'],
            ['0931676530','DERECK STALIN','MERA  ALBAN ','16'],
            ['0951396860','MATIAS JAVIER','MIELES  GOMEZ ','16'],
            ['0931705446','JUAN PABLO','MONTIEL  MOREIRA ','16'],
            ['0931646996',' MARCO ANTONIO','OCHOA  FALCONES','16'],
            ['0931811517','OLIVER ALEJANDRO','OCHOA MENDEZ ','16'],
            ['0931721435','ARIEL ALEXANDER','OCHOA RIVERA ','16'],
            ['0931781405','ROGER MAVERICK','PFEIL  ABAD ','16'],
            ['2250026156','MARIA JOSE','PROAÑO LEDEZMA ','16'],
            ['0931696082','KIANNA GABRIELA','QUIROZ  PARRAGA ','16'],
            ['0952002418','DANIEL EDUARDO ','REINOSO WONG ','16'],
            ['0931771158','AMELIA JULIETT','RIOS MOREIRA ','16'],
            ['0931828503','GONZALO MISAEL','RIVADENEIRA ROJAS ','16'],
            ['0931979553','ASHLEY DAYANNA','RIVERA ESPINOZA ','16'],
            ['0931776546','BYRON OMAR','RIZZO BOHORQUEZ ','16'],
            ['0952794055','JUAN PABLO','RIZZO LAVAYEN ','16'],
            ['0952111532','JANELLE ANGELINA ','ROBALINO PAZMIÑO ','16'],
            ['0931698443','JEREMY MATEO   ','ROSERO SANTANA ','16'],
            ['0931678007','SHELBY DANAE','SANCHEZ AVILES ','16'],
            ['0931839674',' KEILA ALEJANDRA','TENESACA RIVAS','16'],
            ['0931701858','EMANUEL BENJAMIN','VELIZ  PAZMIÑO ','16'],
            ['0931680565','THIAGO DIDIER','VINUEZA TINOCO ','16'],
            ['0931803464',' PAULA VALENTINA','VITERI CEDEÑO','16'],


            // QUINTO A

            ['0950430199','HECTOR DANIEL','ALVAREZ REINA ','17'],
            ['0931259618','HAROLD JOEL','ARROYO RAMIREZ ','17'],
            ['0950508580','MARIA FERNANDA','AVILES SORIANO ','17'],
            ['0950453621','AYLEEN GABRIELA','BANGUERA RONQUILLO ','17'],
            ['0931340822',' MATHIAS JARED ','BARBA   HERRERA    ','17'],
            ['0951199553','JUAN MATEO     ','BARREIRO  AVELLAN ','17'],
            ['0931380497','EMILY POLET','CABRERA ASPIAZU ','17'],
            ['0951339704','LINDA GABRIELA','CHACAGUASAY ILVIS ','17'],
            ['0932064405','RENATTA VALENTINA','ESCOBAR ORDOÑEZ ','17'],
            ['0931443469',' THIAGO BRUNO ','ESPINOZA  MATIZ','17'],
            ['0931419444','NATALIA ANALYS','FAJARDO PLUAS ','17'],
            ['0931563985','ADRIANO EMILIO','FARFAN HENRIQUEZ','17'],
            ['0931313332','CAMILA','FUERTES  CHICA ','17'],
            ['0931303341','ANAHI JANICE','HARO QUINDE ','17'],
            ['0931342828','ALMA DOMENICA','HUAYAMAVE LOPEZ ','17'],
            ['0931548481','ADRIAN VINICIO','HURTADO LAZ ','17'],
            ['0955049598','LADY VANESSA','LEON CHACAGUASAY ','17'],
            ['0931342612','VALENTINA DE LOS ANGELES','LOZANO MENA ','17'],
            ['0952893105','ANTONNY DANIEL','MACIAS PINARGOTE ','17'],
            ['0931590715','ISABELLA IVANNA ','MALDONADO  MATOS ','17'],
            ['0951411412','AXEL JOSUE','MENDIETA MAYFREN ','17'],
            ['0931371710','OSCAR JOSHUA','MOSQUERA NUÑEZ ','17'],
            ['0931516710','RENATHA ALEJANDRA','NARANJO MALDONADO ','17'],
            ['0931576110','JEAN MARCOS','NUÑEZ ARELLANO ','17'],
            ['0950820639','MATEO ALEJANDRO','NUÑEZ FELIX ','17'],
            ['0931581482','CARLOS MATIAS','ORTIZ BERMEJO ','17'],
            ['0931565493','YELENA PAULETTE','RENGEL PONCE ','17'],
            ['0952139186',' FELIX EMILIO','SAMPEDRO IZA','17'],
            ['0950569780','EMMA VICTORIA','VIDAL CEPEDA ','17'],
            ['0950493759','JOSE ROBERTO','VITERI VALVERDE ','17'],


            // SEXTO A

            ['0950264028','BRIANA FRANCESCA','ALVARADO CEDENO ','18'],
            ['0931066369','ZULEIKA FIORELLA','ALVAREZ DOMINGUEZ ','18'],
            ['0954062154','YANITZA GIANELLA','BRAVO GONZALEZ ','18'],
            ['0931227193','WILMER ANDRES','CABRERA VILLAMAR ','18'],
            ['0950377200','DYLAN JULIAN       ','CASTRO  HERRERA       ','18'],
            ['0951969526','MAURICIO NICOLAS ','CEBALLOS  TUTIVEN ','18'],
            ['0931255954','HENRY SAHID','ELIAS  MANCHENO ','18'],
            ['0930959903','FERNANDA CAMILA    ','ESPINOZA   VALDEZ ','18'],
            ['0950561217','JUAN EMILIO','GARCIA FRANCO ','18'],
            ['0950131854','KIARA DANITZA','HERNANDEZ   FRANCO        ','18'],
            ['0956569107','AXEL ARIEL','HERNANDEZ  MOLINA ','18'],
            ['0931277537','GIA LUCIANA','INTRIAGO ORMAZA ','18'],
            ['0950789784','ROBERTO ALEJANDRO','JAMBAY  BRIONES ','18'],
            ['0950286831','DANTE GIANPIERRE','JARAMILLO  YANTEN ','18'],
            ['1208465524','SAMANTHA NOELIA','LLAGUNO BUSTAMANTE ','18'],
            ['0950238345','BYRON ADRIAN  ','MARTINEZ  BRIONES ','18'],
            ['0931220404','MARIA DANIELLA','MARTINEZ  CORREA ','18'],
            ['0931279707','EVA MILENA','MEDINA  CRESPO ','18'],
            ['0954082145','JOHAN GABRIEL','MENDIETA  BAJAÑA ','18'],
            ['0956652796','MATHEW SEBASTIAN','MOREIRA  CORREA ','18'],
            ['0958838351','CAMILA DOMÈNICA','NOBOA  RESABALA ','18'],
            ['0950489336','ABEL ENRIQUE','PAGUAY REYES ','18'],
            ['0931169429',' MATHEW ANDRE','PAREDES  GARCES','18'],
            ['0954830725','ELVIS ALAN   ','PAREDES  JIMENEZ ','18'],
            ['0950427138','ILIANA MAITE','PEREZ  VILLACRESES ','18'],
            ['0930931019','LEONARDO ANDRES','QUIROZ  PARRAGA ','18'],
            ['0931205439','RAFAELA ALEJANDRA','RAMIREZ ARRIAGA ','18'],
            ['0950206748','KRISTEL FRANCESCA','RENDON  CORDOVA ','18'],
            ['0931308712','ANA VICTORIA','ROSALES RODRIGUEZ ','18'],
            ['0951148840','LUIS SEBASTIAN','SALAZAR MOSQUERA ','18'],
            ['0944169275','NICOLE ALEJANDRA','SOTO ROMERO ','18'],
            ['0931297220','NICOLE ALEJANDRA','TORAL IBARRA ','18'],
            ['0930914262','RONY SAMUEL','TORO PIN ','18'],
            ['0950315648','PAULETTE MERCEDES','TORRES GARCIA ','18'],
            ['0930959283','ANDRES JOSUE','VELIZ  PAZMIÑO ','18'],
            ['0957931207','JEREMIAS PAUL','VILLON REINOSO ','18'],


            // SEPTIMO A

            ['0930749007','ADRIAN ISAAC','ARIAS MONTALVAN ','19'],
            ['0943890343','MARIA GABRIELA','AVILES SORIANO ','19'],
            ['0951863190','ALAN GABRIEL','BANGUERA RONQUILLO ','19'],
            ['0955667571','PIERINA ISABELLA','CEDEÑO BALDEON ','19'],
            ['0951339787','LEONELA BONITA','CHACAGUASAY ILVIS ','19'],
            ['0930626262','ALEX DANIEL','CHIMBO MARTILLO ','19'],
            ['0958951386','SERGIO ANDRES','CHOEZ MUÑOZ ','19'],
            ['0930583471','MELANIE YULIANA','CRESPIN PINEDA ','19'],
            ['0930600283','JORDAN ALFREDO','ESPINOZA VEGA ','19'],
            ['0952823086',' ANAHI CRISTINA','FERNANDEZ INTRIAGO','19'],
            ['0950592196','MARIA ALEJANDRA','FREIRE DORADO ','19'],
            ['0953331022','PAULA LUCIANA','FUERTES CHICA ','19'],
            ['1727660084','AVRIL VALENTINA','HIDALGO HENRIQUEZ ','19'],
            ['0951287499','DAMARIS ZARAHI','HUAYAMAVE LACERA ','19'],
            ['0930379821','HANNE MILENA','INSUASTI TORRES ','19'],
            ['0953995669','DANNA NARCISA','LOPEZ AREVALO ','19'],
            ['0954330353','JORDY SANTIAGO','MERO BRIONES ','19'],
            ['0931437180','JOEL SEBASTIAN','MIRANDA VIERA ','19'],
            ['0955455894','DANNA ISABELLA','MONTALVO OLVERA ','19'],
            ['0952944155','ANA PAULA','MONTIEL MOREIRA ','19'],
            ['0944212018','OLIVER ANDRES','MOREIRA DELGADO ','19'],
            ['0957572266','MATHIAS RENE','MORENO RICAURTE ','19'],
            ['0930746599','JORGE FRANCISCO','NEIRA CONSTANTINE ','19'],
            ['0951094119','PHOEBE RACHEL','PAREDES LOOR ','19'],
            ['0954168563','SAID SEBASTIAN','PIEDRAHITA MERO ','19'],
            ['0932512536','ISABELLA SOFÌA','RAMIREZ ARRIAGA','19'],
            ['0930785597','EMILY RAFAELA','RIVADENEIRA ROJAS ','19'],
            ['0930359021','PAUL ANDRE','RODRIGUEZ MACIAS ','19'],
            ['0202701389','ADRIAN FARID','RODRIGUEZ WILCASO ','19'],
            ['0955597141',' ZULEYKA FERNANDA','ROMERO CEPEDA','19'],
            ['0930747571','LAYLA FIORELLA','RONQUILLO VILLAGOMEZ ','19'],
            ['0930690144','DOUGLAS ALEXANDER','SUAREZ BOWEN ','19'],
            ['0930366752','DIEGO MANUEL','VEINTIMILLA FIGUEROA ','19'],
            ['0943909069','NASHLIE MAITE','VERA LYNCH ','19'],
            ['0940843048','MARIA PAOLA','VITERI VALVERDE ','19'],
            ['0956744262','GEAMPIER ADRIAN','ZAMBRANO ORRALA ','19'],


            // OCTAVO A

            ['0954058384','DERECK BENJAMIN','ALVARADO FIGUEROA ','20'],
            ['0951863034','ABEL DAVID','BANGUERA RONQUILLO ','20'],
            ['1729945723','STALIN JOSUE','BAQUEDANO MUYUDUMBAY ','20'],
            ['0930267083','VALESKA PIERINA','BARBA HERRERA ','20'],
            ['0931374573','DIEGO ALEJANDRO','BRAVO GARCIA ','20'],
            ['0930334297','ROSSY STEFANIE','CAMPOVERDE VACACELA ','20'],
            ['0951301688','JOSE MIGUEL','CASTRO FALCONES ','20'],
            ['0930311626','JUAN PABLO','DOYLET VILLAVICENCIO ','20'],
            ['0957173016','ADRIAN GABRIEL','ESPAÑA VARGAS ','20'],
            ['0931752257','ROLANDO ISAAC','ESPINALES CEDEÑO ','20'],
            ['0953494176','ESTEFANY MICHELLE','ESPINOZA DIAZ ','20'],
            ['0930338520','MARIA ALEJANDRA','ESPINOZA MATIZ ','20'],
            ['0932398407','HEIDI ELIZABETH','GONZALEZ AVILES ','20'],
            ['1208465508','JOSE ALEXANDER','LLAGUNO BUSTAMANTE ','20'],
            ['0959029190','DALLELY JULIXA','MOREIRA VELEZ ','20'],
            ['0954434338','MELISSA ANALIA','MURILLO CORONEL ','20'],
            ['0930020458','HECTOR ENRIQUE','OÑATE VERDUGA ','20'],
            ['0930346606','YUMEI ALEJANDRA','PALMA ZAMBRANO ','20'],
            ['0943442293','RONNY JESUS','RUGEL AVENDAÑO ','20'],
            ['0930196449','KASSIANA VALENTINA','SACA FAUBLA ','20'],
            ['0930089396','ALLISON NICOLE','SALAZAR ARTEAGA ','20'],
            ['0954773131','FIORELLA CRISTINA','SAMANIEGO CABRERA ','20'],
            ['0953791548','PAMELA DHAYUMA','SELLAN VENTURA ','20'],
            ['0931257976','DEREK JOSUA','VILLEGAS ALBUJA ','20'],
            ['0941264624','LUIS SEBASTIAN','ZUÑIGA RAMIREZ ','20'],


            // NOVENO A 

            ['0930001508','ISAAC LIONEL','AGURTO VEGA ','21'],
            ['0932418668','ANA PAULA','ARREAGA CARVALLO ','21'],
            ['0943712059','NAHOMI BELEN','BAQUEDANO MUYUDUMBAY ','21'],
            ['0932356165','ANDREA VICTORIA','BARRIOS ALAVA ','21'],
            ['0959447590','SARAHI MILENA','BORBOR BAQUE ','21'],
            ['0954082871','ELKIN GABRIEL','CASTAÑEDA PACHECO ','21'],
            ['0929284966','MATIAS MAURICIO','CEBALLOS TUTIVEN','21'],
            [' 0932341217','NATHALIA SILVANA','CRUZ MUÑOZ ','21'],
            ['0955187497','MARINA LILIBETH','DESIDERIO  VERGARA ','21'],
            ['0952851152','LIAH NICOLE','FERNANDEZ INTRIAGO ','21'],
            ['0953474392','JOHN JAIRO','GELO PETERSEN ','21'],
            ['0952430890','DIDIER PAUL','GIL ZAMBRANO ','21'],
            ['0955154208','JENIFFER JAEL','GUALE HOLGUIN ','21'],
            ['0952573012','FIORELLA NICOLE','HENRIQUEZ ENDERICA ','21'],
            ['0950526673','ISAAC ENRIQUE','LONDOÑO PAREJA ','21'],
            ['0955138169','JAEL JHOAN','MAGALLANES LOPEZ ','21'],
            ['0943450189','MARIA DANIELA','MARRIOTT BUSTAMANTE ','21'],
            ['0951569748','BYRON JOSUE','MARTINEZ BRIONES ','21'],
            ['0954441259','MIGUEL ALFONSO','MURILLO CORONEL ','21'],
            ['0958424806','JOSE XAVIER','OCHOA MENDEZ ','21'],
            ['0931877591','AXEL BENJAMIN','OCHOA ROSALES ','21'],
            ['0951039064','CHARLOTTE ANNETTE','PAREDES LOOR ','21'],
            ['0944295682','JAIR ARIEL','PAREJA JAIME ','21'],
            ['0943450130','DAVID ALEJANDRO','PATIÑO PAZMIÑO ','21'],
            ['0930387600','XAVIER ANDRES','PERDOMO BUSTOS ','21'],
            ['0956680292','JOAN ALBERTO','PEREZ VILLACRESES ','21'],
            ['0943747592','ISAAC ALEXANDER','SAAVEDRA CARRILLO ','21'],
            ['0952700656','JUAN ANDRES','SALAZAR ARTEAGA ','21'],
            ['0943152348','NATHALY CAMILA','VELEZ BERMEO ','21'],


            // DECIMO A

            ['0953396629','SEBASTIAN DAVID','ALVARADO PEÑAFIEL ','22'],
            ['0931877260','JANNETHE NICOL','ARREAGA CARVALLO ','22'],
            ['0930377304','CESAR OSWALDO','BERMEJO VERA ','22'],
            ['0926816505','MARIO EMILIO','CADENA BARBERAN ','22'],
            ['0959313230','GABRIEL ISAIAS','CALDERON VERA ','22'],
            ['0954232146','DOMENICA SOLANGE','CARPIO CHEME ','22'],
            ['0943761767','ANGELICA NATASHA','DOMINGUEZ MORAN ','22'],
            ['0957173008','DARIO ALEJANDRO','ESPAÑA VARGAS ','22'],
            ['0953639796','OMAR ANDRES','HERNANDEZ PIÑA ','22'],
            ['0928663822','CARLOS ANDRES','JAMBAY BRIONES ','22'],
            ['0932042278','ERICK GABRIEL','MACIAS QUIMIS ','22'],
            ['0940646466','DIEGO ANTONIO','MARTINEZ CORREA ','22'],
            ['0931702955','DIEGO ANDRES','MARTINEZ RUIZ ','22'],
            ['0926641481','CARLOS DAVID','MAZON SUAREZ ','22'],
            ['0959029117','ROXANA ESTHELA','MOREIRA VELEZ ','22'],
            ['0958424962','CARLOS DANIEL','OCHOA MENDEZ ','22'],
            ['0931985238','CAMILA ABIGAIL','OCHOA RIVERA ','22'],
            ['0932348790','AISHA NOELIA','PALACIOS SALAZAR ','22'],
            ['0932071772','DOUGLAS ESTEFANO','SUAREZ BURGOS ','22'],
        
        );


		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
        	$student->ci = $key[0];
        	$student->nombres = $key[1];
        	$student->apellidos = $key[2];
        	$student->sexo = 'Masculino';
        	$student->fechaNacimiento = '01-01-2000';
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	$student->matricula = 'Ordinaria';
            $student->idCurso = $key[3];
            $idPeriodo = 1;
            $student->retirado= 'NO';
            
            //SE GUARDA LA SECCION DEPENDIENDO DEL CURSO
			if ($key[3]<9){            $student->seccion = 'EI';			}
			if ($key[3]>8){            $student->seccion = 'EGB';		    }
			
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