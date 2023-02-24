<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\PagoProveedor;
use App\Retencion;
use App\CodigoRetencion;
use App\CodigoIva;

class ProveedorController extends Controller
{
    public function index(){
        $cont = 1;
        $proveedores = Proveedor::all();
    	return view('UsersViews.administrador.proveedores.registro.index', compact('cont','proveedores'));
    }

    public function registros_consultas(){ 
    	return view('UsersViews.administrador.proveedores.registro.index');
    }

    public function crear_proveedor(){
    	return view('UsersViews.administrador.proveedores.registro.crear');
    }

    public function editar_proveedor(){
    	return view('UsersViews.administrador.proveedores.registro.editar');
    }

    /**
        PAGOS
    **/
    public function pagos(){
        $cont=1;
        $proveedores=Proveedor::all();
        $pagos_proveedores= PagoProveedor::all();
        return view('UsersViews.administrador.proveedores.pagos.index',compact('pagos_proveedores','cont','proveedores'));
    }

    public function crear_transaccion_pago(){
        return view('UsersViews.administrador.proveedores.pagos.crear');
    }


    /**
        Retenciones
    **/
    public function retenciones(){
        $cont=1;
        $proveedores=Proveedor::all();
        $pagos_proveedores= PagoProveedor::all();
        $retenciones=Retencion::all();
        
    	return view('UsersViews.administrador.proveedores.retenciones.index',compact('cont','proveedores','pagos_proveedores','retenciones'));
    }

    public function crear_retencion(){
        $proveedores=Proveedor::all();
        $pagos=PagoProveedor::all();
        $codigos_retenciones=CodigoRetencion::all();
        $codigos_iva=CodigoIva::all();
        return view('UsersViews.administrador.proveedores.retenciones.crear',compact('pagos','proveedores','codigos_retenciones','codigos_iva'));
    }

    public function store_retencion(Request $request){
        //return $request;
        $cedula_ruc='0941773905';
        $numero_retencion=1001;
        $proveedor=Proveedor::find(1);
        $correo='soporte@pined.ec';
        $telefono='0999609552';
        $fuente=1;
        $iva=0;
        ComprobantesElectronicosController::generarRetencion($cedula_ruc,$numero_retencion,$proveedor,$correo,$telefono,$fuente,$iva);
        return "Hola";
    }

}
