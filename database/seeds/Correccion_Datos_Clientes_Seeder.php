<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class Correccion_Datos_Clientes_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = Cliente::all();
     	$count = 0;
     	$nombre1;
     	$nombre2;
     	$apellido1;
     	$apellido2;

    
     	// Este arreglo reconoce 4 palabras y las separa, excepto estudiante 692, 180, 340 y 363
     	// Son 596 estudiantes corregidos
     	foreach( $clientes as $cliente ){
     		if( $cliente->nombres==$cliente->apellidos ){
				
     			if( str_word_count($cliente->nombres, 0)==4 && $cliente->id!=692 && $cliente->id!=180 && $cliente->id!=340 && $cliente->id!=363 ){
     				$count++;
     				//echo str_word_count($cliente->nombres, 0);
					$cliente->nombres = trim($cliente->nombres);
     				$porciones = explode(" ", $cliente->nombres);
     				$nombre1 = $porciones[0];
			     	$nombre2 = $porciones[1];
			     	$apellido1 = $porciones[2];
			     	$apellido2 = $porciones[3];
     				//echo "'".$cliente->nombres.".".str_word_count($cliente->nombres, 0).".       ";
     				//echo $cliente->id.":'".$nombre1." ".$nombre2." ".$apellido1." ".$apellido2.".";

     				$cliente->nombres = $nombre1." ".$nombre2;
     				$cliente->apellidos = $apellido1." ".$apellido2;
     				$cliente->save();
     			}

     		}
     	}
     	
     	
     	// Después de funcionar el foreach de arriba
     	// Quedan 153 estudiantes
     	$registros = array(
     		//array(id, nombres, apellidos),             
     		array('33','SHU','WANG'),
     		array('150','NN','NN'),
     		array('222','HAIPING','YAO'),
     		array('266','JINWEI','LUO'),
     		array('267','SHU','WANG'),
     		array('268','LIYUN','LIN'),
     		array('269','YU','XU'),
     		array('270','QIANG','CHEN'),
     		array('525','WEI','ZHONG'),
     		array('567','LIYUN','LIN'),
     		array('569','HAIPING','YAO'),
     		array('589','JIALI','DAI'),
     		array('605','JINWEI','LUO'),
     		array('606','YU','XU'),
     		array('607','QIANG','CHEN'),
     		array('6','VARELA PATIÑO','CARLOS MANUEL'), 
			array('150','NN','NN'),				
			array('180','BAÑO CRUZ','PAUL'),			
			array('311','XIE','XIE'),  			
			array('340','REMPAQUES PROINPACK','S.A.'),			
			array('363','BAÑO CRUZ','PAUL'),			
			array('692','REMPAQUES PROINPACK','S.A.'),			
			array('705','XIE','XIE'),
			array('20','CONTRERAS OROZCO','JOHNNY'),
			array('37','MASACELA PAUCAR','ALBERTO'),
			array('42','PAREDES VILLAMAR','ARIOSVALDO'),
			array('56','BAYAS LAURA','MERCEDES'),
			array('77','CASTRO MENDOZA','FELIX'),
			array('92','SPER SEMPERTEGU',' ALBERTO'),
			array('111','GUIA CASTEJON','DANIEL'),
			array('117','RODRIGUEZ ORTIZ','MAXWELL'),
			array('159','MONTALVO MANZABA','OMAYRA'),
			array('179','RIVERA ARCOS','ALEX'),
			array('211','CASTRO RIVADENEIRA','CARLA'),
			array('263','BARZOLA IRRAZABAL','GEORGINA'),
			array('276','CASTRO MENDOZA','FELIX'),
			array('301','RONQUILLO MORAN','FANNY'),
			array('302','SPER SEMPERTEGUI','ALBERTO'),
			array('303','QUINTEROS PELAEZ','MARIA'),
			array('306','ECHEVERRIA GARCIA','LETTY'),
			array('339','ECHEVERRIA ESPINOZA','CHRISTIAN'),
			array('341','SOSA JAMA','MARIANA'),
			array('344','DURAN MONCADA','LILIBETH'),
			array('386','ZAMORA NARANJO','ALDRIN'),
			array('434','JACOME CEVALLOS','JEANINE'),
			array('513','SESINGAQUA','S.A.'),
			array('519','ZAMBRANO CULMA','NIXON'),
			array('533','OCEJO CHERREZ','RODOLFO'),
			array('535','MORAN RONQUILLO','MIGUEL'),
			array('541','GUAMAN CAIRO','JOSEFA'),
			array('592','PAUCAR TAMBO','FAVIANNA'),
			array('597','BARZOLA IRRAZABAL','GEORGINA'),
			array('610','QUINTEROS PELAEZ','MARIA'),
			array('630','MORALES VILLAGRAN','ANTONIO'),
			array('647','CEVALLOS ROCAFUERTE','VICTOR'),
			array('691','ECHEVERRIA ESPINOZA','CHRISTIAN'),
			array('693','SOSA JAMA','MARIANA'),
			array('696','DURAN MONCADA','LILIBETH'),
			array('723','ECHEVERRIA GARCIA','LETTY'),
			array('8','MUÑOZ VILLALTA','NORMAN RODOLFO'),
			array('18','NUÑEZ PONCE','ALICIA JANETH'),
			array('25','RODRIGUEZ NUÑEZ','FREDDI XAVIER'),
			array('44','IÑAGUAZO HERRERA','ESTHER MAGALY'),
			array('67','VALLEJO COBEÑA','LEOPOLDO ERNESTO'),
			array('86','LARREATEGUI ZUÑIGA','FREDDY FERNANDO'),
			array('88','LUDEÑA CHAMBA','HITLER PAUL'),
			array('106','TUNG SAN LAMA','FATIMA MARIA'),
			array('108','ZAMORA ORDOÑEZ','KARINA INES'),
			array('127','ZUÑIGA SEGARRA','MANUEL ENRIQUE'),
			array('133','CEDEÑO MARQUEZ','GIOVANNY SEVERO'),
			array('135','DORADO ORDOÑEZ','LUIS JONATHAN'),
			array('138','MUÑOS CANDELA','YICELA MARIA'),
			array('140','GUZHÑAY ORTEGA','EVELYN CAROLINA'),
			array('156','GARCIA PROAÑO','JESSICA MARCIA'),
			array('163','ANDRADE OCAÑA','RICARDO JAVIER'),
			array('166','DE JANON VELEZ','RICARDO FERNANDO'),
			array('168','ORDOÑEZ PRADO','ROLANDO WASHINGTON'),   
			array('173','RAMIREZ SUAREZ','DENISSE ESTEFANÍE'),
			array('175','PAZMIÑO WEISSON','LUIS FERNANDO'),
			array('178','CEDEÑO ACOSTA','ANDREA LUCRECIA'),
			array('183','PAZMIÑO GORDILLO','GUSTAVO FABRICIO'),
			array('187','SANCHEZ LARA','ROCIO DEL CARMEN'),
			array('202','QUIÑONEZ LOPEZ','JUAN CARLOS'),
			array('212','IBAÑEZ APOLO','MARIA FERNANDA'),
			array('213','YANEZ SERRANO','MAIELISA DEL ROCIO'),
			array('217','PEÑAFIEL SARCOS','EDDNA EUGENIA'),
			array('218','PIÑA MERA','JEAN CARLOS'),
			array('221','TUNG SAN LAMA','FATIMA MARIA'),
			array('226','DORADO ORDOÑEZ','LUIS JONATHAN'),
			array('228','ORMEÑO TIGUA','SILVANIA JENNIFFER'),
			array('251','LUDEÑA CHAMBA','HITLER PAUL'),
			array('255','SANCHEZ LARA','ROCIO DEL CARMEN'),
			array('258','PAZMIÑO WEISSON','LUIS FERNANDO'),
			array('262','ESPINOZA AMAGUAÑA','RICARDO LUTFALLAH'),
			array('264','PROAÑO SILVA','ELIZANDRO NEPTALI'),
			array('284','RODRIGUEZ NUÑEZ','FREDDI XAVIER'),
			array('299','DELGADO ORDOÑEZ','HERNEY JHOFRE'),
			array('317','ESTUPIÑAN NAVARRETE','LUISA ELIZABETH'),
			array('318','ARGANDOÑA PACHECO','JENNY TATIANA'),
			array('319','MONTESDEOCA VEGA','SILVANA DEL CONSUELO'),
			array('329','MUÑOZ VILLALTA','NORMAN RODOLFO'),
			array('346','DE SANTIS FLORES','JUAN VITTORIO'),
			array('364','BARRIOS CRUZ','ISABEL DEL ROCIO'),
			array('379','RAMIREZ MONTOYA','WILLIAM DE JESUS'),
			array('381','BARROS SALDAÑA','JESSICA VIRGINIA'),
			array('395','PEÑAFIEL SARCOS','EDDNA EUGENIA'),
			array('401','MALDONADO ORDOÑEZ','MAGALY JOSEFINA'),
			array('402','AREVALO MUÑOZ','LUIS RENE'),
			array('414','MIÑO LOPEZ','JAIME DAVID'),
			array('423','TOBAR MUÑOZ','GEOVANNY JACINTO'),
			array('424','YCAZA MARIDUEÑA','KENNY PAUL'),
			array('436','MUÑOZ GUERRA','MARCELA MARIELLA'),
			array('438','CARRANZA MUÑOZ','CARLOS ALBERTO'),
			array('448','LUCAS CEDEÑO','JOHANNA MARIA'),
			array('487','ANDRADE PEÑA','GERARDO WILFRIDO'),
			array('497','BAJAÑA BELTRAN','PABLO RAFAEL'),
			array('498','PAZMIÑO BALDEON','JHEN ORLANDO'),     
			array('514','PAEZ PAZMIÑO','DORIS PAMELA'),
			array('515','ARELLANO OCAÑA','SALVADOR AGUSTIN'),
			array('529','TRIVIÑO BUSTOS','FAUSTO ANDRES'),
			array('542','COX PEÑAFIEL','LIDIA MARIA'),
			array('558','MARTINEZ BANCHEN','GINA DEL ROCIO'),
			array('559','YANEZ SERRANO','MAIELISA DEL ROCIO'),
			array('603','VEINTIMILLA COELLO','PATRICIA DEL ROCIO'),
			array('608','VITE ZAVALA','ROSSINA DEL PILAR'),
			array('612','FLORES ZAPATA','ROXANA DEL PILAR'),
			array('616','SANCHEZ MUÑOZ','KRYSTEL MICHELLE'),
			array('618','CEDEÑO PLUAS','LIGIA ADRIANA'),
			array('619','SARMIENTO YULAN','DIANA DEL CARMEN'),
			array('620','CAAMAÑO ARIAS','SAUL XAVIER'),
			array('625','MONTESDEOCA VEGA','SILVANA DEL CONSUELO'),
			array('633','CEDEÑO BRAVO','CARLOS MIGUEL'),
			array('635','VELAÑA TOAQUIZA','MARIA LETICIA'),
			array('648','HIDALGO CEDEÑO','VANESSA VIVIANA'),
			array('668','RAMIREZ MONTOYA','WILLIAM DE JESUS'),
			array('672','BARRIOS CRUZ','ISABEL DEL ROCIO'),
			array('695','DELGADO ORDOÑEZ','HERNEY JHOFRE'),
			array('698','DE SANTIS FLORES','JUAN VITTORIO'),
			array('707','ESTUPIÑAN NAVARRETE','LUISA ELIZABETH'),
			array('730','PROAÑO SILVA','ELIZANDRO NEPTALI'),
			array('745','ORMEÑO TIGUA','SILVANIA JENNIFFER'),
			array('751','VACA FRANCO','CONSUELO DE JESUS'),
			array('755','IBAÑEZ APOLO','MARIA FERNANDA'),
			array('15','QUINCHE AGUILAR','SONIA DE LOS ANGELES'),   
			array('146','AVILA FRANCO','PEDRO DE LA CRUZ'),     
			array('154','PARREÑO QUIÑONEZ','MONICA ALEXANDRA'),      
			array('165','ZAMBRANO MIÑO','ANA DEL ROCIO'),      
			array('250','PESANTES BAJAÑA','GLADYS DEL PILAR'),           
			array('252','PESANTES BAJAÑA','GLADYS DEL PILAR'),           
			array('289','QUINCHE AGUILAR','SONIA DE LOS ANGELES'),      
			array('327','RODRIGUEZ SANCHEZ','IVETTE DE LOS ANGELES'),            
			array('488','MUÑOZ MERA','ANA DEL ROCIO'),   
			array('562','OCAÑA OCAÑA','CHARLES ALBERTO'),     
			array('712','RODRIGUEZ SANCHEZ','IVETTE DE LOS ANGELES'),     
			array('744','PESANTES BAJAÑA','GLADYS DEL PILAR'),
     	);
     	for ($i=0; $i<count($registros); $i++){
     		echo $registros[$i][0]."     ";
     		$cliente = Cliente::find((int)$registros[$i][0]);
     			$cliente->apellidos = $registros[$i][1];
     			$cliente->nombres = $registros[$i][2]; 
     			$cliente->save();
     	}
     	
     	
    }
}
