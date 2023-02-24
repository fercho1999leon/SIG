<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Matter;
use Sentinel;
use App\User;
use App\Supply;
use Illuminate\Support\Facades\DB;
use App\Parameters\General;

class SupplyController extends Controller
{
    public function getaddInsumo(Request $request, Matter $matter)
    {
    	return view('layouts.modals.InsumoCrear', compact('matter'));
    }

    public function postaddInsumo(Request $request)
    {
        $request->request->add(['idPeriodo'=> $this->idPeriodoUser()]);
    	$this->validate($request,[
    		'idMateria' => 'required|exists:matters,id',
    		'idCurso'	=>	'required|exists:courses,id',
            'porcentaje'   =>  'sometimes|digits_between:1,3',
    	]);
    	if(isset($request->idDocente))
    		$this->validate($request,[
    		'idDocente' => 'exists:users,id',
    	]);
        try {
       $ins_mat = Supply::getSuppliesByMatter($request->idMateria)->pluck('porcentaje')->toArray();
        $cienXciento = array_sum($ins_mat) + $request->porcentaje ;
        if($cienXciento > 100){
            return '<div class="alert alert-danger" role="alert">"Error: La suma de los insumos debe ser igual a 100."</div>';
        }
    		$supply = Supply::create($request->all());
    		 return '<div class="alert alert-success" role="alert">Insumo Creado con exito.</div>';
    	} catch (Exception $e) {
    		return view('layouts.messages')->with('message', [
                'type' => 'danger', 'text' => "Algo salió mal."
            ]);
    	}
    }

    public function deleteInsumo(Request $request,Supply $supply)
    {
    	try {
    		 $supply->delete();
    		 DB::commit();
    		 return '<div class="alert alert-info" role="alert">Insumo Eliminado con exito.</div>';

    	} catch (Exception $e) {
    		return view('layouts.messages')->with('message', [
                'type' => 'danger', 'text' => "Algo salió mal."
            ]);
    	}
    }

    public function showListInsumos(Matter $matter)
    {
    	return view('layouts.modals.ShowInsumos', compact('matter'));
    }

    public function putInsumo(Request  $request,Supply $supply)
    {

    	$supply->update($request->all());
    	 return '<div class="alert alert-success" role="alert">Insumo Actualizado con exito.</div>';
    }

    public function showInsumo(Supply $supply)
    {
    	return view('layouts.modals.InsumoEditar',compact('supply'));
    }
    public function confInsumoSeccion($seccion)
    {
        $cursos = Course::getCourse($seccion)->pluck('id');
        $supply = Supply::getSuppliesBySeccion($seccion)->groupBy('nombre')->get();
       // dd($supply);
        $supply2 = Supply::getSuppliesBySeccion($seccion)->select('nombre','idCurso','idMateria', DB::raw('count(*) as total'))
                 ->groupBy('nombre')
                 ->get();
        $materias = Matter::wherein('idCurso', $cursos)->get();
       // dd($materias->sortBy('idCurso'));
            foreach ($materias->sortBy('idCurso') as $materia) {
                foreach ($supply as $nombreSupply) {
                $existe = Supply::where('idMateria',$materia->id)->where('nombre', $nombreSupply->nombre)->exists();

                    if(!$existe){
                        $curso = Course::findOrFail($materia->idCurso);

                        $output ='<div class="alert alert-danger" role="alert"><ul>Resumen Insumos Totales de la Sección:';
                        foreach($supply2 as $sup){
                        $curso = Course::findOrFail($sup->idCurso);
                        $materia = Matter::findOrFail($sup->idMateria);
                        $output .= '<li>('.$sup->total.')-'.$sup->nombre.', nombre del curso: '.$curso->grado.' '.$curso->paralelo.', materia: '.$materia->nombre.'</li>';
                        }
                        $output .= '</ul></div>';
                        return  $output;
                    }
                }
            }
        return view('layouts.modals.ConfiguracionInsumos',compact('supply','seccion'));
    }
     public function actInsSeccion(Request $request)
    {
        if (array_sum($request->porcentaje)!=100 ) {
           return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "La suma de los insumos debe ser igual a 100." ]);
        }
        try {
           $supply = Supply::getSuppliesBySeccion($request->seccion)->get();
           foreach ($request->nombre_old as $key => $nombre) {
            $insumo = $supply->where('nombre',$nombre);
            if ($insumo!=null) {
                foreach ($insumo as $ins) {
                   $ins = Supply::findOrFail($ins->id);
                   $ins->nombre     = $request->nombre[$key];
                   $ins->porcentaje = $request->porcentaje[$key];
                   $ins->save();
                }
            }
           }
        return redirect()->back()->with('message', ['type'=> 'success', 'text' =>  "Insumos Actualizados" ]);
        } catch (Exception $e) {
          return redirect()->back()->with('message', ['type'=> 'danger', 'text' => "Ocurrió un error comuniquerse con el administrador." ]);
        }
    }
}
