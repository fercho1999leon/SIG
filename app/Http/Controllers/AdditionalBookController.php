<?php

namespace App\Http\Controllers;

use App\AdditionalBook;
use App\BooksAreaGrade;
use App\Course;
use App\Area;
use App\Http\Requests\AdditionalBookRequest;
use App\Institution;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Sentinel;
use App\User;
use App\Student2Profile;

class AdditionalBookController extends Controller
{
    public function index() {
		$areas = Area::where('idPeriodo',$this->idPeriodoUser())->get();
		$booksGrade = BooksAreaGrade::where('idPeriodo',$this->idPeriodoUser())->get();
		$books = AdditionalBook::where('idPeriodo',$this->idPeriodoUser())->get();
		return view('UsersViews.administrador.librosAdicionales.index', compact(
			'books','areas','booksGrade'
		));
	}

	public function store(AdditionalBookRequest $request) {
		try {
			$nombreAdjunto = null;
			if ($request->hasFile('portada')) {
				$nombreAdjunto = request()->portada->getClientOriginalName();
				request()->portada->storeAs('public/adjuntos', $nombreAdjunto);
			}
			$institution = Institution::first();
			$libro = AdditionalBook::create([
				'nombre' => $request->nombre,
				'descripcion' => $request->descripcion,
				'enlace' => $request->enlace,
				'idPeriodo' => $this->idPeriodoUser(),
				'portada' => $nombreAdjunto ?? null
			]);
			BooksAreaGrade::create([
				'idAdditionalBook' => $libro->id,
				'grado' => $request->grado,
				'idArea' => $request->area,
				'idPeriodo' => $this->idPeriodoUser()
			]);

			return back();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function edit(AdditionalBook $book) {
		return view('partials.librosAdicionales.modalEditar', compact(
			'book'
		));
	}

	public function update(AdditionalBook $book, AdditionalBookRequest $request) {
		$nombreAdjunto = null;
		$book->update($request->all());
		if ($request->hasFile('portada')) {
			$nombreAdjunto = request()->portada->getClientOriginalName();
			request()->portada->storeAs('public/adjuntos', $nombreAdjunto);
			$book->portada = $nombreAdjunto;
			$book->save();
		}
		return back();
	}

	public function destroy(AdditionalBook $book) {
		$book->delete();
		return back();
	}

	// Representante
	public function indexRep() {
		$books = AdditionalBook::allBooks();
		return view('UsersViews.representante.librosAdicionales.index', compact(
			'books'
		));
	}

	// Estudiante
	public function indexEst() {
		$user_profile = User::where('userid', Sentinel::getUser()->id)->first();
		$student = Student2Profile::getStudent($user_profile->profileStudent->id);
		$course = Course::findOrFail($student->idCurso);
		$booksGrade = BooksAreaGrade::where(['idPeriodo'=>$this->idPeriodoUser(),'grado'=>$course->grado])->get();
		$books= collect(new AdditionalBook());
		foreach ($booksGrade as $bk) {
			$books->push(AdditionalBook::findOrFail($bk->idAdditionalBook));
		}
		return view('UsersViews.estudiante.librosAdicionales.index', compact(
			'booksGrade','books','course'
		));
	}


	// Docente
	public function indexDoc() {
		$areas = Area::where('idPeriodo',$this->idPeriodoUser())->get();
		$booksGrade = BooksAreaGrade::where('idPeriodo',$this->idPeriodoUser())->get();
		$courses = Course::getAllCourses();
		$books = AdditionalBook::where('idPeriodo',$this->idPeriodoUser())->get();
		return view('UsersViews.docente.librosAdicionales.index', compact(
			'areas','booksGrade','courses','books'
		));
	}
}
