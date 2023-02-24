<?php

namespace App\Http\Controllers;

use App\LibroCategoria;
use Illuminate\Http\Request;

class LibroCategoriaController extends Controller
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
     * @param  \App\LibroCategoria  $libroCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(LibroCategoria $libroCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LibroCategoria  $libroCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroCategoria $libroCategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LibroCategoria  $libroCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroCategoria $libroCategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LibroCategoria  $libroCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroCategoria $libroCategoria)
    {
        //
    }

     public static function getCategoryByBook($book_id){
        return LibroCategoria::getCategoryByBook($book_id);
    }
}
