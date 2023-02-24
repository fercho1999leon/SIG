<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class planificacionesController extends Controller
{
    public function home() {
		return view('UsersViews.administrador.planificaciones.index');
	}

    public function pci() {
		return view('UsersViews.administrador.planificaciones.pci');
	}

    public function pca() {
		return view('UsersViews.administrador.planificaciones.pca');
	}

	public function microplanificaciones() {
		//return 'Hola';
		return view('UsersViews.administrador.planificaciones.pca');
	}

    public function curso() {
		return view('UsersViews.administrador.planificaciones.curso.index');
	}

    public function documento() {
		return view('UsersViews.administrador.planificaciones.curso.documento');
	}


	/*
	Planificaciones Docente
	*/
	public function index_D() {
		$courses = Course::getAllCourses();
		return view('UsersViews.docente.planificaciones.index', 
		compact('courses'));
	}

	public function materias_D() {
		$courses = Course::getAllCourses();
		return view('UsersViews.docente.planificaciones.materia',
		compact('courses'));
	}

	public function documento_D() {
		$courses = Course::getAllCourses();
		return view('UsersViews.docente.planificaciones.documento',
		compact('courses'));
	}
	/**/


	/*
	Planificaciones Tutor
	*/
	public function home_Tutor() {
		$courses = Course::getAllCourses();
		return view('UsersViews.docente.tutoria.planificaciones.index', 
		compact('courses'));
	}
	/**/
}
