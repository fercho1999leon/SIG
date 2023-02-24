<?php

use Illuminate\Database\Seeder;
use App\Proveedor;
use App\PagoProveedor;
use App\Retencion;

class RetencionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
			Se registran 5 proveedores.
        */
		$proveedores = array(
			['Activo','0941773905','DARWIN JAVIER','LEON RAMOS','2 524 000','GUAYAS','DURAN','DURAN','darwin@pined.com',0,	   'Natural',0,'0941773905001','PINED S.A.',0,0,     		null,null,''],
			['Activo','0941773901','CRISTHIAN GUILLERMO','ZAMBRANO NAVARRETE','2 524 000','GUAYAS','DURAN','DURAN','c_z@pined.com',0,	   'Natural',0,'0941773901001','PINED S.A.',0,0,     		null,null,''],
			['Activo','0941773902','HECTOR ALFREDO','FUENTES MONTENEGRO','2 524 000','GUAYAS','DURAN','DURAN','h_f@pined.com',0,	   'Natural',0,'0941773902001','PINED S.A.',0,0,     		null,null,''],
			['Activo','0941773903','MIGUEL VINICIO','BONIFAZ','2 524 000','GUAYAS','DURAN','DURAN','m_b@pined.com',0,	   'Natural',0,'0941773903001','PINED S.A.',0,0,     		null,null,''],
			['Activo','0941773904','DAVID JOSUE','SALAZAR','2 524 000','GUAYAS','DURAN','DURAN','d_z@pined.com',0,	   'Natural',0,'0941773904001','PINED S.A.',0,0,     		null,null,''],
		);
		
		for($i=0;$i<count($proveedores);$i++){
			Proveedor::create([
				//Datos
					'estado' 					=> $proveedores[$i][0],
					'cedula' 					=> $proveedores[$i][1],
					'nombres' 					=> $proveedores[$i][2],
					'apellidos'					=> $proveedores[$i][3],
					'telefonos'					=> $proveedores[$i][4],
					'provincia' 				=> $proveedores[$i][5],
					'ciudad' 					=> $proveedores[$i][6],
					'direccion' 				=> $proveedores[$i][7],
					'email'						=> $proveedores[$i][8],
					'extranjero'				=> 0,
				//Datos comerciales
					'tipo' 						=> 'Natural',
					'contribuyente_especial' 	=> 0,
					'ruc' 						=> '0941773900001',
					'nombre_comercial'			=> 'PINED S.A.K',
					'cia_relacionada' 			=> 0,
					'artesano'					=> 0,
				//Retenciones(no vamos a usarlo) 	
					'ret_ir' 					=> null,
					'ret_iva'					=> null,
					'descuento'        			=> '',

	        ]);
		}
		

		/*
			Se registran 10 pagos
		*/	
		$pagos = array(
			['PAGO','EFECTIVO','2020/03/24',2,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',100],
			['PAGO','EFECTIVO','2020/03/24',2,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',110],
			['PAGO','EFECTIVO','2020/03/24',3,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',120],
			['PAGO','EFECTIVO','2020/03/24',3,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',125],
			['PAGO','EFECTIVO','2020/03/24',3,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',150],
			['PAGO','EFECTIVO','2020/03/24',4,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',160],
			['PAGO','EFECTIVO','2020/03/24',4,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',175],
			['PAGO','EFECTIVO','2020/03/24',4,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',200],
			['PAGO','EFECTIVO','2020/03/24',5,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',205],
			['PAGO','EFECTIVO','2020/03/24',5,'','','REALIZACIÓN DE PAGOS A PROVEEDORES.',210],
		);	
		/*
			EFECTIVO,DEPOSITO,TRANSFERENCIA,CHEQUE,TARJETA DEBITO,TARJETA CREDITO
		*/
		for($i=0;$i<count($pagos);$i++){
			PagoProveedor::create([
				//Transaccion
					'tipo_de_transaccion' 	=> $pagos[$i][0],
					'forma_de_pago' 		=> $pagos[$i][1],
					'fecha_de_emision' 		=> $pagos[$i][2], 
				//Proveedor
					'id_proveedor' 			=> $pagos[$i][3], 
				//Detalles pago
					'cuenta_bancaria' 		=> '', 
					'numero_cheque'			=> '', 
					'descripcion'			=> $pagos[$i][6],
					'total'					=> $pagos[$i][7],
					'plazo'					=> '',
					'unidad_tiempo'			=> '',

	        ]);
		}	
	

		/*
			Se registro 3 retenciones
		 	
		$retenciones = array(
			['2','2','2020/03/24',150,],
			['3','3','2020/03/24',200,],
			['5','4','2020/03/24',250,],
		);
		for($i=0;$i<count($retenciones);$i++){
			Retencion::create([
				//Pago vinculado
					'id_pagos_realizados'	=> 
				//Proveedor con quien esta vinculado el pago 	
					'id_proveedores' 		=> 
					'fecha_emision' 		=> 
					'neto'					=> 
				//Valores a retener 	
					'retencion_fuente' 	  	=>0 
					'retencion_iva' 		=>0
				//Totales y cancelar
					'total' 				=> 
					'retenido' 				=> 
					'saldo' 				=> 
				//Factura con la que esta vinculada
					'numero_documento' 		=> 
					'autorizacion'		 	=> 
	        ]);
		}

		*/



    }
}
