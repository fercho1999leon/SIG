<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/datosTrasact/{id}','AcademicRequestsController@get')->name('datosTransact');
Route::get('/docentesPorCarrera/{id}','QualificationController@docentesPorCarrera')->name('docentesPorCarrera');
Route::get('/semestresPorCarrera/{id}','QualificationController@semestresPorCarrera')->name('semestresPorCarrera');
Route::get('/matriasPorSemestre/{id}','QualificationController@matriasPorSemestre')->name('matriasPorSemestre');
Route::get('/cursoPorSemestre/{id}','QualificationController@cursoPorSemestre')->name('cursoPorSemestre');
Route::get('/postAccedeParalelos/{id}','QualificationController@postAccedeParalelos')->name('postAccedeParalelos');
Route::get('/postAccedeCurso/{id}','QualificationController@postAccedeCurso')->name('postAccedeCurso');
Route::get('/postAccedeMateria/{id}','QualificationController@postAccedeMateria')->name('postAccedeMateria');
Route::get('/idDocenteMateria/{id}','QualificationController@idDocenteMateria')->name('idDocenteMateria');
