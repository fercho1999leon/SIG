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

class Recibo_Usuario_3_Seeder extends Seeder
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
				ARRAY DE RECIBOS PARA MARJORIE BARRERA	2	|| POR DEFCTO LOS CREE COMO USUARIO DE LA MISS TANIA
        	*/
			array('2019-04-03','788','NOVENO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','BARBA PACHECO EDISON JOHN','0916243280','14507-1388','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-03','792','DÉCIMO GRADO - BÁSICA SUPERIOR - A','MAT - Ambiente Digital,MAT - Robótica Educativa','BARBA PACHECO EDISON JOHN','0916243280','14508-1389','70.00','EFECTIVO','CHEQUE','DEPOSITO','70.00','70.00','SALDO','ABONO'),

			array('2019-04-03','39','CUARTO GRADO - BÁSICA ELEMENTAL - A','MAT - Ambiente Digital,MAT - Robótica Educativa','TAYLOR MIELES JUANA AURORA','0915986723','14510-1390','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-03','790','NOVENO GRADO - BÁSICA SUPERIOR - B','MAT - Ambiente Digital,MAT - Robótica Educativa','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14514-1391','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-03','772','SEXTO GRADO - BÁSICA MEDIA - B','MAT - Ambiente Digital,MAT - Robótica Educativa','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14515-1392','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-03','768','QUINTO GRADO - BÁSICA MEDIA - B','MAT - Ambiente Digital,MAT - Robótica Educativa','LIPPKE ORTIZ CARLOS FERNANDO','0916094543','14516-10','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-09','594','SEGUNDO AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','SANTOS MOREIRA EUGENIO ERNESTO','1304345083','14748-1432','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-11','434','PRIMER AÑO - TÉCNICO CONTABILIDAD - A','MAT - Ambiente Digital,MAT - Robótica Educativa','MENDOZA CHICA JOSE BENIGNO','1308508900','14639-1455','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-22','606','TERCER AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','CEVALLOS ROCAFUERTE VICTOR','0902188234','14982-1540','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-22','671','TERCER AÑO - TÉCNICO ADMINISTRACION DE SISTEMAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','LIMONES TOALA SOPHIA LORENA','0917774861','14986-1541','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-23','829','TERCER AÑO - EN CIENCIAS - A','MAT - Ambiente Digital,MAT - Robótica Educativa','BARRAGAN COELLO ERIKA YANIRE','1204442261','15030-1556','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO'),

			array('2019-04-23','795','DÉCIMO GRADO - BÁSICA SUPERIOR - A','MAT - Ambiente Digital,MAT - Robótica Educativa','CISNEROS GARCIA ANA CRISTINA','1309036075','15033-1558','70.00','70.00','CHEQUE','DEPOSITO','TARJETA','70.00','SALDO','ABONO')
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
				$factura->idUsuario = 2;
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
