<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;
use Carbon\Carbon;
use App\Fechas;

class EstudiantesElSamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = array(
        //INICIAL 1
			['AGUILAR ARROYAVE','THIAGO ANDRE','Masculino','2451012658','9/4/2015','1'],
			['ALARCON DUMANI','RONNY ARAFACK','Masculino','0932883903','1/9/2016','1'],		
			['AVALOS GUARTATANGA','JOSE DANIEL','Masculino','0960401073','12/7/2015','1'],
			['CARVAJAL ZAMORA','EMILIA ALEJANDRA','Femenino','1234567890','4/19/2016','1'],
			['ESPINOZA ICAZA','ANNE SOPHIA','Femenino','0960840814','6/24/2016','1'],
			['FERNANDEZ BUENAIRE','ALAIA VALENTINA','Femenino','1234567890','1/11/2010','1'],
			['GUEVARA PERALTA','SOPHIE RAFAELLA','Femenino','0961068863','10/7/2016','1'],
			['GUEVARA TUMBACO','LUCAS NATHANAEL','Masculino','2451068536','7/1/2016','1'],
			['ORDOÑEZ BAJAÑA','JOAQUIN ANDRE','Masculino','0960785228','5/19/2016','1'],
			['SOTOMAYOR AGUILAR','AMY KRYSTLE','Femenino','0932692338','11/22/2014','1'],
			['SOTOMAYOR AGUILAR','SERGIO ALBERTO','Masculino','092366198','6/15/2013','1'],
			['SUAREZ BUENAIRE','ARIANA ISABELLA','Femenino','0960575843','2/24/2016','1'],
			['TORRES BAJAÑA','AINHOA','Femenino','0932815871','1/11/2010','1'],	
			['VINUEZA MUÑOZ','EMMA FERNANDA','Femenino','0932901200','3/10/2016','1'],
			['YAGUAL ZAVALA','SANTIAGO NICOLAS','Masculino','0932975683','8/8/2016','1'],
		//INICIAL 2
			['CARVAJAL ZAMORA','CAMILO ANDRES','Masculino','0959341215','9/5/2014','2'],
			['CONSTANTE ALAVA','OSCAR RICARDO','Masculino','0932681133','10/21/2014','2'],
			['FLORES PEREZ','MATEO DAMIAN','Masculino','0932645799','8/11/2014','2'],
			['GAIBOR MORAN','IKER DYLAN','Masculino','0959560491','11/14/2014','2'],
			['LINO ALCIVAR','ROXANA SOFIA','Femenino','0960026318','6/2/2015','2'],
			['LOPEZ AVILES','DYLAND ABDIEL','Masculino','0932707474','12/23/2014','2'],
			['MONSALVE CORREA','MARIA ISABEL','Femenino','1234567890','12/16/2014','2'],
			['PALMA TOMALA','SOFIA NICOLE','Femenino','0932752603','5/28/2015','2'],
			['PIBAQUE CHIQUITO','DANIEL EMILIO','Masculino','0932651680','9/2/2014','2'],
			['PINCAY PEREZ','AINOHA FERNANDA','Femenino','0959793944','11/22/2014','2'],
			['REYES IBARRA','KAPIELLA NOELIA','Femenino','0932786809','5/29/2015','2'],
			['REYES IBARRA','KATRINA SAMANTHA','Femenino','0932786783','5/29/2015','2'],
			['ROSERO MORALES','VALENTINA ANTONELLA','Femenino','1756668586','3/18/2015','2'],
			['SANAFRIA GONZÁLEZ','VICTORIA KAROLINA','Femenino','0959744848','2/20/2015','2'],
			['SALAZAR RODRIGUEZ','SNEIDER SANTIAGO','Masculino','0932786205','6/10/2015','2'],
			['SUAREZ BUCHELLI','DOMINIK ELIAS','Masculino','0751164641','12/18/2014','2'],
			['YUQUILIMA RODRIGUEZ','SARAHI ADRIANA','Femenino','0960150845','8/18/2015','2'],
		//PRIMERO
			['ALARCON MORAN','KEYSHA AILEEN','Femenino','0959569757','10/17/2014','3'],
			['ARTEAGA ZARAGUAYO','RUBEN','Masculino','3050247802','9/22/2013','3'],
			['BAJAÑA MOREIRA','MATHIAS RAFAEL','Masculino','0932398464','9/3/2013','3'],
			['CARRASCO CONTRERAS','SARA MIRANDA','Femenino','1234567890','12/29/2013','3'],
			['CHASI RAMIREZ','WILLIAM WLADIMIR','Masculino','0250230927','12/8/2013','3'],
			['CHISPE BURGOS','DAPHNEY SCARLET','Femenino','1234567890','1/11/2010','3'],
			['CHISPE BURGOS','JOE JACOB','Masculino','1234567890','1/11/2010','3'],	
			['IMBAQUINGO DE LA TORRE','IVANNA SOFIA','Femenino','0956657217','9/16/2013','3'],
			['LADINES FRANCO','BARBARA VALERIA','Femenino','0932565534','4/25/2014','3'],
			['LOPEZ MATAMOROS','BRANDON ARIEL','Masculino','1234567890','1/11/2010','3'],
			['LOPEZ VINUEZA','DAVID ANDRES','Masculino','0957549322','3/18/2013','3'],
			['MARTINEZ LEON','NATHAN ARJEND','Masculino','0959349663','8/26/2014','3'],
			['PERALTA PALMA','RAFAELLA VICTORIA','Femenino','0956985169','9/22/2013','3'],
			['SANCHEZ ESCOBAR','MICKAELA CHARLOTTE','Femenino','0956913438','9/30/2013','3'],
			['SOLORZANO INTRIAG','DAEMYN XAVIER','Masculino','1351775836','5/22/2014','3'],
			['TANDAZO PEREZ','LUCIANA ISABELLA','Femenino','0932404882','9/14/2013','3'],
			['VALLEJO VERGARA','LUCIANA NATHALIA','Femenino','0959375270','9/3/2014','3'],
			['ZAVALA AVALOS','ESTEFANO DAVID','Masculino','0932631757','6/30/2014','3'],
		//SEGUNDO
			['AVALOS GUARTATANGA','NATALI GABRIELA','Femenino','0955480637','2/21/2013','4'],
			['CENTANARO GUERRERO','GEANFRANCO','Masculino','0958929424','5/23/2013','4'],
			['CONDO PILAMUNGA','JHON MATHIAS','Masculino','0955389390','10/8/2012','4'],
			['MACIAS ARBAIZA','REBECA VALENTINA','Femenino','0932373913','7/24/2013','4'],
			['MACIAS CARRIEL','SAHILY DAYANARA','Femenino','0954673513','9/8/2012','4'],
			['MARTINEZ LEON','JEFFREY EIDHAN','Masculino','0932326010','5/2/2013','4'],
			['MINA CASTRO','RAFAELA ELIZABETH','Femenino','111234567890','1/11/2010','4'],
			['QUIÑONEZ SABANDO','NATANAEL SEBASTIAN','Masculino','0956809925','5/20/2013','4'],
			['RODRIGUEZ BARQUET','DANNA','Femenino','0954613212','9/5/2012','4'],
			['SOXO CEVALLOS','BIANCA ELEANA','Femenino','0959022013','7/17/2013','4'],
			['VERA RIVERA','ORLY GONZALO','Masculino','0932104581','10/6/2011','4'],
		//TERCERO
			['AVALOS GUARTATANGA','ESTER ABIGAIL','Femenino','0931913206','9/18/2011','5'],
			['CARVAJAL ZAMORA','MIGUEL ANTONIO','Masculino','0931969224','12/14/2011','5'],
			['CAVA CAVA','JOEL ALEXANDER','Masculino','0954364329','6/28/2011','5'],
			['CEDILLO NEIRA','JONATHAN ANDRE','Masculino','0932101066','5/12/2012','5'],
			['CHICAIZA BAQUE','THAIZ ALEJANDRA','Femenino','0954148821','4/18/2012','5'],
			['DIAZ ESPINOZA','ZAIRA ELIZABETH','Femenino','0954328100','3/6/2012','5'],
			['DOMINGUEZ GUEVARA','ROBERTO EMANUEL','Masculino','0953145356','11/14/2011','5'],
			['FUENTES HIDALGO','VICTORIA MARINA','Femenino','0954176806','5/21/2012','5'],
			['GIL SOLIS','ALEX JESHUA','Masculino','0954573937','8/17/2012','5'],
			['MORALES DIAZ','KRYSTEL AINARA','Femenino','0931918601','9/1/2011','5'],
			['PALMA TOMALA','KIARA VALENTINA','Femenino','0953416963','1/6/2012','5'],
			['QUEZADA VALDEZ','JUAN SEBASTIAN','Masculino','1234567890','1/11/2010','5'],		
			['RADA CAMPUZANO','PATRICIA ALEISHA','Femenino','0931947253','11/14/2011','5'],
			['RADA PONCE','MARTIN ALBERTO','Masculino','0954878211','9/18/2011','5'],
			['RIVADENEIRA ARANDA','RAFAELLA RENATA','Femenino','0952526333','7/27/2011','5'],
			['ROSERO MORALES','JUSTIN JOEL','Masculino','1753008604','6/30/2012','5'],
			['SAMPER PEREZ','ZALET','Masculino','0961912524','7/15/2012','5'],
			['SANYER CASTRO','JORGE FRANCISCO','Masculino','0932107741','5/16/2012','5'],
			['SOXO CEVALLOS','RONNY MATEO','Masculino','0954174207','4/25/2012','5'],
			['SUAREZ CASTAÑEDA','NUBRASKA AYLEEN','Femenino','0931887913','8/15/2011','5'],
			['TIGSE FRANCO','PIERO LEONEL','Masculino','0954169736','6/11/2011','5'],
			['VILLALOBOS ROGGIERO','ANA PAULA','Femenino','1234567890','6/9/2011','5'],
			['ZAMBRANO CEDEÑO','ARIANA JULIETH','Femenino','0932095193','5/1/2012','5'],
			['ZAMBRANO MEDRANO','JEREMY MATHIAS','Masculino','1234567890','1/11/2010','5'],
		//CUARTO
			['ALVARADO DUARTE','DIDIER EDUARDO','Masculino','0952225001','6/28/2010','6'],
			['ALVARADO SANCAN','KRISTEL VALENTINA','Femenino','0931679302','11/5/2010','6'],
			['CERCADO AMPUERO','RAFAEL ALEXANDER','Masculino','0931861397','6/6/2011','6'],
			['CHACON NEIRA','EDDU DARWIN','Masculino','0931684781','11/15/2010','6'],
			['CONDO PILAMUNGA','ALAN JOEL','Masculino','0951393099','11/12/2010','6'],
			['ESPIN COELLO','JIGAEL ESTEFFANO','Masculino','0931634349','8/10/2010','6'],
			['MORAN OROZCO','SERGI ORIOL','Masculino','3050259575','7/23/2011','6'],
			['MORENO BENAVIDES','DANNA GABRIELA','Femenino','095601391','7/1/2011','6'],
			['MORENO DELGADO','DAVID AIDEEN','Masculino','0931660336','10/7/2010','6'],
			['NAVAS URBAEZ','HELLEN STEPHANIE','Femenino','1234567890','1/20/2010','6'],
			['ORTIZ CEDEÑO','GABRIEL ALONSO','Masculino','0931814933','4/25/2011','6'],
			['PALMA TOMALA','MATHIAS FERNANDO','Masculino','0951492867','12/4/2010','6'],
			['PARIS MOLINA','MARIA VICTORIA','Femenino','144951510','3/15/2011','6'],
			['PEREZ VIVERO','MATEO DAVID','Masculino','0952701654','5/27/2011','6'],
			['QUINTANA RIVAS','OMAR EMILIANO','Masculino','1234567890','3/2/2010','6'],
			['RAMIREZ ALVARADO','BRUNO YAHIR','Masculino','0952437267','7/8/2011','6'],
			['RUIZ DIAZ','JOHN ANDERSON','Masculino','0952805539','9/9/2011','6'],
			['SALAZAR RODRIGUEZ','SAMUEL ANDRES','Masculino','0931846828','3/15/2011','6'],
			['SOLORZANO QUIJIJE','RICARDO GABRIEL','Masculino','0931850614','6/14/2011','6'],
			['VILLAGRAN NARANJO','ANGEL DAVID','Masculino','0931814917','4/17/2011','6'],
			['VILLANUEVA CARPIO','INDIRA VALENTINA','Femenino','0956856652','5/2/2011','6'],
			['YEPEZ VALENCIA','JORGE SAMUEL','Masculino','0931835102','4/26/2011','6'],
		//QUINTO
			['AGUILAR ARROYAVE','JOSE XAVIER','Masculino','0950848713','5/29/2010','7'],
			['ALVAREZ ENDARA','ELIAS GUSTAVO','Masculino','0950715276','2/5/2010','7'],
			['AREVALO RAMBAY','DAMARIS JAEL','Femenino','0931571475','6/25/2010','7'],
			['AREVALO RAMBAY','DEBORA ABIGAIL','Femenino','0931571483','6/25/2010','7'],
			['BAJAÑA MOREIRA','LEONEL SEBASTIAN','Masculino','0931394159','1/7/2010','7'],
			['BRAVO BARRETO','MARIA ANGELICA','Femenino','0956612022','6/17/2005','7'],
			['BRAVO CORNEJO','ISIS EVANGELINE','Femenino','0950897710','5/16/2010','7'],
			['BUSTAN BAJAÑA','JUAN PABLO','Masculino','0931395982','12/26/2009','7'],
			['CAZAÑAS IZAGUIRRE','FABRIZIO','Masculino','0959590100','2/26/2010','7'],
			['DUEÑAS BRAVO','KRISS DAYANNA','Femenino','1315860336','3/13/2010','7'],
			['ELIZALDE MUÑOZ','DUSTIN MARCOS','Masculino','0932098973','5/25/2010','7'],
			['LINO ALCIVAR','ROSMARY ELISA','Femenino','1753151594','6/3/2010','7'],
			['LOOR RAMIREZ','FILIBERTO HERNAN','Masculino','0950822767','3/31/2010','7'],
			['LOZA VALERO','JEAN PIERE','Masculino','0931527097','4/16/2010','7'],
			['MACIAS ARBAIZA','ANGEL HERNAN','Masculino','0931426480','1/15/2010','7'],
			['MEDINA LINDAO','ABEL DANIEL','Masculino','0959208935','11/20/2009','7'],
			['MERA ZAMBRANO','VALESKA ANAHI','Femenino','0950934430','11/3/2009','7'],
			['MERINO SAN LUCAS','ALESSIO MATIAS','Masculino','0931462741','2/18/2010','7'],
			['MONTENEGRO ZAMBRANO','JOSE ALBERTO','Masculino','1234567890','1/11/2010','7'],	
			['PEÑAHERRERA NAY','ISAAC ALEJANDRO','Masculino','0931317218','9/19/2009','7'],
			['PINOS GALECIO','JORGE ADRIAN','Masculino','0951478395','2/27/2010','7'],
			['RUIZ LARCO','PIERO ANDRES','Masculino','0931304810','9/14/2009','7'],
			['SAMPER PEREZ','CALEB','Masculino','0961912532','2/17/2009','7'],
			['TORRES GARCIA','SARAHI VALENTINA','Masculino','1727572198','6/9/2010','7'],
		//SEXTO
			['ALCIVAR OYOLA','RONALD ANDRES','Masculino','0957360571','2/9/2009','8'],
			['BUSTAMANTE BARZOLA','DEREK','Masculino','1234567890','1/11/2010','8'],
			['COLL ELENO','TYRA PAULA','Femenino','1234567890','1/11/2010','8'],
			['CONFORME PAGUAY','MELANY','Femenino','0931290357','8/28/2009','8'],
			['CONSTANTE ALAVA','ANUZKA JUYNETH','Femenino','1754136743','8/8/2008','8'],
			['CORREA QUIJIJE','VALESKA NATASHA','Femenino','0950251728','7/18/2009','8'],
			['GALARRAGA MENDOZA','SHIRLEY','Femenino','0950113910','5/26/2009','8'],
			['GARCIA PAZMIÑO','JAIR SEBASTIAN','Masculino','0950991000','11/17/2009','8'],
			['LOOR RAMIREZ','MELBA VALENTINA','Femenino','0950294710','3/10/2009','8'],
			['MORA ZABALA','JOSUE DANIEL','Masculino','0931173520','4/16/2009','8'],
			['ORRALA SANCHEZ','DIEGO ANTONIO','Masculino','1234567890','11/8/2008','8'],
			['PERALTA PALMA','JORGE LUIS','Masculino','0950499640','5/23/2009','8'],
			['RAMON PELAEZ','ADRIAN DAVID','Masculino','0950198697','10/29/2008','8'],
			['RAMOS ALCIVAR','JAVIER','Masculino','0931157978','4/1/2009','8'],
			['REYES IBARRA','MATHIAS','Masculino','0931207674','5/15/2009','8'],
			['TORRES PACHECO','MARIA PIERINA','Femenino','0957432438','6/27/2009','8'],
			['VECILLAS BRIONES','NEUSTON ZAIR','Masculino','0931269427','7/10/2009','8'],
			['VILLALTA BOBADILLA','HANSEL','Masculino','0958126658','5/15/2009','8'],
			['VINUEZA ROGEL','NICOLAS MIGUEL','Masculino','0951795632','5/22/2009','8'],
			['YEPEZ VALENCIA','MARIA CAMILA','Femenino','0930672803','4/10/2008','8'],
			['ZAMBRANO LARA','KLEBER STEVEN','Masculino','0951393248','9/14/2009','8'],
		//SEPTIMO
			['ALAVA CHAGUAY','TAYRA KATHERINE','Femenino','0930912019','11/28/2008','9'],
			['ALMEIDA RIVERA','IAN MATTHEW','Masculino','0943623579','8/29/2007','9'],
			['BAJAÑA MOREIRA','SERGIO DANIEL','Masculino','0930447958','12/7/2007','9'],
			['CUJILAN AYALA','BRITHANIE DOMINIK','Femenino','1753138880','2/5/2009','9'],
			['GUEVARA FLORES','JUAN PABLO','Masculino','0930409925','10/26/2007','9'],
			['GUTIERREZ CASTRO','JORGE DAVID','Masculino','3050052012','11/23/2007','9'],
			['JARRO MUÑETON','NICOLAS ANDRES','Masculino','1234567890','1/11/2010','9'],
			['LEON OSORIO','ETHAM JAVIER','Masculino','2000162574','3/31/2008','9'],
			['LINTHON JIMENEZ','BRITTANY NATASHA','Femenino','0957950637','9/6/2008','9'],
			['MARTINEZ TAPIA','FERNANDO JAVIER','Masculino','0944268309','6/9/2008','9'],
			['ORTIZ CEDEÑO','JOAQUIN ALONSO','Masculino','1234567890','7/21/2008','9'],
			['PARRAGA CAMPOVERDE','ELIAN ALESSANDRO','Masculino','0930855713','9/28/2008','9'],
			['PINCAY SALAVARRIA','EDHU CHRISTIAN','Masculino','0953402856','11/10/2007','9'],
			['SANTILLAN CHILUIZA','JOSE RUBEN','Masculino','0930659347','3/25/2008','9'],
			['TAMAYO ACOSTA','LUIS ANGEL','Masculino','0950043877','10/10/2007','9'],
			['VECILLA BRIONES','KENETH ALDAIR','Masculino','0930528690','2/5/2008','9'],
			['VILLAGRAN NARANJO','WILSON ABEL','Masculino','0932186745','7/4/2008','9'],
			['VILLAGRAN VERA','JOSE MIGUEL','Masculino','0955483052','6/19/2008','9'],
		//OCTAVO
			['ALVAREZ CABRERA','ALEX SAMUEL','Masculino','0931351167','11/25/2004','10'],
			['ANTEPARA CEREZO','JEREMIAS MOISES','Masculino','0930093372','2/15/2007','10'],
			['AREVALO RAMBAY','JIREH NOEMI','Femenino','0958569113','12/21/2006','10'],
			['BASANTES RAMOS','LUIS FRANCISCO','Masculino','0930251202','6/11/2007','10'],
			['BUSTAN BAJAÑA','MARIA EDUARDA','Femenino','1234567890','1/11/2010','10'],
			['BUSTOS ROMAN','JOSTHIN JHOSUA','Masculino','0952338630','4/26/2008','10'],
			['CEDEÑO CEVALLOS','FLAVIO ANDRES','Masculino','0930304928','7/6/2007','10'],
			['FLORES SOLORZANO','DARITZA JULLIETH','Femenino','0956350003','10/31/2006','10'],
			['GAIBOR ZABALA','JOHN MISAEL','Masculino','1234567890','1/11/2010','10'],	
			['LAPO ALDEAN','MARIO WLADIMIR','Masculino','0930267711','5/30/2007','10'],
			['QUEZADA VALDEZ','JUAN SEBASTIAN','Masculino','1234567890','1/11/2010','10'],			
			['POLIT DUMANI','ARACK ALONSO','Masculino','0931721310','2/9/2007','10'],
			['QUINTANA RIVAS','VITANGELA ESTEFANIA','Femenino','1234567890','1/27/2007','10'],
			['RUA TENORIO','MARIA CLARA','Femenino','1234567890','1/11/2010','10'],
			['SOSA LITARDO','ARISTIDES ROBERTO','Masculino','0950525253','3/3/2006','10'],
			['TANDASO VELEZ','MARLON ANDRE','Masculino','0958158586','8/7/2006','10'],
			['TORRES ZUÑIGA','CARLOS IVAN','Masculino','3050079858','10/10/2006','10'],
			['VILLALTA BOBADILLA','DOMENICA MICAELLA','Femenino','0932107022','4/3/2007','10'],
		//NOVENO
			['ARELLANO MOARRI','MATTHEW MIGUEL','Masculino','1234567890','1/11/2010','11'],			
			['AVECILLAS BURGOS','FIORELLA ALEXANDRA','Femenino','0931831952','8/2/2006','11'],
			['BECERRA PALACIOS','KATRINA PAULETTE','Femenino','0940294531','11/7/2005','11'],
			['BERMEO CHAVEZ','DIANA ANGELA','Femenino','1313459925','12/22/2005','11'],
			['BONIFAZ SUAREZ','CHRISTIAN ALEXANDER','Masculino','0955330634','07/09/2006','11'],
			['CARREÑO SAENZ DE VITERI','OLGA MARIELA','Femenino','0950891366','6/2/2002','11'],
			['CASTRO MOREIRA','MILTON SEBASTIAN','Masculino','0953241262','5/18/2006','11'],
			['CUJILEMA RODRIGUEZ','DANNY RODRIGO','Masculino','1251091342','1/2/2006','11'],
			['DIAZ FLOR PEDRO','ALEJANDRO','Masculino','0957016983','11/22/2005','11'],
			['DIAZ ZARAGUAYO','YESSI','Femenino','0928665165','9/12/2006','11'],
			['MAYORGA ARIAS','VALESKA RACHELL','Femenino','1250775242','6/19/2006','11'],
			['MINA CASTRO','HIRAM DAVID','Masculino','0956401285','1/11/2010','11'],	
			['NOVILLO GUERRERO','DANNY EMILIO','Masculino','0950783910','7/5/2006','11'],
			['OQUENDO MIRANDA','XAVIER ANDRES','Masculino','1234567890','1/11/2010','11'],			
			['RODRIGUEZ CARRERA','DANIEL GONZALO','Masculino','0950294421','3/20/2006','11'],
			['RUA TENORIO MARIA','STEFANIA','Femenino','0954941563','5/30/2003','11'],
			['VALDEZ LARCO','CLAUDIA CATALINA','Femenino','0956379317','6/5/2006','11'],
		//DECIMO
			['AVECILLAS BURGOS','ALEJANDRO DOMENIO','Masculino','0957314313','10/5/2004','12'],
			['BAQUE CHERNEZ','KEVIN JOSE','Masculino','0943595454','6/28/2004','12'],
			['BENAVIDES MORENO','MARIA EMILIA','Femenino','0943149534','2/12/2005','12'],
			['CABEZAS GONZALEZ','ELENA DEL PILAR','Femenino','1003692926','6/13/2005','12'],
			['CERCADO AMPUERO','REBECA ARELI','Femenino','0951753847','2/6/2005','12'],
			['CEVALLOS FLOR','DANIEL ANDRES','Masculino','1729729408','7/1/2005','12'],
			['ESCOBAR VERA','CARLOS LEONARDO','Masculino','0953543816','11/6/2004','12'],
			['FAICAN CARRERA','JOSTIN LENIN','Masculino','0958364739','8/2/2005','12'],
			['FLORES DELGADO','MIRTHA FERNANDA','Femenino','0958580797','8/31/2004','12'],
			['GUANIN LORENTTY','DANIEL ENRIQUE','Masculino','0954712261','5/2/2005','12'],
			['GUERRERO HERRERA','ERIKA DANIELA','Femenino','0943418152','6/29/2005','12'],
			['GUEVARA FLORES','JOSE ROBERTO','Masculino','0957911076','6/14/2005','12'],
			['HARO ENRIQUEZ','LEONELA','Femenino','1726407388','3/30/2004','12'],
			['LLAGUNO ZAMBRANO','KARLA','Femenino','0955498167','12/15/2004','12'],
			['MAYORGA ARIAS','SHARLEN ADELAYDA','Femenino','1250330774','6/19/2003','12'],
			['MUÑOZ FLORES','MOISES SEBASTIAN','Masculino','0958439507','12/10/2004','12'],
			['ORRALA SANCHEZ','ENRIQUE JEREMIAS','Masculino','1234567890','10/24/2005','12'],
			['RODRIGUEZ BARQUET','MARCELA','Femenino','0927077511','7/2/2005','12'],
			['RODRIGUEZ CARRERA','ALEXANDRA DANIELA','Femenino','0950294397','4/6/2005','12'],
			['RODRIGUEZ PARDO','EDGAR','Masculino','0931780381','2/24/2005','12'],
			['SALTOS PARRA','DIEGO ALESSANDRO','Masculino','0944034875','11/4/2004','12'],
			['TORRES VERA','NEXAR RICARDO','Masculino','0955594411','1/11/2010','12'],	
			['VELASCO LINO','JORGE OMAR','Masculino','0955594411','1/11/2010','12'],			
			['VILLANUEVA CARPIO','LUIS DAVID','Masculino','0930544036','6/5/2004','12'],
			['WONG CAMPUZANO','KENNY','Masculino','0928218874','7/7/2005','12'],
			['ZAMBRANO BURGOS','ANA KRISTEL','Femenino','0954864336','12/1/2004','12'],
		//1RO BGU
			['AVECILLAS BURGOS','JURGEN','Masculino','0931831960','2/4/2003','13'],
			['AVILA CARVAJAL','ALFREDO JAHIR','Masculino','0951647213','1/16/2004','13'],
			['BARONA MUÑOZ','RENATO GUSTAVO','Masculino','0950846089','4/15/2003','13'],
			['CONTRERAS PINEDA','DERECK ANDRES','Masculino','0953351756','7/8/2004','13'],
			['CUÑAS CHAVEZ','ANGELO','Masculino','1721256277','11/2/2003','13'],
			['GAME ZAMBRANO','JUAN MANUEL','Masculino','0932467236','3/25/2004','13'],
			['LOOR RAMIREZ','MARIA EMILIA','Femenino','0941694143','1/26/2005','13'],
			['MEDINA LINDAO','ALAN DANIEL','Masculino','3050116981','4/10/2013','13'],
			['MINA CASTRO','GENESIS NOEMI','Femenino','1234567890','1/11/2010','13'],
			['MIRANDA MURILLO','EVELYN ISABEL','Femenino','1234567890','1/11/2010','13'],
			['MORA CEVALLOS','JOSHUE DAVID','Masculino','0958192494','1/25/2004','13'],
			['ORTIZ CEDEÑO','VALERIA LUCIA','Femenino','0954186623','8/21/2003','13'],
			['PACHECO PLASENCIO','STEPHANIE FIORELLA','Femenino','0959442922','10/9/2004','13'],
			['PALACIOS LEON','NATASHA PAULINE','Femenino','0943436410','1/7/2004','13'],
			['QUINTANA RIVAS','SARA ALEJANDRA','Femenino','1234567890','2/2/2004','13'],
			['SANCHEZ MORALES','JOSE GABRIEL','Masculino','0955575410','4/19/2004','13'],
			['SALCAN MENDEZ','ISAIAS NATANAEL','Masculino','0954172573','6/25/2004','13'],
			['VERA CASTILLO','ODALYS CAMILA','Femenino','0941093056','7/5/2003','13'],
		//2DO BGU
			['ANDRADE MOREIRA','XIOMARA ANDREINA','Femenino','0952830180','9/22/2002','14'],
			['BENAVIDES MORENO','CARLOS LUIS','Masculino','0943649897','10/11/2002','14'],
			['BERMEO RENDON','EVELYN MELANIA','Femenino','0954267217','4/3/2003','14'],
			['CHICA NAJERA','ANGEL JAVIER','Masculino','0953974953','10/31/2002','14'],
			['CORREA QUIJIJE','JENNIFER THALIA','Femenino','1311693939','8/28/2003','14'],
			['COVEÑA COLOMA','KAREN LOURDES','Femenino','0931630743','9/6/2002','14'],
			['ENDARA BENAVIDES','MOISES DE JESUS','Masculino','0951554054','9/22/2001','14'],
			['GONZALEZ YANEZ','NATHALY MILENA','Femenino','0956771638','5/20/2002','14'],
			['GUANIN LORENTTY','JAVIER ANDRES','Masculino','0954712444','3/21/2003','14'],
			['LOPEZ MATAMOROS','BRAD WILLY','Masculino','1234567890','6/26/2003','14'],
			['MACIAS SAVERIO','BERTHA NAYELY','Femenino','0956926943','1/11/2001','14'],
			['MEDINA','LUIGGI','Masculino','1234567890','1/11/2010','14'],	
			['MENDOZA LIMA','MELANIE NICOLE','Femenino','0954896957','5/1/2004','14'],
			['MORALES AGUILAR','MAURO ALEJANDRO','Masculino','0956898241','10/5/2003','14'],
			['PACHECO PLASENCIO','NICOLE VANESSA','Femenino','0959443011','4/10/2003','14'],
			['PINCAY QUIÑONEZ','KAREN ZULLY','Femenino','0950596007','12/18/1999','14'],
			['RAMIREZ OVIEDO','JOSE ADRIAN','Masculino','0958363210','3/13/2003','14'],
			['VELASCO LINO','LEVID FERNANDO','Masculino','1234567890','1/11/2010','14'],			
			['YEPEZ VALENCIA','JOHANNA ISABEL','Femenino','0958123036','9/5/2003','14'],
			['ZARAGUAYO MAQUILON','MICHELE JAVIER','Masculino','0950550988','9/5/2005','14'],
		//3RO BGU
			['ALVAREZ RIZZO','PAULINA','Femenino','0955337571','8/14/2002','15'],
			['BARRETO GUANIN','ARIANA DE JESUS','Femenino','0955790225','6/11/2001','15'],
			['CABELLO BALLADARES','MARVIN FERNANDO','Masculino','0951548569','10/15/2001','15'],
			['CARRERA BELLO','EFRAIN EMANUEL','Masculino','0952783447','6/8/2001','15'],
			['CEDEÑO ESTRELLA','JEAN CARLOS','Masculino','0950243444','4/27/2001','15'],
			['GARCIA AYOVI','MABEL THAIS','Femenino','0942006305','4/17/2002','15'],
			['GRANDA VERA','ROBERTO ROMARIO','Masculino','0950323717','1/11/2010','15'],
			['GUERRERO HERRERA','STEVEN EDUARDO','Masculino','0950101865','9/1/2002','15'],
			['LLAGUNO ZAMBRANO','ERICKA CECILIA','Femenino','0955498035','6/4/2002','15'],
			['LLAGUNO ZAMBRANO','JOEL ALI','Masculino','0956119382','6/4/2002','15'],
			['LOPEZ VINUEZA','NATALIA ALEJANDRA','Femenino','1728132886','6/11/2001','15'],
			['LUCIO QUINTANILLA','MARIA BELEN','Femenino','0928438928','1/11/2010','15'],
			['MALLATAGSI ANDRADE','ANGELA MILENA','Femenino','0943887042','10/2/2001','15'],
			['PERERO SUAREZ','JULIO MOISES','Masculino','0953868627','7/10/2001','15'],
			['RIVERA VEGA','TAHYSHAA ALEJANDRA','Femenino','0930202650','8/15/2001','15'],
			['ROBALINO AGUILAR','ELIAN MISAEL','Masculino','0953227329','12/11/2000','15'],
			['SUAREZ CASTAÑEDA','VICTOR EMILIO','Masculino','0951962851','7/15/2002','15'],
			['ZUÑIGA ALTAMIRANO','WILMER ADRIAN','Masculino','0952361152','6/20/2002','15'],
        );
		$role = Sentinel::findRoleByName('Estudiante');
		foreach ($students as $key){
			$student = new Student2();
        	$student->ci = $key[3];
        	$student->nombres = $key[1];
        	$student->apellidos = $key[0];
        	$student->sexo = $key[2];
        	$student->fechaNacimiento = $key[4];
        	$student->ciudad = 'GUAYAQUIL';
        	$student->direccion = 'GUAYAQUIL';
        	//
        	$student->matricula = 'Ordinaria';
        	$student->numeroMatricula  = $student->id;
        	$student->idCurso = $key[5];
			if ($key[5]<3){ 

				$student->seccion = 'EI';
			}
			if ($key[5]>2 && $key[5]<13){

				$student->seccion = 'EGB';
			}
			if ($key[5]==13 || $key[5]==14 || $key[5]==15){

				$student->seccion = 'BGU';
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
