<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student2;
use App\User;

class Parents extends Model
{
	protected $table = 'datospadres';
	protected $guarded = [];
	public function scopeSearch($query, $search) {
		$query->when($search, function($query, $search) {
			$query->where('nombres', 'like', "%{$search}%")
			->orWhere('apellidos', 'like', "%{$search}%");
		});
	}
    public static function representantes($idCurso){
    	$representantes = [];
    	$students = Student2::where('idCurso', $idCurso)->get();

    	foreach($students as $student){
    		echo $student->id.':'.$student->idRepresentante.'-';
    		$r = Parents::find($student->idRepresentante);
    		array_push($representantes, $student->idRepresentante);
    	}
    	return $students;
    	//Join que muestre el arreglo de los representantes
	}
	
    public static function padres($idCurso){
    	$padres = [];
    	$students = Student2::where('idCurso', $idCurso)->get();
        
    	foreach($students as $student){
    		//echo $student->id.':'.$student->idPadre.'-';

            if($student->idPadre==null){
                array_push($padres, 0);
            }else{
                $p = Parents::find($student->idPadre);
                array_push($padres, $p);
            }
    	}
    	return $padres;
    }

    public static function madres($idCurso){
    	$madres = [];
    	$students = Student2::where('idCurso', $idCurso)->get();

    	foreach($students as $student){
    		//echo $student->id.':'.$student->idMadre.'-';
    		if($student->idMadre==null){
                array_push($madres, 0);
            }else{
                array_push($madres, $student->idMadre);
            }
    	}
    	return $madres;
    }



    public static function representante($idEstudiante){
    	
    }

    public static function padre($idEstudiante){

    }

    public static function madre($idEstudiante){

    }
}
