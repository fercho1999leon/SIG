<?php

use Illuminate\Database\Seeder;
use App\Student2;
use App\PagoEstudianteDetalle;
use App\Course;
use Carbon\Carbon;

use App\Payment;
use App\Factura;
use App\Cliente;
use App\FacturaDetalle;
use App\BecaDescuento;
use App\BecaDetalle;
use App\Abono;

class Factura_Usuario_3_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$students = Student2::all();
        $reportes = array(
    /*
		FACTURA PARA MARJORIE BARRERA 2
    */
    	array('2019-03-14','120','QUINTO GRADO - BÁSICA MEDIA - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CAMACHO GAVILANEZ CESAR DANILO','0201331857','13834','210.63','210.63','CHEQUE','DEPOSITO','TARJETA','210.63','SALDO','ABONO'),


		array('2019-03-14','580','SEGUNDO AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CAMACHO GAVILANEZ CESAR DANILO','0201331857','13835','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-03-15','935','3 - 4 AÑOS - INICIAL 2 - A','MATRICULA,MAT - Ambiente Digital','MORALES JARAMILLO MARCIA LORENA','0909806168','13856','128.13','128.13','CHEQUE','DEPOSITO','TARJETA','128.13','SALDO','ABONO'),

		array('2019-03-15','272','OCTAVO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ANDRADE MIRANDA INDIRA ERICKA','0922446992','13857','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-15','384','PRIMER AÑO - EN CIENCIAS - A','MATRICULA','BARZOLA IRRAZABAL GEORGINA','0911212975','13858','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-03-15','499','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','MATRICULA','MARIN MURILLO LYDIA KARINA','0916558182','13859','118.75','118.75','CHEQUE','DEPOSITO','TARJETA','118.75','SALDO','ABONO'),

		array('2019-03-15','36','TERCER GRADO - BÁSICA ELEMENTAL - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','LLANEZ BELTRAN KAREN JHIOMAYRA','0927354997','13860','195.00','EFECTIVO','CHEQUE','DEPOSITO','195.00','195.00','SALDO','ABONO'),

		array('2019-03-15','36','TERCER GRADO - BÁSICA ELEMENTAL - B','ABR - Pensión','LLANEZ BELTRAN KAREN JHIOMAYRA','0927354997','13861','200.00','EFECTIVO','CHEQUE','DEPOSITO','200.00','200.00','SALDO','ABONO'),

		array('2019-03-15','599','SEGUNDO AÑO - EN CIENCIAS - A','MATRICULA','RUIZ VILLEGAS BETTY PILAR','0911423473','13862','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-03-15','965','SEGUNDO AÑO - TÉCNICO INFORMÁTICA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','TIGUA ARTEAGA JENNY MONSERRATE','1306923952','13863','226.88','EFECTIVO','CHEQUE','DEPOSITO','226.88','226.88','SALDO','ABONO'),

		array('2019-03-26','940','4 - 5 AÑOS - INICIAL 2 - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CASTRO CASTRO BYRON ANTONIO','0917060386','14307','173.13','EFECTIVO','173.13','DEPOSITO','TARJETA','173.13','SALDO','ABONO'),

		array('2019-03-26','261','OCTAVO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','PEREZ CASTILLO EVELIN PAOLA','0926262031','14308','215.00','EFECTIVO','215.00','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-26','46','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','PEREZ CASTILLO EVELIN PAOLA','0926262031','14309','201.25','EFECTIVO','201.25','DEPOSITO','TARJETA','201.25','SALDO','ABONO'),

		array('2019-03-26','187','SÉPTIMO GRADO - BÁSICA MEDIA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','VEINTIMILLA COELLO PATRICIA DEL ROCIO','1204131534','14310','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-26','331','DÉCIMO GRADO - BÁSICA SUPERIOR - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ROMERO MORAN RONALD DANIEL','0919212050','14311','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-26','548','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','LUO JINWEI','0929697332','14313','188.75','188.75','CHEQUE','DEPOSITO','TARJETA','188.75','SALDO','ABONO'),

		array('2019-03-26','890','4 - 5 AÑOS - INICIAL 2 - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','XU YU','G23046285','14314','173.13','173.13','CHEQUE','DEPOSITO','TARJETA','173.13','SALDO','ABONO'),

		array('2019-03-26','862','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CHEN QIANG','0960503159','14315','188.75','188.75','CHEQUE','DEPOSITO','TARJETA','188.75','SALDO','ABONO'),

		array('2019-03-26','621','TERCER AÑO - EN CIENCIAS - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','PLUAS AVILA IVAN FEDERICO','0909428435','14325','715.35','EFECTIVO','CHEQUE','DEPOSITO','715.35','715.35','SALDO','ABONO'),

		array('2019-03-26','621','TERCER AÑO - EN CIENCIAS - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','PLUAS AVILA IVAN FEDERICO','0909428435','14326','715.35','715.35','CHEQUE','DEPOSITO','TARJETA','715.35','SALDO','ABONO'),

		array('2019-03-26','621','TERCER AÑO - EN CIENCIAS - A','OCT - Pensión,NOV - Pensión','PLUAS AVILA IVAN FEDERICO','0909428435','14327','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-03-26','621','TERCER AÑO - EN CIENCIAS - A','DIC - Pensión,ENE - Pensión','PLUAS AVILA IVAN FEDERICO','0909428435','14328','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-03-26','353','DÉCIMO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','VITE ZAVALA ROSSINA DEL PILAR','092239581 ','14329','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-26','291','NOVENO GRADO - BÁSICA SUPERIOR - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','MORALES MURILLO ROMMEL EUDORO','0912474806','14330','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-27','346','DÉCIMO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','QUINTEROS PELAEZ MARIA','0905804670','14340','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-27','208','SÉPTIMO GRADO - BÁSICA MEDIA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','PESANTEZ SIGUENZA CARLOS SAMUEL','0913491452','14341','215.00','EFECTIVO','CHEQUE','DEPOSITO','215.00','215.00','SALDO','ABONO'),

		array('2019-03-27','208','SÉPTIMO GRADO - BÁSICA MEDIA - A','ABR - Pensión','PESANTEZ SIGUENZA CARLOS SAMUEL','0913491452','14344','220.40','EFECTIVO','CHEQUE','DEPOSITO','220.40','220.40','SALDO','ABONO'),

		array('2019-03-27','60','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','PESANTEZ SIGUENZA CARLOS SAMUEL','0913491452','14345','201.25','EFECTIVO','CHEQUE','DEPOSITO','201.25','201.25','SALDO','ABONO'),

		array('2019-03-27','60','CUARTO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión','PESANTEZ SIGUENZA CARLOS SAMUEL','0913491452','14346','189.00','EFECTIVO','CHEQUE','DEPOSITO','189.00','189.00','SALDO','ABONO'),

		array('2019-03-27','276','OCTAVO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','FLORES ZAPATA ROXANA DEL PILAR','0920487642','14347','215.00','EFECTIVO','215.00','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-27','584','SEGUNDO AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital','LUNA GUTIERREZ LIRIA GEORGINA','0916871890','14348','181.88','181.88','CHEQUE','DEPOSITO','TARJETA','181.88','SALDO','ABONO'),

		array('2019-03-27','559','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','MATRICULA,MAT - Ambiente Digital','LUNA GUTIERREZ LIDIA GEORGINA','0916871890','14349','143.75','143.75','CHEQUE','DEPOSITO','TARJETA','143.75','SALDO','ABONO'),

		array('2019-03-27','67','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','VERA CARRION FERMIN ANDRES','0930505276','14350','201.25','201.25','CHEQUE','DEPOSITO','TARJETA','201.25','SALDO','ABONO'),

		array('2019-03-27','839','TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','FLORES BALON CECILIA VICTORIA','0909969081','14351','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-03-27','827','SEGUNDO AÑO - TÉCNICO INFORMÁTICA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','FLORES BALON CECILIA VICTORIA','0909969081','14352','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-03-27','384','PRIMER AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','BARZOLA IRRAZABAL GEORGINA','0911212975','14353','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

		array('2019-03-27','931','3 - 4 AÑOS - INICIAL 2 - A','MATRICULA,MAT - Ambiente Digital','SANCHEZ MUÑOZ KRYSTEL MICHELLE','0921676300','14354','128.13','128.13','CHEQUE','DEPOSITO','TARJETA','128.13','SALDO','ABONO'),

		array('2019-03-28','742','TERCER AÑO - TÉCNICO CONTABILIDAD - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ZEA CABANILLA LUIS ANTONIO','0912720893','14371','226.88','EFECTIVO','CHEQUE','DEPOSITO','226.88','226.88','SALDO','ABONO'),

		array('2019-03-28','603','TERCER AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CEDEÑO PLUAS LIGIA ADRIANA','0912955796','14372','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-03-28','958','TERCER GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','SARMIENTO YULAN DIANA DEL CARMEN','1203719750','14373','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

		array('2019-03-28','188','SÉPTIMO GRADO - BÁSICA MEDIA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CAAMAÑO ARIAS SAUL XAVIER','0917720005','14374','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-03-28','382','PRIMER AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','SANCHEZ SALVATIERRA TANYA JANETH','0930058607','14375','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-03-28','742','TERCER AÑO - TÉCNICO CONTABILIDAD - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','ZEA CABANILLA LUIS ANTONIO','0912720893','14376','715.35','715.35','CHEQUE','DEPOSITO','TARJETA','715.35','SALDO','ABONO'),

		array('2019-03-28','742','TERCER AÑO - TÉCNICO CONTABILIDAD - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','ZEA CABANILLA LUIS ANTONIO','0912720893','14377','715.35','715.35','CHEQUE','DEPOSITO','TARJETA','715.35','SALDO','ABONO'),

		array('2019-03-28','742','TERCER AÑO - TÉCNICO CONTABILIDAD - A','OCT - Pensión,NOV - Pensión','ZEA CABANILLA LUIS ANTONIO','0912720893','14378','476.90','476.90','CHEQUE','DEPOSITO','TARJETA','476.90','SALDO','ABONO'),

		array('2019-03-28','742','TERCER AÑO - TÉCNICO CONTABILIDAD - A','DIC - Pensión,ENE - Pensión','ZEA CABANILLA LUIS ANTONIO','0912720893','14379','476.90','476.90','CHEQUE','DEPOSITO','TARJETA','476.90','SALDO','ABONO'),

		array('2019-03-28','529','PRIMER GRADO - PREPARATORIA - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ARAUJO PEREZ CARLOS HUMBERTO','0923344667','14380','182.50','182.50','CHEQUE','DEPOSITO','TARJETA','182.50','SALDO','ABONO'),

		array('2019-03-28','540','PRIMER GRADO - PREPARATORIA - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','REYES CAMPUZANO SANDRA JESSENIA','0923009328','14381','182.50','182.50','CHEQUE','DEPOSITO','TARJETA','182.50','SALDO','ABONO'),

		array('2019-03-28','408','TERCER GRADO - BÁSICA ELEMENTAL - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','VIDAL CORDOVA ERIKA KATIUSKA','0920407681','14382','195.00','EFECTIVO','195.00','DEPOSITO','TARJETA','195.00','SALDO','ABONO'),

		array('2019-03-29','463','PRIMER GRADO - PREPARATORIA - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','MONTESDEOCA VEGA SILVANA DEL CONSUELO','0922919188','14398','182.50','182.50','CHEQUE','DEPOSITO','TARJETA','182.50','SALDO','ABONO'),

		array('2019-03-29','877','3 - 4 AÑOS - INICIAL 2 - B','MATRICULA,MAT - Ambiente Digital','MONTESDEOCA VEGA SILVANA DEL CONSUELO','0922919188','14399','128.13','128.13','CHEQUE','DEPOSITO','TARJETA','128.13','SALDO','ABONO'),

		array('2019-03-29','877','3 - 4 AÑOS - INICIAL 2 - B','ABR - Pensión','MONTESDEOCA VEGA SILVANA DEL CONSUELO','0922919188','14400','156.75','156.75','CHEQUE','DEPOSITO','TARJETA','156.75','SALDO','ABONO'),

		array('2019-04-1','173','SEXTO GRADO - BÁSICA MEDIA - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','FAJARDO HERRERA CESAR XAVIER','0922309356','14420','215.00','EFECTIVO','CHEQUE','DEPOSITO','215.00','215.00','SALDO','ABONO'),

		array('2019-04-1','64','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','RUIZ CENTURION OSCAR ALFREDO','0924626989','14421','201.25','EFECTIVO','CHEQUE','DEPOSITO','201.25','201.25','SALDO','ABONO'),

		array('2019-04-1','64','CUARTO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','RUIZ CENTURION OSCAR ALFREDO','0924626989','14422','472.50','EFECTIVO','CHEQUE','DEPOSITO','472.50','472.50','SALDO','ABONO'),

		array('2019-04-1','64','CUARTO GRADO - BÁSICA ELEMENTAL - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','RUIZ CENTURION OSCAR ALFREDO','0924626989','14423','472.50','EFECTIVO','CHEQUE','DEPOSITO','472.50','472.50','SALDO','ABONO'),

		array('2019-04-1','64','CUARTO GRADO - BÁSICA ELEMENTAL - A','OCT - Pensión,NOV - Pensión','RUIZ CENTURION OSCAR ALFREDO','0924626989','14424','315.00','EFECTIVO','CHEQUE','DEPOSITO','315.00','315.00','SALDO','ABONO'),

		array('2019-04-1','64','CUARTO GRADO - BÁSICA ELEMENTAL - A','DIC - Pensión,ENE - Pensión','RUIZ CENTURION OSCAR ALFREDO','0924626989','14425','315.00','EFECTIVO','CHEQUE','DEPOSITO','315.00','315.00','SALDO','ABONO'),

		array('2019-04-1','129','QUINTO GRADO - BÁSICA MEDIA - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','SEMPERTEGUI ARELLANO VICTOR ANTONIO','0918675307','14427','210.63','EFECTIVO','210.63','DEPOSITO','TARJETA','210.63','SALDO','ABONO'),

		array('2019-04-1','409','TERCER GRADO - BÁSICA ELEMENTAL - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','GALARZA ESPINOSA ANDRES GONZALO','0704616762','14428','195.00','195.00','CHEQUE','DEPOSITO','TARJETA','195.00','SALDO','ABONO'),

		array('2019-04-1','618','TERCER AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','MORALES VILLAGRAN ANTONIO','0907949739','14429','226.88','226.88','CHEQUE','DEPOSITO','TARJETA','226.88','SALDO','ABONO'),

		array('2019-04-1','340','DÉCIMO GRADO - BÁSICA SUPERIOR - B','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CARTAGENA MANTILLA CARLOS FREDDY','1709994477','14430','215.00','EFECTIVO','215.00','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-04-1','45','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CARTAGENA MANTILLA CARLOS FREDDY','1709994477','14431','201.25','EFECTIVO','201.25','DEPOSITO','TARJETA','201.25','SALDO','ABONO'),

		array('2019-04-1','506','4 - 5 AÑOS - INICIAL 2 - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','DICADO PINTO JOSE ISRAEL','0930924485','14432','173.13','173.13','CHEQUE','DEPOSITO','TARJETA','173.13','SALDO','ABONO'),

		array('2019-04-1','581','SEGUNDO AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14433','226.88','EFECTIVO','CHEQUE','DEPOSITO','226.88','226.88','SALDO','ABONO'),

		array('2019-04-1','581','SEGUNDO AÑO - EN CIENCIAS - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14434','677.70','EFECTIVO','CHEQUE','DEPOSITO','677.70','677.70','SALDO','ABONO'),

		array('2019-04-1','581','SEGUNDO AÑO - EN CIENCIAS - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14435','677.70','EFECTIVO','CHEQUE','DEPOSITO','677.70','677.70','SALDO','ABONO'),

		array('2019-04-1','581','SEGUNDO AÑO - EN CIENCIAS - A','OCT - Pensión,NOV - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14436','451.80','EFECTIVO','CHEQUE','DEPOSITO','451.80			451.80','SALDO','ABONO'),

		array('2019-04-1','581','SEGUNDO AÑO - EN CIENCIAS - A','DIC - Pensión,ENE - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14437','451.80','EFECTIVO','CHEQUE','DEPOSITO','451.80			451.80','SALDO','ABONO'),

		array('2019-04-1','605','TERCER AÑO - EN CIENCIAS - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14438','226.88','EFECTIVO','CHEQUE','DEPOSITO','226.88','226.88','SALDO','ABONO'),

		array('2019-04-1','605','TERCER AÑO - EN CIENCIAS - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14439','715.35','EFECTIVO','CHEQUE','DEPOSITO','715.35','715.35','SALDO','ABONO'),

		array('2019-04-1','605','TERCER AÑO - EN CIENCIAS - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14440','715.35','EFECTIVO','CHEQUE','DEPOSITO','715.35','715.35','SALDO','ABONO'),

		array('2019-04-1','605','TERCER AÑO - EN CIENCIAS - A','OCT - Pensión,NOV - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14441','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-04-1','605','TERCER AÑO - EN CIENCIAS - A','DIC - Pensión,ENE - Pensión','CEDEÑO BRAVO CARLOS MIGUEL','0915750988','14442','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-04-2','481','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ROBLES CHAFLA MARIANELLA PAULINA','0922440722','14461','188.75','EFECTIVO','CHEQUE','DEPOSITO','188.75','188.75','SALDO','ABONO'),

		array('2019-04-2','481','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión','ROBLES CHAFLA MARIANELLA PAULINA','0922440722','14462','190.00','EFECTIVO','CHEQUE','DEPOSITO','190.00','190.00','SALDO','ABONO'),

		array('2019-04-2','953','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','VELAÑA TOAQUIZA MARIA LETICIA','0500987029','14463','188.75','188.75','CHEQUE','DEPOSITO','TARJETA','188.75','SALDO','ABONO'),

		array('2019-04-2','243','OCTAVO GRADO - BÁSICA SUPERIOR - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','ARCOS GOMEZ ESTEFAN ROLANDO','1001514825','14464','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-04-2','243','OCTAVO GRADO - BÁSICA SUPERIOR - A','ABR - Pensión','ARCOS GOMEZ ESTEFAN ROLANDO','1001514825','14465','116.00','116.00','CHEQUE','DEPOSITO','TARJETA','116.00','SALDO','ABONO'),

		array('2019-04-2','946','4 - 5 AÑOS - INICIAL 2 - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','TAPIA FRANCO ROBERTO VALENTINO','0926215641','14466','173.13','EFECTIVO','CHEQUE','DEPOSITO','173.13','173.13','SALDO','ABONO'),

		array('2019-04-2','252','OCTAVO GRADO - BÁSICA SUPERIOR - A','MATRICULA,MAT - Ambiente Digital,MAT - Robótica Educativa','SALTOS PLACENCIO MARTINA PERPETUA','0702187741','14467','215.00','215.00','CHEQUE','DEPOSITO','TARJETA','215.00','SALDO','ABONO'),

		array('2019-04-2','252','OCTAVO GRADO - BÁSICA SUPERIOR - A','ABR - Pensión','SALTOS PLACENCIO MARTINA PERPETUA','0702187741','14468','174.00','174.00','CHEQUE','DEPOSITO','TARJETA','174.00','SALDO','ABONO'),

		array('2019-04-3','792','DÉCIMO GRADO - BÁSICA SUPERIOR - A','MATRICULA','BARBA PACHECO EDISON JOHN','0916243280','14505','145.00','EFECTIVO','CHEQUE','DEPOSITO','145.00','145.00','SALDO','ABONO'),

		array('2019-04-3','788','NOVENO GRADO - BÁSICA SUPERIOR - B','MATRICULA','BARBA PACHECO EDISON JOHN','0916243280','14506','145.00','EFECTIVO','CHEQUE','DEPOSITO','145.00','145.00','SALDO','ABONO'),

		array('2019-04-3','39','CUARTO GRADO - BÁSICA ELEMENTAL - A','MATRICULA','TAYLOR MIELES JUANA AURORA','0915986723','14509','131.25','131.25','CHEQUE','DEPOSITO','TARJETA','131.25','SALDO','ABONO'),

		array('2019-04-3','768','QUINTO GRADO - BÁSICA MEDIA - B','MATRICULA','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14511','140.63','140.63','CHEQUE','DEPOSITO','TARJETA','140.63','SALDO','ABONO'),

		array('2019-04-3','772','SEXTO GRADO - BÁSICA MEDIA - B','MATRICULA','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14512','145.00','145.00','CHEQUE','DEPOSITO','TARJETA','145.00','SALDO','ABONO'),

		array('2019-04-3','790','NOVENO GRADO - BÁSICA SUPERIOR - B','MATRICULA','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14513','145.00','145.00','CHEQUE','DEPOSITO','TARJETA','145.00','SALDO','ABONO'),

		array('2019-04-4','970','4 - 5 AÑOS - INICIAL 2 - A','MATRICULA','RUIZ ESPINOZA VICENTE ARMANDO','0915379374','14541','103.13','EFECTIVO','103.13','DEPOSITO','TARJETA','103.13','SALDO','ABONO'),

		array('2019-04-4','151','SEXTO GRADO - BÁSICA MEDIA - A','MATRICULA','CORTEZ FAJARDO MARIA ANDREA','0925638835','14542','145.00','145.00','CHEQUE','DEPOSITO','TARJETA','145.00','SALDO','ABONO'),

		array('2019-04-5','523','4 - 5 AÑOS - INICIAL 2 - B','ABR - Pensión,MAY - Pensión,JUN - Pensión','JARA TOMALA LUIS ALBERTO','0917486532','14574','470.25','EFECTIVO','CHEQUE','DEPOSITO','470.25','470.25','SALDO','ABONO'),

		array('2019-04-5','523','4 - 5 AÑOS - INICIAL 2 - B','JUL - Pensión,AGO - Pensión,SEP - Pensión','JARA TOMALA LUIS ALBERTO','0917486532','14575','470.25','EFECTIVO','CHEQUE','DEPOSITO','470.25','470.25','SALDO','ABONO'),

		array('2019-04-5','523','4 - 5 AÑOS - INICIAL 2 - B','OCT - Pensión,NOV - Pensión','JARA TOMALA LUIS ALBERTO','0917486532','14576','313.50','EFECTIVO','CHEQUE','DEPOSITO','313.50','313.50','SALDO','ABONO'),

		array('2019-04-5','523','4 - 5 AÑOS - INICIAL 2 - B','DIC - Pensión,ENE - Pensión','JARA TOMALA LUIS ALBERTO','0917486532','14577','313.50','EFECTIVO','CHEQUE','DEPOSITO','313.50','313.50','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','MATRICULA','JACOME ENCALADA SOFIA HAYDEE','0917713026','14578','156.88','EFECTIVO','CHEQUE','DEPOSITO','156.88','156.88','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','MAT - Ambiente Digital,MAT - Robótica Educativa','JACOME ENCALADA SOFIA HAYDEE','0917713026','14579','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','ABR - Pensión,MAY - Pensión,JUN - Pensión','JACOME ENCALADA SOFIA HAYDEE','0917713026','14580','715.35','EFECTIVO','CHEQUE','DEPOSITO','715.35','715.35','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','JUL - Pensión,AGO - Pensión,SEP - Pensión','JACOME ENCALADA SOFIA HAYDEE','0917713026','14581','715.35','EFECTIVO','CHEQUE','DEPOSITO','715.35','715.35','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','OCT - Pensión,NOV - Pensión','JACOME ENCALADA SOFIA HAYDEE','0917713026','14582','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-04-5','975','PRIMER AÑO - TÉCNICO INFORMÁTICA - A','DIC - Pensión,ENE - Pensión','JACOME ENCALADA SOFIA HAYDEE','0917713026','14583','476.90','EFECTIVO','CHEQUE','DEPOSITO','476.90','476.90','SALDO','ABONO'),

		array('2019-04-9','594','SEGUNDO AÑO - EN CIENCIAS - A','MATRICULA','SANTOS MOREIRA EUGENIO ERNESTO','1304345083','14747','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-04-11','434','PRIMER AÑO - TÉCNICO CONTABILIDAD - A','MATRICULA','MENDOZA CHICA JOSE BENIGNO','1308508900','14638','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-04-11','658','SEGUNDO AÑO - TÉCNICO INFORMÁTICA - A','MATRICULA','CHABLA BRIONES JULIO ALBERTO','0911390821','14640','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-04-22','341','DÉCIMO GRADO - BÁSICA SUPERIOR - B','ABR - Pensión','CERECEDA ANDRADE TEDDY MIGUEL','0913908802','14978','232.00','232.00','CHEQUE','DEPOSITO','TARJETA','232.00','SALDO','ABONO'),

		array('2019-04-22','413','CUARTO GRADO - BÁSICA ELEMENTAL - B','MAY - Pensión,JUN - Pensión','ARROBA SANTOS DIANA CATHERINE','0918784752','14979','420.00','420.00','CHEQUE','DEPOSITO','TARJETA','420.00','SALDO','ABONO'),

		array('2019-04-22','606','TERCER AÑO - EN CIENCIAS - A','MATRICULA','CEVALLOS ROCAFUERTE VICTOR','0902188234','14981','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-04-22','492','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión','HIDALGO CEDEÑO VANESSA VIVIANA','0914662440001','14983','190.00','EFECTIVO','CHEQUE','DEPOSITO','190.00','190.00','SALDO','ABONO'),

		array('2019-04-22','872','3 - 4 AÑOS - INICIAL 2 - B','ABR - Pensión,MAY - Pensión,JUN - Pensión','RIZO VERA EVELIN ELIZABETH','1206443366','14984','495.00','EFECTIVO','CHEQUE','DEPOSITO','495.00','495.00','SALDO','ABONO'),

		array('2019-04-22','671','TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A','MATRICULA','LIMONES TOALA SOPHIA LORENA','0917774861','14985','156.88','156.88','CHEQUE','DEPOSITO','TARJETA','156.88','SALDO','ABONO'),

		array('2019-04-22','443','PRIMER GRADO - PREPARATORIA - A','MATRICULA','CIRES MOYA GUSTAVO ANDRES','0919388157','14987','112.50','112.50','CHEQUE','DEPOSITO','TARJETA','112.50','SALDO','ABONO'),

		array('2019-04-23','829','TERCER AÑO - EN CIENCIAS - A','MATRICULA','BARRAGAN COELLO ERIKA YANIRE','1204442261','15029','156.88','EFECTIVO','CHEQUE','DEPOSITO','156.88','156.88','SALDO','ABONO'),

		array('2019-04-23','541','PRIMER GRADO - PREPARATORIA - B','ABR - Pensión','JIMENEZ LOPEZ OSWALDO FABRICIO','0922488960','15031','180.00','180.00','CHEQUE','DEPOSITO','TARJETA','180.00','SALDO','ABONO'),

		array('2019-04-23','795','DÉCIMO GRADO - BÁSICA SUPERIOR - A','MATRICULA','CISNEROS GARCIA ANA CRISTINA','1309036075','15032','145.00','145.00','CHEQUE','DEPOSITO','TARJETA','145.00','SALDO','ABONO'),

		array('2019-04-23','187','SÉPTIMO GRADO - BÁSICA MEDIA - A','ABR - Pensión','VEINTIMILLA COELLO PATRICIA DEL ROCIO','1204131534','15034','232.00','232.00','CHEQUE','DEPOSITO','TARJETA','232.00','SALDO','ABONO'),

		array('2019-04-24','453','PRIMER GRADO - PREPARATORIA - A','ABR - Pensión','SALINAS ALMEA MARINA NARCISA','0955370143','15067','180.00','180.00','CHEQUE','DEPOSITO','TARJETA','180.00','SALDO','ABONO'),
				);

		//Registro el cliente
        for($i=0; $i < count($reportes); $i++){
        	$cliente = Cliente::getClienteByCedula($reportes[$i][5]);
			// Creo al cliente en caso que no exista
			if( $cliente==null ){
				$cliente = new Cliente();
					$cliente->nombres = $reportes[$i][4];
					$cliente->apellidos = $reportes[$i][4];
					$cliente->cedula_ruc = $reportes[$i][5];
					$cliente->direccion = " ";
					$cliente->telefono = " ";
					$cliente->correo = "sincorreo@gmail.com";
					$cliente->created_at = '2019-04-27 12:06:32';
					$cliente->save();
			}
        }

       
		for($i=0; $i < count($reportes); $i++){
			
			// Ubico al estudiante
			$student = Student2::find($reportes[$i][1]);
			// Ubico el curso
			$curso = $reportes[$i][2];
			// Se convierte el nombre del curso a us id respectivo
			switch ($curso) {
				case '3 - 4 AÑOS - INICIAL 2 - A':
					$reportes[$i][2] = 3;
					break;
				case '3 - 4 AÑOS - INICIAL 2 - B':
					$reportes[$i][2] = 4;
					break;
				case '4 - 5 AÑOS - INICIAL 2 - A':
					$reportes[$i][2] = 26;
					break;
				case '4 - 5 AÑOS - INICIAL 2 - B':
					$reportes[$i][2] = 27;
					break;
				case 'PRIMER GRADO - PREPARATORIA - A':
					$reportes[$i][2] = 5;
					break;
				case 'PRIMER GRADO - PREPARATORIA - B':
					$reportes[$i][2] = 6;
					break;
				case 'SEGUNDO GRADO - BÁSICA ELEMENTAL - A':
					$reportes[$i][2] = 7;
					break;
				case 'SEGUNDO GRADO - BÁSICA ELEMENTAL - B':
					$reportes[$i][2] = 8;
					break;
				case 'TERCER GRADO - BÁSICA ELEMENTAL - A':
					$reportes[$i][2] = 9;
					break;
				case 'TERCER GRADO - BÁSICA ELEMENTAL - B':
					$reportes[$i][2] = 10;
					break;
				case 'CUARTO GRADO - BÁSICA ELEMENTAL - A':
					$reportes[$i][2] = 11;
					break;
				case 'CUARTO GRADO - BÁSICA ELEMENTAL - B':
					$reportes[$i][2] = 12;
					break;
				case 'QUINTO GRADO - BÁSICA MEDIA - A':
					$reportes[$i][2] = 13;
					break;
				case 'QUINTO GRADO - BÁSICA MEDIA - B':
					$reportes[$i][2] = 14;
					break;
				case 'SEXTO GRADO - BÁSICA MEDIA - A':
					$reportes[$i][2] = 15;
					break;
				case 'SEXTO GRADO - BÁSICA MEDIA - B':
					$reportes[$i][2] = 16;
					break;
				case 'SÉPTIMO GRADO - BÁSICA MEDIA - A':
					$reportes[$i][2] = 17;
					break;
				case 'SÉPTIMO GRADO - BÁSICA MEDIA - B':
					$reportes[$i][2] = 18;
					break;
				case 'OCTAVO GRADO - BÁSICA SUPERIOR - A':
					$reportes[$i][2] = 19;
					break;
				case 'OCTAVO GRADO - BÁSICA SUPERIOR - B':
					$reportes[$i][2] = 20;
					break;
				case 'NOVENO GRADO - BÁSICA SUPERIOR - A':
					$reportes[$i][2] = 21;
					break;
				case 'NOVENO GRADO - BÁSICA SUPERIOR - B':
					$reportes[$i][2] = 22;
					break;
				case 'DÉCIMO GRADO - BÁSICA SUPERIOR - A':
					$reportes[$i][2] = 23;
					break;
				case 'DÉCIMO GRADO - BÁSICA SUPERIOR - B':
					$reportes[$i][2] = 24;
					break;

				case 'PRIMER AÑO - TÉCNICO CONTABILIDAD - A':
					$reportes[$i][2] = 29;
					break;
				case 'PRIMER AÑO - TÉCNICO INFORMÁTICA - A':
					$reportes[$i][2] = 28;
					break;
				case 'PRIMER AÑO - EN CIENCIAS - A':
					$reportes[$i][2] = 25;
					break;

				case 'SEGUNDO AÑO - TÉCNICO CONTABILIDAD - A':
					$reportes[$i][2] = 32;
					break;
				case 'SEGUNDO AÑO - TÉCNICO INFORMÁTICA - A':
					$reportes[$i][2] = 31;
					break;
				case 'SEGUNDO AÑO - EN CIENCIAS - A':
					$reportes[$i][2] = 30;
					break;

				case 'TERCER AÑO - TÉCNICO CONTABILIDAD - A':
					$reportes[$i][2] = 35;
					break;
				case 'TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A':
					$reportes[$i][2] = 34;
					break;
				case 'TERCER AÑO - EN CIENCIAS - A':
					$reportes[$i][2] = 33;
					break;
				
			}
			echo $reportes[$i][1]."_".$reportes[$i][2]."   ";
		
			// Ubico el curso
			$course = Course::find($student->idCurso);
			// Ubico los pagos correspondientes del curso
			$pagosCurso = Payment::where('idCurso', $course->id)->get();
			
			echo $reportes[$i][1]."_".$reportes[$i][2]."   ";
			
			//Se llevan los valores a cancelar
			$pagosEstudiantes = PagoEstudianteDetalle::where('idEstudiante', $student->id)->get();
			$cancelarPago1;
			$cancelarPago2;
			$cancelarPago3;
			$cancelarTotal;

			/////

			//Extrae los rubros del array
			$cadena = explode(",", $reportes[$i][3]);
			$pago1 = $cadena[0];
			$idPago1;
			
			// Pago único -Guía visual
			if( count($cadena)==1 ){
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago1=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if( $pago1=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if( $pago1=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago1=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante1 = PagoEstudianteDetalle::where(['idPago'=>$idPago1, 'idEstudiante'=>$student->id])->first();
				$cancelarTotal = $cancelarPago1; 
				echo "Pago 1:".$pago1." ";
				echo "$".$cancelarPago1."-".$pagoEstudiante1->estado;
				echo "   Total a cancelar(BASE):".$cancelarTotal."   Total a cancelar(SEEDER):".$reportes[$i][12];
				echo "            ";
			}
			
			// Pago múltiple (doble) -Guía visual
			if( count($cadena)==2 ){
				$pago2 = $cadena[1];
				$idPago2;

				// Datos para el pago 1
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago1=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if( $pago1=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if( $pago1=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago1=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante1 = PagoEstudianteDetalle::where(['idPago'=>$idPago1, 'idEstudiante'=>$student->id])->first();

				//Datos para el pago 2
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago2=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if( $pago2=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}	
					if( $pago2=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago2=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante2 = PagoEstudianteDetalle::where(['idPago'=>$idPago2, 'idEstudiante'=>$student->id])->first();

				$cancelarTotal = $cancelarPago1+$cancelarPago2;
				echo "Pago 1:".$pago1." ";
				echo "$".$cancelarPago1."-".$pagoEstudiante1->estado;
				echo "   Pago 2:".$pago2." ";
				echo "$".$cancelarPago2."-".$pagoEstudiante2->estado;
				echo "   Total a cancelar(BASE):".$cancelarTotal."   Total a cancelar(SEEDER):".$reportes[$i][12];
				echo "            ";
			}

			// Pago múltiple (triple) -Guía visual
			if( count($cadena)==3 ){
				$pago2 = $cadena[1];
				$idPago2;
				$pago3 = $cadena[2];
				$idPago3;

				// Datos para el pago 1
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago1=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if( $pago1=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if( $pago1=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago1=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}
					if ( $pago1=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago1 = $pagoCurso->id;
						$cancelarPago1 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante1 = PagoEstudianteDetalle::where(['idPago'=>$idPago1, 'idEstudiante'=>$student->id])->first();

				//Datos para el pago 2
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago2=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if( $pago2=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}	
					if( $pago2=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago2=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}
					if ( $pago2=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago2 = $pagoCurso->id;
						$cancelarPago2 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante2 = PagoEstudianteDetalle::where(['idPago'=>$idPago2, 'idEstudiante'=>$student->id])->first();

				//Datos para el pago 3
				$pagosCurso = Payment::where('idCurso', $course->id)->get();
				foreach ($pagosCurso as $pagoCurso) {

					if( $pago3=='MATRICULA' && $pagoCurso->tipo=='Matricula' ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if( $pago3=='MAT - Ambiente Digital' && $pagoCurso->tipo=='Ambiente_Digital' ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}	
					if( $pago3=='MAT - Robótica Educativa' && $pagoCurso->tipo=='Robotica_Educativa' ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}	
					if ( $pago3=='ABR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==4 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='MAY - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==5 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='JUN - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==6 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='JUL - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==7 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='AGO - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==8 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='SEP - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==9 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='OCT - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==10 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='NOV - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==11 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='DIC - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==12 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='ENE - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==1 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='FEB - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==2 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}
					if ( $pago3=='MAR - Pensión' && $pagoCurso->tipo=='Pension' &&$pagoCurso->mes==3 ){
						$idPago3 = $pagoCurso->id;
						$cancelarPago3 = $pagoCurso->valor_cancelar;
					}

				}
				$pagoEstudiante3 = PagoEstudianteDetalle::where(['idPago'=>$idPago3, 'idEstudiante'=>$student->id])->first();

				$cancelarTotal = $cancelarPago1+$cancelarPago2+$cancelarPago3;
				echo "Pago 1:".$pago1." ";
				echo "$".$cancelarPago1."-".$pagoEstudiante1->estado;
				echo "   Pago 2:".$pago2." ";
				echo "$".$cancelarPago2."-".$pagoEstudiante2->estado;
				echo "   Pago 3:".$pago3." ";
				echo "$".$cancelarPago3."-".$pagoEstudiante3->estado;
				echo "   Total a cancelar(BASE):".$cancelarTotal."   Total a cancelar(SEEDER):".$reportes[$i][12];
				echo "            ";
			}
			
			// Se registra el cliente.
			$cliente = Cliente::getClienteByCedula($reportes[$i][5]);
			$idcliente;
			// Creo al cliente en caso que no exista
			if( $cliente==null ){
				$cliente = new Cliente;
					$cliente->nombres = $reportes[$i][4];
					$cliente->apellidos = $reportes[$i][4];
					$cliente->cedula_ruc = $reportes[$i][5];
					$cliente->direccion = " ";
					$cliente->telefono = " ";
					$cliente->correo = "sincorreo@gmail.com";
					$cliente->created_at = $reportes[$i][0]." 12:00:00";
					$cliente->save();

				$clientes = Cliente::all();
				$idcliente = $clientes->last();
			}else{

				$idcliente = $cliente->id;
			}

			// Buscamos la forma del pago
			if($reportes[$i][8]!='EFECTIVO' && $reportes[$i][8]!=NULL){
				$tipo_de_pago = 'EFECTIVO';
			}
			if($reportes[$i][9]!='CHEQUE' && $reportes[$i][9]!=NULL){
				$tipo_de_pago = 'CHEQUE';
			}
			if($reportes[$i][10]!='DEPOSITO' && $reportes[$i][10]!=NULL){
				$tipo_de_pago = 'DEPOSITO';
			}
			if($reportes[$i][11]!='TARJETA' && $reportes[$i][11]!=NULL){
				$tipo_de_pago = 'TARJETA';
			}
		
			//Se crea la factura
			$factura = new Factura();
				$factura->idCliente = $idcliente;
				$factura->idUsuario = 2;
				$factura->subtotal = $reportes[$i][7];//Subtotal
				$factura->total = $reportes[$i][12];//Total Cancelado, se registra del [7] xq son pagos completos
				$factura->fecha = $reportes[$i][0]." 12:00:00";
				$factura->numeroFactura = $reportes[$i][6];
				$factura->tipo_pago = $tipo_de_pago;
				$factura->estatus="";

				$factura->created_at = $reportes[$i][0]." 12:00:00";
				$factura->updated_at = $reportes[$i][0]." 12:00:00";
				$factura->save();
			// Se busca ultima factura 
			$idFacturas = Factura::all(); 
			$idFacturas = $idFacturas->last()->id;
		

			//Pago único
			if(count($cadena)==1){
				// Actualizar estado del pago
				$estadoPago1 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago1 ])->first();
				$estadoPago1->estado = 'PAGADO';
				$estadoPago1->save();

				// Se guarda Factura Detalles - Primer Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago1->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $reportes[$i][7];//Se guarda el total a pagar
					$factura_detalles->total = $reportes[$i][12];//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago1."---";
					//echo $factura_detalles;

			}
			
			
			//Pago multiple (doble)
			if(count($cadena)==2){
				// Actualizar estado del pago 1
				$estadoPago1 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago1 ])->first();
				$estadoPago1->estado = 'PAGADO';
				$estadoPago1->save();
				// Se guarda Factura Detalles - Primer Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago1->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $cancelarPago1;//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago1;//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago1."---";
					//echo $factura_detalles;


				if( $pago1=='MAT - Ambiente Digital' || $pago1=='MAT - Robótica Educativa' ){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $estadoPago1->id;
						$abono->cantidad = $reportes[$i][12];//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}


				// Actualizar estado del pago 2
				$estadoPago2 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago2 ])->first();
				$estadoPago2->estado = 'PAGADO';
				$estadoPago2->save();
				// Se guarda Factura Detalles - Segundo Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago2->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
				
					
					$factura_detalles->subtotal = $cancelarPago2;//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago2;//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago2."---";
					//echo $factura_detalles;
				if( $pago2=='MAT - Ambiente Digital' || $pago2=='MAT - Robótica Educativa' ){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $estadoPago2->id;
						$abono->cantidad = $cancelarPago2;//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}

			}


			//Pago multiple (doble)
			if(count($cadena)==3){
				// Actualizar estado del pago 1
				$estadoPago1 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago1 ])->first();
				$estadoPago1->estado = 'PAGADO';
				$estadoPago1->save();
				// Se guarda Factura Detalles - Primer Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago1->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $cancelarPago1;//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago1;//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago1."---";
					//echo $factura_detalles;


				if( $pago1=='MAT - Ambiente Digital' || $pago1=='MAT - Robótica Educativa' ){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $estadoPago1->id;
						$abono->cantidad = $reportes[$i][12];//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}


				// Actualizar estado del pago 2
				$estadoPago2 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago2 ])->first();
				$estadoPago2->estado = 'PAGADO';
				$estadoPago2->save();
				// Se guarda Factura Detalles - Segundo Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago2->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
				
					
					$factura_detalles->subtotal = $cancelarPago2;//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago2;//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago2."---";
					//echo $factura_detalles;
				if( $pago2=='MAT - Ambiente Digital' || $pago2=='MAT - Robótica Educativa' ){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $estadoPago2->id;
						$abono->cantidad = $cancelarPago2;//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}


				// Actualizar estado del pago 3
				$estadoPago3 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago3 ])->first();
				$estadoPago3->estado = 'PAGADO';
				$estadoPago3->save();
				// Se guarda Factura Detalles - Segundo Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $estadoPago3->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
				
					
					$factura_detalles->subtotal = $cancelarPago3;//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago3;//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
					echo "---".$idPago2."---";
					//echo $factura_detalles;
				if( $pago3=='MAT - Ambiente Digital' || $pago3=='MAT - Robótica Educativa' ){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $estadoPago3->id;
						$abono->cantidad = $cancelarPago3;//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}

			}

			
		
		
		}
	
    }
}
