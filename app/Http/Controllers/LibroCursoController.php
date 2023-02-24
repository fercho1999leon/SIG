<?php

namespace App\Http\Controllers;

use App\LibroCurso;
use App\Career;
use App\Course;
use App\Semesters;
use App\User;
use Illuminate\Http\Request;
use Sentinel;
use Carbon\Carbon;

class LibroCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        try {
            $carreras = Career::all()->where('estado', '1');
            $cursos = Course::all();
            $semestres = Semesters::all();
            return view('UsersViews.administrador.biblioteca.libros_curso.index', compact('carreras','cursos', 'semestres'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if($request!=null){
                    $libro_curso = new LibroCurso;
                    $libro_curso->curso_id = $request->input('curso');
                    $libro_curso->libro_id = $request->input('libro');
                    $libro_curso->save();
                return redirect()->route('indexLibrosCurso')->with('message', '¡Agregado Correctamente!')->with('type','success');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LibroCurso  $libroCurso
     * @return \Illuminate\Http\Response
     */
    public function show(LibroCurso $libroCurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LibroCurso  $libroCurso
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroCurso $libroCurso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LibroCurso  $libroCurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroCurso $libroCurso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LibroCurso  $libroCurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroCurso $libroCurso)
    {
        //
    }

    public static function getCourseByBook($book_id){
        return LibroCurso::getCourseByBook($book_id);
    }
}
