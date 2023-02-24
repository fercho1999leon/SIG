<?php

namespace App\Http\Controllers;

use App\Parcial;
use Illuminate\Http\Request;

class ParcialController extends Controller
{
    public function edit()
    {
        $configuracion = Parcial::getParcial();
        return view('UsersViews.administrador.configuraciones.configuracionesParcial.index', compact('configuracion'));
    }

    public function update(Request $request, $id)
    {
        $actualizacion = Parcial::findOrFail($id);
        /*Primer Quimestre*/
        $actualizacion->p1q1FI = $request->p1q1FI;
        $actualizacion->p1q1FF = $request->p1q1FF;
        $actualizacion->p2q1FI = $request->p2q1FI;
        $actualizacion->p2q1FF = $request->p2q1FF;
        $actualizacion->p3q1FI = $request->p3q1FI;
        $actualizacion->p3q1FF = $request->p3q1FF;
        $actualizacion->exq1FI = $request->exq1FI;
        $actualizacion->exq1FF = $request->exq1FF;
        /*Segundo Quimestre*/
        $actualizacion->p1q2FI = $request->p1q2FI;
        $actualizacion->p1q2FF = $request->p1q2FF;
        $actualizacion->p2q2FI = $request->p2q2FI;
        $actualizacion->p2q2FF = $request->p2q2FF;
        $actualizacion->p3q2FI = $request->p3q2FI;
        $actualizacion->p3q2FF = $request->p3q2FF;
        $actualizacion->exq2FI = $request->exq2FI;
        $actualizacion->exq2FF = $request->exq2FF;

        $actualizacion->save();
        return redirect()->route('configuraciones');
    }

    public static function getParcial($idPeriodoLectivo)
    {
        return Parcial::getParcialByPeriodo($idPeriodoLectivo);
    }

}
