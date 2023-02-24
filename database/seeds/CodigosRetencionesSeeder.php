<?php

use Illuminate\Database\Seeder;
use App\CodigoRetencion;

class CodigosRetencionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		/*
    		[
    		'DETALLE DE % DE RETENCION EN LA FUENTE DE IMPUESTO A LA RENTA CONFORME LA NORMATIVA VIGENTE',
    		'Porcentajes vigentes',
    		'Campo Formulario 103',
    		'Código del Anexo',
    		'Activo'
    		]
		*/
        $codigos = array(
        	['Honorarios profesionales y demás pagos por servicios relacionados con el título profesional','10','303','303','1'],
			['Servicios predomina el intelecto no relacionados con el título profesional','8','304','304','1'],
			['Comisiones y demás pagos por servicios predomina intelecto no relacionados con el título profesional','8','304','304A','1'],
			['Pagos a notarios y registradores de la propiedad y mercantil por sus actividades ejercidas como tales','8','304','304B','1'],
			['Pagos a deportistas, entrenadores, árbitros, miembros del cuerpo técnico por sus actividades ejercidas como tales','8','304','304C','1'],
			['Pagos a artistas por sus actividades ejercidas como tales','8','304','304D','1'],
			['Honorarios y demás pagos por servicios de docencia','8','304','304E','1'],
			['Servicios predomina la mano de obra','2','307','307','1'],
			['Utilización o aprovechamiento de la imagen o renombre','10','308','308','1'],
			['Servicios prestados por medios de comunicación y agencias de publicidad','1','309','309','1'],
			['Servicio de transporte privado de pasajeros o transporte público o privado de carga','1','310','310','1'],
			['Pagos a través de liquidación de compra (nivel cultural o rusticidad)','2','311','311','1'],
			['Transferencia de bienes muebles de naturaleza corporal','1','312','312','1'],
			['Compra de bienes de origen agrícola, avícola, pecuario, apícola, cunícula, bioacuático, y forestal','1','312','312A','1'],
			['Impuesto a la Renta único para la actividad de producción y cultivo de palma aceitera','1','312','312B','1'],
			['Regalías por concepto de franquicias de acuerdo a Ley de Propiedad Intelectual-pago a personas naturales','8','314','314A','1'],
			['Cánones, derechos de autor,  marcas, patentes y similares de acuerdo a Ley de Propiedad Intelectual – pago a personas naturales','8','314','314B','1'],
			['Regalías por concepto de franquicias de acuerdo a Ley de Propiedad Intelectual-pago a sociedades','8','314','314C','1'],
			['Cánones, derechos de autor,  marcas, patentes y similares de acuerdo a Ley de Propiedad Intelectual – pago a sociedades','8','314','314D','1'],
			['Cuotas de arrendamiento mercantil (prestado por sociedades), inclusive la de opción de compra','1','319','319','1'],
			['Arrendamiento bienes inmuebles','8','320','320','1'],
			['Seguros y reaseguros (primas y cesiones)','1','322','322','1'],
			['Rendimientos financieros pagados a naturales y sociedades  (No a IFIs)','2','323','323','1'],
			


			['Rendimientos financieros: depósitos Cta. Corriente','2','323','323A','1'],
			['Rendimientos financieros:  depósitos Cta. Ahorros Sociedades','2','323','323B1','1'],
			['Rendimientos financieros: depósito a plazo fijo  gravados','2','323','323E','1'],
			['Rendimientos financieros: depósito a plazo fijo exentos','0','332','323E2','1'],
			['Rendimientos financieros: operaciones de reporto-repos','2','323','323F','1'],
			['Inversiones (captaciones) rendimientos distintos de aquellos pagados a IFIs','2','323','323G','1'],
			['Rendimientos financieros: obligaciones','2','323','323H','1'],
			['Rendimientos financieros: bonos convertible en acciones','2','323','323I','1'],
			['Rendimientos financieros: Inversiones en títulos valores en renta fija gravados','2','323','323 M','1'],
			
			['Rendimientos financieros: Inversiones en títulos valores en renta fija exentos','0','332','323 N','1'],
			['Intereses y demás rendimientos financieros pagados a bancos y otras entidades sometidas al control de la Superintendencia de Bancos y de la Economía Popular y Solidaria','0','332','323 O','1'],
			['Intereses pagados por entidades del sector público a favor de sujetos pasivos','2','323','323 P','1'],
			['Otros intereses y rendimientos financieros gravados','2','323','323Q','1'],

			['Otros intereses y rendimientos financieros exentos','0','332','323R','1'],
			['Pagos y créditos en cuenta efectuados por el BCE y los depósitos centralizados de valores, en calidad de intermediarios, a instituciones del sistema financiero por cuenta de otras personas naturales y sociedades','2','323','323S','1'],
			['Rendimientos financieros originados en la deuda pública ecuatoriana','0','332','323T','1'],
			['Rendimientos financieros originados en títulos valores de obligaciones de 360 días o más para el financiamiento de proyectos públicos en asociación público-privada','0','332','323U','1'],
			['Intereses y comisiones en operaciones de crédito entre instituciones del sistema financiero y entidades economía popular y solidaria.','1','324','324A','1'],

			['Inversiones entre instituciones del sistema financiero y entidades economía popular y solidaria','1','324','324B','1'],
			['Pagos y créditos en cuenta efectuados por el BCE y los depósitos centralizados de valores, en calidad de intermediarios, a instituciones del sistema financiero por cuenta de otras instituciones del sistema financiero','1','324','324C','1'],

			['Anticipo dividendos','22 ó 25','325','325','0'],
			['Préstamos accionistas,beneficiarios o partícipes residentes o establecidos en el Ecuador','22 ó 25','325','325A','0'],

			['Dividendos distribuidos que correspondan al impuesto a la renta único establecido en el art. 27 de la LRTI ','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos','326','326','0'],
			['Dividendos distribuidos a personas naturales residentes','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos','327','327','1'],
			['Dividendos distribuidos a sociedades residentes','0','328','328','1'],
			['Dividendos distribuidos a fideicomisos residentes','0','329','329','1'],
			['Dividendos gravados distribuidos en acciones (reinversión de utilidades sin derecho a reducción tarifa IR)','0','330','330','1'],
			['Dividendos exentos distribuidos en acciones (reinversión de utilidades con derecho a reducción tarifa IR)','0','331','331','1'],

			['Otras compras de bienes y servicios no sujetas a retención','0','332','332','1'],
			['Compra de bienes inmuebles','0','332','332B','1'],
			['Transporte público de pasajeros','0','332','332C','1'],
			['Pagos en el país por transporte de pasajeros o transporte internacional de carga, a compañías nacionales o extranjeras de aviación o marítimas','0','332','332D','1'],
			['Valores entregados por las cooperativas de transporte a sus socios','0','332','332E','1'],
			['Compraventa de divisas distintas al dólar de los Estados Unidos de América','0','332','332F','1'],
			['Pagos con tarjeta de crédito','0','332','332G','1'],
			['Pago al exterior tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP','0','332','332H','1'],
			['Pago a través de convenio de debito (Clientes IFI`s)','0','332','332I','1'],
			['Ganancia en la enajenación de derechos representativos de capital u otros derechos que permitan la exploración, explotación, concesión o similares de sociedades, que se coticen en bolsa de valores del Ecuador','10','333','333','1'],
			['Contraprestación producida por la enajenación de derechos representativos de capital u otros derechos que permitan la exploración, explotación, concesión o similares de sociedades, no cotizados en bolsa de valores del Ecuador','1','334','334','1'],
			['Loterías, rifas, apuestas y similares','15','335','335','1'],
			['Venta de combustibles a comercializadoras','2/mil','336','336','0'],
			['Venta de combustibles a distribuidores','3/mil','337','337','0'],
			['Producción y venta local de banano producido o no por el mismo sujeto pasivo','1-2','338','338','0'],
			['Impuesto único a la exportación de banano','3','340','340','1'],
			['Otras retenciones aplicables el 1%','1','343','343','1'],
			['Energía eléctrica','1','343','343A','1'],
			['Actividades de construcción de obra material inmueble, urbanización, lotización o actividades similares','1','343','343B','1'],
			['Impuesto Redimible a las botellas plásticas-IRBP','1','343','343C','1'],
			['Otras retenciones aplicables el 2%','2','344','344','1'],
			['Pago local tarjeta de crédito reportada por la Emisora de tarjeta de crédito, solo RECAP','2','344','344A','1'],
			['Adquisición de sustancias minerales dentro del territorio nacional','2','344','344B','1'],
			['Otras retenciones aplicables el 8%','8','345','345','1'],
			['Otras retenciones aplicables a otros porcentajes ','varios porcentajes','346','346','1'],
			['Otras ganancias de capital distintas de enajenación de derechos representativos de capital','varios porcentajes','346','346A','1'],
			['Donaciones en dinero-Impuesto a la donaciones','Según art 36 LRTI literal d)','346','346B','0'],
			['Retención a cargo del propio sujeto pasivo por la exportación de concentrados y/o elementos metálicos','0 ó 10','346','346C','0'],
			['Retención a cargo del propio sujeto pasivo por la comercialización de productos forestales','0 ó 10','346','346D','0'],
			['Impuesto único a ingresos provenientes de actividades agropecuarias en etapa de producción / comercialización local o exportación','1','348','348','1'],
			['Pago a no residentes-Rentas Inmobiliarias','25 ó 35','411.422.432','500','0'],
			['Pago a no residentes-Beneficios/Servicios  Empresariales','25 ó 35','411.422.432','501','0'],
			['Pago a no residentes-Servicios técnicos, administrativos o de consultoría y regalías','25 ó 35','410,421,431','501A','0'],
			['Pago a no residentes-Navegación Marítima y/o aérea','0 ó 25 ó 35','411.422.432','503','0'],
			['Pago a no residentes-Dividendos distribuidos a personas naturales (domicilados o no en paraiso fiscal) o a sociedades sin beneficiario efectivo persona natural residente en Ecuador','0','405.416.426','504','1'],
			['Pago al exterior-Dividendos a sociedades con beneficiario efectivo persona natural residente en el Ecuador (no domiciliada en paraísos fiscales o regímenes de menor imposición) / o incumpliendo el deber de informar la composición societaria','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos / Diferencia entre tarifas naturales y sociedades sin que exceda el 10%','406.417','504A','0'],
			['Pago a no residentes-Dividendos a fideicomisos con beneficiario efectivo persona natural residente en el Ecuador (no domiciliada en paraísos fiscales o regímenes de menor imposición) /o incumpliendo el deber de informar la composición societaria','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos / Diferencia entre tarifas naturales y sociedades sin que exceda el 10%','407.418','504B','0'],
			['Pago a no residentes-Dividendos a sociedades domiciladas en paraísos fiscales o regímenes de menor imposición (con beneficiario efectivo persona natural residente en el Ecuador)','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos','427','504C','0'],
			['Pago a no residentes-Dividendos a fideicomisos domiciladas en paraísos fiscales o regímenes de menor imposición (con beneficiario efectivo persona natural residente en el Ecuador)','según art 36 LRTI literal a) y  deducción de créditos tributarios por dividendos','428','504D','0'],
			['Pago a no residentes-Anticipo dividendos (no domiciliada en paraísos fiscales o regímenes de menor imposición)','22 ó 25','404.415','504E','0'],
			['Pago a no residentes-Anticipo dividendos (domiciliadas en paraísos fiscales o regímenes de menor imposición)','22, 25 ó 28','425','504F','0'],
			['Pago a no residentes-Préstamos accionistas, beneficiarios o partìcipes (no domiciladas en paraísos fiscales o regímenes de menor imposición)','22 ó 25','404.415','504G','0'],
			['Pago a no residentes-Préstamos accionistas, beneficiarios o partìcipes (domiciladas en paraísos fiscales o regímenes de menor imposición)','22, 25 ó 28','425','504H','0'],
			['Pago a no residentes-Préstamos no comerciales a partes relacionadas  (no domiciladas en paraísos fiscales o regímenes de menor imposición)','22 ó 25','404.415','504I','0'],
			['Pago a no residentes-Préstamos no comerciales a partes relacionadas  (domiciladas en paraísos fiscales o regímenes de menor imposición)','22, 25 ó 28','425','504J','0'],
			['Pago a no residentes-Rendimientos financieros','25 ó 35','411.422.432','505','0'],
			['Pago a no residentes – Intereses de créditos de Instituciones Financieras del exterior','0 ó 25','403,414,424','505A','0'],
			['Pago a no residentes – Intereses de créditos de gobierno a gobierno','0 ó 25','403,414,424','505B','0'],
			['Pago a no residentes – Intereses de créditos de organismos multilaterales','0 ó 25','403,414,424','505C','0'],
			['Pago a no residentes-Intereses por financiamiento de proveedores externos','25','402,413,424','505D','1'],
			['Pago a no residentes-Intereses de otros créditos externos','25','411.422.432','505E','1'],
			['Pago a no residentes-Otros Intereses y Rendimientos Financieros','25 ó 35','411.422.432','505F','0'],
			['Pago a no residentes-Cánones, derechos de autor,  marcas, patentes y similares','25 ó 35','411.422.432','509','0'],
			['PPago a no residentes-Regalías por concepto de franquicias','25 ó 35','411.422.432','509A','0'],
			['Pago a no residentes-Otras ganancias de capital distintas de enajenación de derechos representativos de capital','5, 25, 35','411.422.432','510','0'],
			['Pago a no residentes-Servicios profesionales independientes','25 ó 35','411.422.432','511','0'],
			['Pago a no residentes-Servicios profesionales dependientes','25 ó 35','411.422.432','512','0'],
			['Pago a no residentes-Artistas','25 ó 35','411.422.432','513','0'],
			['Pago a no residentes-Deportistas','25 ó 35','411.422.432','513A','0'],
			['Pago a no residentes-Participación de consejeros','25 ó 35','411.422.432','514','0'],
			['Pago a no residentes-Entretenimiento Público','25 ó 35','411.422.432','515','0'],
			['Pago a no residentes-Pensiones','25 ó 35','411.422.432','516','0'],
			['Pago a no residentes-Reembolso de Gastos','25 ó 35','411.422.432','517','0'],
			['Pago a no residentes-Funciones Públicas','25 ó 35','411.422.432','518','0'],
			['Pago a no residentes-Estudiantes','25 ó 35','411.422.432','519','0'],
			['Pago a no residentes-Pago a proveedores de servicios hoteleros y turísticos en el exterior','25 ó 35','411.422.432','520A','0'],
			['Pago a no residentes-Arrendamientos mercantil internacional','0, 25, 35','411.422.432','520B','0'],
			['Pago a no residentes-Comisiones por exportaciones y por promoción de turismo receptivo','0, 25, 35','411.422.432','520D','0'],
			['Pago a no residentes-Por las empresas de transporte marítimo o aéreo y por empresas pesqueras de alta mar, por su actividad.','0','411.422.432','520E','1'],
			['Pago a no residentes-Por las agencias internacionales de prensa','0, 25, 35','411.422.432','520F','0'],
			['Pago a no residentes-Contratos de fletamento de naves para empresas de transporte aéreo o marítimo internacional','0, 25, 35','411.422.432','520G','0'],
			['Pago a no residentes-Enajenación de derechos representativos de capital u otros derechos que permitan la exploración, explotación, concesión o similares de sociedades','1, 10','408.419.429','521','0'],
			['Pago a no residentes-Seguros y reaseguros (primas y cesiones)','0, 25, 35','409,420,430','523A','0'],
			['Pago a no residentes-Donaciones en dinero-Impuesto a la donaciones','Según art 36 LRTI literal d)','411.422.432','525','0'],
        );
		$n=0;		
		for($i=0;$i<count($codigos);$i++){
			//echo $codigos[$i][0].' '.$codigos[$i][1].' '.$codigos[$i][2].' '.$codigos[$i][3].' '.$codigos[$i][4].'                           ';
			//echo $n++.':'.intval($codigos[$i][1]).'              ';
			$n++;
			$estado='';
			$porcentajes='';
			if(intval($codigos[$i][1])==0){
				$estado=0;
			}else{
				$estado=1;
			}

			\DB::table('codigos_retenciones')->insert(array(
	                'detalle'           =>  $codigos[$i][0],
	                'porcentajes'       =>  $codigos[$i][1],
	                'campo_formulario'  =>  $codigos[$i][2],
	                'codigo_anexo'      =>  $codigos[$i][3],
	                'activo'        	=>  $estado,
	                'fecha_inicio'   	=>  '2020-01-01',
	                'fecha_fin'         =>  ''
	            ));
		}
		
		/*
			['NOMBRE','CODIGO','PORCENTAJE','ACTIVO','FECHA_INICIO','FECHA_FIN']
		*/
		$codigos_iva=array(
			['Retencion del 10%','9','10','1','',''],
			['Retencion del 20%','10','20','1','',''],
			['Retencion del 30%','1','30','1','',''],
			['Retencion del 50%','11','50','1','',''],
			['Retencion del 70%','2','70','1','',''],
			['Retencion del 100%','3','100','1','',''],
			['Retencion del 0%','7','0','1','',''],
			['Retencion del 0%','8','0','1','',''],
		);
		for($i=0;$i<count($codigos_iva);$i++){
			\DB::table('codigos_iva')->insert(array(
	                'nombre'           =>  $codigos_iva[$i][0],
	                'codigo'       =>  $codigos_iva[$i][1],
	                'porcentaje'  =>  $codigos_iva[$i][2],
	                'activo'        	=>  $codigos_iva[$i][3],
	                'fecha_inicio'   	=>  '',
	                'fecha_fin'         =>  ''
	            ));	
		}


    }
}
