<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfiguracionSistema;
use App\Matter;
use App\Course;
use App\Student2;
use Illuminate\Support\Facades\Redirect;
use Exception;

class DHIController extends Controller
{
    public function index($parcial) {
		try {
			$cargo = 'administrador';
			$configuracionDHI = ConfiguracionSistema::configuracionDHI();
			if($configuracionDHI->valor == null)
				throw new Exception('Primero debe configurar DHI en la sección Configuraciones Generales');
			$regimen = ConfiguracionSistema::regimen();
			$coursesEI = Course::getCourse('EI');
			$coursesEGB = Course::getCourse('EGB');
			$coursesBGU = Course::getCourse('BGU');
		} catch (\Exception $e) {
			return Redirect::back()->withErrors(['error' => 'Error: '.$e->getMessage()]);
		}

    	return view('UsersViews.administrador.grados.dhi.index', compact(
			'regimen', 'coursesEI', 'coursesEGB', 'coursesBGU', 'configuracionDHI', 'parcial', 'cargo'
		));
    }

    public function curso($parcial, Course $course) {
    	try {
			$habilidades = [
				'Inicial 2' => 'Autoconocimiento',
				'Primero' => 'Autoconocimiento',
				'Segundo' => 'Empatía',
				'Tercero' => 'Empatía',
				'Cuarto' => 'Empatía',
				'Quinto' => 'Manejo de emociones',
				'Sexto' => 'Manejo de emociones',
				'Septimo' => 'Manejo de emociones',
				'Octavo' => 'Resolución de conflictos',
				'Noveno' => 'Resolución de conflictos',
				'Decimo' => 'Resolución de conflictos',
				'Primero de Bachillerato' => 'Toma de decisiones',
				'Segundo de Bachillerato' => 'Toma de decisiones',
				'Tercero de Bachillerato' => 'Toma de decisiones',
			];
			foreach ($habilidades as $grado => $habilidad) {
				if (strtoupper($grado) == strtoupper($course->grado)) {
					$habilidad = $habilidad;
					break;
				}
			}
            $subject = Matter::query()
                ->where('nombre', 'DESARROLLO HUMANO INTEGRAL')
                ->where('idCurso', $course->id)
                ->first();
    		return view('layouts.modals.dhi', compact(
				'subject', 'course', 'habilidad', 'parcial'
			));
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Error: '.$e->getMessage()]);
        }
	}

	public function storeParcial(Request $request,$parcial, Course $course) {
		try {
			$materia = Matter::query()
                ->where('nombre', 'DESARROLLO HUMANO INTEGRAL')
                ->where('idCurso', $course->id)
                ->first();
			if ($materia == null) {
				throw new Exception('No existe la materia Desarrollo Humano Integral.');
			}

			$materia[$parcial] = $request->habilidad;
			$materia->observacion = $request->observacion;
			$materia->save();

			return back();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	// Controladores Docente
	public function docenteIndex($parcial) {
		try {
			$cargo = 'docente';
            $configuracionDHI = ConfiguracionSistema::configuracionDHI();
			if($configuracionDHI->valor == null)
				throw new Exception('Primero debe configurar DHI en la sección Configuraciones Generales');
			$regimen = ConfiguracionSistema::regimen();
			$coursesEI = Course::where('seccion', 'EI')
				->where('idProfesor',session('user_data')->id)// se cambio iduser
				->where('idPeriodo', $this->idPeriodoUser())
				->get();
			$coursesEGB = Course::where('seccion', 'EGB')
				->where('idProfesor',session('user_data')->id)
				->where('idPeriodo', $this->idPeriodoUser())
				->get();
			$coursesBGU = Course::where('seccion', 'BGU')
				->where('idProfesor',session('user_data')->id)
				->where('idPeriodo', $this->idPeriodoUser())
				->get();
		} catch (\Exception $e) {
			return Redirect::back()->withErrors(['error' => 'Error: '.$e->getMessage()]);
		}
    	return view('UsersViews.administrador.grados.dhi.index', compact(
			'regimen', 'coursesEI', 'coursesEGB', 'coursesBGU', 'configuracionDHI', 'parcial', 'cargo'
		));
    }
}
