<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuntaDeCursoController extends Controller
{
    public function junta(){
    	return view('UsersViews.administrador.juntaDeCurso.juntadecurso');
    }

    public function junta_PDF(){
		return view('pdf.junta-de-curso', compact('p'));
	}

	public function lista_docentes(){
		return view('UsersViews.administrador.juntaDeCurso.listaDocentes');
	}
    
    public function resoluciones_anteriores(){
		return view('UsersViews.administrador.juntaDeCurso.resolucionesAnteriores');
	}

	public function orden_del_dia(){
		return view('UsersViews.administrador.juntaDeCurso.ordenDelDia');
	}

	public function rendimiento_quimestral(){
		return view('UsersViews.administrador.juntaDeCurso.rendimientoQuimestral');
	}

	public function informe_asistencia(){
		return view('UsersViews.administrador.juntaDeCurso.informeAsistencia');
	}

	public function promedio_materias(){
		return view('UsersViews.administrador.juntaDeCurso.promedioMaterias');
	}

	public function cuadro_de_honor(){
		return view('UsersViews.administrador.juntaDeCurso.cuadroDeHonor');
	}

	public function notas_faltantes(){
		return view('UsersViews.administrador.juntaDeCurso.notasFaltantes');
	}

	public function resoluciones(){
		return view('UsersViews.administrador.juntaDeCurso.resoluciones');
	}
}
