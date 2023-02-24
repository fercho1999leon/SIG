<?php

namespace App\Http\Controllers;

use App\LibroAutor;
use Illuminate\Http\Request;

class LibroAutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LibroAutor  $libroAutor
     * @return \Illuminate\Http\Response
     */
    public function show(LibroAutor $libroAutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LibroAutor  $libroAutor
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroAutor $libroAutor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LibroAutor  $libroAutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroAutor $libroAutor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LibroAutor  $libroAutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroAutor $libroAutor)
    {
        //
    }

    public static function getAuthorByBook($book_id){
        return LibroAutor::getAuthorByBook($book_id);
    }
}
