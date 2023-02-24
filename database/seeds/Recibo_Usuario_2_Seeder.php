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

class Recibo_Usuario_2_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $students = Student2::all();
        $reportes = array(
        	/*
				ARRAY DE RECIBOS PARA LISSETTE CACERES		
        	*/
        	array('2019-03-15','615','TERCER AÑO - EN CIENCIAS - A','ABR - Pensión','RODRIGUEZ VEGA GEORGIA ROSANA','0701694747','1458','251.00','43.12','CHEQUE','DEPOSITO','TARJETA','43.12','207.88','ABONO'),

			array('2019-03-19','210','SÉPTIMO GRADO - BÁSICA MEDIA - A','ABR - Pensión','TORRES NEIRA ANA MERCEDES','0905472700','1459','232.00','190.00','CHEQUE','DEPOSITO','TARJETA','190.00','42.00','ABONO'),

			array('2019-03-20','472','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión','RUILOVA MOSQUERA MARIA CRISTINA','0917473969','1460','190.00','50.00','CHEQUE','DEPOSITO','TARJETA','50.00','140.00','ABONO'),

			array('2019-03-21','908','PRIMER GRADO - PREPARATORIA - B','ABR - Pensión','TUNG SAN LAMA FATIMA MARIA','0922399340','14218-1466','174.60','113.00','CHEQUE','DEPOSITO','TARJETA','113.00','61.60','ABONO'),

			array('2019-03-22','50','CUARTO GRADO - BÁSICA ELEMENTAL - A','ABR - Pensión','GUAMAN BARBECHO JOSE ALBERTO','0102677291','1462','210.00','EFECTIVO','CHEQUE','DEPOSITO','100.00','100.00','110.00','ABONO'),

			array('2019-03-25','130','QUINTO GRADO - BÁSICA MEDIA - B','ABR - Pensión','YUBAILLO YUNGAN JOSE MANUEL','0919161638','1463','225.00','50.00','CHEQUE','DEPOSITO','TARJETA','50.00','175.00','ABONO'),

			array('2019-03-25','20','TERCER GRADO - BÁSICA ELEMENTAL - B','ABR - Pensión','VALENCIA JAIME SANDRA JENNIFFER','0912207800','1464','200.00','15.00','CHEQUE','DEPOSITO','TARJETA','15.00','185.00','ABONO'),

			array('2019-03-28','908','PRIMER GRADO - PREPARATORIA - B','ABR - Pensión','TUNG SAN LAMA FATIMA MARIA','0922399340','14218','174.60','61.60','CHEQUE','DEPOSITO','TARJETA','61.60','113.00','ABONO'),

			array('2019-04-2','397','PRIMER AÑO - EN CIENCIAS - A','ABR - Pensión','MUÑOS CANDELA YICELA MARIA','0920411261','14015','251.00','7.88','CHEQUE','DEPOSITO','TARJETA','7.88','243.12','ABONO'),

			array('2019-04-3','954','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','ALARCON SALAS XAVIER ALBERTO','0916786718','1468','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-3','588','SEGUNDO AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','MOYANO CONDO SEGUNDO GENARO','0914203666','1469','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-3','754','PRIMER GRADO - PREPARATORIA - B','MAT - Ambiente Digital,MAT - Robótica Educativa','MORAN DUMES EDWARD RONALD','0915615892','1470','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-3','951','PRIMER GRADO - PREPARATORIA - A','MAT - Ambiente Digital,MAT - Robótica Educativa','LIN LIYUN','0963117817','1471','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-3','412','CUARTO GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','LINDAO MANTUANO MARIA FERNANDA','0924733777','1472','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-3','889','PRIMER GRADO - PREPARATORIA - A','MAT - Ambiente Digital,MAT - Robótica Educativa','YAO HAIPING','0962902383','1474','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-3','240','SÉPTIMO GRADO - BÁSICA MEDIA - B','MAT - Ambiente Digital,MAT - Robótica Educativa','JAIGUA ROJANO MIRIAN ELIZABETH','1803271814','1475','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-4','37','CUARTO GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','ACOSTA FRANCO JORGE GEOVANNY','0915785737','1476','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-4','776','SÉPTIMO GRADO - BÁSICA MEDIA - B','MAT - Ambiente Digital,MAT - Robótica Educativa','JORDAN VERA VERONICA CECILIA','0915120273','1478','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-4','784','NOVENO GRADO - BÁSICA SUPERIOR - A','MAT - Ambiente Digital,MAT - Robótica Educativa','JORDAN VERA VERONICA CECILIA','0915120273','1479','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-4','318','NOVENO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','TORO CASTRO DANIEL ANTONIO','0101107068','1480','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-4','672','TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','JUNCO VANONI RUTH KATIUSKA','0915194690','1481','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-4','812','TERCER AÑO - TÉCNICO CONTABILIDAD - A','MAT - Ambiente Digital,MAT - Robótica Educativa','MOSCOSO GALLEGOS JOSE LUIS','0915747927','1482','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-4','35','TERCER GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','VELA ABAD MARIO ENRIQUE','0923274955','1483','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-5','926','SEGUNDO AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','RIVERA TOALA MARTHA MERCEDES','0923599286','1484','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-5','724','SEGUNDO AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','LACA GUALE SAYONARA NORMA','0918957515','1485','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-5','87','CUARTO GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','ROMERO GUZMAN VICTOR HUGO','0920233541','1486','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-5','969','3 - 4 AÑOS - INICIAL 2 - B','MAT - Ambiente Digital','OSPINA GARCES JULISSA LILIANA','1204399610','1488','25.00','EFECTIVO','CHEQUE','DEPOSITO','25.00','25.00','SALDO','ABONO'),

			array('2019-04-5','971','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','OSPINA GARCES JULISSA LILIANA','1204399610','1489','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-8','706','TERCER AÑO - TÉCNICO CONTABILIDAD - A','MAT - Ambiente Digital,MAT - Robótica Educativa','RUIZ LEON WASHINGTON DECIO','0908431158','1491','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-8','775','SÉPTIMO GRADO - BÁSICA MEDIA - A','MAT - Ambiente Digital,MAT - Robótica Educativa','POVEDA VELEZ CHRISTIAN DAVID','0910369693','1492','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-8','4','TERCER GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','FRANCO CASTILLO BOLIVAR EFRAIN','0905121117','1493','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-8','273','OCTAVO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','SUAREZ RIPALDA FRANCISCO SEGUNDO','1202993042','1494','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-8','698','TERCER AÑO - TÉCNICO CONTABILIDAD - A','MAT - Ambiente Digital,MAT - Robótica Educativa','DIAZ MARTILLO JOSE ALBERTO','0910040633','1495','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-8','840','TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','GUAMAN GALAN EMILIA MARIBEL','0930871876','1496','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-8','663','SEGUNDO AÑO - TÉCNICO INFORMÁTICA - A','MAT - Ambiente Digital,MAT - Robótica Educativa','PEREZ TADAY CARLOS HUMBERTO','0911339893','1497','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-8','355','DÉCIMO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','PEREZ TADAY CARLOS HUMBERTO','0911339893','1498','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-8','805','PRIMER AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','SUANGO CABRERA JAVIER RAMIRO','1713575312','1499','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-9','487','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','FLORES CASTRO YAJAIRA JAZMIN','0923771315','1500','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-9','886','4 - 5 AÑOS - INICIAL 2 - A','MAT - Ambiente Digital,MAT - Robótica Educativa','FLORES CASTRO YAJAIRA JAZMIN','0923771315','1501','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-9','303','NOVENO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','BANDA MAYA CHRISTIAN FABIAN','0910518042','1502','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-9','458','SEGUNDO GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','BANDA MAYA CHRISTIAN FABIAN','0910518042','1503','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-9','306','NOVENO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','DAI JIALI','0955943063','1504','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-9','785','NOVENO GRADO - BÁSICA SUPERIOR - A','MAT - Ambiente Digital,MAT - Robótica Educativa','GUERRERO BRAVO RIGOBERTO JOSE','0911283091','1505','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-10','925','SEGUNDO AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','TAGLE VERA PEDRO JULIO','1201412721001','1506','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-10','375','PRIMER AÑO - TÉCNICO CONTABILIDAD - A','MAT - Ambiente Digital,MAT - Robótica Educativa','PAUCAR TAMBO FAVIANNA','0602662942','1507','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-11','497','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','MAT - Ambiente Digital,MAT - Robótica Educativa','PALACIOS GRIJALVA SUCRE MAURICIO','0911336014','1508','70.00','EFECTIVO','70.00','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-11','497','SEGUNDO GRADO - BÁSICA ELEMENTAL - B','ABR - Pensión','PALACIOS GRIJALVA SUCRE MAURICIO','0911336014','14635-1510','171.00','25.00','CHEQUE','DEPOSITO','TARJETA','25.00','146.00','ABONO'),

			
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
			echo $reportes[$i][1];
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
			$course = Course::find($student->idCurso);
			// Ubico los pagos correspondientes del curso
			$pagosCurso = Payment::where('idCurso', $course->id)->get();

					// Se registran los valores a cancelar
			$pagosEstudiantes = PagoEstudianteDetalle::where('idEstudiante', $student->id)->get();
			$cancelarPago1 = 0;
			$cancelarPago2 = 0;
			$cancelarPago3 = 0;
			$cancelarTotal = 0;

			// Se extrae los rubros del array
			$cadena = explode(",", $reportes[$i][3]);
			$pago1;
			$idPago1;
			$pago2;
			$idPago2;
			$pago3;
			$idPago3;

			// Visualización de rubro si hay 1 pago
			if( count($cadena)==1 ){

				$pago1 = $cadena[0];
			}
			// Visualización de rubros si hay 2 pagos
			if( count($cadena)==2 ){
				$pago1 = $cadena[0];
				$pago2 = $cadena[1];
			}
			// Visualización de rubros si hay 3 pagos
			if( count($cadena)==3 ){
				$pago1 = $cadena[0];
				$pago2 = $cadena[1];
				$pago3 = $cadena[3];
			}


			//Seleccion del id del pago1 y valor a cancelar
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
			// Rubro 1
			$rubro1 = $pago1;
			//Seleccion del id del pago2 y valor a cancelar
			if( count($cadena)==2 ){
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
				// Rubro 2
				$rubro2 = $pago2;
			}
			//Seleccion del id del pago3 y valor a cancelar
			if( count($cadena)==3 ){
				//Asignacion del pago 2
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
				// Rubro 2
				$rubro2 = $pago2;

				//Asignacion del pago 3
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
				// Rubro 3
				$rubro3 = $pago3;
			}

			// Obtengo el pago 1 del estudiante
			$pago1 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago1 ])->first();
			
			// Obtengo el pago 2 del estudiante
			if(  count($cadena)==2 ){
				$pago2 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago2 ])->first();
			}

			// Obtengo el pago 3 del estudiante
			if(  count($cadena)==3 ){
				$pago2 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago2 ])->first();
				$pago3 = PagoEstudianteDetalle::where(['idEstudiante'=>$student->id, 'idPago'=>$idPago3 ])->first();

			}


			// Se registra los datos del cliente o se lo crea, según el caso.
			$cliente = Cliente::getClienteByCedula($reportes[$i][5]);
			$idcliente = $cliente->id;
			echo "_:".$idcliente."   ";
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

			$abonosPasados = Abono::where('idPagoDetalle', $pago1->id)->get();
			
			
			// Se guarda datos de la factura
			$factura = new Factura();
				$factura->idCliente = $idcliente;
				$factura->idUsuario = 16;
				$factura->subtotal = $reportes[$i][7];//Subtotal
				$factura->total = $reportes[$i][12];//Total Cancelado
				$factura->fecha = $reportes[$i][0]." 12:00:00";//asignar fecha correspondiente
				$factura->numeroFactura = $reportes[$i][6];
				$factura->tipo_pago = $tipo_de_pago;
				$factura->estatus="";

				$factura->created_at = $reportes[$i][0]." 12:00:00";
				$factura->updated_at  = $reportes[$i][0]." 12:00:00";
				$factura->save();

			// Se busca ultima factura 
			$idFacturas = Factura::all(); 
			$idFacturas = $idFacturas->last()->id;

			
			//Se guarda los detalles de la factura en pago único	
			if( count($cadena)==1){
				// Se busca abonos anteriores
				$valoresAbonos = 0;
				$abonosPasados = Abono::where('idPagoDetalle', $pago1->id)->get();
				if( $abonosPasados!=null){
					//Cuento el valor de los abonos
					foreach ($abonosPasados as $abonos) {
						$valoresAbonos = $valoresAbonos+$abonos->cantidad;
					}
					if( ($reportes[$i][12]+$valoresAbonos)==$reportes[$i][7]){
						$pago1->estado='PAGADO';
						$pago1->save();
						//Me servira para almacenar id de la factura en abonos
						
						$idFacturas = $abonos->idFactura;
					}	
				}

				// Se actualiza el estado del pago
				if( ((int)$reportes[$i][7]==(int)$reportes[$i][12]) && ($rubro1=='MAT - Ambiente Digital' || $rubro1=='MAT - Robótica Educativa')){
					$pago1->estado='PAGADO';
					$pago1->save();
				}

				// Se guarda Factura Detalles 
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $pago1->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $reportes[$i][7];//Se guarda el total a pagar
					$factura_detalles->total = $reportes[$i][12];//Se guarda el total pagado

					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();

				$abono = new Abono ();
					$abono->idFactura = $idFacturas;
					$abono->idPagoDetalle = $pago1->id;
					$abono->cantidad = $reportes[$i][12];//Se guarda lo cancelado en este pago
					
					$abono->created_at = $reportes[$i][0]." 12:00:00";
					$abono->updated_at = $reportes[$i][0]." 12:00:00";
					$abono->save();

				//son los valores obtenidos de la base.
				//$cancelarTotal = $cancelarPago1;
				//echo "Total a cancelar: ".$cancelarTotal."   ";
			}

			//Se guarda los detalles de la primera factura en pago múltiple (Aplica a 2 registros)
			
			if( count($cadena)==2){
				
				//	PAGO 1
				
				// Se busca si hay abonos anteriores
				$valoresAbonos1 = 0;
				$abonosPasados1 = Abono::where('idPagoDetalle', $pago1->id)->get();
				if( $abonosPasados1!=null){
					//Cuento el valor de los abonos
					foreach ($abonosPasados1 as $abonos) {
						$valoresAbonos1 = $valoresAbonos1+$abonos->cantidad;
					}
					if( ($reportes[$i][12]+$valoresAbonos1)==$reportes[$i][7]){
						$pago1->estado='PAGADO';
						$pago1->save();
					}
				}
				

				// Se guarda Factura Detalles - Primer Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $pago1->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $reportes[$i][7];//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago1;//Se guarda el total pagado
					
					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();

				//ABONO:Si es ambiente  o robotica y se paga completo pongo los valores de cada pago
				if($rubro1=='MAT - Ambiente Digital' || $rubro1=='MAT - Robótica Educativa'){
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $pago1->id;
						$abono->cantidad = $cancelarPago1;//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}else{
					$abono = new Abono ();
						$abono->idFactura = $idFacturas;
						$abono->idPagoDetalle = $pago1->id;
						$abono->cantidad = $reportes[$i][12];//Se guarda lo cancelado en este pago
						
						$abono->created_at = $reportes[$i][0]." 12:00:00";
						$abono->updated_at = $reportes[$i][0]." 12:00:00";
						$abono->save();
				}
				
				// PAGO 2
				
				// Se busca si hay abonos anteriores
				$valoresAbonos2 = 0;
				$abonosPasados2 = Abono::where('idPagoDetalle', $pago2->id)->get();
				if( $abonosPasados2!=null){
					//Cuento el valor de los abonos
					foreach ($abonosPasados2 as $abonos) {
						$valoresAbonos2 = $valoresAbonos2+$abonos->cantidad;
					}
					if( ($reportes[$i][12]+$valoresAbonos2)==$reportes[$i][7]){
						$pago2->estado='PAGADO';
						$pago2->save();
					}
				}
				

				// Se guarda Factura Detalles - Primer Pago
				$factura_detalles = new FacturaDetalle();
					$factura_detalles->idCliente = $idcliente;
					$factura_detalles->idPagoDetalle = $pago2->id;
					$factura_detalles->idEstudiante = $student->id;
					$factura_detalles->idFactura = $idFacturas;
					$factura_detalles->subtotal = $reportes[$i][7];//Se guarda el total a pagar
					$factura_detalles->total = $cancelarPago2;//Se guarda el total pagado
					
					$factura_detalles->created_at = $reportes[$i][0]." 12:00:00";
					$factura_detalles->updated_at  = $reportes[$i][0]." 12:00:00";
					$factura_detalles->save();
				//ABONO:Si es ambiente  o robotica y se paga completo pongo los valores de cada pago
				// Se pone por defecto el 2so valor a cancelar.Porque no existe un caso que muestre lo contrario
				
				$abono = new Abono ();
					$abono->idFactura = $idFacturas;
					$abono->idPagoDetalle = $pago2->id;
					$abono->cantidad = $cancelarPago2;//Se guarda lo cancelado en este pago
					
					$abono->created_at = $reportes[$i][0]." 12:00:00";
					$abono->updated_at = $reportes[$i][0]." 12:00:00";
					$abono->save();
				
				

			}
		
				


			
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
